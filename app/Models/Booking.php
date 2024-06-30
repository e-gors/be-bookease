<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'service_id', 'start_date', 'end_date', 'time', 'type', 'status'];

    public function user(){
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function service(){
        return $this->belongsTo(Service::class, 'service_id');
    }
}
