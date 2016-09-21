<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use DB,Request,Session;
header("content-type:text/html;charset=utf-8");

class SchoolController extends Controller
{
	/**
	 * [schooladd 展示学校添加页面]
	 */
    public function schooladd()
    {
    	// echo $_SERVER['SERVER_NAME'];
    	// $name= $_SERVER['REDIRECT_URL'];
    	// $names=explode("/", $name);
    	// print_r($names) ;
    	// print_r($names[1]);
    	// exit;
    	return view('admin/schooladd');

    }
    /**
     * [schooladds 学校添加 ]
     */
    public function schooladds()
    {
    	$photo=Request::file("school_badge");
    	$all=Request::all();
    	// print_r($all);exit;
    	$school_name=$all['school_name'];
    	$re=DB::table('school')->where("school_name",$school_name)->first();
    	if (!empty($re)) 
    	{
    		echo "<script>location.href='schooladd';alert('此大学已经添加过了')</script>";
    	}
    	else
    	{
    		$file_name = $photo->getClientOriginalName();
		
			$file_ex = $photo->getClientOriginalExtension(); 
			// print_r($file_ex);  
			if(!in_array($file_ex, array('jpg', 'gif', 'png'))){
				echo "<script>alert('文件格式错误,仅支持 jpg ,gif,png');location.href='index'</script>";
			}
			$newname = md5(date('ymdhis').$file_name).".".$file_ex;

			$savepath = base_path().'/public/images/';

			$path = $photo->move($savepath,$newname);
			// $pathname="http://localhost/shixun1/teacher/public/";
			$filepath ="images/".$newname;
			// $content=file_get_contents($filepath); 
			// $content="0x".bin2hex($content);
			$res=DB::table('school')->insert(['school_badge' => $filepath,'school_name' => $all['school_name'],'school_desc'=>$all['school_desc']]);
	// print_r($res);exit;
			if ($res) 
			{
				return redirect("schoollist");
			}
    	}
    	
    	
    }
    /**
     * [schoollist 学校展示]
     */
    public function schoollist()
    {
    	// $res= DB::table('school')->get();
    	// print_r($res);exit;
    	$res = DB::table('school')->paginate(3);

    	return view("admin/schoollist",['res'=>$res]);
    }
    /**
     * [schooldel 学校删除]
     */
    public function schooldel()
    {
    	$id=Request::get("id");
    	$res=DB::table('school')->where("school_id",$id)->delete();
        if ($res) 
		{
			return redirect("schoollist");
		}
    }
    /**
     * [schoolupdate 学校编辑]
     */
    public function schoolupdate()
    {
    	$id=Request::get("id");
    	// print_r($id);exit;
    	$res = DB::table('school')->where("school_id",$id)->first();
    	// print_r($res);exit;
    	return view("admin/schoolupdate",['res'=>$res]);
    }  
    public function schoolnewup()
    {

    	$photo=Request::file("school_badge");
    	$all=Request::all();
        // print_r($all);exit;
        $id=$all['id'];
    	$file_name = $photo->getClientOriginalName();
		
		$file_ex = $photo->getClientOriginalExtension(); 
		// print_r($file_ex);  
		if(!in_array($file_ex, array('jpg', 'gif', 'png'))){
			echo "<script>alert('文件格式错误,仅支持 jpg ,gif,png');location.href='index'</script>";
		}
		$newname = md5(date('ymdhis').$file_name).".".$file_ex;

		$savepath = base_path().'/public/images/';

		$path = $photo->move($savepath,$newname);
		
		$filepath ="images/".$newname;
		$res=DB::table('school')->where('school_id',$id)->update(['school_badge' => $filepath,'school_name' => $all['school_name'],'school_desc'=>$all['school_desc']]);
		// print_r($res);exit;
		if ($res) 
		{
			return redirect("schoollist");
		}
    }
}
