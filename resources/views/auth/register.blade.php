<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Smythe&display=swap"
        rel="stylesheet">
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="">
    <header class="mb-35">
        <p>Login</p>
    </header>
    <div class="text-center text-white ">
        <div class="header-text text-5xl font-light">
            <h1>Register</h1>
        </div>

        <form action="{{ route('register') }}" method="POST">
            <div class="form-container border-colour-gradient p-10 flex flex-col w-5/6 mx-auto mt-10">

                @csrf

                <label for="name">Name:</label>
                <input class="login-input" type="name" name="name" required value="{{ old('name') }}">

                <label for="email">Email:</label>
                <input class="login-input" type="email" name="email" required value="{{ old('email') }}">


                <label for="password">Password:</label>
                <input class="login-input" type="password" name="password" required>

                <label for="password_confirmation">Confirm Password:</label>
                <input class="login-input" type="password" name="password_confirmation" required>

                <button type="submit" class="btn mt-4 border-colour-gradient">Register</button>

                {{-- Validation Errors --}}
                @if ($errors->any())
                <ul class="px-4 py-2">
                    @foreach ($errors->all() as $error)
                    <li class="my-3 p-2 bg-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <a href="{{ route('show.login') }}">
                    <div class="my-5">
                        <p>Already have an account? Login here</p>
                    </div>
                </a>

            </div>
        </form>
    </div>
</body>

</html>