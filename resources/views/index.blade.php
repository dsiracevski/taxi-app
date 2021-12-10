<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Такси ШлифкаTaxi Shlivka</title>
</head>
<body>

    <div>
        <a href="login/">Login</a>
        @auth()

        <a href="register/">Register</a>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="font-normal font-semibold text-blue-500">Logout</button>
        </form>
        @endauth
    </div>

</body>
</html>
