<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-8">Order History</h1>

            @forelse($orders as $order)
                <!-- Single Order -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-6">
                    <!-- Order Info -->
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Order #{{ $order->id }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Placed on: {{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <h3 class="text-sm font-medium text-gray-800 dark:text-gray-200">Shipping Address:</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $order->address['street'] }}, Building: {{ $order->address['building'] }}
                            {{ $order->address['flat'] ? ', Flat: ' . $order->address['flat'] : '' }}<br>
                            {{ $order->address['postcode'] }}, {{ $order->address['city'] }}<br>
                            {{ $order->address['country'] }}
                        </p>
                    </div>

                    <!-- Ordered Items -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-800 dark:text-gray-200">Ordered Items:</h3>
                        <ul class="mt-2 space-y-2">
                            @foreach($order->products as $product)
                                <li class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $product->name }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">Qty: {{ $product->pivot->quantity }}</p>
                                    </div>
                                    <p class="text-sm text-indigo-600 dark:text-indigo-400 font-semibold">
                                        ${{ number_format($product->pivot->price * $product->pivot->quantity, 2) }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @empty
                <!-- No Orders -->
                <p class="text-gray-600 dark:text-gray-400">You have no orders yet.</p>
            @endforelse

            <!-- Pagination -->
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
