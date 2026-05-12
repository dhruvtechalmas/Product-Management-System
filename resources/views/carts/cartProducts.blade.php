@if(session('cart') && count(session('cart')) > 0)

    <table class="table table-bordered align-middle">

        <thead class="table-light">

            <tr>

                <th width="300">Products</th>

                <th>Price</th>

                <th>Quantity</th>

                <th>Subtotal</th>

                <th>Stock_Status</th>

                <th>Action</th>

            </tr>

        </thead>

        <tbody>

            @php $total = 0; @endphp

            @foreach(session('cart') as $id => $details)

                @php

                    $subtotal = $details['price'] * $details['quantity'];

                    $total += $subtotal;

                @endphp

                <tr data-id="{{ $id }}">

                    {{-- PRODUCT --}}
                    <td>

                        <div class="d-flex align-items-center gap-3">

                            <img src="{{ url('uploads/products/' . $details['image']) }}" width="60" height="80"
                                style="object-fit: contain;">

                            <div>

                                <h5 class="mb-1">
                                    {{ $details['name'] }}
                                </h5>

                                <small class="text-muted">
                                    {{ $details['description'] ?? 'Product' }}
                                </small>

                            </div>

                        </div>

                    </td>

                    {{-- PRICE --}}
                    <td>

                        ₹{{ $details['price'] }}

                    </td>

                    {{-- QUANTITY --}}
                    <td>

                        <div class="d-flex align-items-center gap-2">

                            {{-- DECREASE --}}
                            <button class="btn btn-danger btn-sm decrease-cart" data-id="{{ $id }}">

                                -

                            </button>

                            {{-- QUANTITY --}}
                            <input type="number" value="{{ $details['quantity'] }}" min="1" class="form-control quantity"
                                style="width:70px;">

                            {{-- INCREASE --}}
                            <button class="btn btn-success btn-sm increase-cart" data-id="{{ $id }}">

                                +

                            </button>

                        </div>

                    </td>
                    {{-- SUBTOTAL --}}
                    <td>

                        ₹{{ $subtotal }}

                    </td>

                    {{-- STOCK --}}
                    {{-- <td>

                        {{ $details['stock'] ?? 0 }}

                    </td> --}}

                    {{-- STATUS --}}
                    <td>

                        @if(($details['stock'] ?? 0) > 0)

                            <span class="badge bg-success">
                                In Stock
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Out Of Stock
                            </span>

                        @endif

                    </td>

                    {{-- REMOVE --}}
                    <td>

                        <button class="btn btn-danger btn-sm remove-from-cart remove-from-cart" data-id="{{ $id }}">

                            <i class="fa fa-trash"></i>

                        </button>

                    </td>

                </tr>

            @endforeach

            {{-- TOTAL --}}
            <tr>

                <td colspan="3" class="text-end">

                    <h4>Total :</h4>

                </td>

                <td colspan="4">

                    <h4 id="cart-total">

                        ₹{{ $total }}

                    </h4>

                </td>

            </tr>

        </tbody>

    </table>

@else

    <div class="text-center py-5">

        <h3>
            Cart Empty
        </h3>

    </div>

@endif
<script>

    handler: function (response) {

        var options = {

            "key": "YOUR_KEY",

            "amount": amount,

            "handler": function (response) {

                window.location.href = "/payment-success";
            },

            "modal": {

                "ondismiss": function () {

                    window.location.href = "/payment-failed";
                }
            }
        };
    }

</script>