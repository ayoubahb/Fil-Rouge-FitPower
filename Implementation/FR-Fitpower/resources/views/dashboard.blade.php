<x-layout-user>
    <section class="my-10 max-w-5xl mx-auto p-5">
        <div>
            <h2 class="text-3xl md:px-6 lg:px-8 mb-5">Your orders</h2>
        </div>
        <div class="container mx-auto overflow-x-auto">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8 ">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    ID</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Client</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Total</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Payment type
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Status</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Details</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @if ($orders->count() > 0)
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    {{ $order->id }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $order->first_name }}
                                                    {{ $order->last_name }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-gray-900">${{ $order->total }}</div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-gray-900">{{ $order->payment_type }}</div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            @if ($order->payment_status == 'Paid')
                                                <span
                                                    class="inline-flex w-16 rounded bg-green-600 py-1 px-3 justify-center font-semibold leading-5 text-white">{{ $order->payment_status }}</span>
                                            @else
                                                <span
                                                    class="inline-flex w-16 rounded bg-red-600 py-1 px-3 justify-center font-semibold leading-5 text-white">{{ $order->payment_status }}</span>
                                            @endif
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <a href="/orders/{{ $order->id }}/details"
                                                class="text-indigo-600 hover:text-indigo-900">Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                @if ($orders->count() == 0)
                    <p class="text-center mt-4 text-red-400">No orders found</p>
                @endif
            </div>
        </div>
        <div class="mt-7">
            <h2 class="text-3xl md:px-6 lg:px-8 mb-5">Your subscription</h2>
        </div>
        <div class="container mx-auto mb-7 overflow-x-auto">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8 overflow-x-auto">
                <div class="overflow-scroll shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    Subscription owner</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Subscription
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Start date</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">End
                                    date</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Cancel</span>
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Expired</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @isset($subscription)
                                <tr class="{{ $subscription->expired ? 'bg-red-100' : '' }}">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                        {{ $subscription->user->name }}
                                    </td>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                        {{ $subscription->subscription->name }}
                                    </td>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                        {{ $subscription->date_start->format('j F Y') }}
                                    </td>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                        {{ $subscription->date_end->format('j F Y') }}
                                    </td>
                                    <td
                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="orders/{order}/details" class="text-red-600 hover:text-red-400">Cancel</a>
                                    </td>
                                    <td
                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm text-red-700 font-medium sm:pr-6">
                                        @if ($subscription->expired)
                                            Expired
                                        @endif
                                    </td>
                                </tr>
                            @endisset
                        </tbody>
                    </table>

                    @empty($subscription)
                        <p class="text-center mt-4 text-red-400">No subscription found</p>
                    @endisset
                </div>

            </div>
        </div>
    </section>
</x-layout-user>
