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

    public static function paginateProducts($limit, $search_filters) {
        $price_from = $search_filters['price_from'] * 100;
        $price_to = $search_filters['price_to'] * 100;
        $category = Category::where('slug', $search_filters['category'])->first();
        if($category) {
            $category_id = $category->id;
            return self::where('category_id', $category_id)
            ->where('price', '>=', $price_from)
            ->where('price', '<', $price_to)
            ->paginate($limit);
        } else {
            return self::where('price', '>=', $price_from)
            ->where('price', '<', $price_to)
            ->paginate($limit);
        }
    }

    public function netPrice() {
        if(!$this->discount){
            return $this->price;
        }
        
        $discount = $this->price * ($this->discount / 100);
        return $this->price - $discount;
    }

    public function getPriceAfterDiscount()
    {
        $price_after_discount = $this->netPrice();
        return number_format($price_after_discount / 100, 2, ',', ',');
    }

    public static function featured($categories_ids) {
        return self::whereIn('category_id', $categories_ids)->take(8)->get();
    }


    public static function topRatedProducts($limit, $where_filter) {
        return self::with('category')->select('product_id', 'title', 'category_id','slug','price', 'discount','thumbnail', \DB::raw('sum(rate) as the_rate'))
        ->join('reviews', 'products.id', 'reviews.product_id')
        ->where( $where_filter[0],  $where_filter[1],  $where_filter[2])
        ->groupBy('product_id', 'title', 'category_id', 'slug','price', 'discount', 'thumbnail')
        ->orderBy('the_rate', 'DESC')
        ->take($limit)
        ->get();
    }

    public static function topRated($limit) {
        $where_filter = ['discount', '<', 100];
        return self::topRatedProducts($limit, $where_filter);
    }

    public static function topRatedWithDiscount($limit) {
        $where_filter = ['discount', '>', 0];
        return self::topRatedProducts($limit, $where_filter);
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
