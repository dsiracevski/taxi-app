<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
</head>
<body>

    <table>
        <thead>
        <tr>
            <th>Name:</th>
            <th>First name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Admin?</th>

        </tr>
        </thead>

        <tbody>

        @foreach($users as $user)
            <tr>
                <td><a href="users/{{$user->id}}">{{$user->name}}</a></td>
                <td>{{$user->first_name}}</td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->email}}</td>
                @if($user->is_admin)
                    <td>Yes</td>
                @elseif(!$user->is_admin)
                    <td>No</td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>

    <div>
        <a href="/administration/">Go Back</a>
    </div>

</body>
</html>
