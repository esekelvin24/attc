@extends('../layouts.dash_layout')

@section('required_css')

@endsection


@section('content')
	<div class="content-box">
		<div class="element-wrapper">
			<h6 class="element-header">
				All My Application (@if( $all_application_collection->isEmpty() ) 0 @else{{$all_application_collection->count()}}@endif)
			</h6>
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
                                        
                                        <th>PROGRAMME</th>
                                        <th>AMOUNT</th>
                                        <th>APPLIED ON</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th style="width:10px">S/N</th>
                                        <th>STATUS</th>
                                       
                                        <th>PROGRAMME</th>
                                         <th>AMOUNT</th>
                                        <th>APPLIED ON</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($all_application_collection as $k=>$val)
                                        <tr data-id="{{encrypt($val->application_id)}}" style="cursor: pointer">
                                            <td style="width:10px">{{$k+1}}</td>
                                            <td>
                                                @if($val->action_1_status==0) <strong class="text-info"><i class="fa fa-spinner"></i> Pending </strong>@elseif($val->action_1_status==1) <strong class="text-success"><i class="fa fa-check"></i> Approved </strong>  @elseif($val->action_1_status==2)<strong class="text-danger"><i class="fa fa-times"></i> Rejected </strong>  @endif
                                            </td>
                                           
                                            <td>{{$val->programme_name}}</td>
                                            <td>₦{{number_format($val->programme_total_amt,2)}}</td>
                                            <td>{{date('d-m-y h:m A',strtotime($val->created_at))}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                    </table>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade edit_area" role="dialog">
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
	<!-- //End Modal -->


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

@section('required_js')
@endsection


@section('additional_js')
    <script>
        jQuery(document).ready(function() {
            vex.defaultOptions.className = 'vex-theme-flat-attack';
           /* $('body').on('click','button[data-action]',function(e)
            {
                e.preventDefault();
                var no=$(this).data("id");
                var action=$(this).data("action");
                var the_route="{{route('application_level_approval')}}";
                if(action==1) {
                    vex.dialog.confirm({
                        unsafeMessage: `Irreversible process detected! <br/>Are you want to ${action == 1 ? 'APPROVE' : 'REJECT'} this application?`,
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
*/
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
                            url:"",
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
                                },2000)
                            }

                        }
                    );
                }
            })

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

           
            //SOLVE BOOTSTRAP INPUT ISSUE
            $('.general_modal').on('shown.bs.modal', function() {
                $(document).off('focusin.modal');
            });

            @if(isset($offer_letter_set) && $offer_letter_set==false)
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
                        
                         Swal.fire(
                                        'error!',
                                        'All fields are compulsory',
                                        'error'
                                    );
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
                                    Swal.fire("Awesome!","New password successfully set!","success");
                                    
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
                        
                        Swal.fire("Error","Passwords must match","error");
                    }

                }
            );
            @endif
        });
    </script>
@endsection