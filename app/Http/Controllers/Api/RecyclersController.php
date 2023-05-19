<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RecyclersRequest;
use App\Models\Recycler;
use App\Services\AreaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecyclersController extends Controller
{
    public function getArea(AreaService $areaService){
        return jsonData(200, 'success', $areaService->getCategoryTree());
    }

    public function store(RecyclersRequest $request){
        DB::transaction(function() use ($request){
            if($request->user()->recycler && $request->user()->recycler['status'] === 'applying'){
                throw new InvalidRequestException('申请审核中，请勿重复提交!');
            }
            $param = $request->only(['name', 'mobile', 'province', 'city', 'county', 'area']);
            $recycler = new Recycler($param);
            $recycler->user()->associate($request->user());
            $recycler->save();
            
        });
        return jsonData(200, 'success!');
    }

    public function index(Request $request){
        return jsonData(200, 'success!', $request->user()->recycler);
    }
}
