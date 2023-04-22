    @vite('resources/css/app.css')
    <title>{{ Route::currentRouteName() }}</title>

    <div class="bg-gray-100 h-screen">
        <div class="bg-white p-6  md:mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="text-red-500 w-16 h-16 mx-auto my-6" fill='currentColor'>
                <path
                    d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" />
            </svg>
            <div class="text-center">
                <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">Your order has been cancelled!</h3>
                <div class="py-10 text-center">
                    <a href="/" class="px-12 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3">
                        GO BACK
                    </a>
                </div>
            </div>
        </div>
    </div>
