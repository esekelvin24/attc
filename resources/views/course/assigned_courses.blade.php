@extends('../layouts.dash_layout')

@section('required_css')

@endsection



@section('content')
	<div class="content-box">
		<div class="element-wrapper">
			<h6 class="element-header">
				All Assigned Courses List (@if( $course_collection->isEmpty() ) 0 @else{{$course_collection->count()}}@endif)
			</h6>
			@if(Session::get('course_success'))
			<div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
				News Updated successfully!
			</div>
			<br/>
			@endif

			@if(Session::get('course_error'))
			<div class="alert alert-error" style="margin-top:3px; margin-bottom:0">
				An error occurred when performing updates!
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
                               
								<th>S/N</th>
								<th>Programme</th>
								<th>Course</th>
								<th></th>
							
							</tr>
						</thead>
						<tfoot>
							<tr>
                               
								<th>S/N</th>
								<th>Programme</th>
								<th>Course</th>
								<th></th>
								
							</tr>
						</tfoot>
						<tbody>
						@php
							$k = 0;
						@endphp
						@foreach($course_collection as $val)
							<tr>
                                
								<td>
								  {{$k = $k + 1}}
								</td>
								
								<td>{{$val->programme_name}}</td>
								<td>{{$val->course_name}}</td>
								<td><a href="{{url('/my_students?course_id='.encrypt($val->course_id))}}" class="btn btn-warning btn-sm"><i class="fa fa-users"></i> View Students</a></td>
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
