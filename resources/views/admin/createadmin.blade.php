<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
    @include('cdn')
</head>

<body>
    <h3>Add New User</h3>
    <form action="{{route('admin.add')}}" method="post" enctype="multipart/form-data">
        @csrf
        @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="form-group">
            <label for="Name">Name :</label>
            <input type="text" name="name" class="form-control" />
            @error('name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="Email">Email :</label>
            <input type="email" name="email" class="form-control" />
            @error('email')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password :</label>
            <input type="password" name="password" class="form-control" />
            @error('password')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Repassword :</label>
            <input type="password" name="repassword" class="form-control" />
            @error('repassword')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="roles">Roles :</label>
            <select class="form-control" multiple name="roles[]">
                @foreach ($roles as $role )
                <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
            @error('roles')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <input type="submit" class="btn btn-dark px-4" value="Add User">
    </form>
</body>

</html>
