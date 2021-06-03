@extends('layouts.dash_layout')

@section('content')



@if(true)
   
        <div class="content-box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <h6 class="element-header">
                            Portal Dashboard
                        </h6>
                        <div class="element-content">
                        <div class="row">








                                {{-- <div class="col-sm-4 col-xxxl-3">
                                    <a class="element-box el-tablo" href="#">
                                        <div class="label">
                                            New Customers
                                        </div>
                                        <div class="value">
                                            125
                                        </div>
                                        <div class="trending trending-down-basic">
                                            <span>9%</span><i class="os-icon os-icon-arrow-down"></i>
                                        </div>
                                    </a>
                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="support-index">
                <div class="">
                   
                   @if(Auth::user()->can('view-application-on-dashboard')) 
                   <div class="support-tickets-header">
                        <div class="tickets-control">
                            <h5>
                                All Applications (@if(isset($all_application_collection) && !$all_application_collection->isEmpty()){{$all_application_collection->count()}}@else{{"0"}}@endif)
                            </h5>
                        </div>
                    </div>  
                        <div class="element-box">
                      <div class="table-responsive">
                                <style>
                                    .form-inline{
                                        display: block !important;
                                    }
                                    ul.pagination a {
                                        position: relative;
                                        display: block;
                                        padding: 0.5rem 0.75rem;
                                        margin-left: -1px;
                                        line-height: 1.25;
                                        color: #047bf8;
                                        background-color: #fff;
                                        border: 1px solid #dee2e6;
                                    }
                                </style>
                                <table id="dataTable" class="table table-striped" style="width: 100% !important; table-layout: fixed;">
                                    <thead>
                                    <tr>
                                        <th style="width:10px">S/N</th>
                                        <th>STATUS</th>
                                        <th>APPLICANT</th>
                                        <th>PROGRAMME</th>
                                        <th>APPLIED ON</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th style="width:10px">S/N</th>
                                        <th>STATUS</th>
                                        <th>APPLICANT</th>
                                        <th>PROGRAMME</th>
                                        <th>APPLIED ON</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($all_application_collection as $k=>$val)
                                        <tr data-id="{{$val->application_id}}" style="cursor: pointer">
                                            <td style="width:10px">{{$k+1}}</td>
                                            <td>
                                                @if($val->action_1_status==0) <strong class="text-info"><i class="fa fa-spinner"></i> Pending </strong>@elseif($val->action_1_status==1) <strong class="text-success"><i class="fa fa-check"></i> Approved </strong>  @elseif($val->action_1_status==2)<strong class="text-danger"><i class="fa fa-times"></i> Rejected </strong>  @endif
                                            </td>
                                            <td><strong>{{$val->firstname.' '.$val->lastname}}</strong></td>
                                            <td>{{$val->programme_name}}</td>
                                            <td>{{date('d-m-y h:m A',strtotime($val->created_at))}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                   @endif  
                </div>
            </div> 
        </div>
    
    @else
        <div class="content-box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <h6 class="element-header">
                            Portal Dashboard
                        </h6>
                        <div class="element-content">
                            <div class="row">
                                Welcome to the portal landing page. Kindly use the menu on your left to maximize your ePortal landing page.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    @endif

    
    @if($accept_offer_upload == false )
        <!-- Modal Change First Password -->
        <div class="modal fade horizontal upload_offer_letter"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-lg" >
                <div class="modal-content">
                    <button onclick="document.getElementById('logout-form').submit();" class="btn-danger"><i class="fa fa-sign-out"></i>LOGOUT</button>
                    <div class="modal-header" style="flex-direction: column !important; align-items: center !important; ">
                        <img src="{{asset('img/offer_letter.gif')}}" /><br/>
                        <h3 class="modal-title text-primary" id="myModalLabel" style="text-align: center">Congratulations!</h3><br/>
                        <p style="text-align: center">Your have successfully gain a provisional offer with us!<br/>
                           You must however upload your signed acceptance letter which was sent to your email to proceed.
                        </p>
                    </div>

                    <div class="modal-body">
                        <form id="upload_offer" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div align="center" class="col-md-12">
                                Application ID: <strong>{{'ATTC-'.str_pad($application_details[0]->batch_id, 4, "0", STR_PAD_LEFT).'-'.$application_details[0]->application_id}}</strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Signed Acceptance Letter <span class="symbol required"></span>
                                        </label>
                                        <input autocomplete="off" name="completed_offer_letter" class="form-control" type="file">
                                        <span class="text-danger error-message"></span>
                                    </div>
                                    <button type="submit" class="btn btn-o btn-primary save_offer_letter">
                                        Upload Document
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
    @endif

    
    @if($fees_amount != 0)
        <!-- Modal Change First Password -->
        <div class="modal fade horizontal pay_acceptance_fee"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-lg" >
                <div class="modal-content">
                   
                    <div class="modal-header" style="flex-direction: column !important; align-items: center !important; ">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <img style="width:50px; height:50px" src="{{asset('img/logo.png')}}" /><br/>
                        {{-- <h3 class="modal-title text-primary" id="myModalLabel" style="text-align: center">Congratulations!</h3><br/> --}}
                       
                                <h4 style="text-align: center; "> You have an outstanding tuition fees payment of </h4>
                                <strong style="text-align: center; "><h2>N{{number_format($fees_amount,2)}}</h2></strong>
                         
                       
                    </div>

                    <div class="modal-body">
                    
                       @php
                        $payment_check = DB::table('tbl_payments')->where('application_id',$application_details[0]->application_id)->where('paystack_status','99')->get();
                       @endphp
                       @if(count($payment_check) > 0)

                       <div align="center">
                             <img width="100" height="100" src="{{asset('img/barred.png')}}" >
                            <p>Your request has been sent and it is awaiting confirmation from admin, when the confirmation is done you will be able to gain full access to your course materials </p>
                       </div>
                        

                       @else
                        <p class="payment_options" style="text-align: center; font-size:17px"> Kindly Select a payment options </p></p>
                        <div class="row payment_options"> 
                                @if(Auth::user()->can('pay-with-debit-card'))
                                    <div align="center" class="col-md-4">       
                                        <a href="#" data-href="{{route("payment",["type"=> encrypt(1), "id" =>encrypt($application_id)])}}" class="  pay_acceptance_fee_btn" style="margin: 0 auto;">
                                                <img height="120" width="160" src="{{asset('frontend/assets/img/debit_card.png')}}" ><br/>
                                                <h5> Pay with Debit Card</h5>
                                        </a>  
                                    </div> 
                                @endif
                               <div align="center" class="col-md-4">
                                    &nbsp;&nbsp;
                               </div>
                             @if(Auth::user()->can('pay-with-bank-transfer'))
                                <div align="center" class="col-md-4">
                                    <a href="javascript:pay_with_bank_transfer()">
                                    <img height="120" width="160" src="{{asset('frontend/assets/img/bank_transfer-512.png')}}" >
                                    <h5> Bank Transfer</h5>
                                    </a>
                                </div>
                             @endif
                        </div>

                        <div class="bank_transfer_interface" style="display:none">
                        <form id="bank_transfer" method="post" action="{{route('bank_transfer_completed')}}">
                           @csrf
                          <input type="hidden" id="banK_transfer_app_id" name="banK_transfer_app_id" value="{{encrypt($application_details[0]->application_id)}}">
                        </form>

                        <a href="javascript:show_payment_options()" class="btn btn-sm btn-danger text-white "><i class="fa fa-times"></i> Cancel</a><br/><br/>
                        <p>Kindly make a bank transfer into our company's account number below and click the <strong>"I have made the transfer"</strong> button to complete transaction</p>
                        </div>

                        <div style="display:none" class="row bank_transfer_interface">
                           <div style="border-color: rgba(201, 76, 76, 0.3); border-style: solid;" align="center" class="col-md-12">
                             <p><strong>Bank Name</strong>: GT Bank</p>
                             <p><strong>Account Name</strong>: African Technical Training center</p>
                             <p><strong>Account No.</strong>: 0000000000</p>
                           </div>
                           <div>
                           <hr>
                           <div align="center">
                               <p> <font style="color:red; font-weight:bold">Note:</font> Kindly enter your Application ID (<strong>{{'ATTC-'.str_pad($application_details[0]->batch_id, 4, "0", STR_PAD_LEFT).'-'.$application_details[0]->application_id}}</strong>) on the transaction description, failure to do so will cause a delay in confirming your payment</p>
                               <button onclick="$('form#bank_transfer').submit()" class="btn btn-success"><i class="fa fa-check"></i> I have made the transfer</button>
                           </div>
                           
                        </div>
                    </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    
                </div>
            </div>
        </div>
    @endif


    @if(isset($psw))
        <!-- Modal Change First Password -->
        <div class="modal fade horizontal edit_area"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header" style="flex-direction: column !important; align-items: center !important; ">
                        <img src="{{asset('img/p1.gif')}}" /><br/>
                        <h3 class="modal-title text-primary" id="myModalLabel" style="text-align: center">Compulsory Password Change!</h3><br/>
                        <p style="text-align: justify">You are using the default password assigned during staff creation. Kindly enter your new password.<br/>
                            Ensure that your passwords are unique and are at least 6 characters long.
                        </p>
                    </div>

                    <div class="modal-body">
                        <form id="new_pass" action="" method="post">
                            {{  csrf_field()  }}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Password <span class="symbol required"></span>
                                        </label>
                                        <input name="password1" class="form-control" placeholder="Enter Password" type="password">
                                        <span class="text-danger error-message"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Repeat Password <span class="symbol required"></span>
                                        </label>
                                        <input name="password2" placeholder="Confirm Password" class="form-control check" type="password">
                                        <span class="text-danger error-message"></span>
                                    </div>
                                    <button type="submit" class="btn btn-o btn-primary save">
                                        Save Changes
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- / Modal Change First Password -->
    <!-- General Modal -->
    <div class="modal fade general_modal" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <!-- //End General Modal -->
@endsection

@section('additional_js')

   @if($fees_amount != 0) 
        <script src="https://js.paystack.co/v1/inline.js"></script>
        <script id="paystack"></script>
   @endif

  


    <script>

    

       @if($fees_amount != 0) 




       function pay_with_bank_transfer()
        {
            $(".bank_transfer_interface").show('fast');
            $(".payment_options").hide('fast');
        }

        function show_payment_options()
        {
            $(".bank_transfer_interface").hide('fast');
            $(".payment_options").show('fast');
        }

            $(".pay_acceptance_fee").modal
            (
                {
                    backdrop:'static',
                    keyboard:false
                }
            );

            $('body').on('click','a.pay_acceptance_fee_btn',function(e){
                e.preventDefault();
                var route = $(this).data("href");
                $.ajax(
                            {
                                type:"GET",
                                cache:false,
                                contentType:false,
                                processData:false,
                                url:route,
                                beforeSend:function()
                                {
                                    $('body').block();
                                },
                                error: function(r)
                                {
                                    $('body').unblock(); 
                                },
                                success: function(r)
                                {
                                    $('body').unblock();
                                    $('.pay_acceptance_fee').modal('hide');
                                    $('#paystack').html(r);
                                    payWithPaystack();
                                }
                            }

                        );
            });
        @endif

        jQuery(document).ready(function() {
            vex.defaultOptions.className = 'vex-theme-flat-attack';
            $('body').on('click','button[data-action]',function(e)
            {
                e.preventDefault();
                var no=$(this).data("id");
                var action=$(this).data("action");
                var the_route="{{route('application_level_approval')}}";
                if(action==2) {
                    vex.dialog.confirm({
                        unsafeMessage: `Irreversible process detected! <br/>Are you want to ${action == 2 ? 'APPROVE' : 'REJECT'} this application?`,
                        callback: function (value) {
                            if (value) {
                                $.ajax(
                                    {
                                        type: "GET",
                                        url: `${the_route}/${no}/${action}`,
                                        beforeSend: function () {
                                            $('div.modal-content').block();
                                        },
                                        success: function (r) {
                                            $('div.modal-content').unblock();
                                            vex.dialog.alert({
                                                unsafeMessage: `
                                  <div style="text-align: center">
                                    <img src="img/success.png" style="width:100px;height:100px; display: block; margin:0 auto; text-align:center" />
                                    Application has been approved!
                                    </div>
                                    `,
                                                className:'vex-theme-default'
                                            });

                                            setTimeout(function(){
                                                window.location.reload()
                                            },3000);
                                        }
                                    }
                                );
                            }
                        }
                    })
                }
                else{
                    vex.dialog.prompt({
                        message: 'Kindly enter specific reason for rejecting student:',
                        className:'vex-theme-flat-attack',
                        placeholder: 'enter reason',
                        callback: function (value) {
                            if (value) {
                                $.ajax(
                                    {
                                        type: "GET",
                                        data:{
                                            reason: value
                                        },
                                        url: `${the_route}/${no}/${action}`,
                                        beforeSend: function () {
                                            $('div.modal-content').block();
                                        },
                                        success: function (r) {
                                            $('div.modal-content').unblock();
                                            vex.dialog.alert({
                                                unsafeMessage: `
                                <div style="text-align: center">
                                    <img src="img/success.png" style="width:100px;height:100px; display: block; margin:0 auto; text-align:center" />
                                    Application has been rejected and applicant has been notified!
                                </div>
                                    `,
                                                className:'vex-theme-default'
                                            });

                                            setTimeout(function(){
                                                window.location.reload()
                                            },3000);
                                        }
                                    }
                                );
                            }
                            else{
                                vex.dialog.alert({
                                    unsafeMessage: `
                                    <div style="text-align: center">
                                    <img src="img/barred.png" style="width:100px;height:100px; display: block; margin:0 auto; text-align:center" />
                                    You must specify a reason for rejecting application
                                    </div>
                                    `,
                                    className:'vex-theme-default'
                                })
                            }
                        }
                    });
                }
            });

            @if($accept_offer_upload == false)
            $('body').on('click','button.save_offer_letter',function(e){
                e.preventDefault();
                var allowExt=['jpg','jpeg','pdf','png'];
                var filename= $("input[name='completed_offer_letter']").val();
                if(filename==""){
                    vex.dialog.alert({
                        unsafeMessage: `<div style="text-align: center"><img src="img/barred.png" style="width:100px;height:100px; display: block; margin:0 auto; text-align:center" />
                                    File is required</div>`,
                    });
                }
                else if(!allowExt.includes(filename.split('.')[1])){
                    vex.dialog.alert({
                        unsafeMessage: `<div style="text-align: center"><img src="img/barred.png" style="width:100px;height:100px; display: block; margin:0 auto; text-align:center" />
                                    The file doesn't meet file upload type requirements. Only pdfs and image formats are allowed</div>`,
                    });
                }
                else{
                    var formData = new FormData($('form#upload_offer')[0]);
                    $.ajax(
                        {
                            type:"POST",
                            data:formData,
                            url:"{{route('submit_offer_letter')}}",
                            cache:false,
                            contentType:false,
                            processData:false,
                            beforeSend:function()
                            {
                                $('form#upload_offer').block({ message: null });
                            },
                            error: function(r)
                            {
                                $('form#upload_offer').unblock();
                                vex.dialog.alert({
                                    unsafeMessage: `<div style="text-align: center"><img src="img/barred.png" style="width:100px;height:100px; display: block; margin:0 auto; text-align:center" />
                                    There were errors, please try again</div>`,
                                });
                            },
                            success: function(r)
                            {
                                $('form#upload_offer').unblock();
                                vex.dialog.alert({
                                    unsafeMessage: `<div style="text-align: center"><img src="img/success.png" style="width:100px;height:100px; display: block; margin:0 auto; text-align:center" />
                                    Uploaded successfully</div>`,
                                });
                                setTimeout(function(){
                                    vex.closeAll();
                                    $(".upload_offer_letter").modal('hide');
                                     window.location.reload();
                                },2000)
                            }

                        }
                    );
                }
            })
            @endif
            

            $('body').on('click','tr[data-id]',function(e)
            {
                e.preventDefault();
                var no=$(this).data("id");
                var the_route="{{url('/application_details/')}}";
                $.ajax(
                    {
                        type:"GET",
                        url:`${the_route}/${no}`,
                        beforeSend:function()
                        {
                            $('table').block();
                        },
                        success: function(r)
                        {
                            $('table').unblock();
                            $('div.modal-body').html(r);
                            $('.general_modal').modal({
                                backdrop: 'static',
                                keyboard: false
                            });
                        }
                    }
                );
            });

            if ($('#dataTable').length) {
                $('#dataTable').DataTable({
                    "scrollX": true
                });
            }
            //SOLVE BOOTSTRAP INPUT ISSUE
            $('.general_modal').on('shown.bs.modal', function() {
                $(document).off('focusin.modal');
            });

           

            @if($accept_offer_upload == false)
            $(".upload_offer_letter").modal
            (
                {
                    backdrop:'static',
                    keyboard:false
                }
            );
            @endif

            @if(isset($psw))
            $(".edit_area").modal
            (
                {
                    backdrop:'static',
                    keyboard:false
                }
            );

            $('form#new_pass').on('blur','input',(function(e)
            {
                var $this=$(this);
                if($.trim($this.val())!="")
                {
                    //validate
                    $this.next('span.error-message').html('');
                    $this.closest('div.form-group').removeClass('has-error');
                    $this.closest('div.form-group').addClass('has-success');
                }

            }));

            $('button.save').click(function(e){
                    e.preventDefault();
                    var formData = new FormData($('form#new_pass')[0]);
                    var password1=$.trim($("input[name='password1']").val());
                    var password2=$.trim($("input[name='password2']").val());
                    if(password1=="" || password2=="")
                    {
                        
                        
                    }

                    else if(password1==password2)
                    {

                        $.ajax(
                            {
                                type:"POST",
                                data:formData,
                                cache:false,
                                contentType:false,
                                processData:false,
                                url:"{{route('first_changepsw')}}",
                                beforeSend:function()
                                {
                                    $('form#new_pass').block();
                                },
                                error: function(r)
                                {
                                    $('form#new_pass').unblock();
                                    const errors = r.responseJSON.errors;
                                    //clear any previous errors
                                    $('span.error-message').html('');
                                    $('div.has-error').removeClass('has-error');
                                    $.each(errors,function(index,value)
                                        {
                                            $('input[name="'+index+'"]').next('span.error-message').html(''+value);
                                            $('input[name"'+index+'"]').closest('div.form-group').addClass('has-error');
                                        }
                                    );
                                },
                                success: function(r)
                                {
                                    $('.edit_area').modal('hide');
                                    $('form#new_pass').unblock();
                                   
                                    Swal.fire(
                                        'Awesome!',
                                        'New password successfully set!',
                                        'success'
                                    );
                                    $('span.error-message').html('');
                                    $('div.has-error').removeClass('has-error');
                                    $('div.has-success').removeClass('has-success');
                                    //clear all items
                                    $('form#new_pass')[0].reset();


                                }
                            }

                        );
                    }else
                    {
                        
                          Swal.fire(
                                        'Error',
                                        'Passwords must match',
                                        'error'
                                    );
                    }

                }
            );
            @endif
        });
    </script>
@endsection