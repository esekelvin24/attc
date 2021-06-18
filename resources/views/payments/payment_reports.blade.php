@extends('../layouts.dash_layout')

@section('required_css')

@endsection


@section('content')
	<div class="content-box">
		<div class="element-wrapper">
			<h6 class="element-header">
				All Payments (@if( $payment_collections->isEmpty() ) 0 @else{{$payment_collections->count()}}@endif)
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

					<form method="GET" action="">
					<div class="row">
						<div class="col-md-3 col-sm-12">
							<div class="form-group">
								<label for="course_id">Payment Type</label>
								<select  autocomplete="off" class="form-control" id="payment_type"  name="payment_type">
									<option value="" >--All Payments--</option>
									<option {{$payment_type==1?"selected":""}} value="1" >Fees</option>
                                    <option {{$payment_type==2?"selected":""}} value="2" >Accomodation</option>
								</select>
							</div>
						</div>
						<div class="col-md-3 col-sm-12">
							<div class="form-group">
								<label for="course_id">Payment Method</label>
								<select  autocomplete="off" class="form-control" id="payment_method"  name="payment_method">
									 <option value="" >--All Methods--</option>
                                     <option {{$payment_method==1?"selected":""}} value="1" >Card</option>
                                     <option {{$payment_method==2?"selected":""}} value="2" >Bank Transfer</option>
								</select>
							</div>
						</div>
						<div class="col-md-3 col-sm-12">
							<button style="margin-top:27px; margin-bottom:25px" class="btn btn-success"><i class="fa fa-filter"></i> Filter</button>
						</div>
                    </div>
					</form>

					 <table id="dataTable" class="table table-striped" style="width: 100% !important; table-layout: fixed;">
                                    <thead>
                                    <tr>
                                        
                                        <th style="width:10px">S/N</th>
                                       
                                        <th>Application ID</th>
                                        <th>Payment Type</th>
                                        <th>Reference No</th>
                                        <th>Amount</th>
                                        <th>Payment Method</th>
                                        <th>Created at</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th style="width:10px">S/N</th>
                                       
                                        <th>Application ID</th>
                                        <th>Payment Type</th>
                                        <th>Reference No</th>
                                        <th>Amount</th>
                                        <th>Payment Method</th>
                                        <th>Created at</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($payment_collections as $k=>$val)
                                        <tr>
                                            <td style="width:10px">{{$k+1}}</td>
                                            
                                            <td>{{'ATTC-'.str_pad($val->batch_id, 4, "0", STR_PAD_LEFT).'-'.$val->application_id}}</td>
                                            <td>{{$val->payment_type==1?"Fees":"Accomodation"}}</td>
                                            <td>{{$val->ref}}</td>
                                            <td>₦{{number_format($val->amount,2)}}</td>
                                            <td>{{$val->payment_type==1?"Card":"Bank Transfer"}}</td>
                                            <td>{{$val->created_at}}</td>
                                            <td>@if($val->paystack_status=="success")<font class="text-success"> Successful </font> @elseif($val->paystack_status=="99") <font class="text-warning"> Pending Bank Transfer </font>   @else <font class="text-danger"> Failed </font>  @endif</td>
                                           
                                            <td></td>
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

    function pay_now(data_href,course_price, application_id, complete_app_id)
    {
       
        $("#fees_modal_amt").html(course_price);   //set the modal form price

        @if(Auth::user()->can('pay-with-debit-card'))
            $("#pay_with_card").attr("data-href",data_href); //Set The link of pay with card
        @endif

        @if(Auth::user()->can('pay-with-bank-transfer'))
              $("#banK_transfer_app_id").val(application_id);//input field
              $("#complete_app_id").html(complete_app_id); //set the bank transfer application ID
        @endif

        $(".pay_acceptance_fee").modal
            (
                {
                    backdrop:'static',
                    keyboard:false
                }
            );

    }

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

           /* if ($('#dataTable').length) {
                $('#dataTable').DataTable({
                    "scrollX": true
                });
            }*/
            //SOLVE BOOTSTRAP INPUT ISSUE
            $('.general_modal').on('shown.bs.modal', function() {
                $(document).off('focusin.modal');
            });


            
      
    </script>
@endsection