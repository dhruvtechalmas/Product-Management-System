<div class="modal-header">
    <h5 class="modal-title">Add Category</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf

    <div class="modal-body">

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

    </div>

    <div class="modal-footer">
        <button class="btn btn-success">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>

</form>