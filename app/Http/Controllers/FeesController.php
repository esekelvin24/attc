<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use PDF;
use Mail;
use App\Models\Payments;

class FeesController extends Controller
{
    //
    public function pay_tution_fees()
    {
        $tuition_fees_collection = DB::table('tbl_');
    }

    public function confirm_bank_transfer()
    {
        $builder = Payments::query();
        $builder->where('payment_method',2)
        ->where('paystack_status',99)
        ->join('users','users.id','tbl_payments.user_id')
        ->join('tbl_applications as a','a.application_id','tbl_payments.application_id');
        $bank_transfer_collections = $builder->get();

        return view ('payments.confirm_bank_transfer', compact('bank_transfer_collections'));

    }

    public function save_confirm_bank_transfer(Request $request)
    {
        $rules = [
            "application_id" => "required",
            "action" => "required",
        ];
        $this->validate($request, $rules);

       $application_id = decrypt($request->application_id);

      

       if ($request->action == 1 || $request->action == 2)
       {
            $transfer_details = DB::table('tbl_payments')
            ->where('application_id',$application_id)
            ->where('payment_method', 2)
            ->where('paystack_status', 99)
            ->get();

            if (count($transfer_details) > 0)
            {
                DB::beginTransaction();

                $Payments = Payments::find($transfer_details[0]->payment_id);
                
                if($transfer_details[0]->paystack_status == "99" && $request->action == 1)//if payment is pending and the action is to confirm transaction
                {
                    $Payments->paystack_status = "success";
                    $update_application = DB::table('tbl_applications')->where('application_id',$application_id)->update(["payment_status" =>1]);
                }else if($transfer_details[0]->paystack_status == "99" && $request->action == 2)//if payment is pending and the action is to cancel transaction
                {
                    $Payments->paystack_status = "";
                    $update_application = true; //set this to true because no update was made
                }
                $Payments->bank_trans_confirmed_by = Auth::user()->id;
                $Payments->bank_trans_confirmed_date =  NOW();
                $Payments->save();

                if($Payments && $update_application)
                {
                    $application_collection = DB::table('tbl_applications')
                            ->join('tbl_programmes','tbl_programmes.programme_id','tbl_applications.programme_id')
                            ->join('users','users.id','tbl_applications.user_id')
                            ->where('application_id',$application_id)
                            ->where('tbl_applications.status',1)
                            ->where('tbl_applications.action_1_status', 1)
                            ->orderBy('application_id','desc')
                            ->limit(1)
                            ->get();

                            $application_courses = DB::table('tbl_application_courses')
                            ->join('tbl_courses','tbl_courses.course_id','tbl_application_courses.course_id')
                            ->where('application_id',$application_id)->get();
                    
                    $email = $application_collection[0]->email;
                 
                    DB::commit();

                 if($request->action == 1 )//Send receipt to email if the application is confirmed
                 {   
                            
                
                           

                            $data1 = [
                                'full_name'=>$application_collection[0]->firstname." ".$application_collection[0]->lastname,
                                'programme_name'=> $application_collection[0]->programme_name,
                                'university'=> "African Technical Training",
                                'reference'=> "",
                                'application_courses'=> $application_courses, 
                                'application_collection'=> $application_collection,
                                'payment_method'=> "Bank Transfer"
                            ];

                            $file_name= "General_Fee_".'ATTC-'.str_pad($application_collection[0]->batch_id, 4, "0", STR_PAD_LEFT).'-'.$application_collection[0]->application_id.".pdf";

                            $pdf = PDF::loadView('pdfs.receipt', $data1)->setPaper('a4', 'portrait')->save("file_upload/applications/attc/$file_name");
                            
                            //send email
                            Mail::send('emails.notify_general_fee', $data1, function($message) use ($data1,$email,$file_name){
                                $message->from("dangote.gts@gmail.com", 'ATTC Nigeria Portal');
                                $message->to($email);
                                //$message->bcc("isokenodigie@gmail.com");
                                //$message->bcc("mailaustin37@gmail.com");
                                $message->subject("Payment Receipt: Tuition Fee ");
                                $message->attach("file_upload/applications/attc/$file_name",[
                                    'as' => 'General Fee Receipt.pdf',
                                    'mime' => 'application/pdf',
                                ]);
                            });
                 }else if($request->action == 2 )//Send receipt to email if the application is rejected
                 {

                    $data1 = [
                        'full_name'=>$application_collection[0]->firstname." ".$application_collection[0]->lastname,
                        'programme_name'=> $application_collection[0]->programme_name,
                        'university'=> "African Technical Training",
                        'reference'=> "",
                        'application_collection'=> $application_collection,
                        'application_courses'=> $application_courses,
                     
                    ];

                    Mail::send('emails.bank_confirmation_cancelled', $data1, function($message) use ($data1,$email){
                        $message->from("dangote.gts@gmail.com", 'ATTC Nigeria Portal');
                        $message->to($email);
                        //$message->bcc("isokenodigie@gmail.com");
                        //$message->bcc("mailaustin37@gmail.com");
                        $message->subject("Bank Transfer: Cancelled ");
                        
                    });    
                 }

                return $request->action;  // 1 - successful confirmation, 2- Successful rejection

                }else
                {
                    DB::Rollback();
                    return 3; //an error occured
                }
            }else
            {
                return 4;//record not found
            }
           
       }
     

    }



    public function bank_transfer_completed(Request $request )
    {
        $rules = [
             "banK_transfer_app_id" => "required"
        ];

        $application_id = decrypt($request->banK_transfer_app_id);
        
        $application_details = DB::table('tbl_applications')->where('application_id',$application_id)->where('user_id',Auth::user()->id)->where('status',1)->where('action_1_status', 1)->where('payment_status',0)->get();

        if(count($application_details) > 0)
        {
            $payment_check = DB::table('tbl_payments')->where('application_id',$application_id)->where('paystack_status','99')->get();
                
           if ($application_details[0]->accept_offer == 1 && $application_details[0]->payment_status != 1 && count($payment_check) < 1)//if the user has accepted the offer and a successful payment has not been made && a pending bank transfer is not made
           {
              $total_fee = DB::table('tbl_application_courses')->selectRaw('SUM(application_course_price) as total_amt')->where('application_id',$application_id)->first()->total_amt;

              $payments = new Payments;
              $payments->user_id = Auth::user()->id;
              $payments->amount= $total_fee ;
              $payments->application_id = $application_id;
              $payments->payment_method = 2;
              $payments->paystack_status = "99";
              $payments->creation_date = NOW();
              $payments->save();
           }
        }

       return redirect('/dashboard');

        //check if course exist and payment has not been made
    }

  
    public function payment(Request $request, $payment_type, $application_id){
        $payment_type = decrypt($payment_type);
        $application_id = decrypt($application_id);

        //check if application exist
        $application_collection = DB::table('tbl_applications as a')
        ->where('a.application_id',$application_id)
        ->where('a.user_id',Auth::user()->id)
        ->get();

        //check if successful payment has been made for this application
        $payment_check = DB::table('tbl_payments')->where('application_id',$application_id)->where('paystack_status','success')->get();

         
         if (count($application_collection) > 0 && count($payment_check) < 1)             
            {
                        $firstname=Auth::user()->firstname;
                        $lastname=Auth::user()->lastname;
                        $email=Auth::user()->email;
                        $token=$request->session()->token();
                        $type=$request->type;
                        $part_payment="no";
                        $balance_payment="no";
                        $order_code=Auth::user()->id.'_'.date('Ymd').'_'.rand(0,99999);

                        $order_code = Auth::user()->id.'_'.date('Ymd').'_'.rand(0,99999);
                        $total_fee = DB::table('tbl_application_courses')->selectRaw('SUM(application_course_price) as total_amt')->where('application_id',$application_id)->first()->total_amt;


                        $payments = new Payments;
                        $payments->user_id = Auth::user()->id;
                        $payments->amount= $total_fee ;
                        $payments->application_id = $application_id;
                        $payments->ref = $order_code;
                        $payments->creation_date = NOW();
                        $payments->save();
                        
                        switch($payment_type){

                        case 1://1-Tuition Fee
                            $the_place= route('verify_transaction');
                            $the_final= route('dashboard',['acceptance_success']);
                            
                            $total_sum=$total_fee*100;//paystack requirement

                        break;
                        default:

                        break;
                        }
                
                        $animation_image_path=asset("img/payment.gif");
                
                        return ("
                        <script>
                        function payWithPaystack(){
                        var handler = PaystackPop.setup({
                        key: 'pk_test_5ea88e36a7f9b3fd56b3a3311f79b3849f623f7c',
                        email: '$email',
                        amount: '$total_sum',
                        currency: 'NGN',
                        ref: '$order_code', // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                        firstname: '$firstname',
                        lastname: '$lastname',
                        // label: 'Optional string that replaces customer email'
                        metadata: {
                        custom_fields: [
                            {
                                
                                display_name: 'email',
                                variable_name: 'email',
                                value: '$email'
                            },
                            {
                                display_name: 'Application ID',
                                variable_name: 'Application ID',
                                value: '".'ATTC-'.str_pad($application_collection[0]->batch_id, 4, "0", STR_PAD_LEFT).'-'.$application_id."' 
                            }
                        ]
                        },
                        callback: function(response){
                            if(response.status=='success')
                            {
                            $.ajax(
                                    {
                                    type: 'POST',
                                    data:{
                                        _token:'$token',
                                        ref:''+response.reference,
                                        type:'$type',
                                        part_payment:'$part_payment',
                                        balance_payment:' $balance_payment'
                                    },
                                    url: '$the_place',
                                    cache: false,
                                    beforeSend: function () {
                                        $('body').block({ message: '<img src=\'$animation_image_path\' >' });
                                    },
                                    error:function(){
                                        
                                        Swal.fire(
                                            'Oops',
                                            'An error occurred. Contact Administration',
                                            'error'
                                        );
                                        /*setTimeout(function(){
                                            window.location.reload();
                                        },3000);*/
                                    },
                                    success: function (r) {
                                    if(r=='ok'){
                                      
                                        Swal.fire(
                                            'Congrats',
                                            'Payment Successful',
                                            'success'
                                        );
                                        setTimeout(function(){
                                            window.location.reload();
                                        },3000);
                                    }else{
                                        console.log('The non okay error is ',r);
                                        
                                        Swal.fire(
                                            'Oops',
                                            'Payment Successful',
                                            'success'
                                        );
                                        /*setTimeout(function(){
                                            window.location.reload();
                                        },3000);*/
                                    
                                    }
                                    }
                                    }  
                                );
                            }
                            else
                            
                            Swal.fire(
                                'Oops',
                                'Transaction was not successful',
                                'error'
                            );
                        },
                        onClose: function(){
                        }
                    });
                    handler.openIframe();
                    }
                        </script>");
                }
    }


      
    public function verify_transaction(Request $request){
        $reference = $request->ref;
        $url = 'https://api.paystack.co/transaction/verify/'.$reference;
        //open connection
        $ch = curl_init();//set request parameters
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt_array($ch, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/".rawurlencode($reference),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Bearer sk_test_6cfb9b006f364a600d3e2f5a8501077e7fc40844",
                "cache-control: no-cache"
            ],
        ));

        //send request
        $request_data = curl_exec($ch);//close connection
        $err = curl_error($ch);
        //curl_close($ch);//declare an array that will contain the result
        $result = array();
        if($request_data){
            $result = json_decode($request_data, true);
        }
       /*
        $my_file = "dump1.txt";
        $handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
        $data = "\n".date('Y-m-d')."->'".json_encode($result)."',";
        fwrite($handle, $data);  
        */

        if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] == 'success'))
        {
             $date=date("Y-m-d H:i:s");
             $email = Auth::user()->email;

             $application_collection = DB::table('tbl_applications')
            ->join('tbl_programmes','tbl_programmes.programme_id','tbl_applications.programme_id')
            ->join('users','users.id','tbl_applications.user_id')
            ->where('user_id', Auth::user()->id)
            ->where('tbl_applications.status',1)
            ->where('tbl_applications.action_1_status', 1)
            ->orderBy('application_id','desc')
            ->limit(1)
            ->get();

            

            
          switch(decrypt($request->type)){ //Fees Payment
            case 1:

                $id = Auth::user()->id;

                DB::beginTransaction();

                $payments = Payments::where('ref',$reference)
                ->update([
                   "paystack_status" => $result['data']['status'],
                   "paystack_amount_processed" => $result['data']['amount']

                ]);

                $application_id = Payments::where('ref',$reference)->first()->application_id;

                $update_app = DB::table('tbl_applications')->where('application_id',$application_id)->update(["payment_status" => 1]);
            
                $application_courses = DB::table('tbl_application_courses')
                ->join('tbl_courses','tbl_courses.course_id','tbl_application_courses.course_id')
                ->where('application_id',$application_id)->get();


                   if ($update_app && $payments)
                     {   
                        DB::commit(); 
                        //generate pdf here
                        $data1 = [
                            'full_name'=>Auth::user()->firstname." ".Auth::user()->lastname,
                            'programme_name'=> $application_collection[0]->programme_name,
                            'university'=> "African Technical Training",
                            'reference'=> $reference,
                            'application_courses'=> $application_courses, 
                            'application_collection'=> $application_collection,
                            'payment_method'=> "Card"
                        ];

                        $file_name= "General_Fee_".'ATTC-'.str_pad($application_collection[0]->batch_id, 4, "0", STR_PAD_LEFT).'-'.$application_collection[0]->application_id.".pdf";

                        $pdf = PDF::loadView('pdfs.receipt', $data1)->setPaper('a4', 'portrait')->save("file_upload/applications/attc/$file_name");

                        //send email
                        Mail::send('emails.notify_general_fee', $data1, function($message) use ($data1,$email,$file_name){
                            $message->from("dangote.gts@gmail.com", 'ATTC Nigeria Portal');
                            $message->to($email);
                            //$message->bcc("isokenodigie@gmail.com");
                            //$message->bcc("mailaustin37@gmail.com");
                            $message->subject("Payment Receipt: Tuition Fee ");
                            $message->attach("file_upload/applications/attc/$file_name",[
                                'as' => 'General Fee Receipt.pdf',
                                'mime' => 'application/pdf',
                            ]);
                        });
                        return "ok";
                    }else
                    {
                        DB::rollback();
                        return "failed";
                    }

                

                break;
            break;
            case 2://Accommodation Fee
              
                return "failed";

            break;
          }
        }
        else{

                $my_file = "dump2.txt";
                $handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
                $data = "\n".date('Y-m-d')."->'".json_encode($result)."',";
                fwrite($handle, $data);  

                if (count($result) > 0)
                {
                    
                    $payments = Payments::where('ref',$reference)
                    ->update([
                    "paystack_status" => $result['data']['status'],
                    "paystack_amount_processed" => $result['data']['amount']
                    ]);

                    $application_id = Payments::where('ref',$reference)->first()->application_id;
                    $update_app = DB::table('tbl_applications')->where('application_id',$application_id)->update(["payment_status" => 2]);
                }
                

            return "failed";
        }

    }
}
