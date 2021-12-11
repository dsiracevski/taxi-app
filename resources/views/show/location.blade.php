<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$location->street_name}}</title>
</head>
<body>

    <table>
        <thead>
        <tr>
            <th>Street</th>
            <th>City</th>
            <th>Country</th>
        </tr>
        </thead>

        <tbody>

        <tr>
            <form method="POST">
                @csrf
                @method('PATCH')
                <div>
                    <td><input value="{{ $location->street_name }}" name="street_name"></td>
                    <td><input value="{{ $location->city }}" name="city"></td>
                    <td><input value="{{ $location->country }}" name="country"></td>
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
            <button>Delete Location</button>
        </form>
    </div>

</body>
</html>
