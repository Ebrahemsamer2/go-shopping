<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Category, Product, HomeAds, Post};

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

        $top_rated_products = Product::select('product_id', 'title', 'price', 'thumbnail', \DB::raw('sum(rate) as the_rate'))
        ->join('reviews', 'products.id', 'reviews.product_id')
        ->groupBy('product_id', 'title', 'price', 'thumbnail')
        ->orderBy('the_rate', 'DESC')
        ->take(6)
        ->get();

        $reviewed_products = Product::select('product_id', 'title', 'price', 'thumbnail')
        ->join('reviews', 'products.id', 'reviews.product_id')
        ->where('review','!=', '')
        ->groupBy('product_id', 'title', 'price', 'thumbnail')
        ->orderBy('products.id', 'DESC')
        ->take(6)
        ->get();

        $latest_posts = Post::latest()->take(3)->get();

        return view('front.index', [
            'featured_categories' => $featured_categories,
            'featured_products' => $featured_products,
            'home_ads' => $home_ads,
            'latest_products' => $latest_products,
            'top_rated_products' => $top_rated_products,
            'reviewed_products' => $reviewed_products,
            'latest_posts' => $latest_posts
        ]);
    }
}
