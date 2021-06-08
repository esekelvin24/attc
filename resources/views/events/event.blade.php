@extends('../layouts.dash_layout')

@section('required_css')

@endsection


@section('content')
	<div class="content-box">
		<div class="element-wrapper">
			<h6 class="element-header">
				All Event List (@if( $event_collection->isEmpty() ) 0 @else{{$event_collection->count()}}@endif)
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
					@if(Auth::user()->can('create-event'))
					<button id="create_event" class="btn btn-info text-white" style="background:#1F1D5E;margin-bottom: 15px;"><i class="fa fa-plus"></i> Add New Event</button>
					@endif
					<table id="dataTable1" class="table table-striped" style="width: 100% !important;">
						<thead>
							<tr>
                                 @if(Auth::user()->can('edit-event'))
								<th></th>
                                @endif
								<th></th>
								<th>Title</th>
								<th>Venue</th>
								<th>Date</th>
								<th>Start</th>
								<th>End</th>
								<th>Created by</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
                                 @if(Auth::user()->can('edit-event'))
								<th></th>
                                @endif
								<th></th>
								<th>Title</th>
								<th>Venue</th>
								<th>Date</th>
								<th>Start</th>
								<th>End</th>
								<th>Created by</th>
							</tr>
						</tfoot>
						<tbody>
						@foreach($event_collection as $val)
							<tr>
                                @if(Auth::user()->can('edit-event'))
								<td>

										<i title="Edit {{ $val->event_title." ".$val->event_title }}" style="cursor: pointer" data-id="{{ $val->event_id }}" class="fa fa-edit"></i>
								</td>
                                @else
                                    {{--<td>
                                    <i title="View More info of {{ $val->firstname." ".$val->lastname }}" style="cursor: pointer" data-id="{{ $val->id }}" class="fa fa-eye"></i>
                                    </td>--}}
                                @endif
								<td class="center"><img class="img-rounded" height="30" width="30" src='{{ asset("frontend/assets/img/event/".$val->img_path) }}'/></td>
								<td>{{$val->event_title}}</td>
								<td>{{$val->event_venue}}</td>
								<td>{{$val->event_date}}</td>
								<td>{{$val->event_start_time}}</td>
								<td>{{$val->event_end_time}}</td>
								<td>{{$val->user_id}}</td>
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
	 @if(Auth::user()->can('create-event'))
          $("#create_event").click(function()
		  {
                var toks=$("input[name='_token']").val();
             $.ajax(
					{
						type:"POST",
						data:{ _token:toks},
						url:"{{ route('create_event') }}",
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
							@if(Auth::user()->can('edit-event'))
							url:"{{ route('edit_event') }}",
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
