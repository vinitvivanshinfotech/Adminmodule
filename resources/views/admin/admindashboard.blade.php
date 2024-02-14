<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @include('cdn')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>

<body>

    <h4>All user</h4>


    <table class="table table-bordered table-hover" id="users_list" name="users_list">
        <a href="{{route('admin.register')}}" class="btn btn-dark mb-2">Add Users</a>
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <thead>
            <th>No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Action</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($admins as $admin )
            <tr>
                <td>{{$loop->index +1}}</td>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                <td>
                    @foreach ($admin->role as $roles )
                    {{$roles->name }} {{ !$roles->last ?',':''}}
                    @endforeach
                </td>
                <td><a href="{{route('admin.edit',$admin->id)}}" class="btn btn-sm btn-dark">Edit</a></td>
                <td><a href="{{route('admin.delete',$admin->id)}}" class="btn btn-sm btn-dark" id="delete">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        $(document).ready(function(){
            let table = new  DataTable('#users_list');

        });
        $('delete').on('click',function(){
           return confirm("Are you sure?");
        });
    </script>

</body>




</html>
