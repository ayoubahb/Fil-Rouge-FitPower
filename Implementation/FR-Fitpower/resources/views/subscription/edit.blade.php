<x-layout-admin>

    <div class="lg:max-w-3xl w-4/5 container mx-auto">
        <div class="relative">
            <div class="mb-20">
                <h3 class="text-lg leading-6 font-medium text-gray-900 text-center text-2xl">Update Subscription</h3>
            </div>
            <form action="/admin/subscription/{{ $subscription->id }}/update" method="POST">
                @csrf
                @method('PUT')
                <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                        <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                            Subscription
                            name
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <div class="max-w-lg flex rounded-md shadow-sm">
                                <input type="text" name="name" autocomplete="off"
                                    class="flex-1 block w-full focus:ring-indigo-500 focus:border-indigo-500 min-w-0 rounded sm:text-sm border-gray-300"
                                    value="{{ $subscription->name }}">
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                        <label for="Description" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                            Includes
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <textarea id="includes" name="includes" rows="3"
                                class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md"
                                placeholder="include1,include2,...">{{ $subscription->includes }}</textarea>
                            @error('includes')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                        <label for="price" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Monthly
                            price ($)
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <div class="max-w-lg flex rounded-md shadow-sm">
                                <input type="text" name="price" autocomplete="off"
                                    class="flex-1 block w-full focus:ring-indigo-500 focus:border-indigo-500 min-w-0 rounded sm:text-sm border-gray-300"
                                    value="{{ $subscription->price }}">
                            </div>
                            @error('price')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="py-3 text-right">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-mainColor hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</button>
                    </div>
                </div>
            </form>
            <form action="/admin/subscription/{{ $subscription->id }}/delete" class="absolute bottom-3 left-0" method="POST">
                @csrf
                @method('DELETE')
                <button
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Delete
                    subscription</button>
            </form>
        </div>
    </div>

</x-layout-admin>
