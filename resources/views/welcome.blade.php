<x-app-layout>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-gray-100">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">

        <div class="container">

            <a class="navbar-brand fw-bold" href="#">
                My Shop
            </a>

            <div class="d-flex align-items-center gap-3">

                {{-- Cart Dropdown --}}
                <div class="dropdown">

                    <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown">

                        <i class="fa-solid fa-cart-shopping fs-4"></i>

                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                            {{ count((array) session('cart')) }}

                        </span>

                    </a>

                    <div class="dropdown-menu dropdown-menu-end p-3" style="width:320px;">

                        @forelse(session('cart', []) as $id => $item)

                            <div class="d-flex align-items-center mb-3 border-bottom pb-2">

                                <img src="{{ url('uploads/products/' . $item['image']) }}" width="60" height="60"
                                    style="object-fit:contain;">

                                <div class="ms-3">

                                    <h6 class="mb-1">
                                        {{ $item['name'] }}
                                    </h6>

                                    <small>
                                        Qty : {{ $item['quantity'] }}
                                    </small>

                                    <br>

                                    <strong>
                                        ₹{{ $item['price'] }}
                                    </strong>

                                </div>

                            </div>

                        @empty

                            <p class="text-center mb-0">
                                Cart Empty
                            </p>

                        @endforelse

                        <a href="{{ route('cart') }}" class="btn btn-dark w-100">

                            View Cart

                        </a>

                    </div>

                </div>

                {{-- Register / Dashboard --}}
                @auth

                    <a href="{{ route('dashboard') }}" class="btn btn-dark">

                        Dashboard

                    </a>

                @else

                    <a href="{{ route('register') }}" class="btn btn-primary">

                        Register

                    </a>

                @endauth

            </div>

        </div>

    </nav>
    
    {{-- Products --}}
    <div class="max-w-7xl mx-auto px-4 py-8">

        <div class="flex flex-wrap gap-3 justify-start">

            @foreach ($products as $key => $product)

                <div class="bg-white rounded-lg shadow p-3" style="width:230px;">

                    <img src="{{ url('uploads/products/' . $product->image) }}"
                        style="width:100%; height:220px; object-fit:contain; transition:0.3s;" class="p-2 bg-white rounded"
                        onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">

                    <div class="text-center mt-3">

                        <h2 class="text-lg font-bold">
                            {{ $product->name }}
                        </h2>

                        <p style="margin-bottom: auto" class="text-sm text-gray-500 truncate">
                            {{ $product->description }}
                        </p>

                        {{-- <p style="margin-bottom: auto" class="text-sm ">
                            {{ $product->sku }}
                        </p> --}}

                        <h3 class="text-xl font-bold mt-1">
                            ₹{{ $product->price }}
                        </h3>

                     


                        <div class="d-flex flex-column align-items-center pb-3">

                            @if($product->stock > 0)

                                <span class="badge bg-success mb-2">

                                    In Stock

                                </span>

                                <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning">

                                    Add to Cart

                                </a>

                            @else

                                <span class="badge bg-danger">

                                    Out Of Stock

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>
</body>

</html>
</x-app-layout>