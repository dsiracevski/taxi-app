<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Locations</title>
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

        @foreach($locations as $location)
            <tr>
                <td><a href="locations/{{$location->id}}">{{$location->street_name}}</a></td>
                <td>{{$location->city}}</td>
                <td>{{$location->country}}</td>
            </tr>
        @endforeach

        <form method="POST">
            <tr>

                @csrf
                <div>
                    <td><input placeholder="Add a Street Name" name="street_name"></td>
                    <td><input placeholder="Add City" name="city"></td>
                    <td><input placeholder="Add Country" name="country"></td>
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
