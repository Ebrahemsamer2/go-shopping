<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index(Category $category, Request $request) {
        $search_filters = [];
        $search_filters['price_from'] = $request->has('price_from') ? $request->input('price_from') : 2;
        $search_filters['price_to'] = $request->has('price_to') ? $request->input('price_to') : 100;

        $products = $category->paginateProducts(9, $search_filters);
        $top_discount_rated_products = $category->topRatedWithDiscount(9);
        $categories_has_products = Category::getHasProductsCategories(10);
        $latest_products = Product::latest()->take(6)->get();
        return view('front.category.index', [
            'products' => $products,
            'top_discount_rated_products' => $top_discount_rated_products,
            'categories_has_products' => $categories_has_products,
            'latest_products' => $latest_products,
            'category' => $category,
            'search_filters' => $search_filters
        ]);
    }
}
