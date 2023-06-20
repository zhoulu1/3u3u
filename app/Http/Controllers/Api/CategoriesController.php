<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Categories::with('children:id,parent_id,name')->where('status', 1)->where('parent_id', 0)->orderBy('order', 'desc')->get(['id','name','icon']);
        return response()->json(['code' => 200,'msg' => 'success','data' => $categories]);
    }
}
