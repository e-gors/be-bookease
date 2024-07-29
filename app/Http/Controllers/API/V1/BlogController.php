<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Blog;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\BlogCollection;

class BlogController extends Controller
{
    public function index()
    {
        $query = Blog::query();

        $query->with('images');

        return new BlogCollection($query->get());
    }
}
