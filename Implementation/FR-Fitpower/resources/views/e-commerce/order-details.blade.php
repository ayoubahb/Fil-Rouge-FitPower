<x-layout-user>

    <x-order-details :order="$order" />
    <div class="bg-gray-100 relative bottom-10 px-6">
        @if ($order->order_status == 'In progress')
            <form action="/order/{{ $order->id }}/confirm" method="post"
                class=" max-w-4xl px-4 sm:px-6 lg:px-8 mx-auto flex justify-end">
                @csrf
                @method('PUT')
                <button
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-thirdColor focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Confirme
                    order</button>
            </form>
        @endif
    </div>
    <style>
        body {
            background-color: rgb(243 244 246);
        }
    </style>
</x-layout-user>
