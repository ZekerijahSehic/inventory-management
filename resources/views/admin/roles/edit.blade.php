<link rel="stylesheet" href="/app.css">
<div>
    <form action="{{ route('roles.update', $role->id) }}" method="post">
        @csrf
        @method("PUT")
        <div class="form-group">
            <label for="name">Role Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role->name) }}" required>
        </div>
    </form>
</div>
<div>
    <h3>Assign</h3>
    <div>
        @if($role->permissions)
            @foreach($role->permissions as $role_permission)
                <form action="{{ route('roles.permissions.revoke', [$role->id, $role_permission->id]) }}" method="post" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-full btn-delete"> {{ $role_permission->name }}</button>
                </form>
            @endforeach
        @endif
    </div>
    <div>
        <form action="{{ route('roles.permissions', $role->id) }}" method="post">
            @csrf
            @method("POST")
            <div class="form-group">
                <label for="permission">Permissions</label>
                <select id="permission" name="permission">
                    @foreach($permissions as $permission)
                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn-height btn btn-add">Assign</button>
        </form>
    </div>
</div>





