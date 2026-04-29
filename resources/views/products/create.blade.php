<div class="modal-header">
    <h5 class="modal-title">Add Product</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="modal-body">

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>SKU</label>
                <input type="text" name="sku" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    {{-- @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach --}}
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Price</label>
                <input type="number" step="0.01" name="price" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Quantity</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="pending">Pending</option>
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="col-md-12 mb-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control">
            </div>

        </div>

    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>

</form>