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
        'img/product/product-1.jpg',
        'img/product/product-2.jpg',
        'img/product/product-3.jpg',
        'img/product/product-4.jpg',
        'img/product/product-5.jpg',
        'img/product/product-6.jpg',
        'img/product/product-7.jpg',
        'img/product/product-8.jpg',
        'img/product/product-9.jpg',
        'img/product/product-10.jpg',
        'img/product/product-11.jpg',
        'img/product/product-12.jpg',
    ];
    public function definition()
    {
        self::$counter++;
        $title = $this->faker->sentence(3, false);
        return [
            'title' => $title,
            'small_description' => $this->faker->text,
            'description' => $this->faker->sentence(500),
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
