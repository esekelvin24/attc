@extends('../layouts.dash_layout')

@section('required_css')

@endsection

  @php
       $days = [
        7 => 'Sunday',
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday'
    ];
   @endphp

   <style>
    .show-calendar
    {
        left: 0 !important;
         right: 0 !important;
    }

   </style>

@section('content')
	<div class="content-box">
		<div class="element-wrapper">
			<h6 class="element-header">
				All Classes (@if( $time_table_list->isEmpty() ) 0 @else{{$time_table_list->count()}}@endif)
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
					<form id="form_one">
                        <div class="row">
                            <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="short_code">
                                            Date Range <span class="symbol required font"></span>
                                        </label>
                                        <input  autocomplete="off" class="form-control my_date" id="date_range" name="date_range"  >
                                        <span class="text-danger error-message here"></span>
                                    </div>
                            </div>

                              <div style="padding-top:30px" class="col-md-3">
                                    <div class="form-group">
                                        <label for="short_code">
                                        <input type="submit" value="Filter" class="btn btn-sm btn-success" >
                                    </div>
                               </div>
                        </div>
                    </form>


                    <div class="row" style="border: outset #202076; margin-bottom:10px;">
                       <div class="col-md-1"><strong>From:</strong></div>  <div class="col-md-2"> {{date('d M Y',strtotime($start))}} </div> <div class="col-md-1"><strong>To:</strong> </div>  <div class="col-md-2"> {{date('d M Y',strtotime($end))}} </div>
                    </div>

					 <table id="dataTable" class="table table-striped" style="width: 100% !important; table-layout: fixed;">
                                    <thead>
                                    <tr>
                                       @if(Auth::user()->can('edit-timetable'))
                                       <th></th>
                                       @endif
                                        <th style="width:10px">S/N</th>
                                        <th>DATE</th>
                                        <th>DAY</th>
                                        <th>COURSE NAME</th>
                                        <th>TIME START</th>
                                        <th>TIME END</th>
                                        <th>ZOOM LINK</th>
                                        <th align="center">ZOOM ID</th>
                                        <th align="center">ZOOM PASS</th>
                                         @if(Auth::user()->can('edit-timetable'))
                                         <th></th>
                                         @endif
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                       @if(Auth::user()->can('edit-timetable'))
                                       <th></th>
                                       @endif
                                        <th style="width:10px">S/N</th>
                                        <th>DATE</th>
                                        <th>DAY</th>
                                        <th>COURSE NAME</th>
                                        <th>TIME START</th>
                                        <th>TIME END</th>
                                        <th>ZOOM LINK</th>
                                        <th align="center">ZOOM ID</th>
                                        <th align="center">ZOOM PASS</th>
                                         @if(Auth::user()->can('edit-timetable'))
                                         <th></th>
                                         @endif
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @if(count($time_table_list))
                                    @foreach($time_table_list as $k=>$val)
                                        <tr >
                                        
                                            @if(Auth::user()->can('edit-timetable'))
                                            <td>
                                            <i title="Edit {{ $val->id }}" style="cursor: pointer" data-id="{{ encrypt($val->id) }}" class="fa fa-edit"></i>
                                            </td>
                                            @endif
                                            <td style="width:10px">{{$k+1}}</td>
                                             <td>{{date('d M Y',strtotime($val->lecture_date))}}</td>
                                            <td>{{$days[$val->day]}}</td>
                                            <td>{{$val->course_name}}</td>
                                            <td>{{$val->start_time}}</td>
                                            <td>{{$val->end_time}}</td>
                                            
                                           
                                            @if($val->zoom_link=="")
                                            <td class="text-danger"> Unavailable</td>
                                            @else
                                             <td><a target="_blank" href="{{$val->zoom_link}}">{{$val->zoom_link}}</a></td>
                                            @endif

                                            @if($val->zoom_id=="")
                                            <td align="center" class="text-danger"> Unavailable</td>
                                            @else
                                             <td> {{$val->zoom_id}}</td>
                                            @endif

                                             @if($val->zoom_password=="")
                                             <td align="center" class="text-danger"> Unavailable</td>
                                             @else
                                             <td> {{$val->zoom_password}}</td>
                                             @endif

                                              @if(Auth::user()->can('edit-timetable'))
                                              <td><button onclick="process_delete('1','{{encrypt($val->id)}}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button> </td>
                                              @endif

                                           
                                        </tr>
                                    @endforeach
                                    @endif
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
 function process_delete(action, timetable_id)
           {

               var action_message = "";

               if(action == 1)
               {
                   action_message = "Deleted";
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
                                            data:{ _token:toks, action:action, timetable_id:timetable_id },
                                            url:"{{ route('delete_timetable') }}",
                                            beforeSend:function()
                                            {
                                                $('table').block({ message: "Please wait.." });
                                            },
                                            success: function(r)
                                            {
                                                $('table').unblock();
                                                if (r == 1)
                                                {
                                                Swal.fire('Success','Timetable has been deleted successful','success');
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
});

     
           }











        jQuery(document).ready(function() {
            vex.defaultOptions.className = 'vex-theme-flat-attack';
        });


         $('.my_date').daterangepicker({
			
			singleDatePicker: false,
			locale: {
				format: "YYYY-MM-DD"
			}
			});
        $('.my_date').val('{{$start." - ".$end}}') ;

        
         
	$('body').on('click','i[data-id]',function(e)//fetching edit form from the server
			{
				e.preventDefault();

				var no=$(this).data("id");
				//alert(no);
				var toks=$("input[name='_token']").val();
                @if(Auth::user()->can('edit-timetable'))
				$.ajax(
						{
							type:"POST",
							data:{id:no, _token:toks},
							url:"{{ route('timetable_edit') }}",
							beforeSend:function()
							{
								$('table').block({ message: null });
								$('div.modal-body').attr("data-print",no);
							},
							success: function(r)
							{
								$('table').unblock();
								$('div.modal-body').html(r);
								$('.edit_area').modal(
										{
											backdrop: 'static',
											keyboard: false
										});

							}
						}

				);

				@endif
			});

        

    </script>
@endsection