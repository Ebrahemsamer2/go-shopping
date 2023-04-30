<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function getThumbnail()
    {
        return $this->thumbnail == '' || strlen($this->thumbnail) == 0 ? 'assets/img/blog/blog-default.png' : asset('assets/img/' . $this->thumbnail);
    }

    public static function latestBlog($limit){
        return self::latest()->take($limit)->get();
    }
    
    // Relations

    
    public function blogCategory()
    {
        return $this->belongsTo(User::class, 'blog_category_id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'tag_post');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
