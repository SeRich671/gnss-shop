<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row gap-8">
            <!-- Left: Order Form -->
            <div class="w-full lg:w-3/4 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">Order Details</h2>
                <form method="POST" action="{{ route('order.store') }}" class="space-y-6">
                    @csrf

                    <!-- First Name and Last Name -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Name</label>
                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('first_name') border-red-500 @enderror">
                            @error('first_name')
                            <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('last_name') border-red-500 @enderror">
                            @error('last_name')
                            <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror">
                        @error('email')
                        <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Country, City, and Postcode -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="address_country" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Country</label>
                            <input type="text" name="address[country]" id="address_country" value="{{ old('address.country') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('address.country') border-red-500 @enderror">
                            @error('address.country')
                            <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="address_city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">City</label>
                            <input type="text" name="address[city]" id="address_city" value="{{ old('address.city') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('address.city') border-red-500 @enderror">
                            @error('address.city')
                            <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="address_postcode" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Postcode</label>
                            <input type="text" name="address[postcode]" id="address_postcode" value="{{ old('address.postcode') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('address.postcode') border-red-500 @enderror">
                            @error('address.postcode')
                            <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Street, Building, and Flat -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-2">
                            <label for="address_street" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Street</label>
                            <input type="text" name="address[street]" id="address_street" value="{{ old('address.street') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('address.street') border-red-500 @enderror">
                            @error('address.street')
                            <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="address_building" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Building</label>
                            <input type="text" name="address[building]" id="address_building" value="{{ old('address.building') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('address.building') border-red-500 @enderror">
                            @error('address.building')
                            <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="address_flat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Flat</label>
                            <input type="text" name="address[flat]" id="address_flat" value="{{ old('address.flat') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('address.flat') border-red-500 @enderror">
                            @error('address.flat')
                            <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="w-full px-6 py-3 bg-green-600 text-white rounded-md hover:bg-green-700">
                            Place Order
                        </button>
                    </div>
                </form>
            </div>




            <!-- Right: Cart Summary -->
            <div class="w-full lg:w-1/4">
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-4">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">Your Cart</h2>
                    <ul class="space-y-4">
                        @php
                            $total = 0;
                        @endphp
                        @foreach(\App\Support\Cart::retrieveCart() as $item)
                            @php
                                $product = $item['product'];
                                $total += $product->price * $item['quantity'];
                            @endphp
                            <li class="flex items-center space-x-4">
                                <!-- Product Image -->
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-lg">

                                <!-- Product Info -->
                                <div class="ms-2">
                                    <p class="text-gray-800 dark:text-gray-200 font-medium">{{ $product->name }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Qty: {{ $item['quantity'] }}</p>
                                    <p class="text-sm text-indigo-600 dark:text-indigo-400 font-bold">{{ $product->price * $item['quantity'] }} USD</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <h5 class="font-bold text-gray-800 dark:text-gray-200 mt-4">Total: {{ $total }}</h5>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
