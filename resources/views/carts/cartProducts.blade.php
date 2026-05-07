@if(session('cart') && count(session('cart')) > 0)

    <table class="table table-bordered align-middle">

        <thead class="table-light">

            <tr>

                <th width="300">Products</th>

                <th width="50px">
                    Price
                </th>

                <th width="50px">
                    Quantity
                </th>

                <th width="50px">
                    Subtotal
                </th>

                <th width="50px">
                    Action
                </th>

            </tr>

        </thead>

        <tbody>

            @php $total = 0; @endphp

            @foreach(session('cart') as $id => $details)

                @php
                    $subtotal = $details['price'] * $details['quantity'];
                    $total += $subtotal;
                @endphp


                <tr data-id="{{  $id  }}">

                    {{-- Product --}}
                    <td>

                        <div class="d-flex align-items-center gap-3">

                            <img src="{{ url('uploads/products/' . $details['image']) }}" width="50" height="100"
                                style="object-fit:contain;">

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

                    {{-- Price --}}
                    <td>

                        ₹{{ $details['price'] }}

                    </td>

                    {{-- Quantity --}}
                    <td>

                        <input type="number" value="{{ $details['quantity'] }}" min="1" class="form-control quantity">

                    </td>

                    {{-- Subtotal --}}
                    <td class="subtotal">
                        ₹{{ $subtotal }}
                    </td>

                    {{-- Remove --}}
                    <td>

                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}">

                            <i class="fa fa-trash"></i>

                        </button>
                    </td>

                </tr>

            @endforeach

            {{-- Total --}}
            <tr>

                <td colspan="3" class="text-end">

                    <h4>
                        Total :
                    </h4>

                </td>

                <td colspan="2">

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