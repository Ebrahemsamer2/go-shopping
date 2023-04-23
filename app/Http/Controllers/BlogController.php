<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    public function index() {
        $posts = Post::paginate(9);
        $latest_posts = Post::latestBlog(3);
        $blog_categories = BlogCategory::whereHas('posts')->withCount('posts')->limit(10)->get();

        return view('front.blog.index', [
            'posts' => $posts,
            'latest_posts' => $latest_posts,
            'blog_categories' => $blog_categories,
        ]);
    }
}
