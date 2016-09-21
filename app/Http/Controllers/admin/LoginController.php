<?php

namespace App\Http\Controllers\admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Request,Session,DB;

class LoginController extends BaseController
{
    //登陆
    public function index(){
	    return view('admin/login');	
    }
    //判断用户名密码
    public function info(){
    	$name=Request::input('name');
    	$pwd=md5(Request::input('pwd'));
    	$results = DB::select('select * from admin where a_name = ? and a_pwd = ? ', array($name,$pwd));
    	if(empty($results)){
    		echo "<script>alert('用户名或密码错误');history.go(-1);</script>";
    	}else{
    		session_start();
    		$_SESSION['aname']=$name;
    		echo "<script>alert('登陆成功');location.href='demo';</script>";
    	}
    }
    public function login(){
    	 return view('admin/index');
    }
    //退出
    public function logout(){
    	session::flush();
    	return view('admin/login');
    }
    //注册
    public function add(){
    	$email=Request::input('email');
    	$name=Request::input('name');
    	$pwd=md5(Request::input('pwd'));
    	$pwd1=md5(Request::input('pwd1'));
    	if($pwd1==$pwd){
    		$arr=DB::table('admin')->insert(
		    ['a_email' => $email, 
		    'a_name' => $name,
		    'a_pwd'=>$pwd]
		);
    		if($arr){
    			echo "<script>alert('注册成功');history.go(-1);</script>";
    		}
    	}else{
    		echo "<script>alert('密码不一致');history.go(-1);</script>";
    	}
    	
    }
}
