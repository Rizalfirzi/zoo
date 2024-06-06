<!DOCTYPE html>
<html>
<head>
    <title>Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1, h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Ticket Information</h1>
    <p><strong>Name:</strong> {{ $reservation->name }}</p>
    <p><strong>Email:</strong> {{ $reservation->email }}</p>
    
    <h2>Ticket Details</h2>
    <table>
        <thead>
            <tr>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach(json_decode($reservation->ticket_data, true) as $ticket)
            <tr>
                <td>{{ ucfirst($ticket['category']) }}</td>
                <td>{{ $ticket['quantity'] }}</td>
                <td>Rp.{{ $ticket['price'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Total Price: Rp.{{ $reservation->total_price }}</h2>

    <h2>Payment Method</h2>
    <p>Please transfer the total amount to the following bank account:</p>
    <p>Bank: Bank XYZ</p>
    <p>Account Number: 123456789</p>
    <p>Account Name: Your Name</p>
    <p>Amount: Rp.{{ $reservation->total_price }}</p>
    <p>After transfer, please confirm your payment by sending a WhatsApp message to <strong>08123456789</strong> with your name and payment details.</p>
</body>
</html>
