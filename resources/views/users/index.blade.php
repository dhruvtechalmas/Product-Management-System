<x-app-layout>
    <x-slot name="header">
        <h2>User Role & Permission Management</h2>
    </x-slot>

    <div class="p-6">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Actions</th>
                </tr>
            </thead>

           <tbody>
@foreach($users as $user)
<tr>

    {{-- USER INFO --}}
    <td>
        {{ $user->name }} <br>
        <small>{{ $user->email }}</small>
    </td>

    {{-- ROLE --}}
    <td>
        <form method="POST" action="{{ route('users.permission.update') }}">
            @csrf

            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <select name="role" class="form-control">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}"
                        {{ $user->roles->pluck('name')->contains($role->name) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
    </td>

    {{-- PERMISSIONS --}}
    <td>
        {{-- @dd($permissions->toArray()) --}}
        @foreach($permissions as $permission)
            <label style="display:block;">
                <input type="checkbox"
                    name="permissions[]"
                    value="{{ $permission->name }}"
                    {{-- {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}> --}}
                         {{ $user->getDirectPermissions()->pluck('name')->contains($permission->name) ? 'checked' : '' }}>
                {{ $permission->name }}
            </label>
        @endforeach
    </td>


    {{-- ACTIONS --}}
    <td>
        @role('super-admin')
            <button type="submit" class="btn btn-success btn-sm">Save</button>
        @endrole
        </form> {{--  CLOSE UPDATE FORM HERE --}}

        @role('super-admin')
        <form method="POST" action="{{ route('users.delete', $user->id) }}">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger btn-sm">
                Delete
            </button>
        </form>
        @endrole
    </td>

</tr>
@endforeach
</tbody>
        </table>

    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</x-app-layout>