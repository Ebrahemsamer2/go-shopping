<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function getThumbnail()
    {
        return $this->thumbnail == '' || strlen($this->thumbnail) == 0 ? 'assets/img/product/product-default.jpg' : 'assets/img/' . $this->thumbnail;
    }

    public function getPrice()
    {
        return number_format($this->price / 100, 2, ',', ',');
    }

    public static function featured($categories_ids) {
        return self::whereIn('category_id', $categories_ids)->take(8)->get();
    }

    public static function topRated($limit) {
        return self::select('product_id', 'title', 'slug','price', 'thumbnail', \DB::raw('sum(rate) as the_rate'))
        ->join('reviews', 'products.id', 'reviews.product_id')
        ->groupBy('product_id', 'title', 'slug','price', 'thumbnail')
        ->orderBy('the_rate', 'DESC')
        ->take($limit)
        ->get();
    }

    public static function reviewed($limit) {
        return self::select('product_id', 'title', 'slug','price', 'thumbnail')
        ->join('reviews', 'products.id', 'reviews.product_id')
        ->where('review','!=', '')
        ->groupBy('product_id', 'title', 'slug','price', 'thumbnail')
        ->orderBy('products.id', 'DESC')
        ->take($limit)
        ->get();
    }

    // Relations

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
