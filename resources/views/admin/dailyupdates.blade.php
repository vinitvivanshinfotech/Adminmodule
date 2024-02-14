<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    @include('cdn')
</head>

<body>

    <h4>All user</h4>


    <table class="table table-bordered table-hover" id="users_list" name="users_list">
        <thead>
            <th>No.</th>
            <th>Name</th>
            <th>Email</th>
        </thead>
        <tbody>
            @foreach ($total_users as $total_user )
            <tr>
                <td>{{$loop->index +1}}</td>
                <td>{{$total_user->name}}</td>
                <td>{{$total_user->email}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
