<x-layout-user>
    <div class="bg-gray-50">
        <main class="max-w-7xl mx-auto pt-16 pb-24 px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto lg:max-w-none">
                <h1 class="sr-only">Checkout</h1>

                <form class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16" action="/createorder" method="POST">
                    @csrf
                    <div>
                        <div class="">
                            <h2 class="text-lg font-medium text-gray-900">Shipping information</h2>

                            <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                                <div>
                                    <label for="first-name" class="block text-sm font-medium text-gray-700">First
                                        name</label>
                                    <div class="mt-1">
                                        <input type="text" id="first_name" name="first_name"
                                            value="{{ old('first_name') }}"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                    @error('first_name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last
                                        name</label>
                                    <div class="mt-1">
                                        <input type="text" id="last_name" name="last_name"
                                            value="{{ old('last_name') }}"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                    @error('last_name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="address"
                                        class="block text-sm font-medium text-gray-700">Address</label>
                                    <div class="mt-1">
                                        <input type="text" name="address" id="address" value="{{ old('address') }}"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                    @error('address')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                    <div class="mt-1">
                                        <input type="text" name="city" id="city" value="{{ old('city') }}"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                    @error('city')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="postal_code" class="block text-sm font-medium text-gray-700">Postal
                                        code</label>
                                    <div class="mt-1">
                                        <input type="text" name="postal_code" id="postal-code"
                                            value="{{ old('postal_code') }}"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                    @error('postal-code')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                    <div class="mt-1">
                                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                    @error('phone')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Payment -->
                        <div class="mt-10 border-t border-gray-200 pt-10">
                            <h2 class="text-lg font-medium text-gray-900">Payment</h2>

                            <fieldset class="mt-4">
                                <legend class="sr-only">Payment type</legend>
                                <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                                    <div class="flex items-center">
                                        <input id="credit-card" name="payment_type" type="radio" value="Credit card"
                                            class="focus:ring-mainColor h-4 w-4 text-indigo-600 border-gray-300">
                                        <label for="credit-card" class="ml-3 block text-sm font-medium text-gray-700">
                                            Credit card </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="paypal" name="payment_type" type="radio" value="Paypal"
                                            class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                        <label for="paypal" class="ml-3 block text-sm font-medium text-gray-700">
                                            PayPal </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="Cash-on-delivery" name="payment_type" type="radio"
                                            value="Cash on delivery"
                                            class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                        <label for="Cash-on-delivery"
                                            class="ml-3 block text-sm font-medium text-gray-700">
                                            Cash on delivery </label>
                                    </div>
                                </div>
                            </fieldset>
                            @error('payment_type')
                                <p class="text-red-500 text-xs mt-3">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Order summary -->
                    <div class="mt-10 lg:mt-0">
                        <h2 class="text-lg font-medium text-gray-900">Order summary</h2>

                        <div class="mt-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                            <h3 class="sr-only">Items in your cart</h3>
                            <ul role="list" class="divide-y divide-gray-200">
                                @foreach ($carts as $cart)
                                    <li class="flex py-6 px-4 sm:px-6">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('storage/' . $cart->product->images[0]) }}"
                                                alt="" class="w-20 rounded-md">
                                        </div>

                                        <div class="ml-6 flex-1 flex flex-col">
                                            <div class="flex">
                                                <div class="min-w-0 flex-1">
                                                    <h4 class="text-sm">
                                                        <a href="#"
                                                            class="font-medium text-gray-700 hover:text-gray-800">
                                                            Basic
                                                            Tee </a>
                                                    </h4>
                                                    <p class="mt-1 text-sm font-medium text-gray-900">
                                                        ${{ $cart->product->price }}</p>
                                                    <p class="mt-1 text-sm font-medium text-gray-900">Quantity :
                                                        {{ $cart->quantity }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                @endforeach

                                <!-- More products... -->
                            </ul>
                            <dl class="border-t border-gray-200 py-6 px-4 space-y-6 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <dt class="text-base font-medium">Total</dt>
                                    <dd class="text-base font-medium text-gray-900">${{ $total }}</dd>
                                </div>
                            </dl>

                            <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                                <button type="submit"
                                    class="w-full bg-mainColor border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500">Confirm
                                    order</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>

    </div>


</x-layout-user>
