<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\Application;
use App\Models\Timetable;
use Intervention\Image\ImageManagerStatic as Image;

class CourseController extends Controller
{
    //

    public function courses_list(Request $request)
    {
        $selected_programme = "";
        $builder = Course::query();
        $builder->selectRaw('*, tbl_courses.created_at as course_creation_date')
        ->join('tbl_programmes','tbl_programmes.programme_id','tbl_courses.programme_id')
        ->orderby('tbl_courses.created_at','desc');
        
        if(isset($request->programme_id) && $request->programme_id !="")
        {
            $selected_programme = decrypt($request->programme_id);
            $builder->where('tbl_courses.programme_id',$selected_programme);
           
        }
        $course_collection = $builder->get();
        $programme_collection = DB::table('tbl_programmes')->get();


        return view('course.course',compact('course_collection','programme_collection','selected_programme'));
       
    }
    
    public function save_course(Request $request)
    {
        $rules = [
            
            "disp_img" => 'required|mimes:jpeg,jpg,png,gif|max:10000',
            "programme" => "required",
            "course_name" => "required",
            "short_code" => "required",
            "course_duration" => "required",
            "duration_type" => "required",
            "course_price" => "required",
            "title" => "required",
            "course_description" => "required",
            "course_outcome" => "required",
            "open_registration" => "sometimes",
            "enable_course" => "sometimes"
        ];

        $this->validate($request, $rules);

        $Course = new Course();

        $Course->course_name = $request->course_name;
        $Course->short_code = $request->short_code;
        $Course->course_duration = $request->course_duration;
        $Course->course_duration_type = $request->duration_type;
        $Course->course_price = $request->course_price;
        $Course->course_outcome = $request->course_outcome;
        $Course->course_description = $request->course_description;
        $Course->programme_id = $request->programme;
        $Course->title = $request->title;

        if(isset($request->open_registration))
        {
            $Course->open_registration = 1;
        }else
        {
            $Course->open_registration = 2;
        }

        if(isset($request->enable_course))
        {
            $Course->status = 1;
        }else
        {
            $Course->status = 2;
        }


        
        if(isset($request->disp_img))
        {
            $rand_one = rand(1,9999999);
            $rand_two = rand(1,9999999);
            $rand = $rand_one.$rand_two;

            $img_ext =  $request->disp_img->getClientOriginalExtension();
            $Course->disp_img = $rand.".".$img_ext;
            $request->disp_img->move("frontend/assets/img/courses", $rand.".".$img_ext);
        }
        $Course->save();

        return redirect()->route('courses_list')->with("success", "Course creation was successfully");

    }

    public function save_edited_course(Request $request)
    {
        $rules = [
            "course_id" => "required",
            "disp_img" => 'sometimes|mimes:jpeg,jpg,png,gif|max:10000',
            "programme" => "required",
            "course_name" => "sometimes",
            "short_code" => "required",
            "course_duration" => "required",
            "duration_type" => "required",
            "course_price" => "required",
            "title" => "required",
            "course_description" => "required",
            "course_outcome" => "required",
            "open_registration" => "sometimes",
            "enable_course" => "sometimes"

        ];

        $this->validate($request, $rules);

        $Course = Course::find(decrypt($request->course_id));

        //$Course->course_name = $request->course_name;
        $Course->short_code = $request->short_code;
        $Course->course_duration = $request->course_duration;
        $Course->course_duration_type = $request->duration_type;
        $Course->course_price = $request->course_price;
        $Course->course_outcome = $request->course_outcome;
        $Course->course_description = $request->course_description;
        $Course->programme_id = $request->programme;
        $Course->title = $request->title;

        if(isset($request->open_registration))
        {
            $Course->open_registration = 1;
        }else
        {
            $Course->open_registration = 2;
        }

        if(isset($request->enable_course))
        {
            $Course->status = 1;
        }else
        {
            $Course->status = 2;
        }

       

        
        if(isset($request->disp_img))
        {
            
            $img_ext =  $request->disp_img->getClientOriginalExtension();
            $image       = $request->file('disp_img');
            $filename    = $image->getClientOriginalName();
        
            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(800, 600);
            $image_resize->save(/*public_path*/("frontend/assets/img/courses/" .decrypt($request->course_id).".".$img_ext));
            

            $Course->disp_img = decrypt($request->course_id).".".$img_ext;
            //$request->disp_img->move("frontend/assets/img/courses", $request->course_id.".".$img_ext);
        }
        $Course->save();

        return redirect()->route('courses_list')->with("success", "course was updated successfully");

    }

    public function timetable_edit(Request $request)
    {
         $attendance_id = decrypt($request->id);

         $timetable_collection = DB::table('tbl_timetable as t')
         ->join('tbl_courses as c','c.course_id','t.course_id')
         ->orderBy('day','asc')
         ->where("id", $attendance_id)
         ->get();

         $programme_collection = DB::table('tbl_programmes')->get();

         return view('course.edit_timetable', compact('programme_collection','timetable_collection'));
    }

    public function course_timetable_details($course_id, Request $request)
    {
         
         $course_id = decrypt($course_id);

         $date_range_arr = explode(" - ", $request->date_range);

         if(count($date_range_arr) > 1)
         {
             $start = $date_range_arr[0];
             $end = $date_range_arr[1];
         }else
         {
             $start = date('Y-m-d');
             $end = date('Y-m-d');
         }

         $user_id = Auth::user()->id;
         $current_batch = DB::table('tbl_batch')->where('status',1)->orderBy('created_at','desc')->first();
         $current_batch_no = $current_batch->batch_no;

         //--------------------- Student check
         $uncompleted_registered_courses = DB::table('tbl_applications as a')
         ->join('tbl_application_courses as ac','ac.application_id', 'a.application_id')
         ->where('user_id',$user_id)
         ->where('batch_id', $current_batch_no)
         ->where('ac.ca1','=', NULL)
         ->pluck('batch_id','ac.course_id');
         //---------------------- End of student check

         //-----------------------Lecturer check
         $get = DB::table('tbl_map_lecturer_to_courses')
           ->where("lecturer_user_id", Auth::user()->id)
           ->get();

           $lect_map_history = array();
           foreach ($get as $val)
           {
              $lect_map_history[$val->course_id] = "";
           }
          
         $time_table_list = DB::table('tbl_timetable')->where('course_id',92822)->get();

        
         if(isset($uncompleted_registered_courses[$course_id]) || isset($lect_map_history[$course_id]) || Auth::user()->can('view-course-timetable-details')) //if the course is not amoung the uncompleted course dont display anything
         {
            
            $time_table_list = DB::table('tbl_timetable as t')
            ->join('tbl_courses as c','c.course_id','t.course_id')
            ->where('t.course_id',$course_id)
           // ->orderBy('day','asc')
            ->where("lecture_date",">=",$start)
            ->where("lecture_date","<=",$end)
            ->orderBy('lecture_date','asc')
            ->orderBy('start_time','asc')
            ->get();
         }

         return view('course.course_timetable_details', compact('time_table_list','start','end'));
    }

    public function get_courses_by_programme_id(Request $request)
    {
        $programme_id = decrypt($request->id);
        
        $course_collection =  DB::table('tbl_courses')->where('programme_id', $programme_id)->get();
        
        $option = '<option value="">Select Course</option>';
        foreach($course_collection as $val)
        {
            $option = $option .'<option value="'.encrypt($val->course_id).'">'.$val->course_name.'</option>';
        }

        return $option;
    }

    public function save_timetable(Request $request)
    {
        $rules = [
            "programme" => "required",
            "course" => "required",
            "date_range" => "required",
            "dates" => "required|array|size:1",
            "start_time" => "required|array|size:1",
            "end_time" => "required|array|size:1",
        ];

        $this->validate($request, $rules);

        $date_range_arr = explode(" - ", $request->date_range);
        $dates =  $request->dates;
        $start_time =  $request->start_time;
        $end_time =  $request->end_time;

        $current_batch = DB::table('tbl_batch')->where('status',1)->orderBy('created_at','desc')->first();
        $current_batch_no = $current_batch->batch_no;

        $insert = array();
        for($i = 0; $i < count($request->dates); $i++)
        {
           $array[] = [
              "course_id" => decrypt($request->course),
              "week_start" => $date_range_arr[0],
              "week_end" => $date_range_arr[1],
              "lecture_date" => $dates[$i],
              "start_time" => $start_time[$i],
              "end_time" => $end_time[$i],
              "day"      =>  date('N', strtotime($dates[$i])),
              "created_at" => NOW(),
              "created_by" => Auth::user()->id,
              "batch_id"   => $current_batch_no
           ];
        }

        $Timetable = Timetable::insert($array);

        if($Timetable)
        {
            return redirect('/courses_time_table')->with('success','Timetable has been created successfully');
        }
    }

    public function delete_timetable(Request $request)
    {
        $id = decrypt($request->timetable_id);

       $delete = Timetable::where('id',$id)->delete();

       if($delete)
       {
           return 1;
       }else
       {
           return 2;
       }

    }


    public function save_update_timetable(Request $request)
    {
        $rules = [
            "attendance_id" => "required",
            "zoom_id" => "sometimes",
            "zoom_link" => "sometimes",
            "zoom_password" => "sometimes",
            "start_time" => "required",
            "end_time" => "required",
        ];

        $this->validate($request, $rules);
        
        $attendance_id = decrypt($request->attendance_id);
        $zoom_id = $request->zoom_id;
        $zoom_link = $request->zoom_link;
        $zoom_password = $request->zoom_password;
        $start_time = $request->start_time;
        $end_time = $request->end_time;

        $array = [
            "zoom_link" => $zoom_link,
            "zoom_id" => $zoom_id,
            "zoom_password" => $zoom_password,
            "start_time" => $start_time,
            "end_time" => $end_time
        ];
      

        $Timetable = Timetable::where('id',$attendance_id)->update($array);
       

        if($Timetable)
        {
            return redirect()->back()->with('success','Attendance has been updated');
        }else
        {
            return redirect()->back()->with('error','An error occurred while trying to update attendance');
        }
        
    }

    public function get_timetable_date_range(Request $request)
    {
         $date_range_arr = explode(" - ", $request->date_range);
        
        $now = strtotime($date_range_arr[0]);
        $your_date = strtotime($date_range_arr[1]);
        $datediff = $your_date - $now;

        
         $diff = round($datediff / (60 * 60 * 24));
          
         $date_counter = 0;

         for($i = 0; $i < $diff + 1; $i++)
         { 
          
           if ($i == 0)
           {
               $value = $date_range_arr[0];
           }else
           {
            $value = date('Y-m-d', strtotime($date_range_arr[0].' +'.($date_counter).' day'));
           }
          
            
           

           echo '<div class="row">
                    <div class="col-md-4">
                        <label>Date</label>
                        <input readonly class="form-control my_date" name="dates[]" value="'.$value.'">
                    </div>
                    <div class="col-md-4">
                        <label>Start Time</label>
                        <input required class="form-control my_time" name="start_time[]" value="">
                    </div>
                    <div class="col-md-4">
                        <label>End Time</label>
                        <input required class="form-control my_time" name="end_time[]" value="">
                    </div>
             </div>
             <script>
                    $(".my_time").mdtimepicker(
                        {
                            format:"hh:mm",
                            theme:"blue"
                        }
                    ); //Initializes the time picker	
             </script>
             
             ';

             $date_counter = $date_counter + 1;
         }
    }
    

    public function new_timetable()
    {
        $programme_collection = DB::table('tbl_programmes')->get();

        return view('course.new_timetable', compact('programme_collection'));
    }

    public function courses_time_table(Request $request)
    {

        $selected_programme = "";
        
       
        $builder = Timetable::query();

        $builder->join('tbl_courses as c','c.course_id','tbl_timetable.course_id')
        ->select('tbl_timetable.course_id','c.course_name','tbl_timetable.created_at')
        ->groupBy('tbl_timetable.course_id')
        ->orderBy('tbl_timetable.created_at');

        if(isset($request->programme_id) && $request->programme_id !="")
        {
            $selected_programme = decrypt($request->programme_id);
            $builder->where('c.programme_id',$selected_programme);
        }


        $course_collection = $builder->get();
        $programme_collection = DB::table('tbl_programmes')->get();
        
        
        return view('course.courses_timetable',compact('course_collection','programme_collection','selected_programme'));
    }

    public function my_time_table()
    {
        $current_batch_details = DB::table('tbl_batch')->where('status',1)->orderBy('created_at','desc')->get();

        $all_application_collection = Application::join('tbl_programmes','tbl_programmes.programme_id','tbl_applications.programme_id')
        ->join('users','users.id','tbl_applications.user_id')
        ->join('tbl_application_courses as ac','ac.application_id','tbl_applications.application_id')
        ->join('tbl_courses as c','c.course_id','ac.course_id')
        ->where('tbl_applications.user_id',Auth::user()->id)
        ->where('batch_id', $current_batch_details[0]->batch_no)
        ->where('action_1_status',1)
        ->where('payment_status',1)
       // ->orderBy('tbl_applications.created_at','desc')
        ->get();
        

        return view('course.my_time_table', compact('all_application_collection'));
    }


    public function create_course()
    {
        $programme_collection = DB::table('tbl_programmes')->where('status', 1)->get();    
        return view('course.new_course',  compact('programme_collection')); 
    }

    public function course_edit(Request $request)
    {
        $course_collection = Course::selectRaw('*, tbl_courses.status as course_status')->where('course_id',decrypt($request->id))->get();
        
        $selected_programme = $course_collection[0]->programme_id; 
        $programme_collection = DB::table('tbl_programmes')->where('status', 1)->get();       
       
        return view('course.course_edit', compact('course_collection','selected_programme','programme_collection'));
    }

    public function assigned_courses()
    {

        $assigned_courses = DB::table('tbl_map_lecturer_to_courses')->where('lecturer_user_id',Auth::user()->id)->pluck('course_id')->toArray();

    
        $course_collection =  Course::whereIn('course_id',$assigned_courses)
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
           ->where("lecturer_user_id", $request->lecturer)
           ->get();

           $lect_map_history = array();
           foreach ($get as $val)
           {
              $lect_map_history[$val->course_id] = "";
           }

          // $lecturer_details = DB::table('users')->where('id', Auth::user()->id)->first();

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
