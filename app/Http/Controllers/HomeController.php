<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Category, Product, HomeAds, Post};

class HomeController extends Controller
{
    public function __invoke()
    {
        $featured_categories = Category::featured();

        $categories_ids = $featured_categories->pluck('id');
        $featured_products = Product::featured($categories_ids);
        
        $home_ads = HomeAds::latestAds(2);

        $latest_products = Product::latest()->take(6)->get();

        $top_rated_products = Product::topRated(6);

        $reviewed_products = Product::reviewed(6);

        $latest_posts = Post::latestBlog(3);

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
