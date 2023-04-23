<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogCategory>
 */
class BlogCategoryFactory extends Factory
{
    static $counter = -1;
    const blog_categories = [
        'Software Engineering',
        'Problem Solving',
        'Computer Architicture',
        'Dynamic Programming',
        'Graph',
    ];

    public function definition()
    {
        self::$counter++;
        return [
            'name' => self::blog_categories[self::$counter],
            'slug' => $this->generateSlug( self::blog_categories[self::$counter] )
        ];
    }

    public function generateSlug($slug)
    {
        return join("-", explode(" ", strtolower($slug)));
    }
}
