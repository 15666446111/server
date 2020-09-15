<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class CodeOrder extends Model
{
	
    protected $table = 'code_orders';

    
    // 黑名单
    protected $guarded = [];  
}
