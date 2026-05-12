<!DOCTYPE html>
<html>

<head>

    <title>Razorpay Payment</title>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

</head>

<body>

    <script>

        var options = {

            "key": "{{ config('services.razorpay.key') }}",

            "amount": "{{ $amount }}",

            "currency": "INR",

            "name": "My Store",

            "description": "Order Payment",

            "order_id": "{{ $razorpayOrderId }}",

            // PAYMENT SUCCESS
            "handler": function (response) {
                window.location.href =
                    "{{ route('payment.success') }}" +
                    "?razorpay_order_id=" +
                    response.razorpay_order_id;
            },

            // PAYMENT CANCEL
            "modal": {

                "ondismiss": function () {
                    window.location.href =
                        "{{ route('payment.cancel') }}";
                }

            },

            "theme": {

                "color": "#3399cc"

            }

        };

        var rzp1 = new Razorpay(options);

        rzp1.on('payment.failed', function (response) {

            window.location.href = "/payment-cancel";
        });

        // OPEN RAZORPAY
        rzp1.open();

    </script>

</body>

</html>