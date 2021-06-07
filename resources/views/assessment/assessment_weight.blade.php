@extends('../layouts.dash_layout')

@section('required_css')

@endsection


@section('content')
	<div class="content-box">
		<div class="element-wrapper">
			<h6 class="element-header">
				All Assessement Weight List (@if( $assessment_weight_collection->isEmpty() ) 0 @else{{$assessment_weight_collection->count()}}@endif)
			</h6>
			@if(Session::get('news_success'))
			<div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
				Assessement Weight Updated successfully!
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
                                @if(Route::current()->getName() == 'edit_assessement_weight')
								<th></th>
                                @endif
								<th>Batch</th>
								<th>Assessement Type</th>
								<th>C.A 1</th>
								<th>C.A 2</th>
								<th>C.A 3</th>
								<th>C.A 4</th>
								<th>C.A Duration</th>
								<th>Exam</th>
								<th>Exam Duration</th>
								<th>Created</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
                                @if(Route::current()->getName() == 'edit_assessement_weight')
								<th></th>
                                @endif
								<th>Batch</th>
								<th>C.A 1</th>
								<th>C.A 2</th>
								<th>C.A 3</th>
								<th>C.A 4</th>
								<th>C.A Duration</th>
								<th>Exam</th>
								<th>Exam Duration</th>
								<th>Created</th>
							</tr>
						</tfoot>
						<tbody>
						@foreach($assessment_weight_collection as $val)
							<tr>
                                @if(Route::current()->getName() == 'edit_assessement_weight')
								<td>

										{{-- <i title="Edit Assessement weight" style="cursor: pointer" data-id="{{ $val->id }}" class="fa fa-edit"></i> --}}
								</td>
                                @else
                                    {{--<td>
                                    <i title="View More info of {{ $val->firstname." ".$val->lastname }}" style="cursor: pointer" data-id="{{ $val->id }}" class="fa fa-eye"></i>
                                    </td>--}}
                                @endif
								
								<td>{{$val->batch_no}}</td>
                                @if($val->type == 1)
								  <td>2 C.A, 1 Exam</td>
								@elseif($val->type == 2)
								   <td>3 C.A, 1 Exam</td>
								@elseif($val->type == 3)
								    <td>4 C.A, 1 Exam</td>
								@endif


								<td>{{$val->ca_1==""?"":$val->ca_1."%"}}</td>
								<td>{{$val->ca_2==""?"":$val->ca_2."%"}}</td>
								<td>{{$val->ca_3==""?"":$val->ca_3."%"}}</td>
								<td>{{$val->ca_4==""?"":$val->ca_4."%"}}</td>
								<td>{{$val->ca_duration."MIN"}}</td>
								<td>{{$val->exam."%"}}</td>
								<td>{{$val->exam_duration."MIN"}}</td>
								<td>{{$val->created_at}}</td>
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

	$('body').on('click','i[data-id]',function(e)
			{
				e.preventDefault();

				var no=$(this).data("id");
				var toks=$("input[name='_token']").val();

				$.ajax(
						{
							type:"POST",
							data:{id:no, _token:toks},
							@if(Route::current()->getName() == 'edit_event')
							url:"{{ route('dynamic_assessement_weight_edit') }}",
							@else
							url:"{{ route('dynamic_assessement_weight_edit') }}",
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
