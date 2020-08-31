<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class MerchantsImport extends Model
{
	
    protected $table = 'merchants_imports';

    // 黑名单
    protected $guarded = [];
}
