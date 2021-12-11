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

    <table>

        @foreach($cars as $car)

            <div>{{$car->name}}</div>

            <div>{{$car->registration_number}}</div>

        @endforeach
    </table>


</body>
</html>
