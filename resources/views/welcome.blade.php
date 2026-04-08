<x-layout>


    <div class="text-center text-white mt-20">
        <div class="header-text text-5xl font-light">
            <h1>Welcome to MoodGauge</h1>
        </div>

        <div class="signup-div mt-20 text-2xl w-90 mx-auto">
            <h2 class="font-semibold">Create an account to start your Journey</h2>

            <a href="{{ route('show.register') }}">
                <div class="border-colour-gradient">
                    <p>signup</p>
                </div>
            </a>
        </div>
    </div>

</x-layout>