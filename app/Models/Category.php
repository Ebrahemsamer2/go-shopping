<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'image'];

    public function getImage()
    {
        return $this->image == '' || strlen($this->image) == 0 ? 'storage/img/categories/cat-default.jpg' : 'storage/' . $this->image;
    }

    public static function featured() {
        return self::latest()->whereHas('products')->take(5)->get();
    }

    public static function getHasProductsCategories($limit) {
        return self::with('products')->has('products')->limit($limit)->get();
    }

    public function paginateProducts($limit, $search_filters) {
        $price_from = $search_filters['price_from'] * 100;
        $price_to = $search_filters['price_to'] * 100;

        return $this->products()
        ->where('price', '>=', $price_from)
        ->where('price', '<', $price_to)
        ->paginate($limit);
    }

    public function topRatedProducts($limit, $where_filter) {
        return $this->products()->select('product_id', 'title', 'slug','price', 'discount','thumbnail', \DB::raw('sum(rate) as the_rate'))
        ->join('reviews', 'products.id', 'reviews.product_id')
        ->where( $where_filter[0],  $where_filter[1],  $where_filter[2])
        ->groupBy('product_id', 'title', 'slug','price', 'discount', 'thumbnail')
        ->orderBy('the_rate', 'DESC')
        ->take($limit)
        ->get();
    }

    public function topRatedWithDiscount($limit) {
        $where_filter = ['discount', '>', 0];
        return self::topRatedProducts($limit, $where_filter);
    }

    // Relations
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
