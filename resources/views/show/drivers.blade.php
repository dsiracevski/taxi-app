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

    <main>

        @foreach($drivers as $driver)

            <div>{{$driver->first_name}}</div>

            <div>{{$driver->last_name}}</div>

        @endforeach
    </main>


</body>
</html>
