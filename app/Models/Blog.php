<?php

namespace App\Models;

use App\Models\BlogImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'service_id', 'image', 'title', 'description'];

    public function images()
    {
        return $this->hasMany(BlogImage::class);
    }
}
