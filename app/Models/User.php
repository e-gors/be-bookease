<?php

namespace App\Models;

use App\Models\Profile;
use App\Models\Service;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'first_name',
        'last_name',
        'user_name',
        'email',
        'role',
        'password',
        'status',
        'banned_until'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $number = str_pad($model->id, 3, '0', STR_PAD_LEFT);
            $model->user_name = 'bookEase-' . $number;
            $model->save();
        });
    }
}
