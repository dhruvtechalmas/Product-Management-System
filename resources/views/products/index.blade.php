<x-app-layout>
                <x-slot name="header">
                    <div class="flex justify-between items-center">
                        
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            Product List
                        </h2>

                        <button class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#productModal">
                            Add Product +
                        </button>

                    </div>
                </x-slot>

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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>{{ $product->category->name ?? '-' }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>
                                <span class="badge bg-success">{{ $product->status }}</span>
                            </td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" width="50">
                                @endif
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

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
</x-app-layout>