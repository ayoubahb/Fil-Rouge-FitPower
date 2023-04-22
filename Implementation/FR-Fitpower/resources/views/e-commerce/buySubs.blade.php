<x-layout-user>
    <section class="my-6 p-3">
        <div class="max-w-4xl mx-auto my-10">
            <h3 class="text-4xl text-center mb-5">Review your order</h3>
            <p class="mb-5 text-xl">Monthly subscription</p>
            <div class="pb-3 border-b-2">
                <div class="grid grid-cols-6 gap-3">
                    <div class="col-span-6 md:col-span-3">
                        <img src="{{ asset('images/gym.jpg') }}" alt="">
                    </div>
                    <div class="col-span-6 md:col-span-3 px-3">
                        <div class="flex items-center mb-3">
                            <img src="{{ asset('images/logocercle.png') }}" alt="" width="40"
                                class="relative z-30">
                            <span class="bg-gray-200 px-5 relative rounded z-10 text-md"
                                style="right: 10px">{{ $subscription->name }}</span>
                        </div>
                        <div>
                            @foreach ($subscription->includes as $include)
                                <div class="flex gap-2 items-center mb-3 text-sm">
                                    <i class="fa-solid fa-check"></i>
                                    <p>{{ $include }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-span-6 flex justify-between p-3 my-3 bg-gray-100 rounded">
                        <p>Monthly recurring payments</p>
                        <p>${{ $subscription->price }}</p>
                    </div>
                </div>
            </div>
            <div class="my-3">
                <form action="{{ route('paymentsub', ['id' => $subscription->id]) }}" method="post" class="mb-3">
                    @csrf
                    <button class="w-full border border-black py-3 flex justify-center items-center gap-2 text-lg">Check
                        out with <img src="{{ asset('images/PayPal.png') }}" alt="" width="80"></button>
                </form>
                <form action="{{ route('stripesub.payment', ['id' => $subscription->id]) }}" method="post">
                    @csrf
                    <button class="w-full border border-black py-3 flex justify-center items-center gap-2 text-lg">Check
                        out with <i class="fa-regular fa-credit-card"></i></button>
                </form>
            </div>
        </div>
    </section>
</x-layout-user>
