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
        $res=DB::table('course')->insert(
            [
                'course_name' => $data['course_name'],
                'course_desc'=>$data['course_desc'],
                'course_time'=>$data['course_time'],
                'course_content'=>$data['course_content'],
                'school_id'=>$data['school_id'],
                'type_id'=>$data['type_id'],
                'teacher_name'=>$data['teacher_name'],
            ]
        );
        if($res){
            return redirect("classlist");
        }
    }

    /*
    * 课程列表
    */
    public function show(){
        $data = DB::table('course')->join('school', 'course.school_id', '=', 'school.school_id')->get();
        return view("admin/CourseShow",['data'=>$data]);
    }



    /*
     * 课程删除
     */
    public function del(Request $request){
        $course_id=$request->get("course_id");
        $res=DB::table("course")->where("course_id","=","$course_id")->delete();
        if($res){
            echo "<script>alert('删除成功');.href=''</script>";
        }else{
            echo "删除失败";
        }
    }
}
