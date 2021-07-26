<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Course;
use App\Models\Programme;
use Auth;
use PDF;
use App\Models\Application;
use App\Models\Applications_Documents_upload;
use Mail;

class StudentController extends Controller
{
    //
    
	public function manage_students(Request $request)
	{
        $selected_course = "";
        $selected_batch = "";

        $current_batch_details = DB::table('tbl_batch')->where('status',1)->orderBy('created_at','desc')->get();


         //get the list of student that enroll to the lecturer course
         $app_builder = Application::query();
         $app_builder->join('tbl_application_courses as ac','ac.application_id','tbl_applications.application_id');

         //check if admin has approved, if the application is still active, if the user has paid, if the user accepted the offer
         $app_builder->where('action_1_status',1)
         ->where('status',1)
         ->where('payment_status',1)
         ->where('accept_offer',1);

         if (isset($request->batch_no) && $request->batch_no != "")
         {
             $selected_batch = decrypt($request->batch_no);
             $app_builder->where('batch_id',$selected_batch);

             
         }else
         {
             $app_builder->where('batch_id',$current_batch_details[0]->batch_no);
         }

         if(isset($request->course_id) && $request->course_id != "")
         {
             $selected_course = decrypt($request->course_id);
             $app_builder->where('ac.course_id',$selected_course);
         }

         

         if(isset($request->course_id) && $request->course_id != "")
         {
             $selected_course = decrypt($request->course_id);
             $app_builder->where('ac.course_id',$selected_course);
         }



        $all_student_id = $app_builder->pluck('tbl_applications.user_id');



          $user_collection = DB::table('users as u')
         ->leftjoin('users_roles as z','z.user_id','u.id')
         ->join('roles as r','r.id','z.role_id')
         ->leftjoin('titles as t','t.title_id','u.title_id')
         ->leftjoin('tbl_designation as d','d.designation_id','u.designation_id')
         ->select('u.id','u.email','firstname','lastname','name','designation','pics','god_eye','title_name')
         ->where('r.id',6) //student roles is 6
         ->whereIn('u.id',$all_student_id)//only display student that applied to the lecturer cause
         ->orderBy('u.created_at','desc')
         ->get();

        
         

         $get_my_courses =  DB::table('tbl_courses')->where('status',1)->get();

		$data = ['staff_collection'	=> $user_collection];
			
		return view('students.manage_students', compact('get_my_courses','current_batch_details','selected_course','selected_batch'))->with($data);
    }

    
    public function my_students(Request $request)
	{

          $selected_course = "";
          $selected_batch = "";

          $current_batch_details = DB::table('tbl_batch')->where('status',1)->orderBy('created_at','desc')->get();

          //get the list of courses map to lecturer
          $get_my_courses = DB::table('tbl_map_lecturer_to_courses as ml')
          ->join('tbl_courses as c','c.course_id','ml.course_id')
          ->where("lecturer_user_id",Auth::user()->id)
          ->get();

          

           $lect_map_history = array();
           foreach ($get_my_courses as $val)
           {
              $lect_map_history[] = $val->course_id;
           }
             
            //get the list of student that enroll to the lecturer course
            $app_builder = Application::query();
            $app_builder->join('tbl_application_courses as ac','ac.application_id','tbl_applications.application_id');
            $app_builder->whereIn('ac.course_id',$lect_map_history);

            //check if admin has approved, if the application is still active, if the user has paid, if the user accepted the offer
            $app_builder->where('action_1_status',1)
            ->where('status',1)
            ->where('payment_status',1)
            ->where('accept_offer',1);



            if (isset($request->batch_no) && $request->batch_no != "")
            {
                $selected_batch = decrypt($request->batch_no);
                $app_builder->where('batch_id',$selected_batch);

                
            }else
            {
                $app_builder->where('batch_id',$current_batch_details[0]->batch_no);
            }

            if(isset($request->course_id) && $request->course_id != "")
            {
                $selected_course = decrypt($request->course_id);
                $app_builder->where('ac.course_id',$selected_course);
            }
         

        $all_student_id = $app_builder->pluck('tbl_applications.user_id');
       

        $user_collection = DB::table('users as u')
         ->leftjoin('users_roles as z','z.user_id','u.id')
         ->join('roles as r','r.id','z.role_id')
         ->leftjoin('titles as t','t.title_id','u.title_id')
         ->leftjoin('tbl_designation as d','d.designation_id','u.designation_id')
         ->select('u.id','u.email','firstname','lastname','name','designation','pics','god_eye','title_name')
         ->where('r.id',6) //student roles is 6
         ->whereIn('u.id',$all_student_id)//only display student that applied to the lecturer cause
         ->orderBy('u.created_at','desc')
         ->get();

		$data = ['staff_collection'	=> $user_collection];
			
		return view('students.manage_students',compact('get_my_courses','selected_course','selected_batch','current_batch_details'))->with($data);
    }
}
