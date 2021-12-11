<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cars</title>
</head>
<body>

    <main>

        @foreach($locations as $location)

            <div>{{$location->street_name}}</div>

            <div>{{$location->city}}</div>

            <div>{{$location->country}}</div>

        @endforeach
    </main>


</body>
</html>
