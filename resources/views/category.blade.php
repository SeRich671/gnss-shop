<x-app-layout>
    <!-- Breadcrumbs and Header -->
    <x-slot name="header">
        <div class="flex items-center space-x-2">
            <!-- Home Link -->
            <a href="{{ route('home') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 font-medium text-lg transition-colors">
                Home
            </a>

            <!-- Separator Icon after Home -->
            <box-icon name="chevron-right" color="#9CA3AF" class="mx-1"></box-icon>

            <!-- Display category tree as breadcrumbs -->
            @php
                $breadcrumbs = [];
                $currentCategory = $category;
                while ($currentCategory) {
                    array_unshift($breadcrumbs, $currentCategory);
                    $currentCategory = $currentCategory->category; // Assumes 'parent' relationship is set up in Category model
                }
            @endphp
            @foreach($breadcrumbs as $breadcrumb)
                <a href="{{ route('category', $breadcrumb->id) }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 font-medium text-lg transition-colors">
                    {{ $breadcrumb->name }}
                </a>
                @if (!$loop->last)
                    <!-- Separator Icon -->
                    <box-icon name="chevron-right" color="#9CA3AF" class="mx-1"></box-icon>
                @endif
            @endforeach
        </div>
    </x-slot>




    <!-- Category Description and Layout -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Category Title and Description -->
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">{{ $category->name }}</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">{{ $category->description }}</p>
            </div>

            <!-- Two-Column Layout -->
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Left Sidebar: Subcategories (only if subcategories exist) -->
                @if($category->children->isNotEmpty())
                    <div class="w-full lg:w-1/4">
                        <!-- Enhanced Sidebar with dynamic height -->
                        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                            <!-- Subcategories Header -->
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6 border-b border-gray-300 dark:border-gray-600 pb-3 flex items-center">
                                <box-icon name="category" type="solid" color="#6366f1" class="mr-2"></box-icon> Subcategories
                            </h3>

                            <!-- Subcategory List -->
                            <ul class="space-y-3">
                                @foreach($category->children as $subcategory)
                                    <li>
                                        <a href="{{ route('category', $subcategory->id) }}" class="flex items-center text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                <span class="bg-indigo-100 dark:bg-indigo-700 text-indigo-600 dark:text-indigo-200 rounded-full p-2 mr-3">
                                    <box-icon name="folder" color="#4f46e5"></box-icon>
                                </span>
                                            <span class="font-medium">{{ $subcategory->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Right Content: Products Grid -->
                <div class="w-full {{ $category->children->isNotEmpty() ? 'lg:w-3/4' : 'lg:w-full' }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($products as $product)
                            @include('product.shared.card', $product)
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
