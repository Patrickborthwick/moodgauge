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
    </header>
    <div class="text-center text-white ">
        <div class="header-text text-5xl font-light">
            <h1>Login</h1>
        </div>
        <form action="{{ route('login') }}" method="POST">
            <div class="form-container flex flex-col w-5/6 mx-auto mt-10">

                @csrf
                <div class="">
                    <label for="email">Email:</label>
                    <input type="email" name="email" required value="{{ old('email') }}">
                </div>

                <div class="">
                    <label for="password">Password:</label>
                    <input type="password" name="password" required>
                </div>

                <button type="submit" class="btn mt-4">Log in</button>
                {{-- Validation Errors --}}
                @if ($errors->any())
                    <ul class="px-4 py-2 bg-red-100">
                        @foreach ($errors->all() as $error)
                            <li class="my-2 text-red-500">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </form>
    </div>
</body>

</html>