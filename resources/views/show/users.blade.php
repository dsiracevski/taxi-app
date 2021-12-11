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

        @foreach($users as $user)

            <div>{{$user->name}}</div>

            <div>{{$user->first_name}}</div>
            <div>{{$user->last_name}}</div>
            <div>{{$user->is_admin}}</div>
            <div>{{$user->email}}</div>

        @endforeach
    </main>


</body>
</html>
