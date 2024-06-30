<?php

namespace App\Models;

use App\Models\ChildCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParentCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function child()
    {
        return $this->hasMany(ChildCategory::class);
    }
}
