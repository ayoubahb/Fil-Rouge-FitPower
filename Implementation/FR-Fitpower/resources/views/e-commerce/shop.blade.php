<x-layout-user>
    <section class="my-5 bg">
        <div class="container mx-auto my-5">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-9 md:col-span-3 lg:col-span-2 flex flex-col">
                    <div class="p-5 bg-white">
                        <form class=" w-full">
                            <label for="search" class="block">Search</label>
                            <div class="flex w-full justify-between">
                                <input type="text" id="search" name="search" class="border w-9/12 p-2"
                                    placeholder="Search products..">
                                <button class="p-2 bg-thirdColor text-white w-1/5"><i
                                        class="fa-solid fa-chevron-right"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="p-5 bg-white mt-4">
                        <h3 class="font-semibold italic">Filter by categories</h3>
                        <a href="#" class="block mt-3 text-mainColor">Protein (19)</a>
                        <a href="#" class="block mt-3 text-mainColor">Shirts (8)</a>
                        <a href="#" class="block mt-3 text-mainColor">Accessories (10)</a>
                    </div>
                </div>
                <div class="col-span-9 md:col-span-5 lg:col-span-6 py-5 px-10 bg-white">
                    <h1 class="text-center text-6xl font-semibold italic">Shop</h1>

                    <div class="flex justify-between items-center mx-auto mt-4">
                        <p>Showing {{ $products->count() }} result</p>
                        <select class="py-2 px-4">
                            <option value="">Default sorting</option>
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="grid grid-cols-6 gap-5 mt-4">
                        @foreach ($products as $product)
                            <div class="col-span-6 md:col-span-3 lg:col-span-2 flex flex-col gap-2">
                                <a href="/product/{{ $product->id }}">
                                    <img src="{{ count($product->images) > 0 ? asset('storage/' . $product->images[0]) : asset('images/default.jpg') }}"
                                        alt="" class="w-full">
                                    <p class="text-gray-400">Category</p>
                                    <h3 class="font-semibold text-xl">{{ $product->name }}</h3>
                                    <p class="font-semibold italic">{{ $product->price }} DH</p>
                                </a>
                                <livewire:add-to-cart :product="$product" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout-user>
