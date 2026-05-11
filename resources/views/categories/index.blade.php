<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Category List
            </h2>

            @can('category.create')
                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                    Add Category +
                </a>
            @endcan



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
                            <th>Created_at</th>
                            <th>Action</th>
                            <th>Products</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if ($categories->isNotEmpty())
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
                                        {{ \Carbon\Carbon::parse($category->created_at)->format('d-M-Y') }}
                                    </td>

                                    <td>

                                        @can('category.edit')
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-dark">Edit</a>

                                        @endcan


                                        @can('category.delete')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="deleteCategory({{ $category->id }}, {{ $category->products_count }})">
                                                Delete
                                            </button>


                                            {{-- <a href="{{ route('categories.destroy', $category->id) }}"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete Category? !')">
                                                Delete
                                            </a> --}}
                                        @endcan


                                    </td>
                                    <td>{{ $category->products_count }}</td>
                                </tr>
                            @endforeach

                        @endif

                    </tbody>
                </table>
                <script>
                    let categories = @json($categories);
                </script>

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



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function deleteCategory(id, count) {

            if (count == 0) {
                submitForm(id, 'delete');
                return;
            }

            Swal.fire({
                title: `This category has ${count} products`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete All',
                cancelButtonText: 'Transfer'
            }).then((result) => {

                if (result.isConfirmed) {
                    submitForm(id, 'delete');
                } else {
                    showTransferPopup(id);
                }
            });
        }

        function showTransferPopup(id) {

            let options = '';

            categories.forEach(cat => {
                if (cat.id != id) {
                    options += `<option value="${cat.id}">${cat.name}</option>`;
                }
            });

            Swal.fire({
                title: 'Select Category',
                html: `<select id="newCat" class="swal2-select">${options}</select>`,
                showCancelButton: true,
                confirmButtonText: 'Transfer'
            }).then((res) => {

                let newCat = document.getElementById('newCat').value;

                if (newCat) {
                    submitForm(id, 'transfer', newCat);
                }
            });
        }

        function submitForm(id, action, newCategory = null) {

            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '/categories/delete/' + id;

            let csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';

            let act = document.createElement('input');
            act.type = 'hidden';
            act.name = 'action';
            act.value = action;

            form.appendChild(csrf);
            form.appendChild(act);

            if (newCategory) {
                let cat = document.createElement('input');
                cat.type = 'hidden';
                cat.name = 'new_category_id';
                cat.value = newCategory;
                form.appendChild(cat);
            }

            document.body.appendChild(form);
            form.submit();
        }
    </script>

</x-app-layout>