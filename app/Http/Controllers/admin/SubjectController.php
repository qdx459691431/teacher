<?php

namespace App\Http\Controllers\admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Request,Session,DB;

class SubjectController extends BaseController{
	public function adds(){
		$arr=DB::Table('course')->get();
		return view('admin/subject_add',["arr"=>$arr]);
	}
	public function cha(){
		$id=$_GET['id'];
		$data=DB::Table('list')->where("course_id",$id)->get();
		return $data;
		
	}
}