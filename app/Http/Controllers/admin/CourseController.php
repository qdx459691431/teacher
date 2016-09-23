<?php

namespace App\Http\Controllers\admin;

use DB;
use Session;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CourseController extends BaseController
{
    /*
     * 课程添加显示目录
     */
    public function insert(Request $request){
        $school = DB::table('school')->get();
        $school_id=$request->get("school_id");
        if(!empty($school_id)){
            $type = DB::table('course_type')->where("school_id","=","$school_id")->get();
            echo json_encode($type);die;
        }
        return view('admin/CourseInsert',['school'=>$school]);
    }

    /*
     * 课程信息添加
     */
    public function add(Request $request){
        $data=$request->input();
        //数据添加入库
        $photo=$request->file("file");
        $file_name = $photo->getClientOriginalName();

        $file_ex = $photo->getClientOriginalExtension();
        if(!in_array($file_ex, array('jpg', 'gif', 'png'))){
            echo "<script>alert('文件格式错误,仅支持 jpg ,gif,png');location.href='insert'</script>";
        }
        $newname = md5(date('ymdhis').$file_name).".".$file_ex;

        $savepath = base_path().'/public/picture/';

        $path = $photo->move($savepath,$newname);
        $filepath ="picture/".$newname;
        $res=DB::table('course')->insert(
            [
                'course_name' => $data['course_name'],
                'course_desc'=>$data['course_desc'],
                'course_time'=>$data['course_time'],
                'course_content'=>$data['course_content'],
                'school_id'=>$data['school_id'],
                'type_id'=>$data['type_id'],
                'teacher_name'=>$data['teacher_name'],
                'course_img'=>$filepath,
            ]
        );
        if($res){
            return redirect("courselist");
        }
    }

    /*
     * 课程类型添加
     */
    public function type(){
        $school = DB::table('school')->get();
        return view("admin/CourseType",['school'=>$school]);
    }

    /*
     * 类型添加
     */
    public function type_add(Request $request){
        $data=$request->input();
        $school_id=$data['school_id'];
        $type_name=$data['type_name'];
        $first=DB::table("course_type")->where("school_id","=","$school_id")->where("type_name","=","$type_name")->first();
       if(!$first){
           $res=DB::table("course_type")->insert([
               'type_name'=>$data['type_name'],
               'school_id'=>$data['school_id'],
           ]);
           if($res){
               return redirect("courselist");
           }else{
               echo "<script>alert('添加失败');localhost.href='type_add'</script>";
           }
       }else{
           echo "<script>alert('学校已经有此科目');localhost.href='type_add'</script>";
       }

    }

    /*
    * 课程列表
    */
    public function show(){
        $data = DB::table('course')->join('school', 'course.school_id', '=', 'school.school_id')->paginate(5);
        return view("admin/CourseShow",['data'=>$data]);
    }



    /*
     * 课程删除
     */
    public function del(Request $request){
        $course_id=$request->get("course_id");
        $res=DB::table("course")->where("course_id","=","$course_id")->delete();
        if($res){
            return redirect("courselist");
        }else{
            echo "<script>alert('删除失败');localhost.href='courselist'</script>";
        }
    }
}
