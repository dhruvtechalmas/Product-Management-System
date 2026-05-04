<x-app-layout>
    <x-slot name="header">
        <h2>Role & Permission Management</h2>
    </x-slot>

    <div class="p-6">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('roles.update') }}" method="POST">
            @csrf

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Role</th>
                        @foreach($permissions as $permission)
                            <th>{{ $permission->name }}</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td><b>{{ $role->name }}</b></td>

                            @foreach($permissions as $permission)
                                <td>
                                    @if($role->name === 'super-admin')
                                        <!-- Only show tick -->
                                        <span class="text-success">✔</span>
                                    @else
                                        <!--  Show checkbox -->
                                        <input type="checkbox"
                                            name="roles[{{ $role->id }}][]"
                                            value="{{ $permission->name }}"
                                            {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                    @endif
                                </td>
                            @endforeach

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button class="btn btn-primary mt-3">Save Changes</button>
        </form>

    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</x-app-layout>