<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>

    <style>
        @page {
            margin: 12px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
            background: #eef2f7;
            color: #1f2937;
            font-size: 11px;
        }

        .main {
            width: 96%;
            background: #ffffff;
            border: 1px solid #dbe4ee;
            margin: 0 auto;
            padding: 18px;
        }

        .header {
            width: 100%;
        }

        .header td {
            vertical-align: top;
        }

        .logo {
            width: 50px;
            height: 50px;
        }

        .company-name {
            font-size: 22px;
            font-weight: bold;
            margin-top: 8px;
            color: #111827;
        }

        .company-text {
            color: #4b5563;
            line-height: 18px;
            font-size: 11px;
            margin-top: 5px;
        }

        .invoice-title {
            text-align: right;
            font-size: 32px;
            font-weight: bold;
            color: #111827;
        }

        .invoice-info {
            text-align: right;
            line-height: 22px;
            margin-top: 8px;
            font-size: 11px;
        }

        .status {
            display: inline-block;
            background: #dcfce7;
            color: #166534;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
            margin-top: 6px;
        }

        .billing-box {
            background: #f8fafc;
            border: 1px solid #dbe4ee;
            padding: 16px;
            margin-top: 20px;
        }

        .billing-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .billing-box p {
            margin: 6px 0;
            font-size: 11px;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 22px;
        }

        .product-table th {
            background: #1e293b;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 11px;
        }

        .product-table td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
            font-size: 10px;
        }

        .product-table tr:nth-child(even) {
            background: #f9fafb;
        }

        .product-name {
            font-size: 12px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 4px;
        }

        .product-detail {
            font-size: 10px;
            color: #6b7280;
            line-height: 16px;
        }

        .total-table {
            width: 260px;
            margin-top: 18px;
            margin-left: auto;
            border-collapse: collapse;
            border: 1px solid #dbe4ee;
            background: #f8fafc;
        }

        .total-table td {
            padding: 10px;
            font-size: 11px;
        }

        .grand-total td {
            font-size: 15px;
            font-weight: bold;
        }

        .thank-you {
            margin-top: 22px;
            text-align: center;
        }

        .thank-you h2 {
            margin-bottom: 5px;
        }

        .footer {
            margin-top: 15px;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
            line-height: 18px;
        }
    </style>

</head>

<body>

    <div class="main">

        <!-- HEADER -->

        <table class="header">

            <tr>

                <td width="60%">

                    <img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png" class="logo">

                    <div class="company-name">
                        Fashion Flow
                    </div>

                    <div class="company-text">
                        Ahmedabad, Gujarat <br>
                        support@fashionflow.com <br>
                        +91 9876543210
                    </div>

                </td>

                <td width="40%">

                    <div class="invoice-title">
                        INVOICE
                    </div>

                    <div class="invoice-info">

                        <strong>Invoice :</strong>
                        #{{ $order->id }}

                        <br>

                        <strong>Date :</strong>
                        {{ $order->created_at->format('d M Y') }}

                        <br>

                        <span class="status">
                            PAYMENT SUCCESSFUL
                        </span>

                    </div>

                </td>

            </tr>

        </table>

        <!-- BILLING -->

        <div class="billing-box">

            <div class="billing-title">
                Billing Details
            </div>

            <p>
                <strong>Name :</strong>
                {{ $order->user->name ?? 'Customer' }}
            </p>

            <p>
                <strong>Email :</strong>
                {{ $order->user->email ?? 'Not Available' }}
            </p>

            <p>
                <strong>Address :</strong>
                {{ $order->address ?? 'Ahmedabad, Gujarat' }}
            </p>

        </div>

        <!-- PRODUCTS -->

        <table class="product-table">

            <thead>

                <tr>
                    <th width="45%">Product Details</th>
                    <th width="12%">Qty</th>
                    <th width="18%">Price</th>
                    <th width="25%">Total</th>
                </tr>

            </thead>

            <tbody>

                @foreach($order->products as $product)

                    <tr>

                        <td>

                            <div class="product-name">
                                {{ $product->name ?? $product->product_name ?? 'Fashion Product' }}
                            </div>

                            <div class="product-detail">

                                SKU :
                                {{ $product->sku ?? 'FF-' . $product->id }}

                                <br>

                                Slug :
                                {{ $product->slug ?? 'fashion-product' }}

                                <br>

                                Status :
                                Confirmed

                            </div>

                        </td>

                        <td>
                            {{ $product->quantity }}
                        </td>

                        <td>
                            ₹{{ number_format($product->price, 2) }}
                        </td>

                        <td>
                            ₹{{ number_format($product->price * $product->quantity, 2) }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

        <!-- TOTAL -->

        <table class="total-table">

            <tr>
                <td>Subtotal</td>

                <td align="right">
                    ₹{{ number_format($subtotal, 2) }}
                </td>
            </tr>

            <tr>
                <td>GST (18%)</td>

                <td align="right">
                    ₹{{ number_format($tax, 2) }}
                </td>
            </tr>

            <tr>
                <td>Shipping</td>

                <td align="right">
                    ₹{{ number_format($shipping, 2) }}
                </td>
            </tr>

            <tr class="grand-total">

                <td>Total</td>

                <td align="right">
                    ₹{{ number_format($total, 2) }}
                </td>

            </tr>

        </table>

        <!-- THANK YOU -->

        <div class="thank-you">

            <h2>
                Thank You ❤️
            </h2>

            <p>
                We appreciate your purchase and trust in our store.
            </p>

        </div>

        <!-- FOOTER -->

        <div class="footer">

            This is a computer generated invoice.

            <br>

            © 2026 Fashion Flow. All Rights Reserved.

        </div>

    </div>

</body>

</html>