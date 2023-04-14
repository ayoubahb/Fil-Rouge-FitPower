<x-layout-admin name='order_search'>
    <div class="mx-auto px-4 sm:px-6 md:px-8 flex justify-between items-center">
        <h1 class="text-4xl font-bold text-mainColor">Orders</h1>
    </div>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        ID</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Client</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Total</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Payment type
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
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
                                                <a href="/admin/products/{{ $order->id }}/edit"
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
        </div>
    </div>
</x-layout-admin>
