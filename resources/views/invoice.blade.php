<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>

    <style>

        body{
            font-family: Arial;
        }

        table{
            width:100%;
            border-collapse: collapse;
            margin-top:20px;
        }

        table, th, td{
            border:1px solid black;
        }

        th, td{
            padding:10px;
            text-align:left;
        }

    </style>

</head>
<body>

    <h2>Invoice</h2>

    <p>
        Order ID: {{ $order->id }}
    </p>

    <p>
        Customer ID: {{ $order->user_id }}
    </p>

    <p>
        Payment Status:
        {{ $order->payment_status }}
    </p>

    <table>

        <thead>

            <tr>

                <th>Product ID</th>

                <th>Quantity</th>

                <th>Price</th>

                <th>Total</th>

            </tr>

        </thead>

        <tbody>

            @foreach($order->products as $product)

                <tr>

                    <td>
                        {{ $product->product_id }}
                    </td>

                    <td>
                        {{ $product->quantity }}
                    </td>

                    <td>
                        {{ $product->price }}
                    </td>

                    <td>
                        {{ $product->quantity * $product->price }}
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <h3>
        Grand Total: {{ $order->amount }}
    </h3>

</body>
</html>