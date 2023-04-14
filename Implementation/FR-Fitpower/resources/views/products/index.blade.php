<x-layout-admin name='search'>
    <div class="mx-auto px-4 sm:px-6 md:px-8 flex justify-between items-center">
        <h1 class="text-4xl font-bold text-mainColor">Products</h1>
        <x-success-flash />
        <a href="{{ route('create.product') }}">
            <button type="button"
                class="inline-flex items-center justify-center rounded-md border border-transparent bg-mainColor px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add
                product</button>
        </a>
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
                                        Product Name</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Stock</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @if ($products->count() > 0)
                                    @foreach ($products as $product)
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                                <div class="flex items-center">
                                                    <div class="h-20 w-20 flex-shrink-0">
                                                        <img class="w-full rounded"
                                                            src="{{ count($product->images) > 0 ? asset('storage/' . $product->images[0]) : asset('images/default.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="font-medium text-gray-900">{{ $product->name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                <div class="text-gray-900">${{ $product->price }}</div>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                @if ($product->stock > 0)
                                                    <span>{{ $product->stock }}</span>
                                                    <span
                                                        class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800 ml-2">On
                                                        stock</span>
                                                @else
                                                    <span
                                                        class="inline-flex rounded-full bg-red-200 px-2 text-xs font-semibold leading-5 text-red-800">Out
                                                        stock</span>
                                                @endif
                                            <td
                                                class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                <a href="/admin/products/{{ $product->id }}/edit"
                                                    class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @if ($products->count() == 0)
                        <p class="text-center mt-4 text-red-400">No products found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout-admin>
