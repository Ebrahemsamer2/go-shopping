<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    static $counter = -1;
    const images = [
        'img/product/details/product-details-1.jpg',
        'img/product/details/product-details-2.jpg',
        'img/product/details/product-details-3.jpg',
        'img/product/details/product-details-4.jpg',
        'img/product/details/product-details-5.jpg',
    ];
    public function definition()
    {
        if(self::$counter == 4)
            self::$counter = -1;

        self::$counter++;
        return [
            'path' => self::images[self::$counter]
        ];
    }
}
