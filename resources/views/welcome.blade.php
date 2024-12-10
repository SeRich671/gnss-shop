<x-app-layout>
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
{{--            {{ __('Dashboard') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

    <div class="w-full bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap py-10">
            <!-- Left Section (Title and Text) -->
            <div class="w-full lg:w-7/12 flex flex-col justify-center space-y-4 pr-8">
                <h1 class="text-3xl font-bold text-gray-800">
                    Precision GNSS Solutions for Every Application
                </h1>
                <p class="text-gray-600 text-lg">
                    Explore our range of high-accuracy GNSS hardware tailored for surveying, mapping, and precision agriculture. Unlock reliable, real-time data to drive smarter decisions and enhance field operations.
                </p>
            </div>

            <!-- Right Section (Image) -->
            <div class="w-full lg:w-5/12 flex justify-center items-center">
                <img src="{{ asset('images/header_logo.png') }}" alt="Descriptive Image" class="w-full max-w-full lg:w-10/12 max-h-52 object-contain rounded-lg">
            </div>
        </div>
    </div>




    <div class="w-full bg-gray-50 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Title -->
            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                Find the Right GNSS Hardware
            </h2>

            <!-- Subtitle -->
            <p class="text-gray-600 text-lg mb-6">
                Search our collection to find the best fit for your navigation and surveying needs.
            </p>

            <!-- Search Form -->
            <div class="flex flex-col items-center space-y-4">
                <!-- Search Input -->
                <input
                        type="text"
                        placeholder="Enter your search query..."
                        class="w-full sm:w-1/2 px-4 py-2 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >

                <!-- Search Button -->
                <button
                        class="w-full sm:w-auto px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Search
                </button>
            </div>
        </div>
    </div>



    <div class="w-full bg-transparent py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Section Title and Subtitle -->
            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                Featured Products
            </h2>
            <p class="text-gray-600 text-lg mb-8">
                Discover our top GNSS products for accurate and reliable navigation solutions.
            </p>

            <!-- Product Cards Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Product Card -->
                @foreach($products as $product)
                    @include('product.shared.card', $product)
                @endforeach
            </div>
        </div>
    </div>



    <div class="w-full bg-white py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Section Title and Subtitle -->
            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                Why Choose Us?
            </h2>
            <p class="text-gray-600 text-lg mb-8">
                Discover the advantages of shopping with us and experience the quality and reliability you deserve.
            </p>

            <!-- Benefits Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Benefit 1 -->
                <div class="flex flex-col items-center text-center space-y-3">
                    <box-icon name="rocket" class="text-indigo-600 text-4xl"></box-icon>
                    <h3 class="text-lg font-semibold text-gray-800">Fast Shipping</h3>
                    <p class="text-gray-600 text-sm">
                        Get your products delivered quickly with our efficient shipping options.
                    </p>
                </div>

                <!-- Benefit 2 -->
                <div class="flex flex-col items-center text-center space-y-3">
                    <box-icon name="like" class="text-indigo-600 text-4xl"></box-icon>
                    <h3 class="text-lg font-semibold text-gray-800">High Quality</h3>
                    <p class="text-gray-600 text-sm">
                        We offer only the best GNSS hardware for top performance and reliability.
                    </p>
                </div>

                <!-- Benefit 3 -->
                <div class="flex flex-col items-center text-center space-y-3">
                    <box-icon name="headphone" class="text-indigo-600 text-4xl"></box-icon>
                    <h3 class="text-lg font-semibold text-gray-800">24/7 Support</h3>
                    <p class="text-gray-600 text-sm">
                        Our support team is available around the clock to assist with your needs.
                    </p>
                </div>

                <!-- Benefit 4 -->
                <div class="flex flex-col items-center text-center space-y-3">
                    <box-icon name="shield" class="text-indigo-600 text-4xl"></box-icon>
                    <h3 class="text-lg font-semibold text-gray-800">Secure Payment</h3>
                    <p class="text-gray-600 text-sm">
                        Shop with confidence using our safe and secure payment methods.
                    </p>
                </div>

                <!-- Benefit 5 -->
                <div class="flex flex-col items-center text-center space-y-3">
                    <box-icon name="award" class="text-indigo-600 text-4xl"></box-icon>
                    <h3 class="text-lg font-semibold text-gray-800">Trusted Quality</h3>
                    <p class="text-gray-600 text-sm">
                        We are known for our commitment to quality in GNSS hardware products.
                    </p>
                </div>

                <!-- Benefit 6 -->
                <div class="flex flex-col items-center text-center space-y-3">
                    <box-icon name="wallet" class="text-indigo-600 text-4xl"></box-icon>
                    <h3 class="text-lg font-semibold text-gray-800">Affordable Prices</h3>
                    <p class="text-gray-600 text-sm">
                        Enjoy competitive pricing on all our high-performance products.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full bg-white py-10 flex justify-center">
        <iframe src="http://127.0.0.1:8000/project/published/d05937f6-c954-4904-8e04-e751d355083d" frameborder="0" width="600" height="400"></iframe> 
    </div>
</x-app-layout>
