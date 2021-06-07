@extends('../layouts.dash_layout')

@section('required_css')
@endsection


@php

use App\Http\Controllers\Utilities;
	
function get_grade($score)
{
   if ($score < 40)
   {
	  return "F";
   }else if ($score >= 40 && $score < 50)
   {
	   return "D";
   }else if ($score >= 50 && $score < 60)
   {
	   return "C"; 
   }else if ($score >= 60 && $score < 70)
   {
      return "B"; 
   }else if ($score >= 70)
   {
	 return "A"; 
   }
}

$shw_result = Utilities::get_result_display();



@endphp

@section('content')
    <div class="content-box">
		
		@if(Session::get('assessement_success'))
		<div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
			{{Session::get('assessement_success')}}
		</div>
        @endif

        @if(Session::get('ca_error'))
		<div class="alert alert-danger" style="margin-top:3px; margin-bottom:0">
			{{Session::get('ca_error')}}
		</div>
		@endif

		@if ($eligible_for_ca > 0)
		<div class="row" style="background:white; padding:20px">
			
						<div class="col-sm-12">
								
							<h4>Student Transcript Web View</h4>
							<hr>

							<div align="center">
								<u><h5>Guide to your result</h5></u>
							</div>
							<br/>

							<table style="width:100%">
								<tr>
								<td style="width:50%; font-size:17px; color:#201e5f" align="right"><strong>Name:</strong></td> <td style="width:50%" align="left"> {{$application_collection->firstname." ".$application_collection->middlename." ".$application_collection->lastname}}</td>
								</tr>

								
								<tr>
									<td align="right" style="width:50%; font-size:17px; color:#201e5f" align="right"><strong>Programme Type:</strong></td> <td align="left"> {{$application_collection->programme_type==1?"Cross Boarder":"Distance Learning"}}</td>
								</tr>

								<tr>
								<td align="right" style="width:50%; font-size:17px; color:#201e5f" align="right"><strong>Programme:</strong></td> <td align="left"> {{$application_collection->name}}</td>
								</tr>

								
							</table>

							<div align="center" style="margin-top:15px; padding:15px; border-style:solid" class="">

								<p>
									Overall Progression Decision for the Year (only applicable to undergraduate new entrants from
								January 2020 onwards)
								</p>
								

							</div>

							<br/>
							<table class="table">
								<thead>
									<th> Session </th>
									<th> Short Code </th>
									<th> Course Title </th>
									<th> Course Weight</th>
									<th> Mark  </th>
									<th> Grade </th>
									<th>  Attempt </th>
									<th></th>
								</thead>

								<tbody>
								@if(count($course_collection) > 0)
									
									@foreach($course_collection as $val)
										<tr>
											@php
												$mark = $val->ca1 + $val->ca2 + $val->ca3 + $val->ca4 + $val->exam;
												
											@endphp
												<td>{{$val->session_name}}</td>
												<td>{{$val->course_short_code}}</td>
												<td>{{$val->course_title}}</td>
												<td>{{$val->course_unit}}</td>

                                               @if ($shw_result[$val->session_id] == 1)
												   <td>{{$mark."%"}}</td>
												   <td>{{get_grade($mark)}}</td>
											   @else
                                                   <td></td>
												   <td></td>
											   @endif


												<td>{{$val->course_status==0?"":$attempt_array[$val->course_short_code]}}</td>
										<td><a data-userid="{{base64_encode($user_id)}}" data-shortcode="{{ base64_encode($val->course_short_code) }}" class="btn btn-info" href="javascript:void(0)">Details<a></td>
										</tr>
									@endforeach
                                  @endif

								</tbody>

							</table>
				<hr>

				<br/>

							<table style="width: 100%">
								<tr>
									<td style="font-size:18px"> <strong>Award Title</strong> </td>
									<td style="font-size:18px"> <strong>Classification </strong></td>
								</tr>
								<tr>
									<td>  </td>   <!-- Computer Sci  -->
									<td>  </td> <!-- First Class  -->
								</tr>

							</table>
				<br/>
				<br/>
						<div style="font-size:19px">
								Indirectly funded students and short course students will not be able to see their transcript.
								Please consult your local administrator for further details.
								If you have any technical queries about your transcript please complete our <a href="">queries form</a>
						</div>


					 </div>
		</div>

		@else
					<div align="center">
						<img width="150" height="150" src="{{asset('_img/barred.png')}}" >
						<p> Result is only available to students who has done course registration<p>
					</div>

		@endif

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
@endsection


@section('additional_js')
    <script>
			$('#expiration_date').daterangepicker({
			
			singleDatePicker: true,
			locale: {
				format: "YYYY-MM-DD"
			}
			});

			$(document).ready(function(){

			$('#expiration_time').mdtimepicker(
				{
					format:'hh:mm',
					theme:'blue'
				}
			); //Initializes the time picker	
			});	



			$('body').on('click','a[data-userid]',function(e)
			{

				e.preventDefault();

				var no=$(this).data("id");
				var toks=$("input[name='_token']").val();

				$.ajax(
						{
							type:"POST",
							data:{userid:$(this).data("userid"), shortcode: $(this).data("shortcode") , _token:toks},
							url:"{{ route('dynamic_check_result_details') }}",
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
			});	
	</script>
@endsection
