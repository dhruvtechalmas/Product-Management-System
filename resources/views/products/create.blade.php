<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Product
            </h2>

            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-xl sm:rounded-lg p-6">

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <!-- Name -->
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- SKU -->
                        <div class="col-md-6 mb-3">
                            <label>SKU</label>
                            <input type="text" name="sku" value="{{ old('sku') }}"
                                class="form-control @error('sku') is-invalid @enderror">

                            @error('sku')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="col-md-6 mb-3">
                            <label>Category</label>
                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="col-md-6 mb-3">
                            <label>Price</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                                class="form-control @error('price') is-invalid @enderror">

                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Quantity -->
                        <div class="col-md-6 mb-3">
                            <label>Quantity</label>
                            <input type="number" name="quantity" value="{{ old('quantity') }}"
                                class="form-control @error('quantity') is-invalid @enderror">

                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12 mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                        </div>

                        <!-- Image -->
                        <div class="col-md-12 mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        {{-- Stock / Instock --}}
                        <div class="mb-3">
                            <label>Stock Quantity</label>
                            <input type="number" name="stock" class="form-control" min="0" value="{{ old('stock') }}">
                        </div>

                        <div class="mb-3">
                            <label>Stock Status</label>

                            <select name="stock_status" class="form-control">
                                <option value="in_stock">In Stock</option>
                                <option value="out_of_stock">Out Of Stock</option>
                            </select>
                        </div>

                    </div>

                    <div class="mt-4">
                        <button class="btn btn-primary">Save Product</button>
                    </div>

                </form>

            </div>

        </div>
    </div>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</x-app-layout>