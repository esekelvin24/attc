<?php

namespace App\Http\Controllers;
use App\Applications_Documents;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Str;
use Session;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PDF;
use App\Models\User;
use App\Models\Settings;
use App\Models\Applications;
use App\Models\Title;
use App\Models\Rights;
use App\Models\Designation;
use App\Models\Role;
use App\Models\Applications_Documents_upload;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=> ['attempt_login','attempt_register','forgot_password']]);
    }


    public function manage_department(Request $request)
    {
         
    }

 
   


    public function profile_update_reminder()
    {
        $check = DB::table('users')->where('id', Auth::user()->id)->get();

        
        if ($check[0]->firstname != "" && $check[0]->lastname != "" && $check[0]->gender != "" && $check[0]->phone != "" && $check[0]->account_no != "" && $check[0]->account_name != "" && $check[0]->bank_bincodes != "" )
        {
            $code = 1;
            $message = "your profile is updated";
        }else
        {
            $code = 2;
            $message = "your profile needs update";
        }
        
        return view('profile_update_reminder', compact('code','message'));
    }

    

    public function landing()
	{	

		$id=Auth::user()->id;
		$psw_query= User::select('password', 'chng_password_logon')->where('id',$id)->get();
        $psw=$psw_query[0]->password;

        
        $fees_amount = 0;
        $application_id = "";
        $accept_offer_upload = true;

        //checking for active application that has been approved 
        $application_details = DB::table('tbl_applications')->where('user_id',Auth::user()->id)->where('status',1)->where('action_1_status', 1)->where('payment_status',0)->get();

        if(count($application_details) > 0)
        {
             $application_id = $application_details[0]->application_id;
             
            if ($application_details[0]->accept_offer == 0)//if the user have not accepted the offer
            {
                $accept_offer_upload = false;

            }else
            {
               
                //checking if there are any application with a pending fees payment
                $fees_amount =  DB::table('tbl_application_courses')
                ->selectRaw('SUM(application_course_price) as total_amt')
                ->where('application_id',$application_id)
                ->first()->total_amt;
    
                
                //check if successful payment has been made for this application
                $payment_check = DB::table('tbl_payments')->where('application_id',$application_id)->where('paystack_status','success')->get();
                
                if(count($payment_check) > 0)
                {
                    $fees_amount = 0; //assign fees to zero because the application has been paid for
                }

            }
        }
        
        

        $check = DB::table('users')->where('id', Auth::user()->id)->get();
        /* if ($check[0]->firstname != "" && $check[0]->lastname != "" && $check[0]->gender != "" && $check[0]->phone != "")
        {
            
        }else
        {  
            return redirect('/profile_update_reminder');  
        }
        */

        if($psw_query[0]->chng_password_logon < 1)
        		
            return view('dashboard')->with('psw','yep!');
		else {

           
            $all_application_collection = DB::table('tbl_applications')
            ->join('tbl_programmes','tbl_programmes.programme_id','tbl_applications.programme_id')
            ->join('users','users.id','tbl_applications.user_id')
            ->where('user_id', Auth::user()->id)->get();
            
           $user =  DB::table("users")->get();
           $data = [
               "users" => $user,
               "accept_offer_upload" => $accept_offer_upload,
               "all_application_collection" => $all_application_collection,
               "fees_amount" => $fees_amount,
               "application_details" => $application_details,
               "application_id" => $application_id
           ];
           
            return view('dashboard')->with($data);
        }
    }
  
	public function first_changepsw(Request $request)
	{
	    $rules = 
		   [
		   'password1'=>'required|min:6',
		   'password2'=>'required|min:6|same:password1'
		   ]; 
		
		$this->validate($request,$rules);
		
		$id=Auth::user()->id;
		//dd($id);
		User::where('id',$id)->update(['password'=>Hash::make($request->password1),"chng_password_logon" => 1]);
	 
	   
    }
    
    
    public function submit_offer_letter(Request $request){
        $rules = ['completed_offer_letter' => 'mimes:png,gif,jpg,JPG,jpeg,pdf'];
        //check validation options
        $this->validate($request,$rules);

        

        $application_details = DB::table('tbl_applications')->where('user_id',Auth::user()->id)->where('status',1)->where('action_1_status', 1)->where('payment_status',0)->get();

        if(count($application_details) > 0)
        {
           $application_id = $application_details[0]->application_id;  

           if ($application_details[0]->accept_offer == 0)//if the user have not accepted the offer
           {
                if($request->hasFile('completed_offer_letter'))
                {
                    $fileNameWithExt=$request->file('completed_offer_letter')->getClientOriginalName();
                    //Get Extension
                    $fileExt=$request->file('completed_offer_letter')->getClientOriginalExtension();
                    //new dynamic name
                    $fileNameToStore="Completed_Offer_".'ATTC-'.str_pad($application_details[0]->batch_id, 4, "0", STR_PAD_LEFT).'-'.$application_details[0]->application_id.".".$fileExt;
                    $file_path = 'file_upload/applications/attc/';
                    //upload image
                    $request->file('completed_offer_letter')->move($file_path, $fileNameToStore);

                    DB::beginTransaction();

                    $Applications_Documents_upload = new Applications_Documents_upload();
                    $Applications_Documents_upload->application_id = $application_details[0]->application_id;
                    $Applications_Documents_upload->document_id = 5;
                    $Applications_Documents_upload->file_name =  $fileNameToStore;
                    $Applications_Documents_upload->save();
                    

                    $update_application = DB::table('tbl_applications')
                    ->where('application_id',$application_details[0]->application_id)
                    ->update(["accept_offer" => 1]);

                    if($update_application && $Applications_Documents_upload)
                    {
                        DB::commit();
                    }else
                    {
                        DB::rollback();
                    }
                }
            }
        }
    }




    public function submit_profile_pic(Request $request){
        $id=Auth::user()->id;
        $rules = ['pic'=>'mimes:png,gif,jpg,JPG,jpeg'];
        //check validation options
        $this->validate($request,$rules);

        if($request->hasFile('pic'))
        {
            $fileNameWithExt=$request->file('pic')->getClientOriginalName();
            //Get Extension
            $fileExt=$request->file('pic')->getClientOriginalExtension();
            //new dynamic name
            $fileNameToStore=strtolower(Auth::user()->firstname."_".Auth::user()->lastname."_profile_pic_".rand(1,9999999).".".$fileExt);

            $file_path = 'img/users/';
            //upload image
            $request->file('pic')->move($file_path, $fileNameToStore);
            User::where('id',$id)->update(['pics'=>$fileNameToStore]);
        }
    }

    public function profile(Request $request)
    {
      
        if(isset($request->user_id))
        {
            if(isset($request->edit_type)) //if request is coming from edit staff page
            {
                $id=$request->user_id;
                $title_collection=Title::all();
                $roles_collection = Role::where('id','!=','1')->get();
                
                $branch = DB::table('tbl_branch')->get();

                $designation_collection = Designation::all();
                $profile_collection=DB::table('users as u')
                    ->leftjoin('titles','titles.title_id','u.title_id')
                    ->leftjoin('tbl_designation','tbl_designation.designation_id','u.designation_id')
                    ->where('id',$id)
                    ->select('u.user_type','u.branch_id','title_name','u.bank_bincodes','u.branch_id','u.title_id as title_id','u.designation_id as designation_id','rights_id','firstname','middlename','lastname','gender','pics','email','phone','dob','designation','status','created_at')
                    ->get();
                $data=[
                        'title_collection'=>$title_collection,
                        'profile_collection'=>$profile_collection,
                        'rights_collection'=>$rights_collection,
                        'designation_collection'=>$designation_collection,
                        'branch' => $branch,
                        'user_id'=>$id,
                        'bin_codes' => $bin_codes
                ];  
                if($request->edit_type == "edit_staff")
                {
                    return view("staff.staff_edit")->with($data);
                }else
                {
                    return view("driver.driver_edit")->with($data);
                }
                

            }else//enter edit user page
            {
                $id=$request->user_id;
                $title_collection=Title::all();
                $roles_collection = Role::where('id','!=','1')->get();
                

                $designation_collection=Designation::all();
                $profile_collection=DB::table('users as u')
                    ->leftjoin('titles','titles.title_id','u.title_id')
                    ->leftjoin('users_roles','users_roles.user_id','u.id')
                    ->leftjoin('roles','roles.id','users_roles.role_id')
                    ->leftjoin('tbl_designation','tbl_designation.designation_id','u.designation_id')
                    ->where('u.id',$id)
                    ->select('u.user_type','title_name','u.branch_id','u.title_id as title_id','u.designation_id as designation_id','role_id','firstname','middlename','lastname','gender','pics','email','phone','dob','designation','status','u.created_at')
                    ->get();
                    
                $data=[
                        'title_collection'=>$title_collection,
                        'profile_collection'=>$profile_collection,
                        'roles_collection'=>$roles_collection,
                        'designation_collection'=>$designation_collection,
                        'user_id'=>$id
                ];
            
                return view("user.individual_edit")->with($data);
            }


        }else{ //profile button clicked


           
            $branch = DB::table('tbl_branch')->get();
        
            $id=Auth::user()->id;
            $title_collection=Title::all();
            $roles_collection = Role::all();
            $designation_collection=Designation::all();
            $profile_collection=DB::table('users as u')
                ->leftjoin('titles','titles.title_id','u.title_id')
                ->leftjoin('users_roles','users_roles.user_id','u.id')
                ->leftjoin('roles','roles.id','users_roles.role_id')
                ->leftjoin('tbl_designation','tbl_designation.designation_id','u.designation_id')
                ->where('u.id',$id)
                ->select('u.user_type','u.branch_id','title_name','u.title_id as title_id','u.designation_id as designation_id','role_id','firstname','middlename','lastname','gender','pics','email','phone','dob','designation','status','u.created_at')
                ->get();

            $data=[
                    'title_collection'=>$title_collection,
                    'profile_collection'=>$profile_collection,
                    'roles_collection'=>$roles_collection,
                    'designation_collection'=>$designation_collection,
                    'user_id'=>$id,
                    'branch' => $branch
                    
            ];
           
            return view("user.profile_edit")->with($data);
            
        }




    }

    public function view_settings()
    {
        $query= Settings::all();
        $data=['setting_collection'=>$query];
        return view('settings.vista')->with($data);
    }
    public function save_edit_setting(Request $request)
    {
        $setting= Settings::find($request->settings_id);
        $setting->value=$request->value;
        $setting->save();
    }
    public function attempt_login(Request $request){

       // dd($request);
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('dashboard')/*->with($data)*/;

            }else{
                $data=[
                    'login_error'=>$request->email
                ];
                return redirect()->route('home')->with($data);
            }


    }
    public function attempt_register(Request $request){
        Session::put('register_error_apply','ok');
        $rules =
            [
                'title_id'=>'required|numeric',
                'gender'=>'required|numeric',
                'firstname'=>'required',
                'middlename'=>'nullable',
                'lastname'=>'required',
                'email'=>'required|email|unique:users',
                'confirm_email'=>'required|same:email',
                'phone'=>'required|regex:/^(0)[0-9]{10}$/',
                'dob'=>'required|date_format:Y-m-d',
                'password'=>'required',
                'confirm_password'=>'required|same:password',
            ];
        //check validation options
        $this->validate($request,$rules);
        Session::forget('register_error_apply');
        Session::save();
        $user = new User;
        $user->user_type = 1;//student
        $user->designation_id = 6;//student
        $user->rights_id = 3;//student
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->gender = $request->gender;
        $user->title_id = $request->title_id;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $unique_code=Str::random(45);
        $user->remember_token = $unique_code;
        $user->password = Hash::make($request->password);
        $user->save();

        $link = route("activate_account",$unique_code);//verify email link
        $data = array('full_name'=>request()->firstname." ".request()->lastname,'link'=> $link);
        Mail::send('emails.registration', $data, function($message) use ($data){
            $message->from("info.iaue.portals@gmail.com", 'IAUE Distance Learning Portal');
            $message->to(request()->email);
            $message->subject('Welcome to IAUE Distance Learning Portal!');
        });

        $data=[
            'registration_success'=>$request->email
        ];
        return redirect()->route('apply')->with($data);

    }
    public function forgot_password(Request $request){
        Session::put('reset_password_error','ok');
        $rules =
            ['reset_email'=>'required|email'];
        //check validation options
        $this->validate($request,$rules);
        Session::forget('reset_password_error');
        Session::save();

        $user_collection= User::select('firstname','lastname','email')->where('email',$request->reset_email)->get();

        if($user_collection->isEmpty()){
            $data=[
                'reset_email_not_found'=>'yes'
            ];
            return redirect()->route('home')->with($data);

        }else{
            $unique_code=Str::random(55);
            User::where('email',$request->reset_email)->update(['email_reset_token'=>$unique_code]);
            $link = route("reset_account",$unique_code);//verify email link
            $data = array('full_name'=>$user_collection[0]->firstname." ".$user_collection[0]->lastname,'link'=> $link);
            Mail::send('emails.account_reset', $data, function($message) use ($data){
                $message->from("info.iaue.portals@gmail.com", 'IAUE Distance Learning Portal');
                $message->to(request()->reset_email);
                $message->subject('Password reset request');
            });

            $data=[
                'reset_sent'=>'yes'
            ];
            return redirect()->route('home')->with($data);

        }

    }

}
