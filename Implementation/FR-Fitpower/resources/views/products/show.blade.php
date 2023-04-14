<x-layout-user>
    <main class="max-w-7xl mx-auto sm:pt-16 sm:px-6 lg:px-8 mb-8">
        <div class="max-w-2xl mx-auto lg:max-w-none">
            <!-- Product -->
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
                <!-- Image gallery -->
                <div class="flex flex-col-reverse">
                    <!-- Image selector -->
                    <div class="mt-6 w-full max-w-2xl mx-auto lg:max-w-none p-2">
                        <div class="grid grid-cols-4 gap-6" aria-orientation="horizontal" role="tablist">
                            @foreach ($product->images as $image)
                                <button
                                    class="relative h-24 bg-white rounded-md flex items-center justify-center text-sm font-medium uppercase text-gray-900 cursor-pointer hover:bg-gray-50 focus:outline-none focus:ring focus:ring-offset-4 focus:ring-opacity-50 preview"
                                    type="button">
                                    <span class="absolute inset-0 rounded-md overflow-hidden">
                                        <img src="{{ asset('storage/' . $image) }}" alt=""
                                            class="w-full h-full object-center object-cover">
                                    </span>
                                    <span
                                        class="ring-transparent absolute inset-0 rounded-md ring-2 ring-offset-2 pointer-events-none"
                                        aria-hidden="true"></span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="w-full aspect-w-1 aspect-h-1">
                        <div>
                            <img id="main-image" src="{{ asset('storage/' . $product->images[0]) }}" alt="product image"
                                class="w-full h-full object-center object-cover sm:rounded-lg">
                        </div>
                    </div>
                </div>

                <!-- Product info -->
                <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $product->name }}</h1>

                    <div class="mt-3">
                        <p class="text-3xl text-gray-900">${{ $product->price }}</p>
                    </div>

                    <div class="mt-6">

                        <div class="text-base text-gray-700 space-y-6">
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>

                    <div class="mt-10 flex sm:flex-col1 md:w-1/2">
                        <livewire:add-to-cart :product="$product" />
                    </div>



                </div>
            </div>
        </div>
    </main>

</x-layout-user>
