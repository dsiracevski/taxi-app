<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$user->name}}</title>
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

        <tr>

            <form method="POST">
                @csrf
                @method('PATCH')
                <div>
                    <td><input value="{{ $user->name }}" name="name"></td>
                    <td><input value="{{ $user->first_name }}" name="first_name"></td>
                    <td><input value="{{ $user->last_name }}" name="last_name"></td>
                    <td><input value="{{ $user->email }}" name="email"></td>
                    <input type="hidden" name="is_admin" value="0">
                    <td><input name="is_admin" type="checkbox" {{$user->is_admin ? 'checked' : ''}} value="1"></td>
                </div>

                <div>
                    <button type="submit">Edit</button>
                </div>
            </form>
        </tr>
        </tbody>
    </table>

    <div>
        <a href="/administration/">Go Back</a>
        <form method="POST">
            @csrf
            @method('DELETE')
            <button>Delete User</button>
        </form>
    </div>

</body>
</html>
