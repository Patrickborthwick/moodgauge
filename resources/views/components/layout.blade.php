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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Smythe&family=Zain:ital,wght@0,200;0,300;0,400;0,700;0,800;0,900;1,300;1,400&display=swap"
        rel="stylesheet">
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body>
    <header class="">
        <nav aria-label="Global" class=" mx-auto flex nav items-center justify-between pr-4 pb-2  ">
            <div class=" flex flex-1 justify-end">
                @guest
                <a href="{{ route('show.login') }}" class="text-xl px-2 font-semibold text-white">Log in</a>
                <a href="{{ route('show.register') }}" class="text-xl px-2 font-semibold text-white">Register</a>
                @endguest
                @auth
                {{-- dropdown --}}
                <div class=" mt-2 relative inline-block text-left dropdown">
                    <span class="rounded-md shadow-sm"><button
                            class=" cursor-pointer leading-5 transition duration-150 ease-in-out " type="button"
                            aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">
                            <span class="text-xl pr-2 font-semibold text-white">Welcome {{ucfirst(Auth::user()->name) }}</span>
                        </button></span>
                    <div class="hidden dropdown-menu">
                        <div class="absolute right-0 w-56 mt-2 origin-top-right  border-colour-gradient"
                            aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">

                            <div class="py-5 ">
                                <form action="{{ route('logout') }}" method="POST" class="m-0">@csrf
                                    <button
                                        class="text-xl px-2 cursor-pointer font-semibold text-white">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endauth

            </div>
        </nav>
    </header>

    {{ $slot }}


    <style>
        .dropdown:focus-within .dropdown-menu {
            /* @apply block; */
            display: block;
        }
    </style>
</body>

</html>