<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiCallBackController extends Controller
{
    public function netIn(Request $request)
    {
    	file_put_contents("./netin.txt", json_encode($request->all()));
    }
}
