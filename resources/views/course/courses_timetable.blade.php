@extends('../layouts.dash_layout')

@section('required_css')

@endsection



@section('content')
	<div class="content-box">
		<div class="element-wrapper">
			<h6 class="element-header">
				All  Timetable List (@if( $course_collection->isEmpty() ) 0 @else{{$course_collection->count()}}@endif)
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


					@if(Auth::user()->can('create-timetable'))
                       <button id="new_timetable" class="btn btn-info text-white" style="background:#1F1D5E;margin-bottom: 15px;"><i class="fa fa-plus"></i> Add New Timetable</button>
					@endif
					<form method="GET" action="">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label for="course_id">Programme</label>
								<select  autocomplete="off" class="form-control" id="programme_id"  name="programme_id">
									<option value="" >--All Programmes--</option>
									@if(!$programme_collection->isEmpty())
										@foreach($programme_collection as $val)
											<option {{$selected_programme==$val->programme_id?"selected":""}} value="{{ encrypt($val->programme_id) }}">{{ $val->programme_name }}</option>
										@endforeach
									@endif
								</select>
							</div>
						</div>
						
						<div class="col-md-3 col-sm-12">
							<button style="margin-top:27px; margin-bottom:25px" class="btn btn-success"><i class="fa fa-filter"></i> Filter</button>
						</div>
                    </div>
					</form>
					<table id="dataTable1" class="table table-striped" style="width: 100% !important;">
						<thead>
							<tr>
                                @if(Auth::user()->can('edit-courses'))
								<th></th>
                                @endif
								<th>S/N</th>
								<th>Course</th>
								<th>Last Modify</th>
								<th></th>
							</tr>
						</thead>
						<tfoot>
							<tr>
                                @if(Auth::user()->can('edit-courses'))
								<th></th>
                                @endif
								<th>S/N</th>
								<th>Course</th>
								<th>Last Modify</th>
								<th></th>
							</tr>
						</tfoot>
						<tbody>
						@php
							$counter = 0;
						@endphp
						@foreach($course_collection as $val)
							<tr>
                                @if(Auth::user()->can('edit-courses'))
								<td>
                                <i title="Edit {{ $val->course_name }}" style="cursor: pointer" data-id="{{ encrypt($val->course_id) }}" class="fa fa-edit"></i>
								</td>
								@endif
								<th>{{$counter = $counter + 1}}</th>
								<td>{{$val->course_name}}</td>
								<td>{{$val->created_at}}</td>
								<td><a target="_blank" href="{{url('/course_timetable_details/'.encrypt($val->course_id))}}" class="btn btn-sm btn-warning text-black"><i class="fa fa-eye"></i> View Timetable</a></td>
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




	 @if(Auth::user()->can('create-timetable'))
          $("#new_timetable").click(function()
		  {
                var toks=$("input[name='_token']").val();
             $.ajax(
					{
						type:"POST",
						data:{ _token:toks},
						url:"{{ route('new_timetable') }}",
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

	$('body').on('click','i[data-id]',function(e)//fetching edit form from the server
			{
				e.preventDefault();

				var no=$(this).data("id");
				//alert(no);
				var toks=$("input[name='_token']").val();
                @if(Auth::user()->can('edit-courses'))
				$.ajax(
						{
							type:"POST",
							data:{id:no, _token:toks},
							url:"{{ route('course_edit') }}",
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
