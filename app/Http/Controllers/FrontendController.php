<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
use Mail;
use App\Models\Applications_Documents_upload;
use Illuminate\Support\Facades\Hash; 
use DateTime;



class FrontendController extends Controller
{
    //
    public function welcome()
    {
        $popular_courses = DB::table('tbl_courses')->skip(0)->take(6)->get();
        $event_collection = DB::table('tbl_event')
        ->whereDate('event_date','>=',date('Y-m-d'))
        ->orderBy('event_date','asc')
        ->orderBy('event_start_time','asc')
        ->skip(0)->take(6)
        ->get();

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

        $event_collection = DB::table('tbl_event')
        ->whereDate('event_date','>=',date('Y-m-d'))
        ->orderBy('event_date','asc')
        ->orderBy('event_start_time','asc')
        ->orderBy('event_date','asc')->get();

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
    public function sumbit_registration(Request $request)
    {
      
        $rules = [
            "title" => "required",
            "firstname" => "required",
            "middlename" => "sometimes",
            "lastname" => "required",
            "nationality" => "required",
            "state_of_origin" => "required",
            "date_of_birth" => "required",
            "religion" => "required",
            "gender" => "required",
            "permanent_state_of_residence" => "required",
            "current_state_of_residence" => "required",
            "permanent_residence" => "required",
            "current_residence" => "required",
            "phone_number" => "required",
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
            'confirm_password'=>'required|min:6|same:password'
        ];

        $this->validate($request, $rules);

        $fileNameToStore='no_pic.jpg';//or whatever
        $current_batch = DB::table('tbl_batch')->where('status',1)->orderBy('created_at','desc')->first();
        $current_batch_no = $current_batch->batch_no;

      

        DB::beginTransaction();

        $company_details = DB::table('tbl_settings')->get();
        $company_name = $company_details[0]->value;
       // $company_email = $company_details[4]->value;
       // $plain_password = $company_details[5]->value;
	   //Saving to tbl_staff in order of arrangement in form
	   $user = new User;
	   $user->user_type = 1;// 2- Staff, 1 - General User
	   $user->pics = $fileNameToStore;
	   $user->firstname = $request->firstname;
       $user->lastname = $request->lastname;
       $user->middlename = $request->middlename == NULL?"":$request->middlename;
	   $user->chng_password_logon = 1; //User has alread change password
       $user->title_id = $request->title;
       $user->branch_id = 1; //Refinery Office
       $user->phone = $request->phone_number;
	   $user->gender = $request->gender;
	   $user->designation_id = 4;  //General User
       //$user->created_by = ;
       $user->nationality = $request->nationality ;
       $user->state_of_origin = $request->state_of_origin;
       $user->permanent_state_of_residence = $request->permanent_state_of_residence ;
       $user->current_state_of_residence = $request->current_state_of_residence ;
       $user->permanent_residence = $request->permanent_residence ;
       $user->current_residence = $request->current_residence ;
       $user->religion = $request->religion ;
       $user->dob = $request->date_of_birth ;
       $user->batch_no = $current_batch_no;
	   $user->created_at = date('Y-m-d');
	   $user->updated_at = NOW();
      
	   if($request->god_eye)
	   		$user->god_eye = 1;

        if(trim($request->email)!="")
            $email = $request->email;
     
        $password = Hash::make($request->password); 
        $unique_code=Str::random(45);
        $user->status   = 1;
        $user->email = $email;
       
        $user->password = $password;
        $user->remember_token = $unique_code;
        $user->save();

        $role = DB::table('users_roles')->insert(['user_id'=> $user->id, "role_id"=> "5"]); //- 5 stand for prospective student
        

	    #Send welcome email to new user
        //$link = url("/login",$unique_code);//verify email link
        $link = url("/")."?confirm_email=".encrypt($email);
        $data = array('full_name'=>request()->firstname." ".request()->lastname,'link'=> $link, 'email' => $email, 'password' => "", 'company_name' => $company_name);
      
        if ($user && $role)
        {
            DB::commit(); 
            
            Mail::send('emails.account_registration', $data, function($message) use ($data,$email){
                $message->from("noreply@attcnigeria.org", 'ATTC Nigeria Portal');
                $message->to($email);
            // $message->bcc("isokenodigie@gmail.com");
            // $message->bcc("mailaustin37@gmail.com");
                $message->subject('ATTC User Account Creation');
            });

            return redirect('/register')->with('success','Your registration was successful, a confirmation link has been sent to your email address');
        }else{
            
            DB::rollback();
            return redirect('/register')->with('error','Your registration was not successful');
           
        }
    }
    public function register()
    {

        if(isset(Auth::user()->id))
        {
            return redirect('/dashboard');
        }
        $title_collections = DB::table('titles')->get();

        $states_collection = DB::table('tbl_states')->get();

        return view('frontend.register',compact('title_collections','states_collection'));
    }

    public function save_changed_password(Request $request)
    {
        $rules = [
            'unique_id' => 'required',
            'new_password'=>'required|min:6',
            'confirm_password'=>'required|min:6|same:new_password'
        ];

        $this->validate($request, $rules);

        $unique_id = $request->unique_id;

        $psw_collection= User::select('email','firstname','email_reset_token')->where('email_reset_token',$unique_id)->get();
        
        if(!$psw_collection->isEmpty()) 
        {
            $d1 = new DateTime($psw_collection[0]->email_reset_time);
            $d2 = new DateTime(date('Y-m-d H:m:s'));
            $interval = $d1->diff($d2);
            $diffInSeconds = $interval->s; //45
            $diffInMinutes = $interval->i; //23
            $diffInHours   = $interval->h; //8
            $diffInDays    = $interval->d; //21
            $diffInMonths  = $interval->m; //4
            $diffInYears   = $interval->y; //1
            

            if ($diffInHours < 1)
            {
                $update = User::where('email_reset_token',$unique_id)->update(['email_reset_token'=> "", "password" => Hash::make($request->new_password)]);
            
                if($update)
                {
                    return redirect('/')->with("password_recovery","Your password has been changed, you can now login with your new password");
            
                }
            }
        }

        return redirect('/reset_account');
    


    }

    public function reset_account(Request $request)
    {

        $unique_id = $request->recovery;

        $psw_collection= User::select('email','firstname','email_reset_token','email_reset_time')->where('email_reset_token',$unique_id)->get();
        
        if(!$psw_collection->isEmpty()) {

            
            $d1 = new DateTime($psw_collection[0]->email_reset_time);
            $d2 = new DateTime(date('Y-m-d H:m:s'));
            $interval = $d1->diff($d2);
            $diffInSeconds = $interval->s; //45
            $diffInMinutes = $interval->i; //23
            $diffInHours   = $interval->h; //8
            $diffInDays    = $interval->d; //21
            $diffInMonths  = $interval->m; //4
            $diffInYears   = $interval->y; //1
            

            if ($diffInHours < 1)
            {
                $stored_unique_id = $psw_collection[0]->email_reset_token;
                $firstname = $psw_collection[0]->firstname;
                $email = $psw_collection[0]->email;
                
                return view('frontend.password_change',compact('unique_id'));
            }
            
        }

        return view('frontend.password_change');
    
    }

    public function password_reset(Request $request){
       
         // Session::put('reset_password_error','ok');
          $rules =
              ['reset_email'=>'required|email'];
          //check validation options
          $this->validate($request,$rules);
          //Session::forget('reset_password_error');
          //Session::save();
  
          $user_collection= User::select('firstname','lastname','email')->where('email',$request->reset_email)->get();
       
          if($user_collection->isEmpty()){
              
              return redirect('/')->with("reset_email_not_found","The email address you entered is not associated with any account");
          }else{
              
              $unique_code=Str::random(55);
              User::where('email',$request->reset_email)->update(['email_reset_token'=>$unique_code, "email_reset_time"=>NOW()]);
              $link = route("reset_account","recovery=".$unique_code);//verify email link
              $data = array('full_name'=>$user_collection[0]->firstname." ".$user_collection[0]->lastname,'link'=> $link);
              Mail::send('emails.account_reset', $data, function($message) use ($data){
                  $message->from("noreply@attcnigeria.org", 'ATTC Nigeria Portal');
                  $message->to(request()->reset_email);
                  $message->subject('Password reset request'); 
              });
  
              
              return redirect('/')->with("reset_sent","A password recovery link has been sent to your email");
  
          }
  
      }

    public function get_apply_course_list(Request $request)
    {
        $already_registered_courses = DB::table('tbl_applications as a')
        ->join('tbl_application_courses as ac','ac.application_id', 'a.application_id')
        ->where('a.status',1)
        ->where('a.action_1_status','!=', 2)
        ->where('a.user_id',Auth::user()->id)
        ->pluck('ac.course_id');


        $course_collection = DB::table('tbl_courses')->whereNotIn('course_id',$already_registered_courses)->where('programme_id', $request->id)->get();
        $course_list = "";

        foreach($course_collection as $val)
        {
            $course_list = $course_list. '<div class="p-2 rounded checkbox-form">
                                 <div class="form-check checked"> <input data-id="'.$val->course_price.'" id="'.$val->course_price.'"  name="course[]" style="min-height:1px !important;" class="my_price" type="checkbox" value="'.$val->course_id.'" id="flexCheckDefault-1"> <label class=" newsletter form-check-label" for="flexCheckDefault-1"> '.$val->short_code.' '.$val->course_name.' | '.$val->course_duration.' Weeks | ???'.$val->course_price.'  </label> </div>
                            </div>';
        }

 echo ' <script>
        $(function()
        {
            $(\'.my_price\').each(function () {
                total_checked += this.checked ?parseFloat($(this).data("id")): 0 ;  
              }); 
             });
        
            $(\'.my_price\').change(function() {
                
                total_checked = 0;
                $(\'.my_price\').each(function () {
                    total_checked += this.checked ?parseFloat($(this).data("id")): 0 ;  
                }); 
                
                $("#price_div").html("Total: ???"+xx.format(total_checked));         
            });
            </script>
     ';

        echo $course_list;
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
        $course_builder->where('status',1)->where('tbl_courses.open_registration',1);

      
        $already_registered_courses = DB::table('tbl_applications as a')
        ->join('tbl_application_courses as ac','ac.application_id', 'a.application_id')
        ->where('a.status',1)
        ->where('a.action_1_status','!=', 2)
        ->where('a.user_id',Auth::user()->id)
        ->pluck('ac.course_id');

       
        $course_builder->whereNotIn('course_id',$already_registered_courses);
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

    public function submit_contact_form(Request $request)
    {

        
        $rules = [
            "email"=> "required",
            "name" => "required",
            "phone"=> "required",
            "comments" => "required",
            'g-recaptcha-response' => 'required|recaptcha'
        ];

        $messages = array(
            'g-recaptcha-response.recaptcha' => 'Captcha verification failed',
            'g-recaptcha-response.required' => 'Please complete the captcha'
        );

        $this->validate($request, $rules, $messages);

        $company_details = DB::table('tbl_settings')->get();
        $contact_us_email = $company_details[6]->value;

        

        $data = array('full_name'=>request()->name, 'email' => request()->email, 'phone' => request()->phone, 'comments' => request()->comments);
      
            
            Mail::send('emails.contact_us', $data, function($message) use ($data,$contact_us_email){
                $message->from("noreply@attcnigeria.org", 'ATTC Nigeria Portal');
                $message->to($contact_us_email);
                $message->subject('ATTC Web Contact Form');
            });

       return redirect()->route('contact')->with("contact_success","Thank you for contacting us, we will get back to you as soon as possible");


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
        $user_id = "239199991";
        if (isset(Auth::user()->id))
        {
            $user_id = Auth::user()->id;
        }

        $course_id =  decrypt($course_id); 
        $course_details = DB::table('tbl_courses')
        ->selectRaw('*,tbl_courses.disp_img as cover_img')
        ->where('course_id',$course_id)
        ->where('tbl_courses.status',1)
        ->join('tbl_programmes','tbl_programmes.programme_id','tbl_courses.programme_id')->get();

        $similar_courses = DB::table('tbl_courses')->where('course_id','!=',$course_id)->where('programme_id',$course_details[0]->programme_id)->get();
        
        $instructor_list = DB::table('tbl_courses_instructors')
        ->join('users','users.id','tbl_courses_instructors.user_id')
        ->join('tbl_designation','users.designation_id','tbl_designation.designation_id')
        ->where('course_id', $course_id)->get();

        $already_registered_courses = DB::table('tbl_applications as a')
        ->join('tbl_application_courses as ac','ac.application_id', 'a.application_id')
        ->where('a.status',1)
        ->where('a.action_1_status','!=', 2)
        ->where('a.user_id',$user_id)
        ->pluck('a.user_id','ac.course_id');
        
        return view('frontend.course_details',compact('already_registered_courses','course_details','similar_courses','instructor_list'));
    }

}
