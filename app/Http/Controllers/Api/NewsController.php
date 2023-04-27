<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        $list = News::where('status', 1)->limit(1)->get();
        return response()->json(['code' => 200,'msg' => 'success','data' => $list]);
        // return jsonData(200, 'success', $flights->toArray());
    }

    public function show(News $news){
        return response()->json(['code' => 200,'msg' => 'success','data' => $news]);
        // return jsonData(200, 'success', $flights->toArray());
    }

    public function listPage(Request $request){
        $page_size = $request->page_size ?: 15;
        $list = News::where('status', 1)->paginate($page_size);
        return response()->json(['code' => 200,'msg' => 'success','data' => $list]);
        // return jsonData(200, 'success', $flights->toArray());
    }
}
