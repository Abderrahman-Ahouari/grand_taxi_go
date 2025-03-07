<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ride_id',
        'status',
    ]; 

    public function ride(){
        return $this->belongsto(ride::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
