<nav x-data="{ open: false, cartOpen: {{ session('cart_success') ? 'true' : 'false' }} }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                @php
                    $categories = \App\Models\Category::whereNull('category_id')->get();
                @endphp
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @foreach($categories as $category)
                        <x-nav-link :href="route('category', $category)" :active="request()->routeIs('category') && request()->route('category')->id == $category->id">
                            {{ $category->name }}
                        </x-nav-link>
                    @endforeach
                </div>
            </div>

            <!-- User Options and Cart -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-8">
                <!-- Cart Icon -->
                <div class="relative">
                    <button @click="cartOpen = true" class="flex items-center space-x-2">
                        <box-icon name="cart" type="solid" color="#4B5563"></box-icon>
                        <span class="text-sm text-gray-800 dark:text-gray-200 font-medium"></span>
                        <span class="absolute top-0 left-5 bg-red-600 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center">
                            {{ \App\Support\Cart::cartItemCount() }}
                        </span>
                    </button>
                </div>

                <!-- Authenticated User Dropdown -->
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @admin
                            <x-dropdown-link :href="route('admin.index')">
                                {{ __('Admin Panel') }}
                            </x-dropdown-link>
                            @endadmin
                            <x-dropdown-link :href="route('dashboard')">
                                {{ __('Dashboard') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

                <!-- Guest Links -->
                @guest
                    <a href="{{ route('login') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                        {{ __('Login') }}
                    </a>
                    <a href="{{ route('register') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                        {{ __('Register') }}
                    </a>
                @endguest
            </div>
        </div>
    </div>

    <!-- Cart Modal -->
    <div x-show="cartOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div @click.away="cartOpen = false" class="bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-2xl w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200">Your Cart</h2>
                <!-- Empty Cart Button -->
                <form method="POST" action="{{ route('cart.clear') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                        Empty Cart
                    </button>
                </form>
            </div>

            <!-- Cart Items Table -->
            @if(session('cart') && count(session('cart')) > 0)
                <table class="w-full text-left text-sm text-gray-800 dark:text-gray-200">
                    <thead>
                    <tr>
                        <th class="p-2">Image</th>
                        <th class="p-2">Name</th>
                        <th class="p-2">Description</th>
                        <th class="p-2">Quantity</th>
                        <th class="p-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Support\Cart::retrieveCart() as $item)
                        @php
                            $product = $item['product'];
                        @endphp
                        <tr>
                            <!-- Product Image -->
                            <td class="p-2">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-lg">
                            </td>

                            <!-- Product Name -->
                            <td class="p-2">{{ $product->name }}</td>

                            <!-- Product Description -->
                            <td class="p-2">{{ Str::limit($product->description, 50) }}</td>

                            <!-- Quantity -->
                            <td class="p-2">
                                <form method="POST" action="{{ route('cart.update', $product['id']) }}" class="flex items-center space-x-2">
                                    @csrf
                                    @method('put')
                                    <input
                                            type="number"
                                            name="quantity"
                                            value="{{ $item['quantity'] }}"
                                            min="1"
                                            class="w-16 px-2 py-1 border rounded-md"
                                    >
                                    <button type="submit" class="px-2 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                        Change
                                    </button>
                                </form>
                            </td>

                            <!-- Remove Button -->
                            <td class="p-2">
                                <form method="POST" action="{{ route('cart.remove', $product['id']) }}">
                                    @csrf
                                    <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded-md hover:bg-red-700">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- Proceed to Order Button -->
                <div class="mt-4">
                    <a href="{{ route('order.index') }}" class="block w-full px-4 py-2 bg-green-600 text-white text-center rounded-md hover:bg-green-700">
                        Proceed to Order
                    </a>
                </div>
            @else
                <p class="text-gray-600 dark:text-gray-400">Your cart is empty.</p>
            @endif

            <!-- Close Modal Button -->
            <button @click="cartOpen = false" class="mt-4 w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Close
            </button>
        </div>
    </div>
</nav>
