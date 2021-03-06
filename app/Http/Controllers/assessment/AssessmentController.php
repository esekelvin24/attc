<?php

namespace App\Http\Controllers\assessment;

use App\Models\Questions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Models\Course;
use App\Models\Assessment_Weight;
use App\Models\Map_Lecturer_To_Course;
use App\Session;
use App\Models\Assessment;
use App\Program_Type;
use App\Applications;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;

class AssessmentController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function assessment_weight()
    {
        $user_id = Auth::user()->id;

        $queryBuilder = Assessment_Weight::query();
        $queryBuilder->join('tbl_batch','tbl_batch.batch_no','tbl_assessment_weights.batch_id');
       // ->where('tbl_assessment_weights.created_by',$user_id);
        $assessment_weight_collection = $queryBuilder->get();


        return view('assessment.assessment_weight', compact('assessment_weight_collection'));
    }
    

    public function manage_assessment()
    {
        $user_id = Auth::user()->id;
        
        $queryBuilder = Assessment::query();
        
        $queryBuilder->join('tbl_courses','tbl_courses.course_id','tbl_assessment_creation.course_id')
        ->leftjoin('tbl_batch','tbl_batch.batch_no','tbl_assessment_creation.batch_id')
        ->where('tbl_assessment_creation.created_by',$user_id);
        $assessment_collection = $queryBuilder->get();


        return view('assessment.assessment', compact('assessment_collection'));
    }

    
    public function  edit_assessment(Request $request)
     {
       
        $assessment_id = decrypt($request->id);


        $assessment_collection =  DB::table('tbl_assessment_creation')->where('assessment_id',$assessment_id)->get();
        
        
        if (isset($session_assessment_id->session_id))
        {
            $assessment_session_type = $session_assessment_id->type;
        }

        $assessment_id = $request->id;

        return view("assessment.edit_assessment", compact('assessment_id','assessment_collection'));
     }

    public function take_ca()
    {
        $user_id = Auth::user()->id;
        $current_batch = DB::table('tbl_batch')->where('status',1)->orderBy('created_at','desc')->first();
        $current_batch_no = $current_batch->batch_no;

      
        $passed_assessment_collection = DB::table('tbl_assessment_session')
        ->leftjoin('tbl_courses','tbl_courses.course_id','tbl_assessment_session.course_id')
        ->leftjoin('tbl_batch','tbl_batch.batch_no','tbl_assessment_session.batch_id')
        ->where('tbl_assessment_session.batch_id',$current_batch_no)
        ->where('finished_ca',1)//CA is completed
        ->where('tbl_assessment_session.status',1) //student passed
        ->where('tbl_assessment_session.user_id', $user_id)->pluck("score","assessment_id");
        
        

        $pending_assessment_collection = DB::table('tbl_assessment_session')
        ->leftjoin('tbl_courses','tbl_courses.course_id','tbl_assessment_session.course_id')
        ->leftjoin('tbl_batch','tbl_batch.batch_no','tbl_assessment_session.batch_id')
        ->where('tbl_assessment_session.batch_id',$current_batch_no)
        ->where('finished_ca',0)
        ->where('tbl_assessment_session.user_id', $user_id)->get();

        $completed_assessment_collection = DB::table('tbl_assessment_session')
        ->leftjoin('tbl_courses','tbl_courses.course_id','tbl_assessment_session.course_id')
        ->leftjoin('tbl_batch','tbl_batch.batch_no','tbl_assessment_session.batch_id')
        ->where('tbl_assessment_session.batch_id',$current_batch_no)
        ->where('finished_ca',1)
        ->where('tbl_assessment_session.user_id', $user_id)->pluck("tbl_assessment_session.batch_id","assessment_id")->toArray();
        
        $current_time = date('H:i:s');
        $current_date = date('Y-m-d');

        

        $registered_courses = DB::table('tbl_applications as a')
        ->join('tbl_application_courses as ac','ac.application_id', 'a.application_id')
        ->where('user_id',$user_id)
        ->where('batch_id', $current_batch_no)
        ->pluck('ac.course_id');


        
        $queryBuilder = Assessment::query(); 

        $queryBuilder->join('tbl_courses','tbl_courses.course_id','tbl_assessment_creation.course_id')
        ->leftjoin('tbl_batch','tbl_batch.batch_no','tbl_assessment_creation.batch_id')
        ->join('tbl_assessments_students as sa','sa.assessment_id','tbl_assessment_creation.assessment_id')
        ->where('sa.user_id',Auth::user()->id)
        ->where('tbl_assessment_creation.batch_id',$current_batch_no)
        ->whereIn('tbl_assessment_creation.course_id',$registered_courses);
       
        $assessment_collection = $queryBuilder->get();

       
        
       
        $queryBuilder = Assessment::query();
        $queryBuilder->join('tbl_courses','tbl_courses.course_id','tbl_assessment_creation.course_id')
        ->leftjoin('tbl_batch','tbl_batch.batch_no','tbl_assessment_creation.batch_id');
        $assessment_exp_time = $queryBuilder->pluck('expiration_time','tbl_assessment_creation.course_id');
        $assessment_exp_date = $queryBuilder->pluck('expiration_date','tbl_assessment_creation.course_id');


        $eligible_for_ca = DB::table('tbl_applications as a')->join('tbl_application_courses as ac', 'ac.application_id','a.application_id')->where('a.user_id',$user_id)->get()->count();

       
       

        return view('assessment.take_ca', compact('passed_assessment_collection','completed_assessment_collection','eligible_for_ca','assessment_collection','pending_assessment_collection','assessment_exp_time','assessment_exp_date'));
    }

    public function take_ca_questions(Request $request)
    {

        $assessment_id =  decrypt($request->id);
        $authorise_to_take_assessment = false;

        $assessment_details =   DB::table('tbl_assessment_creation')->where('assessment_id',$assessment_id)->first();
        $course_id = $assessment_details->course_id;
        $course_details = DB::table('tbl_courses')->where('course_id',$course_id)->first();

        $current_batch = DB::table('tbl_batch')->where('status',1)->orderBy('created_at','desc')->first();
        $current_batch_no = $current_batch->batch_no;
        
        $global_assessment_weight = DB::table('tbl_assessment_weights')
        ->where('status',1)
        ->where('batch_id',$current_batch_no)->first();
        
        $check =  DB::table('tbl_applications as a')
        ->join('tbl_application_courses as ac','ac.application_id','a.application_id')
        ->where('user_id',Auth::user()->id)
        ->where('batch_id', $current_batch_no)
        ->where('ac.course_id',$course_id)->count();

        $passed_assessment_collection = DB::table('tbl_assessment_session')
        ->leftjoin('tbl_courses','tbl_courses.course_id','tbl_assessment_session.course_id')
        ->leftjoin('tbl_batch','tbl_batch.batch_no','tbl_assessment_session.batch_id')
        ->where('tbl_assessment_session.batch_id',$current_batch_no)
        ->where('finished_ca',1)//CA is completed
        ->where('tbl_assessment_session.status',1) //student passed
        ->where('tbl_assessment_session.user_id', Auth::user()->id)->pluck("score","assessment_id");
        
        

        $completed_assessment_collection = DB::table('tbl_assessment_session')
        ->leftjoin('tbl_courses','tbl_courses.course_id','tbl_assessment_session.course_id')
        ->leftjoin('tbl_batch','tbl_batch.batch_no','tbl_assessment_session.batch_id')
        ->where('tbl_assessment_session.batch_id',$current_batch_no)
        ->where('finished_ca',1)
        ->where('tbl_assessment_session.user_id', Auth::user()->id)->pluck("tbl_assessment_session.batch_id","assessment_id")->toArray();
        
        
       
        if($check == 1)
        {
            $authorise_to_take_assessment = true; 
        }

      

       return view('assessment.take_ca_question',compact('passed_assessment_collection','completed_assessment_collection','assessment_id','authorise_to_take_assessment','course_details','global_assessment_weight','assessment_details'));
    }

    public function prev_question(Request $request)
    {
       // $request->session()->forget('user_response_arr');
        //print_r($request->session()->get('user_response_arr'));
       
        $assessment_id = base64_decode($request->id);
        $assessment_id = $assessment_id == null?$request->session()->get('assessment_id'):$assessment_id;
        $assessment_details =   DB::table('tbl_assessment_creation')->where('assessment_id',$assessment_id)->first();
        $course_id = $assessment_details->course_id;
        $course_details = DB::table('tbl_courses')->where('course_id',$course_id)->first();

        $user_id = Auth::user()->id;
        $questions = $request->session()->get('question_id_array');
        $navigating_from = base64_decode($request->from);
        $question_count = 0;

        if($request->prev > 1)
        {
            $question_count = $request->prev - 1;
            $current = $request->prev - 1;
        }else
        {
            $current =  0;
        }
             

        $request->session()->put('current_session_count',$current);
        $request->session()->save();
        
       
        

        return view('assessment.next_question', compact('questions','assessment_id','user_id','course_details'));


    } 

    public function my_ca_result()
    {
        $ca_collection = DB::table('tbl_assessment_session as as')
        ->select('*','as.status as assessment_status','as.created_at as assessment_created_at')
        ->join('tbl_courses as c','c.course_id', 'as.course_id')
        ->join('tbl_batch as b','b.batch_no','as.batch_id')
        ->where('user_id',Auth::user()->id)
        ->where('finished_ca',1)//student must have finished the CA
        ->orderBy('as.created_at','desc')
        ->get();

        $eligible_for_ca = DB::table('tbl_applications as a')->join('tbl_application_courses as ac', 'ac.application_id','a.application_id')->where('a.user_id',Auth::user()->id)->get()->count();
        return view('assessment.my_ca_result', compact('ca_collection','eligible_for_ca'));
    }

    public function student_ca_result($assessment_id,$course_id)
    {
        $course_id = decrypt($course_id);
        $assessment_id = decrypt($assessment_id);
        
        $ca_collection = DB::table('tbl_assessment_session as as')
        ->select('*','as.status as assessment_status','as.created_at as assessment_created_at')
        ->join('tbl_courses as c','c.course_id', 'as.course_id')
        ->join('tbl_batch as b','b.batch_no','as.batch_id')
        ->where('as.assessment_id',$assessment_id)
        ->orderBy('as.created_at','desc')
        ->get();

        //get the list of courses map to lecturer
        $get_my_courses = DB::table('tbl_map_lecturer_to_courses as ml')
        ->join('tbl_courses as c','c.course_id','ml.course_id')
        ->where("lecturer_user_id",Auth::user()->id)
        ->get();

         $lect_map_history = array();
         foreach ($get_my_courses as $val)
         {
            $lect_map_history[$val->course_id] = "";
         }
         
         if(isset($lect_map_history[$course_id]))
         {
            $eligible_to_view_ca = true;
         }else
         {
            $eligible_to_view_ca = false; 
         }
        
        
        return view('assessment.student_ca_result', compact('ca_collection','eligible_to_view_ca'));
    }

    public function next_question(Request $request)
    {
       // print_r($request->session()->get('user_response_arr'));
        $assessment_id = base64_decode($request->id);
        $assessment_id = $assessment_id == null?$request->session()->get('assessment_id'):$assessment_id;
        $user_id = Auth::user()->id;
        //$question_limit_ca = 20;

        


        
        $current_batch = DB::table('tbl_batch')->where('status',1)->first();
        $current_batch_no = $current_batch->batch_no;

        $assessment_details =   DB::table('tbl_assessment_creation')->where('assessment_id',$assessment_id)->first();
        $course_id = $assessment_details->course_id;
        $course_details = DB::table('tbl_courses')->where('course_id',$course_id)->first();
        
        $question_limit_ca_arr = DB::table('tbl_assessment_weights')->where('batch_id',$current_batch_no)->pluck("ca_".$assessment_details->assessment_type,"batch_id");
        $question_limit_ca = $question_limit_ca_arr[$current_batch_no];

        $question_count = DB::table('tbl_assessment_student_answers')->where('assessment_id',$assessment_id)->where('user_id',$user_id)->count();

        

        
        if ($request->session()->has('assessment_id'))
            {
               
                if ($request->session()->has('current_session_count'))
                {
                    $question_count = $request->session()->get('current_session_count');
                }
                $assessment_id = $request->session()->get('assessment_id');
                $questions = $request->session()->get('question_id_array');
                $navigating_from = base64_decode($request->from);
              
               
                $content = Cache::get($request->session()->get('assessment_id').'_'.Auth::user()->id);

               if($content == "0:0:0") 
               {
                 $navigating_from = "end_ca";
               }

                if ($navigating_from == "next_page")//if the call trigger by clicking next button
                {
                      
                    $current_count = $request->session()->get('current_session_count');
                    $current_count = $current_count == ""?0:$current_count;

                   
                    $this->save_user_response($current_count, $request->answer, $request);
                    //retriving the question answer
                    if ($question_count ==count($questions))
                    {
                        $question_answer = $questions[$question_count - 1]->answer;
                    }else
                    {
                        $question_answer = $questions[$question_count]->answer;
                    }


                   

                    $current_count = $current_count + 1;
                    $request->session()->put('current_session_count',$current_count);
                    $request->session()->save();
                    $question_count = $current_count;
                    
                    //list of question ID that has been attempted
                    $id_list = "";

                    for ($i=0; $i < count($questions ); $i++)
                    {
                        $id_list = $id_list. '"'.$questions[$i]->question_id.'",'; 
                    }
                    
                    $id_list = rtrim($id_list,",");
                     
                    
                    

                    $status = 2; //failed
                    if ($question_answer == $request->answer)
                    {
                        $status = 1;
                    }
                    
                    
                    $check_if_answered = DB::table('tbl_assessment_student_answers')
                    ->where('assessment_id',$request->session()->get('assessment_id'))
                    ->where('question_arr_index',($request->session()->get('current_session_count') - 1))
                    ->where('user_id',Auth::user()->id)
                    ->count();

                    

                    $insert = [
                        "assessment_id" => $request->session()->get('assessment_id'),
                        "created_at" => NOW(),
                        "user_id" => $user_id,
                        "total_questions" => count($questions),
                        "question_json" => json_encode($questions),
                        "question_id_list" => $id_list,
                        "question_answer" => $question_answer,
                        "question_user_response" => $request->answer,
                        "status" => $status,
                        "question_arr_index" =>  $request->session()->get('current_session_count') - 1,
                    ];


                    if ($check_if_answered > 0)
                    {
                        unset($insert["assessment_id"]);
                        unset($insert["question_arr_index"]);

                        DB::table('tbl_assessment_student_answers')
                        ->where('assessment_id',$request->session()->get('assessment_id'))
                        ->where('question_arr_index',($request->session()->get('current_session_count') - 1))
                        ->where('user_id',Auth::user()->id)
                        ->update($insert);
                    }
                    else
                    {
                        DB::table('tbl_assessment_student_answers')->insert($insert);
                    }

                   
                   

                }else if ($navigating_from == "end_ca")
                {
                    $question_count = $question_limit_ca;
                }

               /////////////////////////////////BEGINING OF IF NUMBER OF QUESTION EQUAL TO ANSWERED QUESTION //////////////////////////

                if ($question_count >= $question_limit_ca)//if all question has been answered by the student
                {
                    
                    $check_completed = DB::table('tbl_assessment_session')->where('user_id',$user_id)->where('assessment_id',$assessment_id)->where('finished_ca',1)->count();
                   
                    if ($check_completed < 1) 
                    {
                            
                         //update course registration with score
                         $score = DB::table('tbl_assessment_student_answers')->where('assessment_id',$assessment_id)->where('user_id',$user_id)->where('status',1)->count();
                        
                            if ($score >= ($question_limit_ca/2))
                            {
                                $status = 1; //student passed
                            }else
                            {
                                $status = 2; //student failed
                            }

                            $update = [
                                "completed_at" => NOW(),
                                "finished_ca" => 1,
                                "score" => $score,
                                "total_questions" => $question_limit_ca,
                                "status" => $status,
                            ];

                            DB::table('tbl_assessment_session')->where('user_id',$user_id)->where('assessment_id',$assessment_id)->update($update);
                            $request->session()->forget(['assessment_id', 'question_id_array']);


                           
                            //$score = ($score * 100)/$question_limit_ca;
                            $update_course_reg = [
                                "ca".$request->session()->get('assessment_type') => $score, 
                            ];

                            $application_details = DB::table('tbl_applications as a')
                            ->selectRaw('ac.application_id')
                            ->join('tbl_application_courses as ac', 'ac.application_id','a.application_id')
                            ->where('a.user_id', Auth::user()->id)
                            ->where('ac.course_id', $course_id)->get();

                            DB::table('tbl_application_courses')->where('application_id', $application_details[0]->application_id)->where('course_id',$course_id)->update($update_course_reg);

                    }
                    $request->session()->forget('user_response_arr');
                    $request->session()->forget('current_session_count');
                    $request->session()->forget('assessment_id');
                    
                    return '<div align="center">
                                <img width="100" height="100" src="'.asset('img/success.png').'" ><br/><br/><br/>
                                <p> Your C.A Test has been completed successfully, Click <a href="'.url('/my_ca_result').'">here</a> to view result</p>
                            </div>';
                }

                /////////////////////////////////END OF IF NUMBER OF QUESTION EQUAL TO ANSWERED QUESTION //////////////////////////


                return view('assessment.next_question', compact('questions','assessment_id','user_id','course_details'));

            }else
            {
                    
               

                    $exam_found = DB::table('tbl_assessment_session')->where('user_id',$user_id)->where('assessment_id',$assessment_id)->first();

                    if(!isset($exam_found->status) || $exam_found->status ==  2)//the student failed so delete all student answer
                    {
                        DB::table('tbl_assessment_student_answers')->where('user_id',$user_id)->where('assessment_id',$assessment_id)->delete();
                        DB::table('tbl_assessment_session')->where('user_id',$user_id)->where('assessment_id',$assessment_id)->update(["finished_ca" => 0]);
                    }
                    
                    if(!isset($exam_found->question_json))
                    {
                            
                        
                            
                            $id_list = "";
                            $question_limit_ca_arr = DB::table('tbl_assessment_weights')->where('batch_id',$current_batch_no)->pluck("ca_".$assessment_details->assessment_type,"batch_id");
                            $question_limit_ca = $question_limit_ca_arr[$current_batch_no];


                            $questions = DB::table('tbl_questions')->where('course_id',$course_id)
                            ->where('assessment_type', $assessment_details->assessment_type)->take($question_limit_ca)->inRandomOrder()->get()->toArray();


                            if (count($questions) < $question_limit_ca)
                            {
                                return '<div align="center">
                                            <img width="150" height="150" src="'.asset('img/barred.png').'" >
                                            <p> No questions is available for this C.A test, please try again later<p>
                                        </div>';
                            }

                            

                            $request->session()->put('question_id_array', $questions);
                            $request->session()->put('assessment_id', $assessment_id);
                            $request->session()->put('assessment_type', $assessment_details->assessment_type);
                            $request->session()->put('course_id', $course_id);
                            $request->session()->save();

                            $session_arr = $request->session()->get('question_id_array');

                            $sql_json = json_encode($session_arr );
                            

                            for ($i=0; $i< count($session_arr ); $i++)
                            {
                                $id_list = $id_list. '"'.$session_arr[$i]->question_id.'",'; 
                            }
                            
                            $id_list = rtrim($id_list,",");


                            $new_ca_session_insert = [
                                "assessment_id" =>  $assessment_id,
                                "user_id" => $user_id,
                                "created_at" => now(),
                                "created_by" => $user_id,
                                "course_id" => $course_id,
                                "batch_id" => $current_batch_no,
                                "question_json" => $sql_json,
                                "question_id_list" => $id_list
                            ];
                            
                            $time = DB::table('tbl_assessment_weights')->where('batch_id',$current_batch_no)->first()->ca_duration;

                            $time =  date('H:i', mktime(0, $time)).":00"; // 01:37:00
                            
                            
                            Cache::forever( $request->session()->get('assessment_id').'_'.Auth::user()->id, $time ); //Key and Value, Expiry Minute
                            
                           
                           DB::table('tbl_assessment_session')->insert($new_ca_session_insert);

                    }else //if Exam is found
                    {

                           




                            $questions = json_decode($exam_found->question_json);
                            $assessment_id = $exam_found->assessment_id;

                            $assessment_details =   DB::table('tbl_assessment_creation')->where('assessment_id',$assessment_id)->first();
                            $course_id = $assessment_details->course_id;


                            //getting already answered question responses
                            $user_responses = DB::table('tbl_assessment_student_answers')
                            ->where('assessment_id', $assessment_id)
                            ->where('user_id',Auth::user()->id)->get();

                            foreach($user_responses as $resp_val)
                            {
                                $this->save_user_response($resp_val->question_arr_index, $resp_val->question_user_response, $request);
                            }

                            
                            $request->session()->put('current_session_count',count($user_responses) );
                            $request->session()->put('question_id_array', $questions);
                            $request->session()->put('assessment_id', $assessment_id);
                            $request->session()->put('course_id', $course_id);
                            $request->session()->save();
                        }
                          
                        
                     return view('assessment.next_question',compact('question_count','questions','assessment_id','user_id','course_details'));

            }
    }

    function get_assessment_student_list(Request $request)
    {
       $assessment_id = decrypt($request->id);
       $selected_student = array();
       //get assessment info
       $assessment_collection =  DB::table('tbl_assessment_creation as a')
       ->join('tbl_courses as c','c.course_id','a.course_id')
       ->where('assessment_id',$assessment_id)
       ->get();

       if(count($assessment_collection) > 0) //if the assessment is found
       {
                      
           //get all the student application ID that registered for a course and yet to take Continous Assessment Test
           $application_id =  DB::table('tbl_application_courses')
           ->where('course_id',$assessment_collection[0]->course_id)
           ->where('ca1',NULL)//where student have not taken the ca test for the course
           ->pluck('application_id');

           //get list of student that has an active application
           $student_collection = DB::table('tbl_applications as a')
           ->join('users as u', 'a.user_id', 'u.id')
           ->whereIn('application_id',  $application_id)
           ->where('a.status',1)//application status is still active
           ->where('a.action_1_status',1)//admin has approved the application
           ->where('a.payment_status',1)//and the student has paid for the application
           ->get();

           $selected_student = DB::table("tbl_assessments_students")->where('assessment_id', $assessment_id)->pluck("assessment_id","user_id");


           return view('assessment.assessment_student_list', compact('student_collection','selected_student','assessment_id'));

       }
               
    }

    public function add_student_to_assessment(Request $request)
    {
       
       $rules = [
           "assessment_id" => "required"
       ];

       $this->validate($request, $rules);

       if(Auth::user()->can('edit_assessement'))
       {
           $assessment_id = decrypt($request->assessment_id);

           $check = DB::table('tbl_assessment_creation')
           ->where('assessment_id', $assessment_id)->get();


           if(count($check) > 0)
           {
              $delete_existing_record = DB::table('tbl_assessments_students')->where('assessment_id',$assessment_id)->delete();

              if(isset($request->students))
              {
                  $students = $request->students;
                  foreach($students as $val)
                  {
                    $insert[] = [
                        "assessment_id" => $assessment_id,
                        "user_id" => $val,
                        "created_by" => Auth::user()->id,
                        "created_at" => NOW()
                    ];
                  }
                  $record = DB::table('tbl_assessments_students')->insert($insert);
                  if($record)
                  {
                      return redirect('/manage_assessment')->with('success','The selected student has been added successfully');
                  }
              }else
              {
                  return redirect('/manage_assessment')->with('success','The selected student has been added successfully');  
              }
           }else
           {
               return redirect('/manage_assessment')->with('error','No assessment was found with this ID');
           }
       }else
       {
        return redirect('/manage_assessment')->with('error','You do not have permission to perform this task');
       }
    }

    function this_log(Request $request)
    {
        $rules =
        [
            'val'=>'required',
                   
        ];
        $this->validate($request,$rules);
       
        Cache::forever( $request->session()->get('assessment_id').'_'.Auth::user()->id, $request->val ); //Key and Value, Expiry Minute                     
    }

    public function save_user_response($question_no, $response, Request $request)
    {
        

       
        $user_response = $request->session()->get('user_response_arr');
       
         // if cart is empty then this the first product
         if($user_response ==  null) {

            $user_response = [
                   $question_no => [
                       
                        "response" => $response
                    ]
            ];

            $request->session()->put('user_response_arr', $user_response);

            //return redirect()->back()->with('success', 'Product added to cart successfully!');
        }else
        {
            
                // if cart not empty then check if this product exist then increment quantity
                if(isset($user_response[$question_no])) {

                        $user_response[$question_no]['response'] = $response;

                        $request->session()->put('user_response_arr', $user_response);

                }else
                {
                    
                        // $user_response= array();                                   
                        // if item not exist in cart then add to cart with quantity = 1
                        $user_response[$question_no] = [
                            
                            "response" => (int)$response
                        ];

                        $request->session()->put('user_response_arr', $user_response);
                }

                $request->session()->save();


        }

        
    }

    public function save_edit_assessment(Request $request)
    {
        $rules =
        [
            'assessment_id'=>'required',
            'expiration_date'=>'required',
            'expiration_time'=>'required',
            'start_date'=>'required',
            'start_time'=>'required',        
        ];
        
        $this->validate($request,$rules);
        $assessment_id = decrypt($request->assessment_id);


        $update = DB::table('tbl_assessment_creation')
        ->where('assessment_id', $assessment_id)
        ->update(['start_date'=> $request->start_date, 'start_time' => $request->start_time,'expiration_date'=> $request->expiration_date, 'expiration_time' => $request->expiration_time]);

        return redirect()->route('manage_assessment')->with('success','Assessment updated successfully');
    }

    public function add_new_assessment(Request $request)
    {

        $user_id = Auth::user()->id;
        $course_collection =  DB::table('tbl_map_lecturer_to_courses')
        ->where('lecturer_user_id',$user_id)
        ->join('tbl_courses','tbl_courses.course_id','tbl_map_lecturer_to_courses.course_id')
        ->get();

        $assessment_session_type = 0;

        $current_batch = DB::table('tbl_batch')->where('status',1)->orderBy('created_at','desc')->first();
        $current_batch_no = $current_batch->batch_no;


        $session_assessment_id = DB::table('tbl_assessment_weights')->where('batch_id',$current_batch_no)->first();

        if (isset($session_assessment_id->batch_id))
        {
            $assessment_session_type = $session_assessment_id->type;
        }

        return view('assessment.new_assessment', compact('course_collection','session_assessment_id','assessment_session_type'));
    }

    
    public function save_assessement(Request $request)
    {
        $rules =
        [
            'course_id'=>'required',
            'ca_no'=>'required|numeric',
            'expiration_time'=>'required', 
            'expiration_date'=>'required',  
            'start_time'=>'required', 
            'start_date'=>'required',       
        ];
    
        //check validation options
        $this->validate($request,$rules);
        $user_id = Auth::user()->id;

        $current_batch = DB::table('tbl_batch')->where('status',1)->orderBy('created_at','desc')->first();
        $current_batch_no = $current_batch->batch_no;

        $check = DB::table('tbl_assessment_creation')
            ->where('batch_id', $current_batch_no)
            ->where('course_id',$request->course_id)
            ->where('assessment_type',$request->ca_no)
            ->where('status',0)->first();

           

            if(isset($check->assessement_status))
            {
                return redirect()->route('manage_assessment')->with('ca_error',$request->ca_no.' C.A Test has already been created for this course');
            }else
            {
               $data = [
                   "start_date" =>$request->start_date,
                   "start_time" =>$request->start_time,
                   "expiration_date" =>$request->expiration_date,
                   "expiration_time" =>$request->expiration_time,
                   "course_id" => $request->course_id,
                   "batch_id" => $current_batch_no,
                   "assessment_status" => 1, //1 ->Open 2->Close  -> Cancel
                   "assessment_type" => $request->ca_no,
                   "created_at" => NOW(),
                   "created_by" => $user_id,
               ];

               DB::table('tbl_assessment_creation')->insert($data);

               return redirect()->route('manage_assessment')->with('success',' C.A Assessement created successfully');
            }


        
    }


    public function upload_exam_score()
    {
        $user_id = Auth::user()->id;
        $course_collection =  DB::table('tbl_map_lecturer_to_courses')
        ->where('lecturer_user_id',$user_id)
        ->join('tbl_courses','tbl_courses.short_code','tbl_map_lecturer_to_courses.short_code')
        ->get();

        $current_section = DB::table('tbl_session')->where('session_status',1)->first();
        $current_section_id = isset($current_section->session_id)?$current_section->session_id:"";

        //$max_exam_grade = DB::table('tbl_assessment_weights')->where('session_id',$current_section_id)->first()->exam;

        $session_collection = DB::table('tbl_session')->get();

        return view('assessment.upload_exam_score',compact('course_collection','session_collection','current_section_id'));
    }


    public function save_assessment(Request $request)
    {
        $rules =
        [
            'course'=>'required',
            'ca_no'=>'required|numeric',
            'expiration_time'=>'required', 
            'expiration_date'=>'required',  
            'start_time'=>'required', 
            'start_date'=>'required',       
        ];
    
        //check validation options
        $this->validate($request,$rules);
        $user_id = Auth::user()->id;

        $current_section = DB::table('tbl_session')->where('session_status',1)->first();
        $current_section_id = $current_section->session_id;

        $check = DB::table('tbl_assessment_creation')
            ->where('session_id', $current_section_id)
            ->where('course_short_code',$request->course)
            ->where('assessment_type',$request->ca_no)
            ->where('status',0)->first();

           

            if(isset($check->assessment_status))
            {
                return redirect()->route('set_assessment')->with('ca_error',$request->ca_no.' C.A Test has already been created for this course');
            }else
            {
               $data = [
                   "start_date" =>$request->start_date,
                   "start_time" =>$request->start_time,
                   "expiration_date" =>$request->expiration_date,
                   "expiration_time" =>$request->expiration_time,
                   "course_short_code" => $request->course,
                   "session_id" => $current_section_id,
                   "assessment_status" => 1, //1 ->Open 2->Close  -> Cancel
                   "assessment_type" => $request->ca_no,
                   "created_at" => NOW(),
                   "created_by" => $user_id,
               ];

               DB::table('tbl_assessment_creation')->insert($data);

               return redirect()->route('set_assessment')->with('assessment_success',' C.A assessment created successfully');
            }


        
    }

    public function save_question_edit(Request $request)//save question edit
    {

        $rules = 
        [
           'options' => 'required|array',
           'answer' => 'required',
           'question' => 'required',
           'id' => 'required'
        ];

        $this->validate($request, $rules);

        $question_id = base64_decode($request->id);

        
        $records = [
            'question' => $request->question,
            'answer' => $request->answer,
            'option_1' => $request->options[0],
            'option_2' => $request->options[1],
            'option_3' => $request->options[2],
            'option_4' => $request->options[3],
        ];

        $result = DB::table('tbl_questions')->where('question_id', $question_id)->update($records);

        return redirect('/manage_question')->with('success','record has been created successful');
    }

    public function edit_question(Request $request)
    {
        $question_details =  DB::table('tbl_questions')->where('question_id', $request->id)->first();
		return view('assessment.question_edit',compact('question_details'));
    }

    public function manage_question()
    {
        $questions = DB::table("tbl_questions")->get();
        return view('assessment.manage_question',compact('questions'));
    }

    public function upload_ca_question()
    {
        $user_id = Auth::user()->id;
        $builder =  Course::query();

        
        if(!Auth::user()->can('view-all-courses-selection-list'))
        {
           $builder->where('lecturer_user_id',$user_id);
           $builder->join('tbl_map_lecturer_to_courses','tbl_map_lecturer_to_courses.course_id','tbl_courses.course_id'); //Display only courses mapped to lecturer
        }

        $course_collection =  $builder->get();

        return view('assessment.new_ca_upload',compact('course_collection'));
    }


    public function set_assessment_weight()
    {
        return view('assessment.new_assessment_weight');
    }

    public function save_ca_upload(Request $request)
    {
        $rules = array(
            'assessment_type' => 'required',
            'course_id' => 'required',
        );
         $this->validate($request,$rules);
         $errors=[];
         $duplicates=[];
         $succeeded=[];

        if ($request->hasFile('question')) {
            $my_sentinel = 0;
            $file = $_FILES["question"]["tmp_name"];
            $file_open = fopen($file, "r");
            $date=date('Y-m-d h:i:s');
            $assessment_type= $request->assessment_type;
            $course_id= decrypt($request->course_id);

            while (($line = fgetcsv($file_open, 10000, ",")) !== false) {
                if ($my_sentinel != 0) {
                    //skip first excel title row
                    $question = trim($line[0]);
                    $answer = trim($line[1]);
                    $option1 = trim($line[2]);
                    $option2 = trim($line[3]);
                    $option3 = trim($line[4]);
                    $option4 = trim($line[5]);
                    if($question!="" && $answer!="" && $option1!="" && $option2!="" && $option3!="" && $option4!="")
                    {
                        //Check if the question doesnt't exist
                        $question_collection = DB::table('tbl_questions')
                            ->where('question',$question)
                            ->where('course_id',$course_id)
                            ->get();

                        if($question_collection->isEmpty()) {
                            $question_model = new Questions;
                            $question_model->assessment_type = $assessment_type;
                            $question_model->course_id = $course_id;
                            $question_model->answer = $answer;
                            $question_model->answer = $answer;
                            $question_model->question = $question;
                            $question_model->option_1 = $option1;
                            $question_model->option_2 = $option2;
                            $question_model->option_3 = $option3;
                            $question_model->option_4 = $option4;
                            $question_model->created_at = $date;
                            $question_model->posted_by = Auth::user()->id;
                            $question_model->save();
                            $succeeded[] = "success";
                        }else{
                            $duplicates[]=$question;
                        }
                    }
                    else{
                        $errors[]="new";
                    }
                }
                $my_sentinel++;
            }
        }

        if(isset($succeeded) && count($succeeded)>0){
            ?>
            <div style="text-align: center">
                <h1 style="color:green">Successful Uploads</h1>
                <p>A total of <?php echo count($succeeded) ?> questions uploaded successfully</p>
            </div>
            <?php

        }

        if(isset($duplicates) && count($duplicates)>0){
            ?>
            <div style="text-align: center">
                <h1 style="color:red">Duplicate Uploads (Skipped)</h1>
                <p>A total of <?php echo count($duplicates) ?> questions were skipped because they already existed </p>
            </div>
            <?php
        }

        if(isset($errors) && count($errors)>0){
            ?>
            <div style="text-align: center">
                <h1 style="color:red">Erroneous Uploads (Skipped)</h1>
                <p>A total of <?php echo count($errors) ?> rows were skipped because they had some errors </p>
            </div>
            <?php
        }
 ?>
<div style="text-align: center">
    <p><a href="<?php echo route('upload_ca_question') ?>">Click to go back</a></p>
</div>

<?php



    }


    public function save_assessment_weight(Request $request)
    {
        $rules =
        [
            'ca_grade'=>'required|array',
            'assessment_type'=>'required|numeric',
            'exam_grade'=>'required|numeric',
            'exam_duration'=>'required|numeric',
            'ca_duration'=>'required|numeric',
            
        ];
    
        //check validation options
        $this->validate($request,$rules);

        $user_id = Auth::user()->id;
        $ca_grade = $request->ca_grade;
        $total_ca = 0;
        $counter = 0;
        $insert_array = array();
       // dd($request->assessment_type);

        if ($request->assessment_type == 1) // 2 C.A  1 Exame
        {
            if (count($ca_grade) == 2)
            {
               
                for($b = 0; $b < count($ca_grade); $b++)
                {
                    $counter = $counter + 1;
                    $total_ca = $total_ca + $ca_grade[$b];
                    $insert_array[0]["ca_".$counter] = $ca_grade[$b];
                } 
            }else
            {
                return redirect()->route('set_assessment_weight')->with('ca_error','2 C.A grades are suppose to be inputted');
            }
        }

        if ($request->assessment_type == 2) // 3 C.A  1 Exame
        {
            if (count($ca_grade) == 3)
            {
                
                for($b = 0; $b < count($ca_grade); $b++)
                {
                    $counter = $counter + 1;
                    $total_ca = $total_ca + $ca_grade[$b];
                    $insert_array[0]["ca_".$counter] = $ca_grade[$b];
                } 
            }else
            {
                return redirect()->route('set_assessment_weight')->with('ca_error','3 C.A grades are suppose to be inputted');
            }
        }

        if ($request->assessment_type == 3) // 4 C.A  1 Exame
        {
            if (count($ca_grade) == 4)
            {
                
                for($b = 0; $b < count($ca_grade); $b++)
                {
                    $counter = $counter + 1;
                    $total_ca = $total_ca + $ca_grade[$b];
                    $insert_array[0]["ca_".$counter] = $ca_grade[$b];
                } 
            }else
            {
                return redirect()->route('set_assessment_weight')->with('ca_error','4 C.A grades are suppose to be inputted');
            }
        }

        if ($total_ca + $request->exam_grade == 100)
        {
            $current_section = DB::table('tbl_session')->where('session_status',1)->first();
            $current_section_id = $current_section->session_id;

            $check = DB::table('tbl_assessment_weights')
            ->where('session_id', $current_section_id)
            ->where('status',0)->first();

            if(isset($check->exam))
            {
                return redirect()->route('set_assessment_weight')->with('ca_error','C.A has already been created for this session');
            }else
            {
                $insert_array[0]["session_id"] = $current_section_id;
                $insert_array[0]["exam"] = $request->exam_grade;
                $insert_array[0]["created_by"] = $user_id;
                $insert_array[0]["created_at"] = NOW();
                $insert_array[0]["type"] = $request->assessment_type;
                $insert_array[0]["exam_duration"] = $request->exam_duration;
                $insert_array[0]["ca_duration"] = $request->ca_duration;
                
                $db_status = DB::table("tbl_assessment_weights")->insert($insert_array);

                return redirect()->route('set_assessment_weight')->with('assessment_success','Course Weight created successfully!');
                
            }

        }else
        {
            return redirect()->route('set_assessment_weight')->with('ca_error','Total course grade must be equal to 100');
        }

    }

   


}
