<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __invoke(Category $category)
    {
        $leafCategoryIds = $category->getAllLeafCategories();

        // Fetch products from all leaf categories
        $products = Product::query()
            ->whereIn('category_id', $leafCategoryIds)
            ->paginate(12);

        return view('category', compact('category', 'products'));
    }
}
