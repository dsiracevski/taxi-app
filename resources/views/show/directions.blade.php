<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form method="POST" action="directions/{{auth()->user()->id}}">
        @csrf

        <label for="driver_id">Driver</label>
        <select name="driver_id" id="driver_id">
            @foreach ($drivers as $driver)
                <option value="{{$driver->id}}">{{$driver->first_name . ' ' . $driver->last_name}}</option>
            @endforeach
        </select>

        <label for="location_from_id">From</label>
        <select name="location_from_id" id="location_from_id">
            @foreach ($locations as $location)
                <option value="{{$location->id}}">{{$location->street_name . ', ' . $location->city}}</option>
            @endforeach
        </select>

        <label for="location_to_id">To</label>
        <select name="location_to_id" id="location_to_id">
            @foreach ($locations as $location)
                <option value="{{$location->id}}">{{$location->street_name . ', ' . $location->city}}</option>
            @endforeach
        </select>

        <input type="number" name="price">

        <input type="date" name="scheduled">

        <button type="submit">Add</button>

    </form>


</body>
</html>
