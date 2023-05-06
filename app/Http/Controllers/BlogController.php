<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\BlogCategory;
use App\Models\Tag;

class BlogController extends Controller
{
    public function index() {
        $posts = Post::paginate(9);
        $latest_posts = Post::latestBlog(3);
        $blog_categories = BlogCategory::whereHas('posts')->withCount('posts')->limit(10)->get();
        $tags = Tag::limit(50)->get();
        return view('front.blog.index', [
            'posts' => $posts,
            'latest_posts' => $latest_posts,
            'blog_categories' => $blog_categories,
            'tags' => $tags
        ]);
    }

    public function show(Post $post) {
        $latest_posts = Post::latestBlog(3);
        $blog_categories = BlogCategory::whereHas('posts')->withCount('posts')->limit(10)->get();
        $tags = Tag::limit(50)->get();
        
        $posts_you_may_like = Post::where('id', '!=', $post->id)
        ->where('blog_category_id', $post->blog_category_id)
        ->inRandomOrder()
        ->limit(3)
        ->get();

        return view('front.blog.show', [
            'single_post' => $post,
            'latest_posts' => $latest_posts,
            'blog_categories' => $blog_categories,
            'tags' => $tags,
            'posts_you_may_like' => $posts_you_may_like
        ]);
    }
}
