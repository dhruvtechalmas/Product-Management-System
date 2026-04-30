<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Product List
            </h2>

            <form method="post" action="{{ route('products.index') }}" class="mb-2 d-flex">

                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product..."
                    class="form-control me-2">

                <button class="btn btn-primary">Search</button>

            </form>

            @role('admin')
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                Add Product +
            </a>
            @endrole

        </div>
    </x-slot>

    <div class="mb-2">
        <a href="{{ route('products.pdf') }}" class="bg-blue-500 text-white px-4 py-2 rounded btn btn-primary ">
            Download All PDF
        </a>
    </div>


    @if(Session::has('success'))
        <div class="alert alert-primary d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16"
                role="img" aria-label="Warning:">
                <path
                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <div>
                {{ Session::get('success') }}
            </div>
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div>
                {{Session::get('error')}}
            </div>
        </div>
    @endif

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
                            <th>Qty</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Created_at</th>
                            <th>Action</th>
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
                                        <td>{{ $product->quantity }}</td>
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
                                            @role('admin')

                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-dark">Edit</a>
                                            @endrole
                                            @role('admin')
                                            <a href="#" onclick="deleteproduct({{ $product->id }})"
                                                class="btn btn-danger">Delete</a>
                                            <form id="delete-product-from-{{ $product->id }}"
                                                action="{{ route('products.destroy', $product->id) }}" method="post">
                                                @method('delete')
                                                @csrf
                                            </form>
                                            @endrole
                                        </td>
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