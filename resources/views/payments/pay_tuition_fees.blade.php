@extends('../layouts.dash_layout')

@section('required_css')

@endsection


@section('content')
	<div class="content-box">
		<div class="element-wrapper">
			<h6 class="element-header">
				All Tuition Fees Payment (@if( $tuition_fees_collection->isEmpty() ) 0 @else{{$tuition_fees_collection->count()}}@endif)
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
                                         <th>APPLICANTION ID</th>
                                        <th>PROGRAMME NAME</th>
                                        <th>AMOUNT</th>
                                        <th>CREATED AT</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th style="width:10px">S/N</th>
                                        
                                        <th>APPLICANTION ID</th>
                                        <th>PROGRAMME NAME</th>
                                        <th>AMOUNT</th>
                                        <th>CREATED AT</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($tuition_fees_collection as $k=>$val)
                                        <tr>
                                            <td style="width:10px">{{$k+1}}</td>
                                           
                                            <td>{{'ATTC-'.str_pad($val->batch_id, 4, "0", STR_PAD_LEFT).'-'.$val->application_id}}</td>
                                             <td>{{$val->programme_name}}</td>
                                            <td>₦{{number_format($val->course_price,2)}}</td>
                                            <td>{{$val->created_at}}</td>
                                            <td>@if($val->payment_status == 3) <font class="text-warning"><i class="fa fa-loading"></i> On Hold</font>@elseif($val->payment_status == 0) <font class="text-info"><i class="fa fa-loading"></i> Pending</font>@elseif($val->payment_status == 1) <font class="text-success"><i class="fa fa-check"></i> Paid</font>@elseif($val->payment_status == 2) <font class="text-danger"><i class="fa fa-times"></i> Cancelled</font>@endif</td>
                                            <td>@if($val->payment_status == 0)<button onclick="pay_now('{{route("payment",["type"=> encrypt(1), "id" =>encrypt($val->application_id)])}}','N{{number_format($val->course_price,2)}}','{{encrypt($val->application_id)}}','{{'ATTC-'.str_pad($val->batch_id, 4, "0", STR_PAD_LEFT).'-'.$val->application_id}}')" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Pay Now</button> @endif</td>
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