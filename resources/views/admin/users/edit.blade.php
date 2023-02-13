@extends('layout/layout')
@section('content')
<form action="/admin/users/{{$user->id}}" method="post" class="create-form">
    @csrf
    @method("PUT")
    <div class="create-group">
        <label for="name">Name</label>
        @if($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
        @endif
        <input type="text" id="name" name="name" value="{{ $user->name }}">
    </div>
    <div class="create-group">
        <label for="email">Email</label>
        @if($errors->has('email'))
            <p class="text-danger">{{ $errors->first('email') }}</p>
        @endif
        <input type="email" id="email" name="email" value="{{ $user->email }}">
    </div>
    <div class="create-group">
        <label for="role">Role</label>
        @if($errors->has('role'))
            <p class="text-danger">{{ $errors->first('role') }}</p>
        @endif
        <select id="role" name="role">
            <option value="administrator" >Administrator</option>
            <option value="manager" >Manager</option>
            <option value="user">User</option>
        </select>
    </div>
    <button type="submit" class="btn-full btn-add">Save</button>
</form>

@endsection


