@extends('../layouts.dash_layout')

@section('required_css')

@endsection


@section('content')
	<div class="content-box">
		<div class="element-wrapper">
			<h6 class="element-header">
				All Assessment List (@if( $assessment_collection->isEmpty() ) 0 @else{{$assessment_collection->count()}}@endif)
			</h6>

			@if(Session::get('assessement_success'))
			<div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
				{{Session::get('assessement_success')}}
			</div>
			<br/>
			@endif

			@if(Session::get('ca_error'))
			<div class="alert alert-danger" style="margin-top:3px; margin-bottom:0">
				{{Session::get('ca_error')}}
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
					@if(Auth::user()->can('create-assessment'))
					<button id="new_assessment" class="btn btn-info text-white" style="background:#1F1D5E; margin-bottom: 15px;"><i class="fa fa-plus"></i> Create Assessment</button>
					@endif

					<table id="dataTable1" class="table table-striped" style="width: 100% !important;">
						<thead>
							<tr>
                                @if(Auth::user()->can('edit_assessement'))
								<th></th>
                                @endif
								<th>Course Title</th>
								<th>Short Code</th>
								<th>Batch No</th>
								<th>Assessement Type</th>
								<th>Start Date</th>
								<th>Start Time</th>
								<th>Expiration Date</th>
								<th>Expiration Time</th>
								<th></th> 
								<th></th>
								
							</tr>
						</thead>
						<tfoot>
							<tr>
                                 @if(Auth::user()->can('edit_assessement'))
								<th></th>
                                @endif
								<th>Course Title</th>
								<th>Short Code</th>
								<th>Batch No</th>
								<th>Assessement Type</th>
								{{-- <th>Assessement Status</th> --}}
								{{-- <th>Show Results</th> --}}
								<th>Start Date</th>
								<th>Start Time</th>
								<th>Expiration Date</th>
								<th>Expiration Time</th>
								<th></th>
								<th></th>
							</tr>
						</tfoot>
						<tbody>
							
						@foreach($assessment_collection as $val)
							<tr>
                                 @if(Auth::user()->can('edit_assessement'))
								<td>

										<i title="Edit Assessement weight" style="cursor: pointer" data-id="{{ encrypt($val->assessment_id) }}" class="fa fa-edit"></i>
								</td>
                                @else
                                    {{--<td>
                                    <i title="View More info of {{ $val->firstname." ".$val->lastname }}" style="cursor: pointer" data-id="{{ $val->id }}" class="fa fa-eye"></i>
                                    </td>--}}
                                @endif
								
								<td>{{$val->course_name}}</td>
								<td>{{$val->short_code}}</td>
								<td>{{$val->batch_id}}</td>

								@if($val->assessment_type == 1)
								  <td>1st Assessment</td>
								@elseif($val->assessment_type == 2)
								<td>2nd Assessment</td>
								@elseif($val->assessment_type == 3)
								  <td>3rd Assessment</td>
							    @elseif($val->assessment_type == 4)
								  <td>4th Assessment</td>
								@endif

								<td>{{substr($val->start_date,0,10)}}</td>
								<td>{{$val->start_time}}</td>
								<td>{{substr($val->expiration_date,0,10)}}</td>
								<td>{{$val->expiration_time}}</td>
								@if(Auth::user()->can('edit_assessement'))
								<td><button onclick="add_student_to_assessment('{{encrypt($val->assessment_id)}}')" class="text-white btn-success btn-sm btn"><i class="fa fa-users"></i> Add Students</button></td>
								<td><a href="{{url('student_ca_result/'.encrypt($val->assessment_id).'/'.encrypt($val->course_id))}}" class="text-black btn-warning btn-sm btn"><i class="fa fa-eye"></i> Student Result</a></td>
                                
							    @else
                                <td></td>
								@endif
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
     @if(Auth::user()->can('create-assessment'))
          $("#new_assessment").click(function()
		  {
             var toks=$("input[name='_token']").val();
             $.ajax(
					{
						type:"POST",
						data:{ _token:toks},
						url:"{{ route('add_new_assessment') }}",
						beforeSend:function()
						{
							$('table').block({ message: null });
						},
						success: function(r)
						{
							$('table').unblock();
							$('div.modal-body').html(r);
							$('.edit_area').modal({
										backdrop: 'static',
										keyboard: false
							});

						}
					}
			);
		  });
		  @endif


    function add_student_to_assessment(assessment_id)
	{
		var no = assessment_id;
		var toks=$("input[name='_token']").val();

         $.ajax(
						{
							type:"POST",
							data:{id:no, _token:toks},
							url:"{{ route('get_assessment_student_list') }}",
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
	}



	if ($('#dataTable1').length) {
	$('#dataTable1').DataTable({ buttons: ['copy', 'excel', 'pdf'] });
	}

	$('body').on('click','i[data-id]',function(e)
			{
				e.preventDefault();

				var no=$(this).data("id");
				var toks=$("input[name='_token']").val();

				$.ajax(
						{
							type:"POST",
							data:{id:no, _token:toks},
							 @if(Auth::user()->can('edit_assessement'))
							url:"{{ route('edit_assessment') }}",
							@else
							url:"{{ route('edit_assessment') }}",
							@endif
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
