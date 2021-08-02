@extends('../layouts.dash_layout')

@section('required_css')

@endsection


@section('content')


@if ($eligible_for_ca > 0)

	<div class="content-box">
		<div class="element-wrapper">
			<h6 class="element-header">
				Available Assessment Result List (@if( $ca_collection->isEmpty() ) 0 @else{{$ca_collection->count()}}@endif)
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
                               <tr>
                                <th></th>
								<th>Course Title</th>
								<th>Short Code</th>
								<th>Batch</th>
								<th>Score</th>
								<th>Total Question</th>
								<th>Status</th>
								<th>Started At</th>
								<th>Ended At</th>
								
								
							</tr>
								
							</tr>
						</thead>
						<tfoot>
							<tr>
                                <th></th>
								<th>Course Title</th>
								<th>Short Code</th>
								<th>Batch</th>
								<th>Score</th>
								<th>Total Question</th>
								<th>Status</th>
								<th>Started At</th>
								<th>Ended At</th>
								
								
							</tr>
						</tfoot>
						<tbody>
							@php
							$counter = 0;
						    @endphp
						@foreach($ca_collection as $val)
							<tr>
                                <td>{{$counter=$counter+1}}</td>
								<td>{{$val->course_name}}</td>
								<td>{{$val->short_code}}</td>
								<td>{{$val->batch_name}}</td>

								@if($val->finished_ca == 1)
									<td>{{$val->score}}</td>
									<td>{{$val->total_questions}}</td>

									@if ($val->assessment_status == 1)
									<td style="color:green">Passed</td>
									@else
										<td style="color:red">Failed</td>
									@endif
								@else
                                    <td></td>
									<td></td>
									<td></td>

								@endif

								<td>{{$val->assessment_created_at}}</td>
								<td>{{$val->completed_at}}</td>
								

							</tr>

							
						@endforeach
						
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
