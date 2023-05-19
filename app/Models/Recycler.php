<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recycler extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'mobile', 'province', 'city', 'county', 'status', 'area'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
