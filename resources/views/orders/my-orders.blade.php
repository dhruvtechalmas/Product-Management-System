<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Orders</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .order-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: 0.3s;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .tracking-line {
            height: 5px;
            background: #198754;
            border-radius: 20px;
            animation: loading 2s infinite alternate;
        }

        @keyframes loading {

            from {
                width: 30%;
            }

            to {
                width: 100%;
            }
        }
    </style>

</head>

<body>

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2 class="fw-bold">
                My Orders
            </h2>

            <a href="{{ url('/') }}" class="btn btn-dark">

                Continue Shopping

            </a>

        </div>

        @if($orders->count() > 0)

            @foreach($orders as $order)

                <div class="card shadow-lg mb-4 order-card">

                    <div class="card-header bg-dark text-white d-flex justify-content-between">

                        <div>

                            <strong>Order ID:</strong>

                            #{{ $order->id }}

                        </div>

                        <div>

                            <div>

                                <strong>Total:</strong>

                                ₹{{ number_format($order->amount, 2) }}

                            </div>


                        </div>

                    </div>

                    <div class="card-body">

                        {{-- STATUS --}}

                        @if($order->payment_status == 'paid')

                            <span class="badge bg-success mb-3">
                                Payment Successful
                            </span>

                        @else

                            <span class="badge bg-warning text-dark mb-3">
                                Payment Pending
                            </span>

                        @endif


                        {{-- TRACKING LINE --}}

                        <div class="tracking-line mb-4"></div>

                        @php

                            $subtotal = 0;

                            foreach ($order->products as $item) {
                                $subtotal += $item->price * $item->quantity;
                            }

                            $tax = $subtotal * 0.18;

                            $shipping = 50;

                            $grandTotal = $subtotal + $tax + $shipping;

                        @endphp

                        <div class="card border-0 bg-light rounded-4 p-3 mb-4">

                            <div class="d-flex justify-content-between mb-2">

                                <span>Subtotal</span>

                                <strong>
                                    ₹{{ number_format($subtotal, 2) }}
                                </strong>

                            </div>

                            <div class="d-flex justify-content-between mb-2">

                                <span>GST (18%)</span>

                                <strong>
                                    ₹{{ number_format($tax, 2) }}
                                </strong>

                            </div>

                            <div class="d-flex justify-content-between mb-2">

                                <span>Shipping</span>

                                <strong>
                                    ₹{{ number_format($shipping, 2) }}
                                </strong>

                            </div>

                            <hr>

                            <div class="d-flex justify-content-between">

                                <h5 class="mb-0">
                                    Grand Total
                                </h5>

                                <h5 class="mb-0 text-success">

                                    ₹{{ number_format($grandTotal, 2) }}

                                </h5>

                            </div>

                        </div>


                        {{-- PRODUCTS --}}

                        <div class="row">

                            @foreach($order->products as $item)

                                <div class="col-md-6 mb-3">

                                    <div class="border rounded-4 p-3 bg-light d-flex gap-3 align-items-center">

                                        <img src="{{ url('uploads/products/' . $item->product->image) }}" class="product-image">

                                        <div>

                                            <h5 class="mb-1">

                                                {{ $item->product->name }}

                                            </h5>

                                            <p class="mb-1 text-muted">

                                                SKU:
                                                {{ $item->product->sku }}

                                            </p>

                                            <p class="mb-1">

                                                Quantity:
                                                {{ $item->quantity }}

                                            </p>

                                            <strong>

                                                ₹{{ $item->price }}

                                            </strong>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>


                        <div class="mt-4 d-flex justify-content-between align-items-center">

                            <div>

                                Ordered On:
                                {{ $order->created_at->format('d M Y h:i A') }}

                            </div>

                            <div class="d-flex gap-2">

                                <button class="btn btn-success rounded-pill">

                                    Tracking Active

                                </button>

                                <a href="{{ route('invoice.download', $order->id) }}" class="btn btn-dark rounded-pill">

                                    Download Invoice

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        @else

            <div class="text-center py-5">

                <h2>
                    No Orders Found
                </h2>

                <a href="{{ url('/') }}" class="btn btn-dark mt-3">

                    Shop Now

                </a>

            </div>

        @endif

    </div>

</body>

</html>