<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicines;
use App\Models\Billing;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Patients;
use App\Models\Service;

use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;


class BillingController extends Controller
{

    

public function generateCode()
{
    $randomNumber = mt_rand(1000000000, 9999999999); // Generate a 10-digit number
    $randomLetters = strtoupper(Str::random(2)); // Generate 2 random uppercase letters

    $code = $randomLetters . $randomNumber; // Combine letters and number

    return response()->json(['code' => $code]);
}


public function RetrieveAll()
{
    // Retrieve all transactions with related billing, patient, product, and service information
    $transactions = Billing::selectRaw('transactionId, billings.created_at, paymentStatus, paymentMethod, CONCAT(users.firstName, " ", users.lastName) as biller_info, GROUP_CONCAT(billingId) as billing_ids, patientId, SUM(cost*quantity) as total_cost')
        ->with('patient.doctor')
        ->join('users', 'users.id', '=', 'billings.billedBy')
        ->groupBy('transactionId', 'patientId', 'created_at', 'paymentStatus', 'paymentMethod', 'billedBy')
        ->orderBy('billings.created_at', 'desc')
        ->get();

    // Loop through each transaction and fetch associated transactions
    foreach ($transactions as $transaction) {
        $transaction->relatedTransactions = Billing::where('transactionId', $transaction->transactionId)
            ->with(['product', 'service'])
            ->get();
    }

    // Return the result with the related transactions
    if ($transactions->isEmpty()) {
        return response()->json(['message' => 'No transactions found'], 404);
    }

    return response()->json($transactions);
}



public function printBilling($transactionId)
{
    // Retrieve transaction details with patient, products, and services
    $transaction = Billing::selectRaw('transactionId, created_at, paymentStatus, paymentMethod, patientId, billedBy, SUM(cost*quantity) as grand_total')
        ->with(['patient.doctor', 'product', 'service', 'biller']) // Eager load relationships
        ->where('transactionId', $transactionId)
        ->groupBy('transactionId', 'patientId', 'billedBy', 'created_at', 'paymentStatus', 'paymentMethod')
        ->first();

    // Fetch all items (products/services) in the transaction
    $items = Billing::where('transactionId', $transactionId)
        ->with(['product', 'service'])
        ->get();

    // Generate PDF using a view
    $pdf = Pdf::loadView('pdf.billing_receipt', [
        'transaction' => $transaction,
        'items' => $items
    ]);

    // Return the PDF as a download
    // return $pdf->download('billing_receipt_' . $transactionId . '.pdf');
    // return $pdf->stream('billing_receipt_' . $transactionId . '.pdf');

}

public function updateBillingStatus(Request $request)
{
    // Validate input
    $request->validate([
        'transactionId' => 'required|string',
        'paymentMethod' => 'required|string',
        'paymentReference' => 'required|string',
    ]);

    // Find transactions
    $transactions = Billing::where('transactionId', $request->transactionId)->get();

    if ($transactions->isEmpty()) {
        return response()->json([
            'error' => 'Transactions not found',
        ], 404);
    }

    $updateData = [
        'paymentStatus'   => 'paid',
        'paymentDate'     => now(),
        'paymentMethod'   => $request->paymentMethod,
        'paymentReference'=> $request->paymentReference,
    ];

    // Update each record
    foreach ($transactions as $transaction) {
        $transaction->update($updateData);
    }

    return response()->json([
        'message' => 'Transactions updated successfully',
        'data'    => $transactions,
    ], 200);
}



    public function store(Request $request)
    {

        // return $userId = auth('api')->user()->id;
     // Generate a unique transaction ID
    $transactionId = strtoupper(Str::random(2)) . mt_rand(1000000000, 9999999999);

        // Validate incoming data
        $request->validate([
            'patientId'     => 'nullable',
            'items'         => 'nullable|array', // Ensure 'items' is an array
            'items.*.inventoryId' => 'nullable',
            'items.*.quantity'    => 'nullable|integer|min:1',
        ]);
    
        // Start a database transaction to ensure atomicity
        DB::beginTransaction();
    
        try {
            $billedItems = [];
    
            foreach ($request->items as $item) {
                if ($item['inventoryType'] === 'Products') {  // Ensure correct inventoryType
                    // Find the inventory item
                    $inventory = Inventory::find($item['inventoryId']);
    
                    if (!$inventory) {
                        // Rollback transaction if inventory is not found
                        DB::rollBack();
                        return response()->json(['message' => 'One or more inventory items not found'], 404);
                    }
    
                    // Ensure quantitySold is initialized to 0 if null
                    $inventory->quantitySold = $inventory->quantitySold ?? 0;
    
                    // Check stock availability
                    if ($inventory->quantityReceived < ($inventory->quantitySold + $item['quantity'])) {
                        DB::rollBack();
                        return response()->json(['message' => 'Insufficient stock for ' . $inventory->product->productName], 400);
                    }
    
                    // Handle products
                    $product = Product::find($item['productId']);
                    if (!$product) {
                        DB::rollBack();
                        return response()->json(['message' => 'Product not found'], 404);
                    }
    
                    $totalCost = $product->productCost * $item['quantity'];
    
                    $billing = Billing::create([
                        'transactionId' => $transactionId,
                        'patientId'     => $request->patientId,
                        'productId'     => $item['productId'],
                        'billingType'   => 'Product',
                        'categoryType'  => $item['categoryType'],
                        'inventoryId'   => $item['inventoryId'],
                        'quantity'      => $item['quantity'],
                        'cost'          => $totalCost,
                        'billedBy'      => auth('api')->user()->id,
                        'paymentStatus' => 'pending',
                    ]);
    
                    // Update inventory
                    $inventory->quantitySold += $item['quantity'];
                    $inventory->save();
                } 
                else { // This handles services
                    // Handle services
                    $service = Service::find($item['serviceId']);
                    if (!$service) {
                        DB::rollBack();
                        return response()->json(['message' => 'Service not found'], 404);
                    }
    
                    $totalCost = $service->serviceCost * $item['quantity'];
    
                    $billing = Billing::create([
                        'transactionId' => $transactionId,
                        'patientId'     => $request->patientId,
                        'serviceId'     => $item['serviceId'], // Fixed serviceId
                        'billingType'   => 'Service',
                        'categoryType'  => $item['categoryType'],
                        'quantity'      => $item['quantity'],
                        'cost'          => $totalCost,
                        'billedBy'      => auth('api')->user()->id,
                        'paymentStatus' => 'pending',
                    ]);
                }
    
                // Add billing item to array
                $billedItems[] = $billing;
            }
    
            // Commit transaction
            DB::commit();
    
            // Return success response
            return response()->json(['message' => 'Billing records created successfully', 'billings' => $billedItems], 201);
    
        } catch (\Exception $e) {
            // Rollback transaction on any exception
            DB::rollBack();
            return response()->json(['message' => 'Something went wrong. Please try again.', 'error' => $e->getMessage()], 500);
        }
    }
    

   
    public function update(Request $request, $billingId)
    {
        // Find the billing by ID
        $billing = Billing::find($billingId);
        if (!$billing) {
            return response()->json([
                'error' => 'Billing not found',
            ]); 
        }
    
        $data = $request->all();
        $billing->update($data);
        return response()->json([
            'message' => 'Billing updated successfully',
            'data' => $billing,
        ], 200);
    }

    public function deleteBilling($transactionId)
    {
        $deleted = Billing::where('transactionId', $transactionId)->delete();
    
        if ($deleted) {   
            return response()->json([
                'message' => 'Billing deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'error' => 'Billing not found',
            ], 404);
        }
    }
    
    
}
