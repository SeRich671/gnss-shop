<x-app-layout>
    <!-- Product Details -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- First Row: Image and Price/Cart Button -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden flex flex-col lg:flex-row gap-6 p-6">
                <!-- Left Column: Product Image -->
                <div class="w-full lg:w-1/2 flex justify-center" style="max-height: 300px">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="rounded-lg shadow-md object-cover">
                </div>

                <!-- Right Column: Price, Quantity, and Add to Cart -->
                <div class="w-full lg:w-1/2 flex flex-col justify-start text-end">
                    <!-- Price -->
                    <p id="unit-price" class="text-indigo-600 text-2xl font-semibold mb-4">{{ $product->price }} USD</p>

                    <!-- Quantity Input -->
                    <div class="mb-4 flex items-center justify-end space-x-2">
                        <label for="quantity" class="text-gray-700 dark:text-gray-300">Quantity:</label>
                        <input
                                type="number"
                                id="quantity"
                                name="quantity"
                                value="1"
                                min="1"
                                class="w-20 px-2 py-1 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-indigo-500"
                                oninput="updateTotalPrice()"
                        >
                    </div>

                    <!-- Total Price -->
                    <p id="total-price" class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Total: {{ $product->price }} USD</p>

                    <!-- Add to Cart Button -->
                    <form method="POST" action="{{ route('cart.add', $product->id) }}">
                        @csrf
                        <input type="hidden" name="quantity" id="form-quantity" value="1">
                        <button type="submit" class="w-full lg:w-auto px-6 py-3 text-white bg-green-600 rounded-md hover:bg-green-700 transition duration-150">
                            Add to Cart
                        </button>
                    </form>
                </div>
            </div>

            <!-- Second Row: Description, Category, and Attributes -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg mt-8 p-6">
                <!-- Description -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">Description</h2>
                    <p class="text-gray-600 dark:text-gray-400">{{ $product->description }}</p>
                </div>

                <!-- Category -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Category</h3>
                    <a href="{{ route('category', $product->category->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                        {{ $product->category->name }}
                    </a>
                </div>

                <!-- Attributes -->
                @if($product->attributes->isNotEmpty())
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Additional Information</h3>
                        <ul class="space-y-2">
                            @foreach($product->attributes as $attribute)
                                <li>
                                    <strong class="text-gray-500 dark:text-gray-400">{{ $attribute->productTemplateAttribute->name }}:</strong>
                                    <span>{{ $attribute->value }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Related Products -->
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Related Products</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($product->similar_products as $related)
                        @include('product.shared.card', ['product' => $related])
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Inline JavaScript for Total Price Calculation -->
    <script>
        const unitPrice = {{ $product->price }};
        const quantityInput = document.getElementById('quantity');
        const totalPriceDisplay = document.getElementById('total-price');
        const formQuantityInput = document.getElementById('form-quantity');

        function updateTotalPrice() {
            const quantity = Math.max(1, parseInt(quantityInput.value) || 1);
            const totalPrice = unitPrice * quantity;
            totalPriceDisplay.textContent = `Total: ${totalPrice.toFixed(2)} USD`;
            formQuantityInput.value = quantity;
        }
    </script>
</x-app-layout>
