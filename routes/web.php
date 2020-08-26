<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return view('welcome'); });


/**
 * @author [name] <[< 755969423@qq.com>]>
 * @version [<vector>] [< 申请办卡 页面方式 >]
 */
Route::get('/ApplyCard/list/{merchant}/{ident}', 			'BankCardController@cardList');   		// 申请办卡 银行/卡种列表页面
Route::get('/ApplyCard/detail/{merchant}/{ident}/{cid}', 	'BankCardController@cardDetail');   	// 申请办卡 银行/卡种详情页面
Route::post('/ApplyCard/apply/{merchant}/{ident}', 			'BankCardController@cardApply');   		// 申请办卡 提交申请信息资料


Route::get('/points/list/{merchant}/{ident}', 				'PointChangeController@bankList');   	// 积分兑换 支持银行列表
Route::get('/points/porduct/{merchant}/{ident}/{bankId}', 	'PointChangeController@productList');  	// 积分兑换 积分产品列表
Route::get('/points/details/{merchant}/{ident}/{product}', 	'PointChangeController@productDetail'); // 积分兑换 兑换的产品详情
Route::get('/points/sub/{merchant}/{ident}/{product}', 		'PointChangeController@productSub'); 	// 积分兑换 兑换报单页面
Route::post('/points/sub-order', 							'PointChangeController@subOrder'); 		// 积分兑换 完成提交


//  聚合支付 标准进件 
Route::get('/aggregate_bz', function(){
	$a = new \App\Librarys\Aggregate\Client();
	dd($a->bzNetIn());
});

//  聚合支付 进件 
Route::get('/aggregate', function(){
	$a = new \App\Librarys\Aggregate\Client();
	dd($a->netIn());
});   

//  聚合支付 进件查询
Route::get('/aggregate_select', function(){
	$a = new \App\Librarys\Aggregate\Query();
	dd($a->query());
}); 

//  聚合支付 进件查询
Route::get('/aggregate_edit', function(){
	$a = new \App\Librarys\Aggregate\Edit();
	dd($a->edit());
});	

//  聚合支付 进件查询
Route::get('/aggregate_edit_bz', function(){
	$a = new \App\Librarys\Aggregate\Edit();
	dd($a->bzEdit());
});	

//  聚合支付 终端绑定
Route::get('/aggregate_bind', function(){
	$a = new \App\Librarys\Aggregate\Temial();
	dd($a->bind());
});	

//  聚合支付 生成二维码
Route::get('/aggregate_make', function(){
	$a = new \App\Librarys\Aggregate\Code();
	dd($a->make());
});

//  聚合支付 扫码
Route::get('/aggregate_sacn', function(){
	$a = new \App\Librarys\Aggregate\Scan();
	dd($a->sacn());
});

//  聚合支付 扫码
Route::get('/aggregate_query', function(){
	$a = new \App\Librarys\Aggregate\Scan();
	dd($a->query());
});