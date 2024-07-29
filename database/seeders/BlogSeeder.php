<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogImage;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blog::factory(20)->create()->each(function ($blog) {
            $blog->images()->saveMany(BlogImage::factory(5)->make());
        });
    }
}
