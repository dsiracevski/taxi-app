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
        <thead>
        <tr>
            <th>Возило</th>
            <th>Регистрација</th>
            <th>Статус</th>
        </tr>
        </thead>

        <tbody>

        @foreach($cars as $car)
            <tr>
                <td><a href="cars/{{$car->id}}">{{$car->name}}</a></td>
                <td>{{$car->registration_number}}</td>
                <td>@if ($car->is_active)
                        Во употреба
                    @elseif (!$car->is_active)
                        Слободно
                    @endif</td>
            </tr>
        @endforeach

        <form method="POST">
            <tr>

                @csrf
                <div>
                    <td><input placeholder="Car Name" name="name"></td>
                    <td><input placeholder="Registration Number" name="registration_number"></td>
{{--                    <td><input name="is_active" value="1" type="checkbox"></td>--}}
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
