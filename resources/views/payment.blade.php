<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>

<script>

    var options = {

        "key": "{{ config('services.razorpay.key') }}",

        "amount": "{{ $amount }}",

        "currency": "INR",

        "name": "My Shop",

        "description": "Order Payment",

        "order_id": "{{ $razorpayOrderId }}",

        "handler": function (response){

            window.location.href =
            "/payment-success?order_id={{ $order->id }}";

        }

    };

    var rzp1 = new Razorpay(options);

    rzp1.open();

</script>

</body>
</html>