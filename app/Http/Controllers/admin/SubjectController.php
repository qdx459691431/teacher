<?php

namespace App\Http\Controllers\admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Request,Session,DB;
use Redirect;
header('content-type:text/html;charset=utf-8');
class SubjectController extends BaseController{
	public function adds(){
		$arr=DB::Table('course')->get();
		return view('admin/subject_add',["arr"=>$arr]);
	}
	public function cha(){
		$id=$_GET['id'];
		$data=DB::Table('list')->where("course_id",$id)->get();
		$arr['list']=$this->set($data);
		echo json_encode($arr);		
	}


	 function set($data,$pid=0){
	        $result=array();
	        foreach($data as $k=>$v){
	            if($v['pid']==$pid){
	                $result[$k]=$v;
	                $result[$k]['son']=$this->set($data,$v['list_id']);
	            }
	        }
	        return $result;
    }
	public function jias(){
		$pid=Request::input('pid');
		$listname=Request::input('listname');
		$courseid=Request::input('courseid');
		//echo $pid,$listname,$courseid;
		if($pid=='0'){
			$arr=DB::table('list')->insert([
			    ['list_name' =>$listname,
			     'pid' => $pid,
			     'course_id'=>$courseid]
			]);
			if($arr){
				return Redirect::to("booklist");
			}
		}else{
			echo "<script>alert('请选择父级目录');location.href='bookadd';</script>";
		}
		
		
	}
	public function lists(){
		$data=DB::Table('list')->get();
		$arr=$this->sets($data);
		//print_r($data);die;
		return view('admin/subject_list',["arr"=>$data]);
	}


	 function sets($arr,$pid=0,$levle=0){
	        static $data=array();
	        foreach($arr as $v){
	            if($v['list_id']==$pid){
	                $v['levle']=$levle;
	                $data[]=$v;
	                $this->sets($arr,$v['list_id'],$levle+1);
	            }
	        }
	        return $data;
    	}

    	public function del(){
    		$id=$_GET['id'];
    		$data=DB::Table('list')->where("pid",$id)->get();
    		//print_r($data);die;
    		if(empty($data)){
    			DB::table('list')->where('list_id',$id)->delete();
    			echo "<script>alert('删除成功');location.href='booklist';</script>";
    		}else{
    			echo "<script>alert('请先删除子级目录');location.href='booklist';</script>";
    		}
    	}

    	public function tian(){
    		$data=DB::Table('list')->get();
		$arr=$this->sets($data);
		//print_r($data);die;
		return view('admin/data_add',["arr"=>$data]);
    	}

    	public function ads(){
    		$listid=Request::input('listid');
		$content=Request::input('content');
		$arr=DB::Table('list')->where('list_id',$listid)->get();
		if($arr[0]['pid']=='0'){
			echo "<script>alert('请选择子级目录');location.href='dataadd';</script>";
		}else{
			$arr=DB::table('data')->insert([
			    ['data_content' =>$content,
			     'list_id' => $listid]
			]);
			if($arr){
				return Redirect::to("demo");
			}
		}
    	}
}