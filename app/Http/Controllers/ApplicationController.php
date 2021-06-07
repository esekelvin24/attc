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

class ApplicationController extends Controller
{
    //

    public function student_application(Request $request)
    {
        $all_application_collection = Application::join('tbl_programmes','tbl_programmes.programme_id','tbl_applications.programme_id')
        ->selectRaw('*,SUM(ac.application_course_price) as programme_total_amt')
        ->join('users','users.id','tbl_applications.user_id')
        ->join('tbl_application_courses as ac','ac.application_id','tbl_applications.application_id')
        ->groupBy('tbl_applications.application_id')
        ->orderBy('tbl_applications.created_at','desc')
        ->get();

        return view('applications.student_application', compact('all_application_collection'));
    }

    public function my_application()
    {
        $all_application_collection = Application::join('tbl_programmes','tbl_programmes.programme_id','tbl_applications.programme_id')
        ->selectRaw('*,SUM(ac.application_course_price) as programme_total_amt')
        ->join('users','users.id','tbl_applications.user_id')
        ->join('tbl_application_courses as ac','ac.application_id','tbl_applications.application_id')
        ->where('tbl_applications.user_id',Auth::user()->id)
        ->groupBy('tbl_applications.application_id')
        ->orderBy('tbl_applications.created_at','desc')
        ->get();

        return view('applications.my_application', compact('all_application_collection'));
    }

    
	public function application_details(Request $request, $application_id){

      
        $user_id = Auth::user()->id;

       
        $application_collection = DB::table('tbl_applications as a')
        ->selectRaw('*,u.batch_no as user_batch_no, action_one.firstname as action_1_taker_firstname,action_one.lastname as action_1_taker_lastname')
        ->join('users as u','u.id','a.user_id')
        ->join('tbl_programmes as p','p.programme_id','a.programme_id')
        ->leftjoin('users as action_one','action_one.id','a.action_1_user')
        ->where('a.application_id',$application_id)
        ->get();

        

        $application_documents = DB::table('tbl_application_documents_upload')
        ->join('tbl_application_documents', 'tbl_application_documents.document_id','tbl_application_documents_upload.document_id' )
        ->where('application_id',$application_id)->get();

        $application_courses = DB::table('tbl_application_courses')
        ->join('tbl_courses','tbl_courses.course_id','tbl_application_courses.course_id')
        ->where('application_id',$application_id)->get();

       
           
 ?>
        <div class="element-wrapper">
            <div class="invoice-w" style="background-color: ">
                <div class="infos">
                    <div class="info-1">
                        <h3>
                           Applicant Details
                        </h3>
                        <div class="company-address">
                           Full Name:  <?php echo $application_collection[0]->firstname.' '.$application_collection[0]->middlename.' '.$application_collection[0]->lastname ?>
                        </div>
                        <div class="company-address">
                            DOB:  <?php echo date('d, F, Y',strtotime($application_collection[0]->dob)) ?>
                        </div>
                        <div class="company-address">
                            Phone No:  <?php echo $application_collection[0]->phone ?>
                        </div>
                        <div class="company-address">
                            Email:  <?php echo $application_collection[0]->email ?>
                        </div>
                    </div>
                </div>
                <div class="invoice-heading" style="margin: 20px 0 !important;">
                    <h3>
                        Application Details
                    </h3><br/>
                    <div class="invoice-date">
                        Date Applied: <?php echo date('d, F, Y',strtotime($application_collection[0]->application_date)) ?>
                    </div>
                    <div class="invoice-date">
                        Application No: <?php echo 'ATTC-'.str_pad($application_collection[0]->user_batch_no, 4, "0", STR_PAD_LEFT).'-'.$application_id ?>
                    </div>
                    <div class="invoice-date">
                        Batch: <?php echo $application_collection[0]->user_batch_no?>
                    </div>

                    <div class="invoice-date">
                        Programme Name: <strong><?php echo $application_collection[0]->programme_name?></strong>
                    </div>

                    <?php if($application_collection[0]->action_1_status == 1){ ?>
                    <div class="invoice-date">
                        Fees Payment: <strong><?php if($application_collection[0]->payment_status == 0){ echo '<font class="text-info">Pending</font>'; }else if ($application_collection[0]->payment_status == 1){ echo '<font class="text-success">Successful</font>'; }else{ echo '<font style"color:red">Failed</font>'; } ?></strong>
                    </div>
                    <?php } ?>
                </div>

               
                  <div class="invoice-desc">
                        <div class="desc-label">
                           <i class="fa fa-list"></i> Courses List
                        </div>
                    </div>

                    <table class="table">
                            <thead>
                                <tr>
                                    <th>S/No.</th>
                                    <th>Name</th>
                                    <th style="text-align:right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $total_registered_course = 0;
                                foreach($application_courses as $courses_val){ 
                                ?>
                               <tr> <td>1</td><td><?php echo $courses_val->course_name ?></td> <td align="right">₦<?php echo number_format($courses_val->application_course_price,2) ?></td> </tr>
                               <?php $total_registered_course = $total_registered_course + $courses_val->application_course_price; } ?>
                               <tr style="text-align:right"> <td colspan="2"><strong>Total:</strong></td> <td> <strong>₦<?php echo number_format($total_registered_course,2) ?><strong></td> </tr>
                            </tbody>
                    </table>
             
                
                    <div class="invoice-desc">
                        <div class="desc-label">
                           <i class="fa fa-anchor"></i> Attached Documents
                        </div>
                    </div>
                    <div class="invoice-table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>S/No.</th>
                                <th>Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $a=0;
                            foreach($application_documents as $doc_val) {
                                ?>
                                <tr>
                                    <td><?php echo $a+1; ?></td>
                                    <?php if($doc_val->document_name == "Academic Qualification") {?>
                                       <td><a class="badge badge-default-inverted" target="_blank" href="<?php echo asset("file_upload/applications/academic_upload/$doc_val->file_name") ?>"> <?php echo $doc_val->document_name ?></a></td>
                                    <?php }else if($doc_val->document_name == "Working Experience"){ ?>
                                       <td><a class="badge badge-default-inverted" target="_blank" href="<?php echo asset("file_upload/applications/work_experience/$doc_val->file_name") ?>"> <?php echo $doc_val->document_name ?></a></td>
                                    <?php }else if($doc_val->document_name == "Offer Letter" || $doc_val->document_name == "Acceptance Letter"){ ?>
                                        <td><a class="badge badge-default-inverted" target="_blank" href="<?php echo asset("file_upload/applications/attc/$doc_val->file_name") ?>"> <?php echo $doc_val->document_name ?></a></td>
                                    <?php } ?>
                                </tr>
                                <?php
                                   $a++;
                                 }
                                ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>S/No.</th>
                                <th>Name</th>
                            </tr>
                            </tfoot>
                        </table>

                        <div class="col-lg-12 col-xxl-12">
                            <!--START - BALANCES-->
                            <div class="element-balances">
                                <div class="balance">
                                    <div class="balance-title">
                                        Level 1 Status
                                    </div>
                                    <div class="balance-value">
                                        <span class="badge
                                        <?php
                                        if($application_collection[0]->action_1_status==0) echo "badge-primary-inverted";
                                        else if($application_collection[0]->action_1_status==1) echo "badge-success-inverted";
                                        else if($application_collection[0]->action_1_status==2) echo "badge-danger-inverted";
                                        ?>">
                                            <?php
                                            if($application_collection[0]->action_1_status==0) echo "Pending";
                                            else if($application_collection[0]->action_1_status==1) echo "Approved";
                                            else if($application_collection[0]->action_1_status==2) echo "Rejected";
                                            ?>
                                        </span>
                                    </div>
                                    <div class="balance-link">
                                        <?php
                                            if($application_collection[0]->action_1_status!=0) {
                                                ?>
                                                <i class="os-icon os-icon-user-check"></i><span>Action by:</span><br/>
                                                <span style="font-weight: bold; font-size: 15px; text-transform: uppercase"><?php echo $application_collection[0]->action_1_taker_firstname." ".$application_collection[0]->action_1_taker_lastname  ?></span><br/>
                                                <span style="">Date: <span style="font-size: 12px"><?php echo date("d F,Y h:m A",strtotime($application_collection[0]->action_1_date)) ?></span></span><br/>

                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!--END - BALANCES-->

                            <br/>
                            <?php
                            if( Auth::user()->can('approve-level-one') && $application_collection[0]->action_1_status==0 ) {
                                ?>
                                <button data-id="<?php echo $application_collection[0]->application_id?>"  data-action="1" class="btn btn-success btn-lg btn-block"><i class="os-icon os-icon-thumbs-up"></i><span>Approve Application (Level 1)</span>
                                </button>
                                <br/>
                                <button data-id="<?php echo $application_collection[0]->application_id?>" data-action="2" class="btn btn-danger btn-lg btn-block"><i class="os-icon os-icon-thumbs-down"></i><span>Reject Application (Level 1)</span>
                                </button>
                            <?php
                            }
                            ?>


                        </div>

                        <?php
                            if( Auth::user()->can('approve-level-one') && $application_collection[0]->action_1_status==0 ) {
                        ?>
                            <div class="terms">
                                <div class="terms-header">
                                    Note:
                                </div>
                                <div class="terms-content">
                                    A 1-Level approval must be issued before a candidate can be issued a conditional offer of admission
                                </div>
                            </div>
                        <?php
                            }
                        ?>

                    </div>
                </div>
                <div class="invoice-footer">
                    <div class="invoice-logo">
                        <img alt="" src="<?php echo asset("frontend/assets/img/favicon.png") ?>"><span>African Technical Training Centre</span>
                    </div>
                </div>
            </div>
        </div>
<?php
}


    public function application_level_approval(Request $request){
        $application_id=$request->application_id;
        $request_id=$request->action;
        $reason=$request->reason;

        $application_collection = DB::table('tbl_applications as a')
        ->selectRaw('*,u.batch_no as student_batch, CONCAT(u.firstname," ",u.middlename," ",u.lastname) as fullname,u.email as applicant_email, u.batch_no as user_batch_no, action_one.firstname as action_1_taker_firstname,action_one.lastname as action_1_taker_lastname')
        ->join('users as u','u.id','a.user_id')
        ->join('tbl_programmes as p','p.programme_id','a.programme_id')
        ->leftjoin('users as action_one','action_one.id','a.action_1_user')
        ->where('a.application_id',$application_id)
        ->get();


        $email = $application_collection[0]->applicant_email;

        if ($request_id == 1 && Auth::user()->can('approve-level-one'))// approved
        {
           
          
            $application_courses = DB::table('tbl_application_courses')
            ->join('tbl_courses','tbl_courses.course_id','tbl_application_courses.course_id')
            ->where('application_id',$application_id)->get();

            DB::beginTransaction();  
            $application = Application::find($application_id);

            if ($application_collection[0]->action_1_status == 0)
            {
                    $application->action_1_status=1;
                    $application->action_1_date=date("Y-m-d H:i:s");
                    $application->action_1_user=Auth::user()->id;
                    $application->save();

                    $file_name= "Offer_Letter_".'ATTC-'.str_pad($application_collection[0]->user_batch_no, 4, "0", STR_PAD_LEFT).'-'.$application_collection[0]->application_id.".pdf";
                    $file_name_acceptance= "Acceptance_Letter_".'ATTC-'.str_pad($application_collection[0]->user_batch_no, 4, "0", STR_PAD_LEFT).'-'.$application_collection[0]->application_id.".pdf";
 
                    $application_courses = DB::table('tbl_application_courses')
                    ->join('tbl_courses','tbl_courses.course_id','tbl_application_courses.course_id')
                    ->where('application_id',$application_id)->get();
                    
                    $data1 = [
                        'full_name'=>$application_collection[0]->fullname,
                        'degree_short_code'=>"",
                        'programme_name'=> $application_collection[0]->programme_name,
                        'batch_no' => $application_collection[0]->student_batch,
                        'application_courses' => $application_courses, 
                        'full_application_no' => 'ATTC-'.str_pad($application_collection[0]->user_batch_no, 4, "0", STR_PAD_LEFT).'-'.$application_collection[0]->application_id
                    ];

                    $pdf = PDF::loadView('pdfs.admission_offer', $data1)->setPaper('a4', 'portrait')->save("file_upload/applications/attc/$file_name");
                    $pdf = PDF::loadView('pdfs.admission_acceptance', $data1)->setPaper('a4', 'portrait')->save("file_upload/applications/attc/$file_name_acceptance");
                    
                    $Applications_Documents_upload = new Applications_Documents_upload();
                    $Applications_Documents_upload->application_id = $application_collection[0]->application_id;
                    $Applications_Documents_upload->document_id = 3;
                    $Applications_Documents_upload->file_name =  $file_name;
                    $Applications_Documents_upload->save();

                    $Applications_Documents_upload = new Applications_Documents_upload();
                    $Applications_Documents_upload->application_id = $application_collection[0]->application_id;
                    $Applications_Documents_upload->document_id = 4;
                    $Applications_Documents_upload->file_name =  $file_name_acceptance;
                    $Applications_Documents_upload->save();

                    $data = [
                        'full_name'=>$application_collection[0]->fullname,
                        'degree_short_code'=>"",
                        'programme_name'=>$application_collection[0]->programme_name,
                        'programme_type'=>"",
                        'university'=>"African Technical Training Centre",
                        'university_id'=>"",
                        'batch_no' => $application_collection[0]->student_batch
                    ];

                    if ($application && $Applications_Documents_upload)
                        {
                            DB::commit(); 
                            Mail::send('emails.notify_applicant_success', $data, function($message) use ($data,$email,$file_name,$file_name_acceptance){
                                $message->from("dangote.gts@gmail.com", 'ATTC Nigeria Portal');
                                $message->to($email);
                            // $message->bcc("isokenodigie@gmail.com");
                            // $message->bcc("mailaustin37@gmail.com");
                                $message->subject('ATTC Provisional Admission Offer');
                                $message->attach("file_upload/applications/attc/$file_name",[
                                    'as' => 'Offer Letter.pdf',
                                    'mime' => 'application/pdf',
                                ]);
                                $message->attach("file_upload/applications/attc/$file_name_acceptance",[
                                    'as' => 'Acceptance Letter.pdf',
                                    'mime' => 'application/pdf',
                                ]);
                            });
                        }else
                        {
                            DB::rollback();
                        }
            }

        }else if($request_id == 2 && Auth::user()->can('approve-level-one'))// Reject
        {
            $application_courses = DB::table('tbl_application_courses')
            ->join('tbl_courses','tbl_courses.course_id','tbl_application_courses.course_id')
            ->where('application_id',$application_id)->get();
            $application = Application::find($application_id);

            if ($application_collection[0]->action_1_status == 0)
            {
                    $application->action_1_status= 2;//Reject application
                    $application->action_1_date=date("Y-m-d H:i:s");
                    $application->action_1_user = Auth::user()->id;
                    $application->rejection_reason = $reason;
                    $application->save();

                    $application_courses = DB::table('tbl_application_courses')
                    ->join('tbl_courses','tbl_courses.course_id','tbl_application_courses.course_id')
                    ->where('application_id',$application_id)->get();

                    $data = [
                        'full_name' => $application_collection[0]->fullname,
                        'degree_short_code' => "",
                        'programme_name' => $application_collection[0]->programme_name,
                        'university'=> "African Technical Training Centre",
                        'reason' => $reason,
                        'application_courses' => $application_courses,
                        'application_collection'=> $application_collection,
                    ];


    //notify_applicant_failure
    
                    Mail::send('emails.notify_applicant_failure', $data, function($message) use ($data,$email){
                        $message->from("dangote.gts@gmail.com", 'ATTC Nigeria Portal');
                        $message->to($email);
                        /*$message->bcc("isokenodigie@gmail.com");*
                        $message->bcc("mailaustin37@gmail.com");*/
                        $message->subject('ATTC Unsuccessful Application Notification');
                    });
            }
 

        }
    }


    public function my_certificate()
    {
        $all_application_collection = Application::join('tbl_programmes','tbl_programmes.programme_id','tbl_applications.programme_id')
        ->selectRaw('*,SUM(ac.application_course_price) as programme_total_amt')
        ->join('users','users.id','tbl_applications.user_id')
        ->join('tbl_application_courses as ac','ac.application_id','tbl_applications.application_id')
        ->where('tbl_applications.user_id',Auth::user()->id)
        ->groupBy('tbl_applications.application_id')
       // ->orderBy('tbl_applications.created_at','desc')
        ->get();

        return view('applications.my_certificate', compact('all_application_collection'));
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
       // ->orderBy('tbl_applications.created_at','desc')
        ->get();
        

        return view('applications.my_time_table', compact('all_application_collection'));
    }





}
