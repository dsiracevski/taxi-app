<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$driver->first_name}}</title>
</head>
<body>

    <table>
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last name</th>
        </tr>
        </thead>

        <tbody>
            <tr>
                <form method="POST">
                    @csrf
                    @method('PATCH')
                    <div>
                        <td><input value="{{ $driver->first_name }}" name="first_name"></td>
                        <td><input value="{{ $driver->last_name }}" name="last_name"></td>
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
            <button>Delete Driver</button>
        </form>
    </div>

</body>
</html>
