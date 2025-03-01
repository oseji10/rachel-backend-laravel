<!DOCTYPE html>
<html>
<head>
    <title>Rachel Eye Clinic</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: left; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .center-text { text-align: center; }
    </style>
</head>
<body>

    <h1 class="center-text">Rachel Eye Clinic</h1>
    <h2 class="center-text">Billing Receipt</h2>

    <h3>Patient Details</h3>
    <p>Name: {{ $transaction->patient->firstName }} {{ $transaction->patient->lastName }} {{ $transaction->patient->otherNames }}</p>
    <p>Gender: {{ $transaction->patient->gender }}</p>
    <p>Phone Number: {{ $transaction->patient->phoneNumber }}</p>
    <p>Email: {{ $transaction->patient->email }}</p>

    <h3>Transaction Details</h3>
    <p><strong>Transaction ID:</strong> {{ $transaction->transactionId }}</p>
    <p><strong>Date:</strong> {{ $transaction->created_at }}</p>
    <p><strong>Payment Status:</strong> {{ $transaction->paymentStatus }}</p>
    <p><strong>Payment Method:</strong> {{ $transaction->paymentMethod }}</p>

    <h3>Purchased Items</h3>
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>
                        {{ $item->product->productName ?? $item->service->serviceName ?? 'N/A' }}
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->cost, 2) }}</td>
                    <td>{{ number_format($item->cost * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="center-text">Grand Total: N{{ number_format($transaction->grand_total, 2) }}</h3>

    <h5>Billed By: {{$transaction->biller->firstName ?? ""}} {{$transaction->biller->lastName ?? ""}}</h5>
</body>
</html>
