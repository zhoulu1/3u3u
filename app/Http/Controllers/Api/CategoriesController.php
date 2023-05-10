<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Categories::where('status', 1)->orderBy('order', 'desc')->get(['id','name','icon']);
        return response()->json(['code' => 200,'msg' => 'success','data' => $categories]);
    }
}
