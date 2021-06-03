@extends('../layouts.dash_layout')

@section('required_css')

@endsection


@section('content')
	<div class="content-box">
		<div class="element-wrapper">
			<h6 class="element-header">
				All Bank Transfer (@if( $bank_transfer_collections->isEmpty() ) 0 @else{{$bank_transfer_collections->count()}}@endif)
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
                                        <th>STUDENT NAME</th>
                                        <th>APPLICANTION ID</th>
                                        <th>CREATED AT</th>
                                         <th>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th style="width:10px">S/N</th>
                                        <th>STUDENT NAME</th>
                                        <th>APPLICANTION ID</th>
                                        <th>CREATED AT</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($bank_transfer_collections as $k=>$val)
                                        <tr>
                                            <td style="width:10px">{{$k+1}}</td>
                                            <td><strong>{{$val->firstname.' '.$val->lastname}}</strong></td>
                                            <td>{{'ATTC-'.str_pad($val->batch_id, 4, "0", STR_PAD_LEFT).'-'.$val->application_id}}</td>
                                            <td>{{$val->creation_date}}</td>
                                            <td><button onclick="process_bank_transfer('1','{{encrypt($val->application_id)}}')" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Confirm</button> | <button onclick="process_bank_transfer('2','{{encrypt($val->application_id)}}')" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Reject</button> </td>
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
       
           function process_bank_transfer(action, application_id)
           {

               var action_message = "";

               if(action == 1)
               {
                   action_message = "Confirmed";
               }else
               {
                   action_message = "Rejected";
               }

Swal.fire({
  title: "Once "+action_message+", you will not be able to undo the process",
  //showDenyButton: true,
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: `Yes Proceed`,
  denyButtonText: `No`,
  customClass: {
    cancelButton: 'order-1 right-gap',
    confirmButton: 'order-2',
    denyButton: 'order-3',
  }
}).then((result) => {
  if (result.isConfirmed) {
   
       var toks='{{Session::token()}}';
             $.ajax(
					{
						type:"POST",
						data:{ _token:toks, action:action, application_id:application_id },
						url:"{{ route('save_confirm_bank_transfer') }}",
						beforeSend:function()
						{
							$('table').block({ message: "Please wait.." });
						},
						success: function(r)
						{
                            $('table').unblock();
                            if (r == 1)
                            {
                              Swal.fire('Success','Payment confirmation was successful','success');
                            }else if (r == 2)
                            {
                               Swal.fire('Success','Payment has been rejected','success');
                            }else if (r == 4)
                            {
                               Swal.fire('Error!','No Record Found','error');
                            }
                            else
                            {
                                Swal.fire('Error!','An error occured','error');
                            }

							setTimeout(function(){
                                            window.location.reload();
                                        },3000);
						}
					}
			);
    
  } 
})

     
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

            if ($('#dataTable').length) {
                $('#dataTable').DataTable({
                    "scrollX": true
                });
            }
            //SOLVE BOOTSTRAP INPUT ISSUE
            $('.general_modal').on('shown.bs.modal', function() {
                $(document).off('focusin.modal');
            });


            
      
    </script>
@endsection