<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
use App\Models\Category;

class ProductFactory extends Factory
{
    static $counter = -1;

    const thumbnails = [
        'product/product-1.jpg',
        'product/product-2.jpg',
        'product/product-3.jpg',
        'product/product-4.jpg',
        'product/product-5.jpg',
        'product/product-6.jpg',
        'product/product-7.jpg',
        'product/product-8.jpg',
        'product/product-9.jpg',
        'product/product-10.jpg',
        'product/product-11.jpg',
        'product/product-12.jpg',
    ];
    public function definition()
    {
        self::$counter++;
        $title = $this->faker->sentence(3, false);
        return [
            'title' => $title,
            'slug' => $this->generateSlug( $title ),
            'price' => rand(200, 10000),
            'discount' => rand(10, 50),
            'thumbnail' => self::thumbnails[self::$counter],
            'category_id' => Category::inRandomOrder()->take(1)->get()[0]->id,
            'user_id' => 1,
        ];
    }

    public function generateSlug($slug)
    {
        return join("-", explode(" ", strtolower($slug)));
    }
}
