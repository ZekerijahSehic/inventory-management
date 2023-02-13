<link rel="stylesheet" href="/app.css">
<form action="{{ route('roles.store') }}" method="post">
@csrf
<div class="form-group">
    <label for="name">Role Name:</label>
    <input type="text" class="form-control" id="name" name="name" required>
</div>
<button type="submit" class="btn-height btn btn-add">Save</button>
</form>
