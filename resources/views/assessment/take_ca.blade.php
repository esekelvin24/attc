@extends('../layouts.dash_layout')

@section('required_css')

@endsection


@section('content')


@if ($eligible_for_ca > 0)

	<div class="content-box">
		<div class="element-wrapper">
			<h6 class="element-header">
				Available assessment List (@if( $assessment_collection->isEmpty() ) 0 @else{{$assessment_collection->count()}}@endif)
			</h6>
			@if(Session::get('news_success'))
			<div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
				assessment Updated successfully!
			</div>
			<br/>
			@endif
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
					<table id="dataTable1" class="table table-striped" style="width: 100% !important;">
						<thead>
							<tr>
                               
								<th>Course Title</th>
								<th>Short Code</th>
								<th>Batch</th>
								<th>assessment Type</th>
								<th>assessment Status</th>
								<th>Start Date</th>
								<th>Start Time</th>
								<th>Expiration Date</th>
								<th>Expiration Time</th>
								
								
							</tr>
						</thead>
						<tfoot>
							<tr>
                               
								<th>Course Title</th>
								<th>Short Code</th>
								<th>Batch</th>
								<th>assessment Type</th>
								<th>assessment Status</th>
								<th>Start Date</th>
								<th>Start Time</th>
								<th>Expiration Date</th>
								<th>Expiration Time</th>
								<th></th>
							</tr>
						</tfoot>
						<tbody>
							@php
								
							@endphp
						@foreach($assessment_collection as $val)
							<tr>
								<td>{{$val->course_name}}</td>
								<td>{{$val->short_code}}</td>
								<td>{{$val->batch_id}}</td>

								@if($val->assessment_type == 1)
								  <td>1st assessment</td>
								@elseif($val->assessment_type == 2)
								<td>2nd assessment</td>
								@elseif($val->assessment_type == 3)
								  <td>3rd assessment</td>
							    @elseif($val->assessment_type == 4)
								  <td>4th assessment</td>
								@endif
								
								@if(substr($val->start_date,0,10)." ".$val->start_time < date('Y-m-d H:i:s')) {{-- Check if the test is opened --}}
								          @if(date('Y-m-d H:i:s') < substr($val->expiration_date,0,10)." ".$val->expiration_time)
								               <td style="color:green">Opened    </td>
										 @else
										       <td style="color:red">Expired </td>
										 @endif
								
								
								@else
								<td style="color:red">Closed </td>
								@endif

								<td>{{substr($val->start_date,0,10)}}</td>
								<td>{{$val->start_time}}</td>
								<td>{{substr($val->expiration_date,0,10)}}</td>
								<td>{{$val->expiration_time}}</td>
								
								@if(substr($val->start_date,0,10)." ".$val->start_time < date('Y-m-d H:i:s')) {{-- Check if the test is opened --}}
										@if(!isset($completed_assessment_collection[$val->assessment_id])) 
											
										   @if(date('Y-m-d H:i:s') < substr($val->expiration_date,0,10)." ".$val->expiration_time)
							                     <td><a href="{{route('take_ca_questions').'?id='.encrypt($val->assessment_id)}}" class="btn btn-info">Take C.A</a></td>
											@else
							                    <td></td>
										    @endif
										
										
										@else
											<td></td>
										@endif
								@else
									<td></td>	
								@endif

							</tr>

							
						@endforeach
						{{-- @foreach($pending_assessment_collection as $val)
							<tr>
								<td>{{$val->course_title}}</td>
								<td>{{$val->short_code}}</td>
								<td>{{$val->session_name}}</td>

								@if($val->assessment_type == 1)
								  <td>1st assessment</td>
								@elseif($val->assessment_type == 2)
								<td>2nd assessment</td>
								@elseif($val->assessment_type == 3)
								  <td>3rd assessment</td>
							    @elseif($val->assessment_type == 4)
								  <td>4th assessment</td>
								@else
								   <td></td>
								@endif

								<td>{{$val->status=="2"?"Close":"Open"}}</td>
								<td>{{substr($assessment_exp_date[$val->short_code],0,10)}}</td>
								<td>{{$assessment_exp_time[$val->short_code]}}</td>
								<td>{{$val->created_at}}</td>
								<td><a href="{{route('take_ca_questions').'?id='.base64_encode($val->assessment_id)}}" class="btn btn-success">Continue C.A</a></td>
							</tr>
						@endforeach --}}
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	@else
		<div align="center">
			<img width="150" height="150" src="{{asset('img/barred.png')}}" >
			<p> assessment is only available to students who has register for a course<p>
		</div>
    @endif






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

@section('required_js')
@endsection

@section('additional_js')
	<script>
	if ($('#dataTable1').length) {
	$('#dataTable1').DataTable({ buttons: ['copy', 'excel', 'pdf'] });
	}




	</script>
@endsection
