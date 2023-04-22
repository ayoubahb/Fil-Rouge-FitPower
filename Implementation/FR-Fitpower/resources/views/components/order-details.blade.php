@props(['order'])
<div class="p-6 bg-gray-100">
    <div class="mx-auto px-4 sm:px-6 md:px-8 my-10">
        <h1 class="text-4xl font-bold text-black text-center">Order details</h1>
    </div>
    <div class="px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto mb-10 bg-gray-100">
        <div class="grid grid-cols-6 w-full gap-5">
            <div class="col-span-6 md:col-span-3 flex gap-5 p-4 bg-white">
                <div class="relative top-1">
                    <i class="fa-solid fa-map-marker-alt fa-lg"></i>
                </div>
                <div class="font-light flex flex-col gap-2">
                    <p>{{ $order->first_name }} {{ $order->last_name }}</p>
                    <p>{{ $order->phone }}</p>
                    <p>{{ $order->address }}</p>
                </div>
            </div>
            <div class="col-span-6 md:col-span-3 flex gap-5 p-4 bg-white">
                <div class="relative top-1">
                    <i class="fa-regular fa-newspaper fa-lg"></i>
                </div>
                <div class="font-light flex flex-col gap-2">
                    <p>Order number: {{ $order->id }}</p>
                    <p>Order placed on: {{ $order->created_at->format('j F Y') }}</p>
                    <p>Payment method: {{ $order->payment_type }}</p>
                    <p>Order status: {{ $order->order_status }}</p>
                </div>
            </div>
            <div class="col-span-6 flex flex-col bg-white p-4">
                <h2 class="text-2xl mb-5">Order Items</h2>
                @foreach ($order->products as $product)
                    <div class="flex gap-3 w-full mb-4 items-center {{ $loop->last ? '' : 'border-b' }} p-3">
                        <div>
                            <img src="{{ count($product->images) > 0 ? asset('storage/' . $product->images[0]) : asset('images/default.jpg') }}"
                                alt="" width="100" height="100">
                        </div>
                        <div class="font-light">
                            <p>
                                <span class="font-bold">Product name: </span>{{ $product->name }}
                            </p>
                            <p>
                                <span class="font-bold">Quantity: </span>{{ $product->pivot->quantity }}
                            </p>
                            <p>
                                <span class="font-bold">Price: </span>$ {{ $product->price }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-span-6 flex justify-between p-4 bg-white">
                <p>Total</p>
                <p>$ {{ $order->total }}</p>
            </div>
        </div>
    </div>
</div>
