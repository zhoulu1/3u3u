<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id', 'name', 'icon', 'order', 'status'
    ];

    public function children(){
        return $this->hasMany(Categories::class, 'parent_id')->with('price');
    }

    public function price(){
        return $this->hasOne(Price::class, 'category_id');
    }
}
