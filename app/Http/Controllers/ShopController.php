<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index(Request $request) {
        $search_filters = [];
        $search_filters['price_from'] = $request->has('price_from') ? $request->input('price_from') : 2;
        $search_filters['price_to'] = $request->has('price_to') ? $request->input('price_to') : 100;
        $search_filters['category'] = $request->has('category') ? $request->input('category') : '';

        $products = Product::paginateProducts(9, $search_filters);
        $top_discount_rated_products = Product::topRatedWithDiscount(6);

        $categories_has_products = Category::getHasProductsCategories(10);
        $latest_products = Product::latest()->take(6)->get();

        return view('front.shop.index', [
            'products' => $products,
            'top_discount_rated_products' => $top_discount_rated_products,
            'categories_has_products' => $categories_has_products,
            'latest_products' => $latest_products,
            'search_filters' => $search_filters
        ]);
    }
}
