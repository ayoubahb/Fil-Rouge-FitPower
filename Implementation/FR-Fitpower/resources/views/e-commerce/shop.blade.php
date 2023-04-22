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
                        <a href="/shop/?category=Protein" class="block mt-3 text-mainColor w-fit">Protein</a>
                        <a href="/shop/?category=Shirts" class="block mt-3 text-mainColor w-fit">Shirts</a>
                        <a href="/shop/?category=Accessories" class="block mt-3 text-mainColor w-fit">Accessories</a>
                    </div>
                </div>
                <div class="col-span-9 md:col-span-5 lg:col-span-6 py-5 px-10 bg-white">
                    <h1 class="text-center text-6xl font-semibold italic">Shop</h1>

                    <div class="flex justify-between items-center mx-auto mt-4">
                        <p>Showing {{ $products->count() }} result</p>
                        <select class="py-2 px-4 w-48" id="sort">
                            <option value="price_asc">Price: Low to High</option>
                            <option value="price_desc">Price: High to Low</option>
                            <option value="name_asc">Name: A to Z</option>
                            <option value="name_desc">Name: Z to A</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-6 gap-5 mt-4 products">
                        @foreach ($products as $product)
                            <div class="col-span-6 md:col-span-3 lg:col-span-2 flex flex-col gap-2 product"
                                data-price="{{ $product->price }}" data-name="{{ $product->name }}">
                                <a href="/product/{{ $product->id }}">
                                    <img src="{{ count($product->images) > 0 ? asset('storage/' . $product->images[0]) : asset('images/default.jpg') }}"
                                        alt="" class="w-full max-h-80">
                                    <p class="text-gray-400">{{ $product->category }}</p>
                                    <h3 class="font-semibold text-xl">{{ $product->name }}</h3>
                                    <p class="font-semibold italic">${{ $product->price }}</p>
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
