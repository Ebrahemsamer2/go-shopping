<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function __invoke()
    {
        $featured_categories = Category::latest()
        ->whereHas('products')
        ->take(5)->get();

        $categories_ids = $featured_categories->pluck('id');
        $featured_products = Product::whereIn('category_id', $categories_ids)->take(8)->get();

        return view('front.index', [
            'featured_categories' => $featured_categories,
            'featured_products' => $featured_products,
        ]);
    }
}
