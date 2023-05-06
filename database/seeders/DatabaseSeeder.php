<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();
        \App\Models\Category::factory(10)->create();
        $products = \App\Models\Product::factory(12)->create();
        \App\Models\HomeAds::factory(2)->create();
        \App\Models\Review::factory(100)->create();

        \App\Models\BlogCategory::factory(5)->create();
        \App\Models\Post::factory(6)->create();

        $tags = \App\Models\Tag::factory(10)->create();
        foreach($tags as $tag) {
            $post = \App\Models\Post::inRandomOrder()->first();
            $post->tags()->attach($tag->id);
        }

        foreach($products as $product) {
            \App\Models\Image::factory(5)->create(['product_id' => $product->id]);
        }


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
