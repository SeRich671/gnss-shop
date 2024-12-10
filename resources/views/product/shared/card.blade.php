<div class="bg-white dark:bg-gray-800 shadow-2xl rounded-lg overflow-hidden h-100 flex flex-col">
    <!-- Product Image -->
    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-3/4 object-cover mx-auto mt-4">

    <!-- Product Info -->
    <div class="p-4 flex-grow flex flex-col">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $product->name }}</h3>
        <p class="text-gray-600 dark:text-gray-400 text-sm flex-grow mt-2 overflow-hidden">
            {{ Str::limit($product->description, 160) }}
        </p>
        <p class="text-indigo-600 font-bold mt-2">{{ $product->price }} USD</p>
    </div>

    <!-- Action Buttons -->
    <div class="p-4 flex space-x-2">
        <a href="{{ route('product.show', $product->id) }}" class="w-1/2 px-4 py-2 text-center text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
            Show Details
        </a>
        <form class="w-1/2" method="POST" action="{{ route('cart.add', $product->id) }}">
            @csrf
            <button type="submit" class="w-full px-6 py-3 text-white bg-green-600 rounded-md hover:bg-green-700 transition duration-150">
                Add to Cart
            </button>
        </form>
    </div>
</div>
