<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    // 商户管理
    $router->resource('merchants', 'MerchantSettingController');

    // 银行申卡列表
    $router->resource('bank_cards', 'BankCardController');

    // 银行申卡订单列表
    $router->resource('bank_card_orders', 'BankCardOrderController');


    // 积分兑换 银行列表
    $router->resource('point_banks',    'PointsBankController');
    // 积分兑换 积分产品
    $router->resource('point_products', 'PointProductController');
    // 积分兑换 申请订单
    $router->resource('point_orders',   'PointsOrderController');



    // 聚合支付 商户进件
    $router->resource('merchant_imports',   'MerchantsImportController');
});
