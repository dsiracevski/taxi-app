<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Такси Шливка</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <div>
        @guest()
            <a href="{{route('login')}}">Login</a>
        @endguest
        @auth()
            @if (Auth::user()->is_admin)
                <a href="administration/">Admin Panel</a>
            @endif

            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="font-normal font-semibold text-blue-500">Logout</button>
            </form>

        @endauth
    </div>

</body>
</html>
