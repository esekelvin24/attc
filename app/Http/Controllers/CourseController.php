<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\User;

class CourseController extends Controller
{
    //

    public function assigned_courses()
    {

        $assigned_courses = DB::table('tbl_map_lecturer_to_courses')->where('lecturer_user_id',Auth::user()->id)->pluck('short_code')->toArray();

    
        $course_collection =  Course::
        whereIn('short_code',$assigned_courses)
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
            ->where('god_eye',0);
            
            
            //Lecturer




            $lecturer_collection = $builder->get();



            // $programme_collection = Programme::all();
                 $program_type_collection = Program_Type::all();

            return view('course.map_lecturer_to_courses',compact('lecturer_collection','program_type_collection'));
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
              $lect_map_history[] = $val->short_code;
           }

           $lecturer_details = DB::table('tbl_users')->where('id', Auth::user()->id)->first();

           $builder = Course::query();
           $builder->where('tbl_courses.programme_id',$id);

           if (isset($lecturer_details->rights_id))
            {
               
                if($lecturer_details->rights_id == 6) //This user is a Lecturer
                {
                    $supper_lecturer_assigned_courses =  DB::table('tbl_map_lecturer_to_courses')->where('lecturer_user_id',Auth::user()->id)->pluck('short_code')->toArray();
                    $builder->whereIn('short_code',$supper_lecturer_assigned_courses);
                }

            }



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
                        "short_code" => $val,
                        "lecturer_user_id" => $request->lecturer,
                        "created_at" => now(),
                        "created_by" => Auth::user()->id
                    ];
                }
           }
           
           $course_array =  DB::table('tbl_courses')->where('programme_id',$request->programme_id)->pluck('short_code');
        
           //Delete the course current mapping to other lecturers
           DB::table('tbl_map_lecturer_to_courses')
           ->whereIn('short_code',$course_array)
           ->where("lecturer_user_id",$request->lecturer)->delete();
        
           
           //Remap the lecturer to the courses selected
           if (isset($request->courses))
           $result = DB::table('tbl_map_lecturer_to_courses')->insert($insert);
           
           
           return redirect()->route("map_lecturer_to_courses")->with("mapping_success","Course Mapping was successful");
           

        }

   
}
