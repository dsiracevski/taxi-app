<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>
</head>
<body>

    <main>

        <div>
            <a href="register/">Add a New User</a>
        </div>

        <div>
            <a href="drivers/">Drivers</a>
        </div>

        <div>
            <a href="cars/" class="nav-link">Cars</a>
        </div>

        <div>
            <a href="locations/" class="nav-link">Locations</a>
        </div>

        <div>
            <a href="users/" class="nav-link">Users</a>
        </div>

        <div>
            <a href="assign/" class="nav-link">Assign Cars</a>
        </div>

        <div>
            <a href="{{ route('adminView') }}/" class="nav-link">Directions</a>
        </div>

        <div>
            <a href="/">Home</a>
        </div>

    </main>

</body>
</html>
