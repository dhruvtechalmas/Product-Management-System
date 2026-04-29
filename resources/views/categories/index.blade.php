<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Category List
            </h2>

            <button class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#categoryModal">
                Add Category +
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-4">

                <!-- Table -->
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                <span class="badge bg-success">
                                    {{ $category->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>

                            <td>

                                <!-- Edit -->
                                <a href="#" class="btn btn-warning btn-sm"
                                   data-bs-toggle="modal"
                                   data-bs-target="#editModal{{ $category->id }}">
                                    Edit
                                </a>

                                <!-- Delete -->
                                <form id="delete-form-{{ $category->id }}"
                                      action="{{ route('categories.destroy', $category->id) }}"
                                      method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <a href="#" class="btn btn-danger btn-sm"
                                   onclick="event.preventDefault();
                                   if(confirm('Delete this category?')){
                                       document.getElementById('delete-form-{{ $category->id }}').submit();
                                   }">
                                    Delete
                                </a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                @include('categories.create')
            </div>
        </div>
    </div>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>