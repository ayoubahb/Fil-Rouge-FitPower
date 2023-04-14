<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    @vite('resources/css/app.css')
    <title>{{ Route::currentRouteName() }}</title>
</head>

<body style="font-family: 'Lato', sans-serif; padding-top: 80px">
    <div class="hidden fixed w-full top-0 left-0 bg-transparent flex justify-center items-center h-screen z-20"
        id="login">
        <div class="max-w-xl w-11/12 p-10 bg-thirdColor text-white relative">
            <button type="button" class="absolute right-5 top-8" id="close-login">
                <i class="fa-solid fa-xmark fa-2xl"></i>
            </button>

            <div class="mb-10">
                <p class="text-4xl font-bold text-center mb-4">Login</p>
                <p class="text-center">Please enter your email and password to access your account</p>
            </div>
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                            name="remember">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="ml-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
    <nav
        class="bg-thirdColor border-gray-200 px-2 sm:px-4 py-2.5 fixed w-full top-0 z-10 bg-secColor h-20 flex items-end">
        <div class="container flex flex-wrap items-center justify-between mx-auto">
            <a href="/" class="block md:hidden">
                <img src="/images/logo.png" alt="logo" width="70">
            </a>
            <div class="flex items-center md:order-2 gap-5">
                <livewire:cart-icon />
                @guest
                    <div class="flex items-center gap-2 cursor-pointer" id="open-login">
                        <i class="fa-regular fa-circle-user text-white fa-lg"></i>
                        <span class="text-bold text-white">Connexion</span>
                    </div>
                @endguest
                @auth
                    <button type="button"
                        class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300"
                        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                        data-dropdown-placement="bottom">
                        <!-- <span class="sr-only">Open user menu</span> -->
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-gray-500">
                            <span class="text-sm font-medium leading-none text-white">
                                @php
                                    $name = auth()->user()->name;
                                    $words = explode(' ', $name);
                                    $avatar = substr($words[0], 0, 1) . substr($words[1], 0, 1);
                                    $avatar = strtoupper($avatar);
                                @endphp
                                {{ $avatar }}
                            </span>
                        </span>
                    </button>

                    <!-- Dropdown menu -->
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow"
                        id="user-dropdown">
                        <div class="px-4 py-3">
                            <span class="block text-sm text-gray-900">{{ auth()->user()->name }}</span>
                            <span class="block text-sm font-medium text-gray-500 truncate">{{ auth()->user()->email }}</span>
                        </div>
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100""
                                        href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
                <button data-collapse-toggle="mobile-menu-2" type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div class="hidden md:flex gap-2">
                    <button>
                        <i class="fa-brands fa-instagram text-white fa-lg"></i>
                    </button>
                    <button>
                        <i class="fa-brands fa-youtube text-white fa-lg"></i>
                    </button>
                    <button>
                        <i class="fa-brands fa-facebook text-white fa-lg"></i>
                    </button>
                </div>
            </div>
            <div class="items-center gap-0 md:gap-10 hidden w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">
                <a href="/" class="hidden md:block">
                    <img src="/images/logo.png" alt="logo" width="100">
                </a>
                <ul
                    class="bg-thirdColor p-4 md:p-0 w-full left-0 absolute md:relative border border-0 flex flex-col md:border-0 md:flex-row md:font-medium md:mt-0 md:space-x-16 md:text-sm outline-0 mt-2.5">
                    <!-- bg-thirdColor p-4 w-full left-0 -->
                    <li>
                        <a href="/"
                            class="font-light block py-2 pl-3 pr-4 rounded md:p-0 {{ Route::is('Home')
                                ? 'text-secColor'
                                : 'text-white hover:bg-mainColor md:hover:bg-transparent md:hover:text-secColor
                                                                                                                                                                                                                                                                                            hover:bg-mainColor md:hover:bg-transparent md:hover:text-secColor
                                                                                                                                                                                                                                                                                            hover:bg-mainColor md:hover:bg-transparent md:hover:text-secColor' }}">Home</a>
                    </li>
                    <li>
                        <a href="/about"
                            class="font-light font-light block py-2 pl-3 pr-4 text-gray-700 rounded md:p-0 {{ Route::is('About')
                                ? 'text-secColor'
                                : 'text-white hover:bg-mainColor md:hover:bg-transparent md:hover:text-secColor
                                                                                                                                                                                                                                                                                            hover:bg-mainColor md:hover:bg-transparent md:hover:text-secColor
                                                                                                                                                                                                                                                                                            hover:bg-mainColor md:hover:bg-transparent md:hover:text-secColor' }}">About</a>
                    </li>
                    <li>
                        <a href="/subscriptions"
                            class="font-light block py-2 pl-3 pr-4 text-gray-700 rounded md:p-0 {{ Route::is('Subscriptions')
                                ? 'text-secColor'
                                : 'text-white hover:bg-mainColor md:hover:bg-transparent md:hover:text-secColor
                                                                                                                                                                                                                                                                                            hover:bg-mainColor md:hover:bg-transparent md:hover:text-secColor
                                                                                                                                                                                                                                                                                            hover:bg-mainColor md:hover:bg-transparent md:hover:text-secColor' }}">Subscriptions</a>
                    </li>
                    <li>
                        <a href="/shop"
                            class="font-light block py-2 pl-3 pr-4 text-gray-700 rounded md:p-0 {{ Route::is('Shop')
                                ? 'text-secColor'
                                : 'text-white hover:bg-mainColor md:hover:bg-transparent md:hover:text-secColor
                                                                                                                                                                                                                                                                                            hover:bg-mainColor md:hover:bg-transparent md:hover:text-secColor
                                                                                                                                                                                                                                                                                            hover:bg-mainColor md:hover:bg-transparent md:hover:text-secColor' }}">Shop</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section id="card" class="fixed w-full right-0 flex justify-end">
        <livewire:cart-display />
    </section>


    {{ $slot }}

    <footer class="bg-mainColor w-full flex items-center md:p-20 px-5 py-10">
        <div class="container mx-auto text-white">
            <div class="grid grid-cols-6 gap-10">
                <div class="col-span-6 md:col-span-2">
                    <p class="mb-10">
                        Send us a message. We will reply as soon as possible
                    </p>
                    <form action="">
                        <div class="grid grid-cols-2 gap-7">
                            <div class="col-span-1">
                                <label>Name</label>
                                <input type="text"
                                    class="block border-0 border-b-2 border-white bg-transparent mt-3 w-full" />
                            </div>
                            <div class="col-span-1">
                                <label>Phone</label>
                                <input type="text"
                                    class="block border-0 border-b-2 border-white bg-transparent mt-3 w-full" />
                            </div>
                        </div>
                        <div class="w-full mt-8">
                            <label>Email</label>
                            <input type="text"
                                class="block border-0 border-b-2 border-white bg-transparent mt-3 w-full" />
                        </div>
                        <div class="w-full mt-8">
                            <label>Message</label>
                            <textarea name="" id="" cols="30" rows="5"
                                class="block border-0 border-b-2 border-white bg-transparent mt-3 w-full"></textarea>
                        </div>
                        <button class="py-2 px-14 bg-transparent font-light border mt-8">
                            Send
                        </button>
                    </form>
                </div>
                <div class="col-span-4 md:col-span-2 flex flex-col justify-center gap-3">
                    <h4 class="text-2xl border-b-2 pb-3">
                        Bled El Jed<br />
                        46000 Safi, Morocco <br />E-mail : fitpower@example.com
                    </h4>
                    <p>Tél : 01 23 45 67 89 I Fax : 01 23 45 67 89</p>
                    <div class="social flex gap-2">
                        <button>
                            <i class="fa-brands fa-instagram text-white fa-lg"></i>
                        </button>
                        <button>
                            <i class="fa-brands fa-youtube text-white fa-lg"></i>
                        </button>
                        <button>
                            <i class="fa-brands fa-facebook text-white fa-lg"></i>
                        </button>
                    </div>
                </div>
                <div class="col-span-4 md:col-span-2 md:p-20 flex items-center">
                    <ul class="flex flex-col gap-5">
                        <li class="hover:text-thirdColor text-lg font-light">
                            <a href="/">Home</a>
                        </li>
                        <li class="hover:text-thirdColor text-lg font-light">
                            <a href="/about">About</a>
                        </li>
                        <li class="hover:text-thirdColor text-lg font-light">
                            <a href="/subscriptions">Subscriptions</a>
                        </li>
                        <li class="hover:text-thirdColor text-lg font-light">
                            <a href="/shop">Shop</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    @vite('resources/js/app.js')
    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
</body>

</html>
