<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Login</title>
</head>


<body class="bg-gray-100">
    <div class="flex justify-center items-center w-screen h-screen">
        <form method="POST">
            @csrf
            <div class="grid grid-cols-2 px-12 py-12 bg-white rounded-2xl shadow-lg">
                <div class="my-6">
                    <label class="mb-2 text-xs font-bold text-gray-700 uppercase"
                           for="email"
                    >
                        Email
                    </label>
                    <input type="email" name="email" id="email"
                           class="px-6 w-3/4 h-9 rounded-lg border-2 border-blue-200 shadow-md focus:outline-none focus:border-blue-500 focus:ring-1"
                           value="{{old('email')}}">

                    @error('email')
                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror

                </div>
                <div class="my-6">
                    <label class="mb-2 text-xs font-bold text-gray-700 uppercase"
                           for="password"
                    >
                        Password
                    </label>
                    <input type="password" name="password" id="password"
                           class="px-6 w-3/4 h-9 rounded-lg border-2 border-blue-200 shadow-md focus:outline-none focus:border-blue-500 focus:ring-1"
                           value="{{old('password')}}">

                    @error('password')
                    <p class="col-start-1 mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex col-span-2 justify-center items-center gap-6">
                    <a href="/" class="px-4 py-2 text-sm font-semibold text-white uppercase bg-blue-400 rounded-xl">Cancel</a>

                    <button type="submit"
                            class="px-4 py-2 text-sm font-semibold text-white uppercase bg-blue-400 rounded-xl">Login
                    </button>
                </div>
            </div>

        </form>
    </div>
</body>
</html>
