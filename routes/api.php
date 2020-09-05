<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) { return $request->user(); });



Route::post('merchant-import',    'ApiJuHeController@merchantImport');						//	 微服务 商户进件 

Route::post('merchant-query',     'ApiJuHeController@merchantQuery');						//	 微服务 商户进件 - 商户查询

Route::post('merchant-bind',      'ApiJuHeController@merchantBind');						//	 微服务 商户绑定 - 绑定终端

Route::post('merchant-qrcode',    'ApiJuHeController@merchantCode');						//	 微服务 生成支付二维码

