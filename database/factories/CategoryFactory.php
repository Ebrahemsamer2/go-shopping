<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    static $counter = -1;
    const categories = [
        'Fresh Meat',
        'Vegetables',
        'Fruit and Nut Gifts',
        'Fresh Berries',
        'Ocean Foods',
        'Butter and Eggs',
        'Fastfood',
        'Fresh Onion',
        'Papayaya and Crisps',
        'Oatmeal'
    ];

    const images = [
        'categories/cat-1.jpg',
        'categories/cat-2.jpg',
        'categories/cat-3.jpg',
        'categories/cat-4.jpg',
        'categories/cat-5.jpg',
        'categories/cat-1.jpg',
        'categories/cat-2.jpg',
        'categories/cat-3.jpg',
        'categories/cat-4.jpg',
        'categories/cat-5.jpg',
    ];
    public function definition()
    {
        self::$counter++;
        return [
            'name' => self::categories[self::$counter],
            'slug' => $this->generateSlug( self::categories[self::$counter] ),
            'image' => self::images[self::$counter]
        ];
    }

    public function generateSlug($slug)
    {
        return join("-", explode(" ", strtolower($slug)));
    }
}
