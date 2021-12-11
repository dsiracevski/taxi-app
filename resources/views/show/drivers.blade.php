<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Drivers</title>
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

        @foreach($drivers as $driver)
            <tr>
                <td><a href="drivers/{{$driver->id}}">{{$driver->first_name}}</a></td>
                <td>{{$driver->last_name}}</td>
            </tr>
        @endforeach

        <form method="POST">
            <tr>

                @csrf
                <div>
                    <td><input placeholder="First name" name="first_name"></td>
                    <td><input placeholder="Last Name" name="last_name"></td>
                </div>

                <div>
                    <button type="submit">Add</button>
                </div>
            </tr>
        </form>

        </tbody>
    </table>

    <div>
        <a href="/administration/">Go Back</a>
    </div>

</body>
</html>
