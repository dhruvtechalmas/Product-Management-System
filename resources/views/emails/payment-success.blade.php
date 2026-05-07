<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmed</title>
</head>

<body style="
    margin:0;
    padding:0;
    background:#f4f7fb;
    font-family:Arial,sans-serif;
">

    <div style="
    width:100%;
    padding:40px 0;
">

        <div style="
        width:620px;
        margin:0 auto;
        background:#ffffff;
        border-radius:18px;
        overflow:hidden;
        box-shadow:0 4px 18px rgba(0,0,0,0.06);
    ">

            <!-- HEADER -->

            <div style="
            background:#1f2937;
            text-align:center;
            padding:35px;
        ">

                <img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png" width="55"
                    style="margin-bottom:12px;">

                <h1 style="
                color:white;
                margin:0;
                font-size:30px;
                letter-spacing:1px;
            ">
                    Fashion Flow
                </h1>

            </div>

            <!-- BODY -->

            <div style="
            padding:40px;
        ">

                <h2 style="
                text-align:center;
                margin-top:0;
                color:#111827;
                font-size:30px;
            ">
                    Your Order Has Been Confirmed 🎉
                </h2>

                <p style="
                color:#4b5563;
                font-size:15px;
                line-height:30px;
                text-align:center;
                margin-top:25px;
            ">

                    Hi <strong>{{ $order->user->name }}</strong>,

                    <br><br>

                    Thank you for shopping with
                    <strong>Fashion Flow</strong> ❤️

                    <br><br>

                    Your order has been placed successfully
                    and our team has started preparing your package.

                    <br><br>

                    We will notify you once your order is shipped.

                    <br><br>

                    Estimated delivery date:
                    <strong style="color:#111827;">
                        15 May 2026
                    </strong>

                </p>

                <!-- DELIVERY -->

                <div style="
                background:#f8fafc;
                border:1px solid #e5e7eb;
                border-radius:14px;
                padding:22px;
                margin-top:35px;
            ">

                    <h3 style="
                    margin-top:0;
                    color:#111827;
                    font-size:18px;
                ">
                        Delivery Details
                    </h3>

                    <p style="
                    margin:10px 0;
                    color:#374151;
                    font-size:14px;
                ">
                        <strong>Order ID:</strong>
                        #{{ $order->id }}
                    </p>

                    <p style="
                    margin:10px 0;
                    color:#374151;
                    font-size:14px;
                ">
                        <strong>Shipping Address:</strong>
                        {{ $order->address }}
                    </p>

                    <p style="
                    margin:10px 0;
                    color:#374151;
                    font-size:14px;
                ">
                        <strong>Payment:</strong>
                        Successful
                    </p>

                </div>

                <!-- PRODUCTS -->

                <div style="
                margin-top:35px;
            ">

                    <h3 style="
                    color:#111827;
                    font-size:20px;
                    margin-bottom:18px;
                ">
                        Order Summary
                    </h3>

                    @foreach($order->products as $product)

                            <div style="
                            border:1px solid #e5e7eb;
                            border-radius:14px;
                            padding:20px;
                            margin-bottom:18px;
                            background:#fafcff;
                        ">

                                <table width="100%">

                                    <tr>

                                        <td>

                                            <div style="
                                            font-size:18px;
                                            font-weight:bold;
                                            color:#111827;
                                            margin-bottom:8px;
                                        ">
                                                {{ $product->name ?? $product->product_name ?? 'Fashion Product' }}
                                            </div>

                                            <div style="
                                            color:#6b7280;
                                            font-size:13px;
                                            line-height:25px;
                                        ">

                                                SKU :
                                                <strong>
                                                    {{ $product->sku ?? 'FF-' . $product->id }}
                                                </strong>

                                                <br>

                                                Slug :
                                                <strong>
                                                    {{ $product->slug ?? 'fashion-product' }}
                                                </strong>

                                                <br>

                                                Quantity :
                                                <strong>
                                                    {{ $product->quantity }}
                                                </strong>

                                                <br>

                                                Price :
                                                <strong>
                                                    ₹{{ number_format($product->price, 2) }}
                                                </strong>

                                                <br>

                                                Status :
                                                <span style="
                                                color:#16a34a;
                                                font-weight:bold;
                                            ">
                                                    Confirmed
                                                </span>

                                            </div>

                                        </td>

                                        <td align="right">

                                            <div style="
                                            font-size:22px;
                                            font-weight:bold;
                                            color:#111827;
                                        ">
                                                ₹{{ number_format($product->price * $product->quantity, 2) }}
                                            </div>

                                        </td>

                                    </tr>

                                </table>

                            </div>

                    @endforeach

                </div>

                <!-- PDF SECTION -->

                <div style="
                margin-top:35px;
            ">

                    <div style="
                    border:1px solid #dbe4ee;
                    border-radius:14px;
                    padding:18px;
                    background:#f9fbfd;
                ">

                        <table width="100%">

                            <tr>

                                <td width="70">

                                    <div style="
                                    width:52px;
                                    height:64px;
                                    background:#ef4444;
                                    border-radius:10px;
                                    color:white;
                                    text-align:center;
                                    line-height:64px;
                                    font-weight:bold;
                                    font-size:16px;
                                ">
                                        PDF
                                    </div>

                                </td>

                                <td>

                                    <div style="
                                    font-size:15px;
                                    font-weight:bold;
                                    color:#111827;
                                    margin-bottom:5px;
                                ">
                                        Invoice.pdf
                                    </div>

                                    <div style="
                                    font-size:12px;
                                    color:#6b7280;
                                    line-height:20px;
                                ">
                                        Your invoice has been attached with this email.

                                        <br>

                                        Download or preview your invoice anytime.
                                    </div>

                                </td>

                                <td align="right">

                                    <a href="{{ route('invoice.download', $order->id) }}" style="
                                    background:#1f2937;
                                    color:white;
                                    text-decoration:none;
                                    padding:10px 18px;
                                    border-radius:10px;
                                    font-size:12px;
                                    font-weight:bold;
                                    display:inline-block;
                                ">
                                        Download
                                    </a>

                                </td>

                            </tr>

                        </table>

                    </div>

                </div>

                <!-- BUTTON -->

                <div style="
                text-align:center;
                margin-top:40px;
            ">

                    <a href="{{ url('/my-orders') }}" style="
                    background:#1f2937;
                    color:white;
                    text-decoration:none;
                    padding:15px 34px;
                    border-radius:10px;
                    display:inline-block;
                    font-size:14px;
                    font-weight:bold;
                ">
                        Track Your Order
                    </a>

                </div>

            </div>

            <!-- FOOTER -->

            <div style="
            background:#f9fafb;
            padding:28px;
            text-align:center;
            color:#6b7280;
            font-size:12px;
            line-height:24px;
        ">

                Need help? Contact our support team anytime.

                <br><br>

                © 2026 Fashion Flow.
                All Rights Reserved.

            </div>

        </div>

    </div>

</body>

</html>