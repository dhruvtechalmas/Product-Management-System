<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
</head>
<body>

    <button id="rzp-button">
        Pay Now
    </button>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

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
                "/payment-success?payment_id=" +
                response.razorpay_payment_id;

            }
        };

        var rzp1 = new Razorpay(options);

        document.getElementById('rzp-button').onclick = function(e){

            rzp1.open();

            e.preventDefault();

        }

    </script>

</body>
</html>