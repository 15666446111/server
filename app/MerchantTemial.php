<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class MerchantTemial extends Model
{
	
    protected $table = 'merchant_temials';


    // 黑名单
    protected $guarded = [];  
}
