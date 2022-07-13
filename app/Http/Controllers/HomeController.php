<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Category, Product, HomeAds};

class HomeController extends Controller
{
    public function __invoke()
    {
        $featured_categories = Category::latest()
        ->whereHas('products')
        ->take(5)->get();

        $categories_ids = $featured_categories->pluck('id');
        $featured_products = Product::whereIn('category_id', $categories_ids)->take(8)->get();
        
        $home_ads = HomeAds::latest()->where('active', 1)->take(2)->get();

        $latest_products = Product::latest()->take(6)->get();

        return view('front.index', [
            'featured_categories' => $featured_categories,
            'featured_products' => $featured_products,
            'home_ads' => $home_ads,
            'latest_products' => $latest_products
        ]);
    }
}
