<?php

namespace App\Http\Controllers\user;



use App\Models\title;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Models\Settings;
use App\Models\Rights;
use App\Models\User;
use App\Models\Designation;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
	{
        $this->middleware('auth',['except'=> ['flex_reg_path_process_registration']]);
    }

    ###########################
    #CREATE, VIEW & EDIT USERS##
    ###########################
    public function make()
    {
	$id=Auth::user()->id;
	$god_eye=Auth::user()->god_eye;
	## User Roles
	$roles_collection = DB::table('roles as r')
        ->where('r.id','<>',1)
        ->get();
	$designation_collection = Designation::all();
    $title_collection = title::all();
    
    $branch_collections = DB::table('tbl_branch')->get();
    $department_collection = DB::table('tbl_department')->get();

	$data=
	[
        'god_eye' => $god_eye,
        'branch_collections' => $branch_collections,
		'roles_collection' =>$roles_collection,
		'department_collection' =>$department_collection,
		'title_collection' =>$title_collection
	];
        
     return view('user.create')->with($data);
    }

    public function username_check(Request $request)
	{
		
		if(User::where('email',$request->email)->exists())
			echo "exists";
		 else
			 echo "available";
		     
    }
   

    public function process_wallet_status($owner_wallet_id)
    {
        $owner_wallet_id = base64_decode($owner_wallet_id);


        $wallet_status = DB::table('tbl_wallet')->where('owner_wall_id',$owner_wallet_id)->get();

        
        if (count($wallet_status) > 0)
        {
            
            if($wallet_status[0]->status == 2)
            {
                $status = 1;

            }else if($wallet_status[0]->status == 1)
            {
                $status = 2;
            }

            
            $update = DB::table('tbl_wallet')->where('owner_wall_id',$owner_wallet_id)->update(["status" => $status]);

            //dd($status);
            if($update)
            {
               // echo $status."-".$wallet_status[0]->status;
            }
            return redirect('/users_wallet_balance');
            
        }

       
    }

    

    public function get_designation(Request $request)
    {
        $designation_collection = DB::table('tbl_designation')->where('department_id',$request->id)->get();
        $option = '<option value="">Select Designation</option>';
        foreach($designation_collection as $val)
        {
            $option = $option.'<option value="'.$val->designation_id.'">'.$val->designation.'</option>';
        }
        
        return $option;
    }
    

    public function save(Request $request)
    {	
       
	   $rules =
	   [
       'staff_pic'=>'sometimes|mimes:png,gif,jpg,JPG,jpeg|max:300',//size:300 will enforce that the size MUST be exactly 300
	   'firstname'=>'required',
       'lastname'=>'required',
       'middlename'=>'sometimes',
       'phone'=>'required',
       'branch'=>'required',
	   'email'=>'required|email|unique:users',
	   'designation'=>'required|numeric',
	   'title'=>'required|numeric',
	   'gender'=>'required|numeric',
	   'role'=>'required|numeric'
      ];

  
	   //check validation options
       $this->validate($request,$rules/*, $customs_messages*/);
      

	   //handle User Image
	   if($request->hasFile('staff_pic'))
	   {  
		 $fileNameWithExt=$request->file('staff_pic')->getClientOriginalName();
		 //Get Extension
		 $fileExt=$request->file('staff_pic')->getClientOriginalExtension();
		 //new dynamic name
		 $fileNameToStore=strtolower($request->firstname."".$request->lastname."_".rand(1,9999999).".".$fileExt);
         $file_path = 'img/users/';
         //upload image
         $request->file('staff_pic')->move($file_path, $fileNameToStore);
		   
	   }
	   else
	    $fileNameToStore='no_pic.jpg';//or whatever


        DB::beginTransaction();

        $company_details = DB::table('tbl_settings')->get();
        $company_name = $company_details[0]->value;
       // $company_email = $company_details[4]->value;
       // $plain_password = $company_details[5]->value;
	   //Saving to tbl_staff in order of arrangement in form
	   $user = new User;
	   $user->user_type = 2;// 2- Staff, 1 - General User
	   $user->pics = $fileNameToStore;
	   $user->firstname = $request->firstname;
       $user->lastname = $request->lastname;
       $user->middlename = $request->middlename == NULL?"":$request->middlename;
	   //$user->role_id = $request->role_id;
       $user->title_id = $request->title;
       $user->branch_id = $request->branch;
       $user->phone = $request->phone;
	   $user->gender = $request->gender;
	   $user->designation_id = $request->designation;
	   $user->created_by = Auth::user()->id;
	   $user->created_at = date('Y-m-d');
	   $user->updated_at = NOW();
      
	   if($request->god_eye)
	   		$user->god_eye = 1;

        if(trim($request->email)!="")
            $email = $request->email;
      
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            // Output: 54esmdr0qf
       
        $plain_password = substr(str_shuffle($permitted_chars), 0, 6);
        $password = Hash::make($plain_password); //All new users have a default password
        $unique_code=Str::random(45);
        $user->status   = 1;
        $user->email = $email;
       
        $user->password = $password;
        $user->remember_token = $unique_code;
        $user->save();

        $role = DB::table('users_roles')->insert(['user_id'=> $user->id, "role_id"=> $request->role]);
        

	    #Send welcome email to new user
        //$link = url("/login",$unique_code);//verify email link
        $link = url("/dashboard");
        $data = array('full_name'=>request()->firstname." ".request()->lastname,'link'=> $link, 'email' => $email, 'password' => $plain_password, 'company_name' => $company_name);
      
        if ($user && $role)
        {
            DB::commit(); 
            
            Mail::send('emails.account_creation', $data, function($message) use ($data,$email){
                $message->from("dangote.gts@gmail.com", 'ATTC Nigeria Portal');
                $message->to($email);
            // $message->bcc("isokenodigie@gmail.com");
            // $message->bcc("mailaustin37@gmail.com");
                $message->subject('ATTC User Account Creation');
            });


        }else{
            return json_encode(["error" => "An unknown error occured"]);
            DB::rollback();
        }
   }
   public function reset_password(Request $request)
   {
       $id = decrypt($request->id);
       $status = 0;
       $user = User::where('id',$id)->get();
       if(count($user)> 0)
       {
          $company_details = DB::table('tbl_settings')->get();
          $company_name = $company_details[0]->value;
          $company_email = $company_details[4]->value;
          $plain_password = $company_details[5]->value;
          
          $reset = User::where('id',$id)->update(["password" => Hash::make($plain_password), "chng_password_logon" => 1]);
          
          if($reset)
          {
            $status = 1;
          }
          
          
        }

       return $status;
   }

   public function save_password_change(Request $request)
   {
       $rules = [
        'old_password' => 'required',
        'password' => 'required|same:password|min:6',
        'password_confirmation' => 'required|same:password|min:6',  
        
       ];
        $this->validate($request,$rules);

        
        $current_password = Auth::User()->password; 

        if(Hash::check($request->old_password, $current_password))
        {  
            $user_id = Auth::User()->id;  
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request->password);
            $obj_user->save();
            return redirect('/change_my_password')->with('password_success','Your password has been changed successfully ');
  
        }

        return redirect('/change_my_password')->with('password_error','Your old password is not correct');
  
        
    }

   public function change_my_password()
   {
       return view('user.change_my_password');
   }

	public function save_edits(Request $request)
    {	
		   $rules = 
		   [
               'pic'=>'sometimes|mimes:png,gif,jpg,JPG,jpeg|max:1500',//size:300 will enforce that the size MUST be exactly 300
               'firstname'=>'required',
               'lastname'=>'required',
               'gender'=>'required|numeric',
               'designation_id'=>'required|numeric',
               
	       ];
   
	   //check validation options
	   $this->validate($request,$rules);
	   $update_id=$request->user_id;
        $user = User::find($update_id);

        //handle Staff Image
        if($request->hasFile('pic'))
        {
            //get and delete old image
            $old_pic=$user->pics;
            $file_path = 'img/users/';
            File::delete(asset("$file_path$old_pic"));


            $fileNameWithExt=$request->file('pic')->getClientOriginalName();
            //Get Extension
            $fileExt=$request->file('pic')->getClientOriginalExtension();
            //new dynamic name
            $fileNameToStore=strtolower($request->firstname."".$request->lastname."_".rand(1,9999999).".".$fileExt);

            //upload image
            $request->file('pic')->move($file_path, $fileNameToStore);

        }

        if(isset($fileNameToStore))
        $user->pics = $fileNameToStore;

        $user->firstname = $request->firstname;
        $user->title_id = $request->title_id;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->status = $request->status;
        $user->designation_id = $request->designation_id;
        $user->updated_at = now();
	    $user->save();
        $data=[
            'success'=>'Profile edits successfully saved! '
        ];
        return redirect()->route('manage_user')->with($data);

   }

   public function save_edits_profile(Request $request)
   {
                $rules = 
                [
                    'pic'=>'sometimes|mimes:png,gif,jpg,JPG,jpeg|max:1500',//size:300 will enforce that the size MUST be exactly 300
                    'firstname'=>'required',
                    'lastname'=>'required',
                    'gender'=>'required|numeric',
                  
                   
                    'branch_id'=>'sometimes',
                ];

            //check validation options
            $this->validate($request,$rules);
            $update_id=$request->user_id;
            $user = User::find($update_id);

            //handle Staff Image
            if($request->hasFile('pic'))
            {
               
                //get and delete old image
                $old_pic=$user->pics;
                $file_path = 'img/users/';
                File::delete(asset("$file_path$old_pic"));


                $fileNameWithExt=$request->file('pic')->getClientOriginalName();
                //Get Extension
                $fileExt=$request->file('pic')->getClientOriginalExtension();
                //new dynamic name
                $fileNameToStore=strtolower($request->firstname."".$request->lastname."_".rand(1,9999999).".".$fileExt);

                //upload image
                $request->file('pic')->move($file_path, $fileNameToStore);

            }


           

            if(isset($fileNameToStore))
            $user->pics = $fileNameToStore;

            $user->firstname = $request->firstname;
            $user->title_id = $request->title_id;
            $user->middlename = $request->middlename;
            $user->lastname = $request->lastname;
     
            $user->phone = $request->phone;
            $user->gender = $request->gender;
        
            $user->branch_id = $request->branch;
            
            $user->updated_at = now();
            $user->save();
            $data=[
                'success'=>'Profile edits successfully saved! '
            ];
            return redirect()->route('dashboard')->with($data);
   }

      


	public function manage_user()
	{
        $user_collection = DB::table('users as u')
         ->leftjoin('users_roles as z','z.user_id','u.id')
         ->leftjoin('roles as r','r.id','z.role_id')
         ->leftjoin('titles as t','t.title_id','u.title_id')
         ->leftjoin('tbl_designation as d','d.designation_id','u.designation_id')
         ->select('u.id','u.email','firstname','lastname','name','designation','pics','god_eye','title_name')
         ->where('r.id','<>',1)
         ->orderBy('u.created_at','desc')
         ->get();

		$data = ['staff_collection'	=> $user_collection];
			
		return view('user.manage_user')->with($data);
	}
	public function reset_user_password_by_godeye(Request $request)
	{
		$id=base64_decode($request->id);
		$user= User::find($id);
		$user->password=Hash::make("password");
		$user->save();
	}

}
