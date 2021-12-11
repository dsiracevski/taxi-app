<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$car->name}}</title>
</head>
<body>

    <table>
        <thead>
        <tr>
            <th>Car Name</th>
            <th>Registration Number</th>
        </tr>
        </thead>

        <tbody>

        <tr>

            <form method="POST">
                @csrf
                @method('PATCH')
                <div>
                    <td><input value="{{ $car->name }}" name="name"></td>
                    <td><input value="{{ $car->registration_number }}" name="registration_number"></td>
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
            <button>Delete Car</button>
        </form>
    </div>

</body>
</html>
