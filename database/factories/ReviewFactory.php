<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $arr = [1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5];
        $key = array_rand($arr);
        return [
            'rate' =>  $arr[$key] , // 1, 5
            'review' => $this->faker->sentence(10, false),
            'user_id' => 0,
            'product_id' => Product::inRandomOrder()->take(1)->pluck('id')[0]
        ];
    }
}
