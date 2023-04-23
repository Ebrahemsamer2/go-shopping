<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    static $counter = -1;
    const tags = [
        'php',
        'c++',
        'js',
        'greedy',
        'sorting',
        'binary search',
        'fibinacci',
        'trees',
        'hash-tables',
        'node'
    ];

    public function definition()
    {
        self::$counter++;
        return [
            'name' => self::tags[self::$counter]
        ];
    }
}
