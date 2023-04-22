@props(['name'])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet" />
    {{-- fontawsome icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    {{-- css style and tailwind --}}
    @vite('resources/css/app.css')
    <title>{{ Route::currentRouteName() }}</title>
</head>

<body style="font-family: 'Lato', sans-serif;">
    <div class="min-h-[100vh] bg-gray-100">

        <div x-data="{ open: false }" @keydown.window.escape="open = false">

            <div x-show="open" class="fixed inset-0 flex z-40 md:hidden"
                x-description="Off-canvas menu for mobile, show/hide based on off-canvas menu state." x-ref="dialog"
                aria-modal="true">

                <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity ease-linear duration-300"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-gray-600 bg-opacity-75"
                    x-description="Off-canvas menu overlay, show/hide based on off-canvas menu state."
                    @click="open = false" aria-hidden="true">
                </div>

                <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform"
                    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in-out duration-300 transform"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                    x-description="Off-canvas menu, show/hide based on off-canvas menu state."
                    class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-thirdColor">

                    <div x-show="open" x-transition:enter="ease-in-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in-out duration-300" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        x-description="Close button, show/hide based on off-canvas menu state."
                        class="absolute top-0 right-0 -mr-12 pt-2">
                        <button type="button"
                            class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                            @click="open = false">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" x-description="Heroicon name: outline/x"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="flex-shrink-0 flex items-center px-4 my-5">
                        <i class="fa-regular fa-circle-user text-white fa-2xl mr-3"></i>
                        <span class="text-white text-xs"><b>AYOUB AHABBANE</b><br>Admin</span>
                    </div>
                    <div class="flex justify-center px-4 my-2">
                        <a href="{{ route('admin.logout') }}">
                            <button class="bg-transparent font-light border text-white px-6 py-1">Logout</button>
                        </a>
                    </div>
                    <div class="mt-5 flex-1 h-0 overflow-y-auto">
                        <nav class="px-2 space-y-5">

                            <a href="/admin/orders"
                                class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ Route::is('Admin - Orders') ? 'text-mainColor' : 'text-white' }}">
                                <i class="fa-solid fa-bag-shopping  mr-5 fa-xl"></i>
                                Orders
                            </a>

                            <a href="/admin/products"
                                class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ Route::is('Admin - Products') ? 'text-mainColor' : 'text-white' }}">
                                <i class="fa-solid fa-dolly mr-4 fa-xl"></i>
                                Products
                            </a>

                            <a href="/admin/clientsubs"
                                class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ Route::is('Admin - Clients subscriptions') ? 'text-mainColor' : 'text-white' }}">
                                <i class="fa-solid fa-window-restore mr-3 fa-xl"></i>
                                Clients’s Subscriptions
                            </a>

                            <a href="/admin/subscriptions"
                                class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ Route::is('Admin - Subscriptions') ? 'text-mainColor' : 'text-white' }}">
                                <i class="fa-solid fa-dumbbell mr-3 fa-xl"></i>
                                Subscriptions
                            </a>


                        </nav>
                    </div>
                </div>

                <div class="flex-shrink-0 w-14" aria-hidden="true">
                    <!-- Dummy element to force sidebar to shrink to fit close icon -->
                </div>
            </div>


            <!-- Static sidebar for desktop -->
            <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div class="flex flex-col flex-grow pt-5 bg-thirdColor overflow-y-auto bg-thirdColor">
                    <div class="flex-shrink-0 flex items-center px-4 my-5">
                        <i class="fa-regular fa-circle-user text-white fa-2xl mr-3"></i>
                        <span
                            class="text-white text-xs uppercase"><b>{{ Auth::guard('admin')->user()->name }}</b><br>Admin</span>
                    </div>
                    <div class="flex justify-center px-4 my-2">
                        <a href="{{ route('admin.logout') }}">
                            <button class="bg-transparent font-light border text-white px-6 py-1">Logout</button>
                        </a>
                    </div>

                    <div class="mt-5 flex-1 flex flex-col">
                        <nav class="flex-1 px-2 pb-4 space-y-5">

                            <a href="/admin/orders"
                                class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ Route::is('Admin - Orders') ? 'text-mainColor' : 'text-white' }}">
                                <i class="fa-solid fa-bag-shopping  mr-5 fa-xl"></i>
                                Orders
                            </a>

                            <a href="/admin/products"
                                class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ Route::is('Admin - Products') ? 'text-mainColor' : 'text-white' }}">
                                <i class="fa-solid fa-dolly mr-4 fa-xl"></i>
                                Products
                            </a>

                            <a href="/admin/clientsubs"
                                class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ Route::is('Admin - Clients subscriptions') ? 'text-mainColor' : 'text-white' }}">
                                <i class="fa-solid fa-window-restore mr-3 fa-xl"></i>
                                Clients’s Subscriptions
                            </a>

                            <a href="/admin/subscriptions"
                                class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ Route::is('Admin - Subscriptions') ? 'text-mainColor' : 'text-white' }}">
                                <i class="fa-solid fa-dumbbell mr-3 fa-xl"></i>
                                Subscriptions
                            </a>



                        </nav>
                    </div>
                </div>
            </div>
            <div class="md:pl-64 flex flex-col flex-1">
                <div class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow">
                    <button type="button"
                        class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden"
                        @click="open = true">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="h-6 w-6" x-description="Heroicon name: outline/menu-alt-2"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                    </button>
                    @if (!Route::is('create.product') && !Route::is('edit.product'))
                        <div class="flex-1 px-4 flex justify-between">
                            <div class="flex-1 flex">
                                <form class="w-full flex md:ml-0" method="GET">
                                    <label for="search-field" class="sr-only">Search</label>
                                    <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                                        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5" x-description="Heroicon name: solid/search"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input id="search-field"
                                            class="block w-full h-full pl-8 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-0 focus:border-transparent sm:text-sm"
                                            placeholder="Search" type="search" name="search">
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                </div>

                <main>
                    <div class="p-6">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </div>

    @vite('resources/js/app.js')
    @livewireScripts

</body>

</html>
