<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    @include('cdn')
</head>

<body>
    <h2>Login</h2>
    <div>
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <div>
        @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
    </div>
    <form method="POST" action="{{route('authenticate')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-outline mb-4">

            <input type="email" id="email" name="email" class="form-control form-control-lg" />
            <label class="form-label" for="form3Example3cg">Your Email</label>
            <div>
                @error('email')
                <div class="alert alert-danger">
                    {{ $errors->first('password') }}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-outline mb-4">
            <input type="password" id="password" name="password" class="form-control form-control-lg" />
            <label class="form-label" for="form3Example4cg">Password</label>
            <div>
                @error('password')
                <div class="alert alert-danger">
                    {{ $errors->first('password') }}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-outline mb-4">
        <label class="form-label" for="form3Example4cg">Role :</label>
            <select class="form-control" multiple name="roles[]">
                @foreach ($roles as $role )
                <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
            @error('roles')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div><a href="">Forget Password</a></div>
        <div><a href="{{url('auth/google')}}">googlelogin</a></div>
        <div><a href="{{url('auth/github')}}">github</a></div>

        <div class="d-flex justify-content-center">
            <input type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" name="button" value="Login">
        </div>
</body>

</html>
