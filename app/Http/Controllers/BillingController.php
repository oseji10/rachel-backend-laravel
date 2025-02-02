<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicines;
use App\Models\Billing;
class BillingController extends Controller
{
    public function RetrieveAll()
    {
        $inventories = Billing::all();
        return response()->json($inventories);
       
    }

    public function store(Request $request)
    {
        
        $data = $request->all();
    
        
        $inventories = Billing::create($data);
    
       
        return response()->json($inventories, 201); 
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


    // Delete Billing
    public function deleteBilling($billingId){
        $billing = Billing::find($billingId);
    if ($billing) {   
    $billing->delete();
    return response()->json([
        'message' => 'Billing deleted successfully',
    ], 200);
    } else {
        return response()->json([
            'error' => 'Billing not found',
        ]);
    }
    }
    
}
