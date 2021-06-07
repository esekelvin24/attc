<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\User;
use App\Models\Course;

class CourseController extends Controller
{
    //

    public function assigned_courses()
    {

        $assigned_courses = DB::table('tbl_map_lecturer_to_courses')->where('lecturer_user_id',Auth::user()->id)->pluck('course_id')->toArray();

    
        $course_collection =  Course::
        whereIn('course_id',$assigned_courses)
        ->leftjoin('tbl_programmes','tbl_programmes.programme_id','tbl_courses.programme_id')
        ->get();
        //dd($cross_course_collection);
        return view('course.assigned_courses',compact('course_collection'));
        
    }

    public function map_lecturer_to_courses()
    {
            $user_details = DB::table('users')
            ->where('id',Auth::user()->id)->first();


            $builder = User::query();
            $builder->select('id','firstname','middlename','lastname')
            ->join('users_roles','users.id','users_roles.user_id')
            ->where('users_roles.role_id', 7)//Lecturer Rights
            ->where('user_type',2) //staff
            ->where('status',1)
            ->where('god_eye',0);
            
            
            //Lecturer

            $lecturer_collection = $builder->get();



            // $programme_collection = Programme::all();
                 $program_collection = DB::table('tbl_programmes')->where('status',1)->get();

            return view('course.map_lecturer_to_courses',compact('lecturer_collection','program_collection'));
    }

    
    public function course_map_list(Request $request)
        {
           $id = $request->id;
           $lecturer_id = $request->lecturer;

           $get = DB::table('tbl_map_lecturer_to_courses')
           ->where("lecturer_user_id",$request->lecturer)
           ->get();

           $lect_map_history = array();
           foreach ($get as $val)
           {
              $lect_map_history[] = $val->course_id;
           }

           $lecturer_details = DB::table('users')->where('id', Auth::user()->id)->first();

           $builder = Course::query();
           $builder->where('tbl_courses.programme_id',$id);



           $course_collection =  $builder->get();

           return view('course.course_map_list',compact('course_collection','lect_map_history'));
        }

    public function save_mapped_lecturer(Request $request)
        {
           // dd($request);
            $rules =
            [
                'lecturer'=>'required|numeric',
                'courses'=>'sometimes|array',
                'programme_id'=>'required',
                
            ];

           //check validation options  
           $this->validate($request,$rules);

           $insert = array();
           if (isset($request->courses))
           {
                foreach($request->courses as $val)
                {
                    
                    $insert[] = [
                        "course_id" => $val,
                        "lecturer_user_id" => $request->lecturer,
                        "created_at" => now(),
                        "created_by" => Auth::user()->id
                    ];
                }
           }
           
           $course_array =  DB::table('tbl_courses')->where('programme_id',$request->programme_id)->pluck('course_id');
        
           //Delete the course current mapping to other lecturers
           DB::table('tbl_map_lecturer_to_courses')
           ->whereIn('course_id',$course_array)
           ->where("lecturer_user_id",$request->lecturer)->delete();
        
           
           //Remap the lecturer to the courses selected
           if (isset($request->courses))
           $result = DB::table('tbl_map_lecturer_to_courses')->insert($insert);
           
           
           return redirect()->route("map_lecturer_to_courses")->with("mapping_success","Course Mapping was successful");
           

        }

   
}
