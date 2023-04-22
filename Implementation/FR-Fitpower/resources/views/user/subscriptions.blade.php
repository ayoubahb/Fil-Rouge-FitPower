<x-layout-user>
    <section class="my-20">
        <div class="container mx-auto">
            <h2 class="font-extrabold text-4xl text-mainColor text-center w-full">
                Our subscriptions
            </h2>
            <div class="flex md:flex-row flex-col justify-center p-4 flex-nowrap gap-4 mt-10">
                @foreach ($subscriptions as $subscription)
                    <div
                        class="card w-full md:w-1/3 bg-mainColor text-white gap-8 p-5 flex flex-col items-center justify-between {{ $loop->iteration % 2 == 0 ? 'bg-thirdColor' : 'bg-mainColor' }}">
                        <div class="flex flex-col items-center gap-8">
                            <p class="text-2xl">{{ $subscription->name }}</p>
                            <h3 class="font-bold text-5xl">
                                {{ $subscription->price }}<span class="font-normal text-lg ml-2">$</span>
                            </h3>
                            <p class="font-bold text-3xl">Per month</p>
                            <div>
                                @foreach ($subscription->includes as $include)
                                    <div class="flex gap-2 items-center mb-3">
                                        <i class="fa-solid fa-check"></i>
                                        <p>{{ $include }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <a href="/checkoutSub/{{$subscription->id}}">
                            <button class="py-2 px-14 bg-transparent font-light border">
                                Subscribe
                            </button>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layout-user>
