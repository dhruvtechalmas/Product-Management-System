<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Category
            </h2>

            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-xl sm:rounded-lg p-6">

                <!-- Form -->
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" value="{{ old('name', $category->name)}}"
                            class="form-control @error('name') is-invalid @enderror">

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $category->slug) }}"
                            class="form-control @error('slug') is-invalid @enderror">

                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Active
                            </option>
                            <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>

                    <!-- Submit -->
                    <div class="mt-4">
                        <button class="btn btn-primary">Update Category</button>
                    </div>

                </form>

            </div>

        </div>
    </div>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</x-app-layout>