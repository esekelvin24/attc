@extends('../layouts.dash_layout')

@section('required_css')

@endsection



@section('content')
	<div class="content-box">
		<div class="element-wrapper">
			<h6 class="element-header">
				All Programme List (@if( $programme_collections->isEmpty() ) 0 @else{{$programme_collections->count()}}@endif)
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

					@if(Auth::user()->can('create-programme'))
                       <button id="new_programme" class="btn btn-info text-white" style="background:#1F1D5E;margin-bottom: 15px;"><i class="fa fa-plus"></i> Add New Programme</button>
					@endif

					<table id="dataTable1" class="table table-striped" style="width: 100% !important;">
						<thead>
							<tr>
                                @if(Auth::user()->can('edit-programme'))
								<th></th>
                                @endif
								
								<th>Programme</th>
								
								<th>Created at</th>
								<th></th>
								<!-- <th>Status</th> --->
							</tr>
						</thead>
						<tfoot>
							<tr>
                                @if(Auth::user()->can('edit-programme'))
								<th></th>
                                @endif
								<th>Programme</th>
								<th>Created at</th>
								<th></th>
							</tr>
						</tfoot>
						<tbody>
						@foreach($programme_collections as $val)
							<tr>
                                @if(Auth::user()->can('edit-programme'))
								<td>
										<i title="Edit {{ $val->programme_name }}" style="cursor: pointer" data-id="{{ encrypt($val->programme_id) }}" class="fa fa-edit"></i>
								</td>
							
								@endif
								<td>{{$val->programme_name}}</td>
								<td>{{$val->created_at}}</td>
								<td><a target="_blank" class="btn btn-sm btn-info text-white" href="{{url('/programme_courses/'.encrypt($val->programme_id))}}"><i class="fa fa-eye"></i> Preview Courses</a></td>
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


	 @if(Auth::user()->can('create-programme'))
          $("#new_programme").click(function()
		  {
                var toks=$("input[name='_token']").val();
             $.ajax(
					{
						type:"POST",
						data:{ _token:toks},
						url:"{{ route('create_programme') }}",
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

                @if (Auth::user()->can('edit-programme'))
				$.ajax(
						{
							type:"POST",
							data:{id:no, _token:toks},
							
							url:"{{ route('programme_edit') }}",
						
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
