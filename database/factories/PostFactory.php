<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    static $counter = -1;

    const thumbnails = [
        'blog/blog-1.jpg',
        'blog/blog-2.jpg',
        'blog/blog-3.jpg',
        'blog/blog-4.jpg',
        'blog/blog-5.jpg',
        'blog/blog-6.jpg'
    ];
    public function definition()
    {
        self::$counter++;
        $title = $this->faker->sentence(8, false);
        return [
            'title' => $title,
            'slug' => $this->generateSlug( $title ),
            'excerpt' => $this->faker->sentence(15, false),
            'thumbnail' => self::thumbnails[self::$counter],
            'body' => $this->faker->paragraph(10),
            'user_id' => 1,
        ];
    }
    public function generateSlug($slug)
    {
        return join("-", explode(" ", strtolower($slug)));
    }
}
