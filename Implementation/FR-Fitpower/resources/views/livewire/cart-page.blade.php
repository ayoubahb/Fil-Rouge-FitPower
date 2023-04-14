<section class="my-20">
    <div class="container mx-auto bg-white lg:max-w-5xl p-5">
        <div class="overflow-x-scroll">
            <table class="product-table w-full my-5 border">
                <thead class="border-b h-14">
                    <tr class="text-left">
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($carts->count() != 0)
                        @foreach ($carts as $cart)
                            <tr class="border-b">
                                <td class="flex gap-10 items-center px-3 h-20">
                                    <button wire:click="deleteCart({{ $cart->id }})">
                                        <i class="fa-regular fa-circle-xmark opacity-50"></i>
                                    </button>
                                    <img src="{{ count($cart->product->images) > 0 ? asset('storage/' . $cart->product->images[0]) : asset('images/default.jpg') }}"
                                        alt="" width="60">
                                </td>
                                <td>{{ $cart->product->name }}</td>
                                <td>{{ $cart->product->price }}DH</td>
                                <td>
                                    <input type="number" wire:model="quantities.{{ $cart->id }}" class="border-0">
                                </td>
                                <td>{{ $cart->product->price * floatval($quantities[$cart->id] ?? 0) }}DH</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="p-5 text-center">Your cart is empty</td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="5" class="text-right h-20 px-5">
                            <button type="button" wire:click="updateCart"
                                class="text-white bg-secColor py-4 px-10 uppercase">Update
                                cart</button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="flex justify-end">
            <table class="h-10 w-full md:w-1/2 border">
                <thead class="bg-gray-100">
                    <th class="p-2 uppercase text-left">Cart Total</th>
                    <th class="p-2 text-left"></th>
                </thead>
                <tbody>
                    <tr class="border-b-2">
                        <td class="p-3 w-1/3">Total :</td>
                        <td class="p-3 w-2/2">{{ $total }} DH</td>
                    </tr>
                    <tr class="border-b-2">
                        <td colspan="2" class="p-5">
                            <a href="/checkout">
                                <button type="button" class="text-white bg-secColor w-full py-4 uppercase">Proceed to
                                    checkout</button>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
