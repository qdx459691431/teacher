<?php

namespace App\Http\Controllers\admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;


class LoginController extends BaseController
{
    public function index()
    {
    	// echo 111;exit;
    	return view('admin/index');
    }
}
