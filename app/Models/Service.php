<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'child_category_id', 'pricing_model', 'price'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function child(){
        return $this->belongsTo(ChildCategory::class, 'child_category_id');
    }
}
