<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Settings;
use App\Models\Application;
use App\Models\Title;
use App\Models\Rights;
use App\Models\Designation;
use App\Models\Role;
use App\Models\Course;
use App\Models\Programme;
use DB;
use Auth;
use App\Models\Applications_Documents_upload;



class FrontendController extends Controller
{
    //
    public function welcome()
    {
        $popular_courses = DB::table('tbl_courses')->skip(0)->take(6)->get();
        $event_collection = DB::table('tbl_event')->orderBy('event_date','asc')->skip(0)->take(6)->get();

        return view('frontend.home', compact('popular_courses','event_collection'));
    }

    public function management_team()
    {
        $teamCollection = DB::table('tbl_team')->get();
        
        return view('frontend.management_team',compact('teamCollection'));
    }

    public function management_team_details($id)
    {
        $id =  decrypt($id);
        $teamCollection = DB::table('tbl_team')->where('id',$id)->get();
        return view('frontend.management_team_details',compact('teamCollection'));
    }

    public function about_us()
    {
        return view('frontend.about_us');
    }

    public function events()
    {

        $event_collection = DB::table('tbl_event')->orderBy('event_date','asc')->get();

        return view('frontend.events',compact('event_collection'));
    }

    public function event_details($event_id)
    {
        $event_id =  decrypt($event_id);
        //dd($event_id);
        $event_details =DB::table('tbl_event')->where('event_id',$event_id)->get();
        $other_events = DB::table('tbl_event')->where('event_id','!=',$event_id)->where('event_date','>',date('Y-m-d'))->orderBy('event_date','asc')->get();
        
        
        
        return view('frontend.event_details',compact('other_events','event_details'));
    }

    public function accommodation()
    {
        $accommodation_list = DB::table('tbl_accommodation')->where('status',1)->get();
        return view('frontend.accommodation',compact('accommodation_list'));
    }

    public function register()
    {
        $title_collections = DB::table('titles')->get();

        return view('frontend.register',compact('title_collections'));
    }

    public function apply(Request $request)
    {
        $course_id = "";
        $programme_id = "";
        $price = 0;

        if(isset($request->course_id))
        {
            $course_id = decrypt($request->course_id);
            $programme_id = decrypt($request->programme_id);
            $price = Course::where('course_id',$course_id)->first()->course_price;
        }

        $programme_builder = Programme::query();
        $programme_builder->where('status',1);
        $programme_collections = $programme_builder->get();

        $course_builder = Course::query();

        if($programme_id == "")
        {
            $course_builder->where('programme_id',$programme_collections[0]->programme_id);
        }else{
            $course_builder->where('programme_id',$programme_id);
        }

        $qualification_collections = DB::table('tbl_qualifications')->get();
        $course_collection = $course_builder->get();
        return view ('frontend.apply',compact('programme_collections','course_collection','course_id','programme_id','price','qualification_collections'));
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function sumbit_application(Request $request)
    {
       $rules = 
       [
           "programme" => "required",
           "academic_qualification_upload" => "required",
           "previous_experience" => "sometimes",
           "previous_experience_upload" => "sometimes",
           "course" => "required|array",
           "qualification" => "required"
       ];
       
       $this->validate($request,$rules);

       $course_array = $request->course;
       
       $wkexp_file_ext = "";
       if(isset($request->previous_experience_upload))
       {
         $wkexp_file_ext =  $request->previous_experience_upload->getClientOriginalExtension();
       }
       $ac_file_ext =  $request->academic_qualification_upload->getClientOriginalExtension();

       
       $current_batch = DB::table('tbl_batch')->where('status',1)->first()->batch_no;
       DB::beginTransaction(); 
      

       $academic_upload = Auth::user()->email."-".$this->generateRandomString().".".$ac_file_ext;
       $work_experience_upload = Auth::user()->email."-".$this->generateRandomString().".".$wkexp_file_ext;
       
       $application_date = date('Y-m-d H:i:s');

       
       
       $application = new Application();
       $application->programme_id = $request->programme;
       $application->user_id =  Auth::user()->id;
       $application->batch_id = $current_batch;
       $application->created_at = $application_date;
       $application->save();


       $Applications_Documents_upload = new Applications_Documents_upload();
       $Applications_Documents_upload->application_id = $application->application_id;
       $Applications_Documents_upload->document_id = 1;
       $Applications_Documents_upload->file_name =  $academic_upload;
       $Applications_Documents_upload->save();
       
       if(isset($request->previous_experience_upload))
       {
            $Applications_Documents_upload = new Applications_Documents_upload();
            $Applications_Documents_upload->application_id = $application->application_id;
            $Applications_Documents_upload->document_id = 2;
            $Applications_Documents_upload->file_name =  $work_experience_upload;
            $Applications_Documents_upload->save();
       }

       $course_price_list = DB::table('tbl_courses')->pluck("course_price","course_id");
       $course_title_list = DB::table('tbl_courses')->pluck("course_name","course_id");

       foreach($course_array as $course)
       {
           
           $course_insert[] =
           [
              "application_id" => $application->application_id,
              "course_id"      => $course,
              "app_created_by" => Auth::user()->id,
              "app_creation_date" => NOW(),
              "application_course_price"  => $course_price_list[$course]
           ];
       }
      
       $insert_to_course = DB::table('tbl_application_courses')->insert($course_insert);

       

       if ($application && $insert_to_course && $Applications_Documents_upload)
       {
            $request->academic_qualification_upload->move("file_upload/applications/academic_upload", $academic_upload);
            
            if(isset($request->previous_experience_upload))
            {
              $request->previous_experience_upload->move("file_upload/applications/work_experience", $work_experience_upload);
            }

            DB::commit(); 
            return redirect('/apply')->with('application_success','Your application has been submitted successfully, click <a href="'.url('/dashboard').'">here</a> to view application status');
       }else{

            DB::rollback();
            return redirect('/apply')->with('application_error','Your application was not successful please try again later');
       }
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function accommodation_description($id)
    {
         $id = decrypt($id);
         $acc_id = $id;
         $accommodation_list = DB::table('tbl_accommodation')->get();
         $accommodation_details = DB::table('tbl_accommodation')->where('accommodation_id',$id)->where('status',1)->get();
         
         $images_name = explode(";",$accommodation_details[0]->accommodation_img);
         $img_links = "";
         for($i = 0; $i < count($images_name); $i++)
         {
            $img_links = $img_links."'".asset("frontend/assets/img/accommodation/".$images_name[$i])."',";
         }
         $img_links = rtrim($img_links,",");

        
         return view('frontend.accommodation_description',compact('accommodation_list','accommodation_details','acc_id','img_links'));
    }

    public function our_programmes()
    {
        $programme_collections = DB::table('tbl_programmes')->where('status',1)->get();

        $course_array = DB::table('tbl_courses')->where('status',1)->selectRaw('count(course_id) as course_count, programme_id')->groupBy('programme_id')->pluck("course_count","programme_id");
       
        return view('frontend.our_programmes',compact('programme_collections','course_array'));
    }

    public function programme_courses($programme_id)
    {

       $programme_id =  decrypt($programme_id); 
       $programme_details = DB::table('tbl_programmes')->where('programme_id', $programme_id)->get();

       $course_collection = DB::table('tbl_courses')->where('programme_id',$programme_id)->get();
       return view('frontend.programme_courses',compact('programme_details','course_collection')) ;
    }

    public function course_details($course_id)
    {
        $course_id =  decrypt($course_id); 
        $course_details = DB::table('tbl_courses')
        ->where('course_id',$course_id)
        ->join('tbl_programmes','tbl_programmes.programme_id','tbl_courses.programme_id')->get();

        $similar_courses = DB::table('tbl_courses')->where('course_id','!=',$course_id)->where('programme_id',$course_details[0]->programme_id)->get();
        
        $instructor_list = DB::table('tbl_courses_instructors')
        ->join('users','users.id','tbl_courses_instructors.user_id')
        ->join('tbl_designation','users.designation_id','tbl_designation.designation_id')
        ->where('course_id', $course_id)->get();
        
        return view('frontend.course_details',compact('course_details','similar_courses','instructor_list'));
    }

}
