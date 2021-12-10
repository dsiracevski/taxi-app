<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Taxi</title>
</head>
<body>


    <main>
        <form action="/register" method="POST">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div>
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" required>
            </div>

            <div>
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" required>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" required>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div>
                <label for="is_admin">Admin User?</label>
                <input type="checkbox" name="is_admin" id="is_admin">
            </div>

            <div>
                <button type="submit">
                    Submit
                </button>
            </div>
        </form>
        <a href="/">Cancel</a>
    </main>


</body>
</html>
