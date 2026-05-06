<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body class="bg-gray-100">
    <div class="container mt-5">

        <div class="card shadow">

            <div class="card-header bg-dark text-white">

                <h3 class="mb-0">
                    My Cart
                </h3>

            </div>

            <div class="card-body" id="cart-products">
                @include('carts.cartProducts')
            </div>
            <div class="card-footer bg-white border-0">

                <div class="d-flex justify-content-end gap-2 p-3">
                    <a class="btn btn-warning" href="{{ url('/') }}">Continue Shoping</a>
                    <button class="btn btn-success">Checkout</button>

                </div>
            </div>

        </div>

    </div>

    <script>

        //UPDATE QUANTITY

        $(document).on('change', '.quantity', function (e) {

            e.preventDefault();

            var elem = $(this);

            $.ajax({
                url: '{{ route("cart.update") }}',
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    type: "update",
                    product_id: elem.parents("tr").attr("data-id"),
                    quantity: elem.val()
                },

                success: function (response) {

                    $('#cart-products').html(response.success);
                    console.log(response);

                }
            });

        });


        // DELETE AJAX

        $(document).on('click', '.remove-from-cart', function (e) {

            e.preventDefault();

            var elem = $(this);

            $.ajax({
                url: '{{ route("cart.update") }}',
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    type: "delete",
                    product_id: elem.parents("tr").attr("data-id"),
                },

                success: function (response) {

                    $('#cart-products').html(response.success);
                    console.log(response);

                }
            });

        });




    </script>

</body>

</html>