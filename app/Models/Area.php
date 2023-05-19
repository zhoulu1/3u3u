<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'parent_id', 'name', 'order', 'status'
    ];

    public function children(){
        return $this->hasMany(Area::class, 'parent_id')->select('id', 'parent_id', 'name as text', 'path as value')->with('children');
    }
}
