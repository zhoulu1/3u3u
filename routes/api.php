<?php

use App\Http\Controllers\Api\AuthorizationsController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\RecyclersController;
use App\Http\Controllers\Api\UsersController;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->name('api.v1.')->group(function(){
    Route::resource('news', NewsController::class, ['only' => ['index','show']]);
    Route::get('/newsList', [ NewsController::class, 'listPage' ]);

    Route::get('/categories', [ CategoriesController::class, 'index' ]);

    Route::middleware('auth:api')->group(function() {
        Route::resource('orders', OrdersController::class, ['only' => ['index','store']]);
        Route::post('order.receive', [ OrdersController::class, 'receive' ]);
        Route::get('/user', [ UsersController::class, 'me' ]);
        Route::get('/getArea', [ RecyclersController::class, 'getArea' ]);
        Route::post('/applyRecycler', [ RecyclersController::class, 'store' ]);
        Route::get('/recycler', [ RecyclersController::class, 'index' ]);
     });
    // 小程序登录
    Route::post('authorizations', [AuthorizationsController::class, 'weappStore']);
});


