<?php

namespace App\Models;

use App\Models\ParentCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildCategory extends Model
{
    use HasFactory;

    protected $fillable = ['parent_category_id', 'name', 'description'];

    public function parent()
    {
        return $this->belongsTo(ParentCategory::class);
    }
}
