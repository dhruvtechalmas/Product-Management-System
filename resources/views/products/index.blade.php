<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Product List
            </h2>

            <form method="GET" action="{{ route('products.index') }}" class="mb-2 d-flex">

                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product..."
                    class="form-control me-2">

                <button class="btn btn-primary">Search</button>

            </form>

            @can('product.create')
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    Add Product +
                </a>
            @endcan



        </div>
    </x-slot>

    <div class="mb-2">
        <a href="{{ route('products.pdf') }}" class="bg-blue-500 text-white px-4 py-2 rounded btn btn-primary ">
            Download All PDF
        </a>
    </div>


    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-xl sm:rounded-lg p-4">

                {{-- Table --}}

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>SKU</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Stock_Status</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Created_at</th>
                            <th>Action</th>
                            {{-- <th>Cart</th> --}}
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($products->isNotEmpty())
                            @foreach($products as $product)
                                <tr>

                                    {{-- Hide Details --}}
                                    @if($product->trashed())
                                        <td colspan="8" class="text-center text-danger">
                                            This product is deleted
                                        </td>

                                        <td>
                                            <!-- Restore -->
                                            <a href="{{ route('products.restore', $product->id) }}" class="btn btn-success btn-sm">
                                                Restore
                                            </a>

                                            <!-- Permanent Delete -->
                                            <a href="{{ route('products.forceDelete', $product->id) }}"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure? This will permanently delete!')">
                                                Delete Permanently
                                            </a>
                                        </td>

                                    @else

                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ $product->category->name ?? '-' }}</td>
                                        <td>${{ $product->price }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>

                                            @if($product->stock > 0)

                                                <span class="badge bg-success">
                                                    In Stock
                                                </span>

                                            @else

                                                <span class="badge bg-danger">
                                                    Out Of Stock
                                                </span>

                                            @endif

                                        </td>

                                        <td>
                                            <span class="badge bg-success">
                                                {{ $product->status ? 'Active' : 'Inactive'  }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($product->image)
                                                <img class="rounded" src="{{ url('uploads/products/' . $product->image) }}" width="50">
                                            @endif
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($product->created_at)->format('d-M-Y') }}
                                        </td>
                                        <td>

                                            @can('product.edit')
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-dark">Edit</a>

                                            @endcan



                                            @can('product.delete')
                                                <a href="#" onclick="deleteproduct({{ $product->id }})"
                                                    class="btn btn-danger">Delete</a>
                                                <form id="delete-product-from-{{ $product->id }}"
                                                    action="{{ route('products.destroy', $product->id) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            @endcan


                                        </td>
                                        {{-- <td>

                                            <form action="{{ route('cart.add', $product->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-warning mt-1">
                                                    Add To Cart
                                                </button>
                                            </form>


                                        </td> --}}
                                        <td>
                                            <a href="{{ route('product.pdf.single', $product->id) }}"
                                                class="bg-green-500 text-white px-3 py-1 rounded btn btn-success">
                                                PDF
                                            </a>


                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">No Products Founds</td>
                            </tr>

                        @endif

                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $products->links() }}
                </div>

            </div>

        </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                @include('products.create')
            </div>
        </div>
    </div>



    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function deleteproduct(id) {
            if (confirm("Are You Sure You want to delete Product ? ")) {
                document.getElementById("delete-product-from-" + id).submit();
            }
        }
    </script>


</x-app-layout>