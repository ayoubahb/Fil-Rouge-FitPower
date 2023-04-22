<x-layout-admin name=''>

    <div class="lg:max-w-3xl w-4/5 container mx-auto">
        <div class="relative">
            <div class="mb-20">
                <h3 class="text-lg leading-6 font-medium text-gray-900 text-center text-2xl">Update product</h3>
            </div>
            <form action="/admin/products/{{ $product->id }}/update" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-gray-200 sm:pt-5">
                    <label class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Product pictures </label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <livewire:manage-picture :product="$product" />
                        <div class="max-w-lg flex justify-cente border-2 border-gray-300 border-dashed rounded-md">
                            <div class="flex text-sm text-gray-600 w-full">
                                <label for="file-upload"
                                    class="flex flex-col items-center p-6 cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500 w-full">
                                    <div class="flex gap-2 mb-2" id="images-container"></div>
                                    <svg id="svg" class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                        fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Upload a picture</span>
                                    <input id="file-upload" name="images[]" type="file" class="sr-only"
                                        multiple="">
                                </label>
                            </div>
                        </div>
                        @error('images')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                        <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Product
                            name
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <div class="max-w-lg flex rounded-md shadow-sm">
                                <input type="text" name="name" autocomplete="off"
                                    class="flex-1 block w-full focus:ring-indigo-500 focus:border-indigo-500 min-w-0 rounded sm:text-sm border-gray-300"
                                    value="{{ $product->name }}">
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                        <label for="Description" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                            Description
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <textarea id="Description" name="description" rows="3"
                                class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md">{{ $product->description }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                        <label for="category" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                            Category
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <select id="category" name="category"
                                class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 w-full">
                                <option value="">Choose a category</option>
                                <option value="Protein"{{ $product->category == 'Protein' ? 'selected' : '' }}>Protein</option>
                                <option value="Shirts" {{ $product->category == 'Shirts' ? 'selected' : '' }}>Shirts</option>
                                <option value="Accessories" {{ $product->category == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                            </select>
                            @error('category')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                        <label for="price" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Price
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <div class="max-w-lg flex rounded-md shadow-sm">
                                <input type="text" name="price" autocomplete="off"
                                    class="flex-1 block w-full focus:ring-indigo-500 focus:border-indigo-500 min-w-0 rounded sm:text-sm border-gray-300"
                                    value="{{ $product->price }}">
                            </div>
                            @error('price')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div
                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-b sm:border-gray-200 sm:pt-5 sm:pb-5">
                        <label for="stock" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Stock
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <div class="max-w-lg flex rounded-md shadow-sm">
                                <input type="number" name="stock" autocomplete="off"
                                    class="flex-1 block w-full focus:ring-indigo-500 focus:border-indigo-500 min-w-0 rounded sm:text-sm border-gray-300"
                                    value="{{ $product->stock }}">
                            </div>
                            @error('stock')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="py-3 flex justify-end">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-mainColor hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</button>
                    </div>
                </div>
            </form>
            <form action="/admin/products/{{ $product->id }}/delete" class="absolute bottom-3 left-0" method="POST">
                @csrf
                @method('DELETE')
                <button
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Delete
                    product</button>
            </form>
        </div>
    </div>

</x-layout-admin>
