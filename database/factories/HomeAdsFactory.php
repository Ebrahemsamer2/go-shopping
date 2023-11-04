<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HomeAds>
 */
class HomeAdsFactory extends Factory
{
    static $counter = -1;
    const images = [
        'img/banner/banner-1.jpg',
        'img/banner/banner-2.jpg',
    ];

    public function definition()
    {
        return [
            'image' => self::images[++self::$counter],
            'link' => '',
            'active' => 1
        ];
    }
}
