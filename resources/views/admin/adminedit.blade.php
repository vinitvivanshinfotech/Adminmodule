<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
    @include('cdn')
</head>
<body>
    <h3>Edit Admin</h3>
    <form action="{{route('admin.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="form-group">
            <label for="Name">Name :</label>
            <input type="text" name="name" class="form-control" value="{{$admins->name}}" />
            <input type="hidden" name="user_id"  value="{{$user_id}}"/>
            @error('name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="Email">Email :</label>
            <input type="email" name="email" class="form-control" value={{$admins->email}} />
            @error('email')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="Password">Password :</label>
            <input type="password" name="password" class="form-control"  />
            @error('password')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="Password">ResetPassword :</label>
            <input type="password" name="Repassword" class="form-control"  />
            @error('password')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="roles">Roles :</label>
            <select class="form-control" multiple name="roles[]">
                @foreach ($roles as $role)
                <option  value="{{$role['id']}}"
                {{in_array($role,$user_roles) ? 'selected':''}}
                >{{$role['name']}}</option>
                @endforeach
            </select>
      </select>
</select>
            @error('roles')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <input type="submit" class="btn btn-dark px-4" value="Update">
    </form>
</body>

</html>
