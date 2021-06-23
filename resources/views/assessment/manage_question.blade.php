@extends('../layouts.dash_layout')

@section('required_css')

@endsection


@section('content')
	<div class="content-box">
		<div class="element-wrapper">
			<h6 class="element-header">
				All Question List (@if( $questions->isEmpty() ) 0 @else{{$questions->count()}}@endif)
			</h6>
			@if(Session::get('news_success'))
			<div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
				Events Updated successfully!
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
                              @if(Auth::user()->can('manage-question'))
								<th></th>
                                @endif
								<th></th>
								<th>Questions</th>
								<th>Answer</th>
								<th>A </th>
								<th>B </th>
								<th>C </th>
								<th>D </th>
							</tr>
						</thead>
						<tfoot>
							<tr>
                               @if(Auth::user()->can('manage-question'))
								<th></th>
                                @endif
								<th></th>
								<th>Questions</th>
								<th>Answer</th>
								<th>A </th>
								<th>B </th>
								<th>C </th>
								<th>D </th>
							</tr>
						</tfoot>
						<tbody>
							@php
								$counter = 0;
							@endphp
						@foreach($questions as $val)
							<tr>
                               @if(Auth::user()->can('manage-question'))
								<td>
										<i title="Edit {{ $val->question_id." ".$val->question_id }}" style="cursor: pointer" data-id="{{ $val->question_id }}" class="fa fa-edit"></i>
								</td>
								@endif
							    <td>{{$counter = $counter + 1}}</td>
								<td>{{$val->question}}</td>
								<td>{{get_answer_letter($val->answer)}}</td>
								<td>{{$val->option_1}}</td>
								<td>{{$val->option_2}}</td>
								<td>{{$val->option_3}}</td>
								<td>{{$val->option_4}}</td>
							</tr>
						@endforeach

						@php
							 function get_answer_letter($answer)
							 {
							   switch($answer)
							   {
									case 1:
											return "A";
									break;
									case 2:
											return "B";
									break;
									case 3:
											return "C";
									break;
									case 4:
									return "D";
									break;	

							   }
							 }
							 
						@endphp

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
							@if(Auth::user()->can('manage-question'))
							url:"{{ route('edit_question') }}",
							@else
							url:"{{ route('edit_question') }}",
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
