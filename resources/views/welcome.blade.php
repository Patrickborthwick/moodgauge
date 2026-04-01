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
            <h1>Welcome to MoodGauge</h1>
        </div>

        <div class="signup-div mt-20 text-2xl">
            <h2 class="font-semibold">Create an account to start your Journey</h2>
            <h3>Sign up</h3>
        </div>
    </div>
</body>

</html>