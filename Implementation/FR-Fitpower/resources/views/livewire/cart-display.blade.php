    <div class="md:w-4/12 lg:w-3/12 sm:w-6/12 w-9/12 h-100 bg-white flex flex-col justify-between">
        <div>
            <div class="flex justify-between items-center p-4 text-lg border-b-2">
                <p>Shopping cart</p>
                <button>
                    <i class="toggele-card fa-solid fa-xmark"></i>
                </button>
            </div>
            <!-- cart products -->
            <div>
                @auth
                    @if ($carts->count() == 0)
                        <p class="text-center mt-6">Cart is emprty</p>
                    @endif
                    @foreach ($carts as $cart)
                        <div class="flex justify-between p-4">
                            <div class="flex gap-3">
                                <img src="{{ count($cart->product->images) > 0 ? asset('storage/' . $cart->product->images[0]) : asset('images/default.jpg') }}"
                                    width="60px" height="60px" alt="">
                                <p>{{ $cart->product->name }}<br>{{ $cart->quantity }} * ${{ $cart->product->price }}</p>
                                <p></p>
                            </div>
                            <button wire:click="deleteCart({{ $cart->id }})">
                                <i class="fa-regular fa-circle-xmark"></i>
                            </button>
                        </div>
                    @endforeach
                @endauth
                @guest
                    <p class="text-center mt-6">Login to see your cart</p>
                @endguest
            </div>
        </div>
        <div>
            <div class="flex justify-between items-center p-4 text-lg border-b-2 border-t-2">
                <p>Subtotal:</p>
                <p>${{ $total }}</p>
            </div>

            <div class="flex flex-col gap-2 p-2">
                <a href="/cart">
                    <button
                        class="py-3 px-10 bg-transparent border border-mainColor text-sm font-normal w-full text-mainColor uppercase">
                        View cart
                    </button>
                </a>
                <a href="/checkout">
                    <button class="py-3 px-10 bg-mainColor text-sm font-normal w-full text-white uppercase">
                        Checkout
                    </button>
                </a>
            </div>
        </div>
    </div>

