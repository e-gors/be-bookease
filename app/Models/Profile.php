<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gender',
        'street',
        'barangay',
        'locality',
        'state',
        'country',
        'postal_code',
        'phone_number',
        'profile_picture'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
