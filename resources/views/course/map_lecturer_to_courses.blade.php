@extends('../layouts.dash_layout')

@section('required_css')

@endsection



@section('content')
	<div class="content-box">
		<div class="element-wrapper">
			
			@if(Session::get('mapping_success'))
			<div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
				{{Session::get('mapping_success')}}
			</div>
			<br/>
			@endif

			@if(Session::get('course_error'))
			<div class="alert alert-error" style="margin-top:3px; margin-bottom:0">
				An error occured when performing updates!
			</div>
			<br/>
			@endif


		<form action="{{route('save_mapped_lecturer')}}" method="POST" id="form" name="form">
	@csrf
			
	<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label for="lecturer">Lecturer</label>
						<select required onchange="reset_selection_field()" autocomplete="off" class="form-control" id="lecturer"  name="lecturer">
							<option value="">--Select a Lecturer--</option>
							@if(!$lecturer_collection->isEmpty())
								@foreach($lecturer_collection as $val)
									<option value="{{ $val->id }}">{{ $val->firstname." ".$val->middlename." ".$val->lastname }}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
				
			  
				<div class="col-sm-3">
					<div class="form-group">
						<label for="programme_id">Programme Type</label>
						<select onchange="get_programme_list()" required autocomplete="off" class="form-control" id="programme_type"  name="programme_type">
							<option value="" selected>--Please Select Programme Type--</option>
							@if(!$program_type_collection->isEmpty())
								@foreach($program_type_collection as $val)
									<option value="{{ $val->program_type_id }}">{{ $val->program_type_name }}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
			
				<div class="col-sm-4">
					<div class="form-group">
						<label for="programme_id">Programme</label>
						<select onchange="get_course_list(this.value)" required autocomplete="off" class="form-control" id="programme_id"  name="programme_id">
							
						</select>
					</div>
				 </div>

				<div style="margin-top:7px;" class="col-sm-1">
					<div class="form-group">
						<label for="programme_id"></label>
						<button type="submit" class="btn btn-success create"> Map to Course</button>
					</div>
				</div>
			</div>

            <input type="hidden" id="my_check" name="my_check"  >

			<div id="table_list" class="element-box">
				

			</div>

			

</form>
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

	$('body').on('click','i[data-id]',function(e)//fetching edit form from the server
			{
				e.preventDefault();

				var no=$(this).data("id");
				//alert(no);
				var toks=$("input[name='_token']").val();

				$.ajax(
						{
							type:"POST",
							data:{id:no, _token:toks},
							@if(Route::current()->getName() == 'edit_course')
							url:"{{ route('dynamic_course_edit') }}",
							@else
							url:"{{ route('dynamic_course_edit') }}",
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


			function get_programme_list()
		      {
				 
				$('#table_list').html("");

		                    $.ajax(
								 {
									 type:"POST",
									 data:{
										 id : $("#programme_type").val(),
										 _token:$("input[name='_token']").val()
									 },
									 url:"{{route('get_programmes_for_map_lecturer')}}",
									 beforeSend:function()
									  {
										  $('form#form').block({ message: null }); 
									  },
									  success: function(r)
									  {							  
										 $('form#form').unblock(); 
							              $("#programme_id").html(r);
											// swal("success!", "Operation was successful", "success");
										     //location.reload();
									  }
								 }
				 
						     );
		        }


				 function get_course_list(get_course_list)
				 {
					
					$.ajax(
								 {
									 type:"POST",
									 data:{
										 lecturer : $("#lecturer").val(),
										 id : get_course_list,
										 _token:$("input[name='_token']").val()
									 },
									 url:"{{route('course_map_list')}}",
									 beforeSend:function()
									  {
										  $('form#form').block({ message: null }); 
									  },
									  success: function(r)
									  {							  
										 $('form#form').unblock(); 
							              $("#table_list").html(r);
											// swal("success!", "Operation was successful", "success");
										     //location.reload();
									  }
								 }
				 
						     );
			



				 }


   function reset_selection_field() 
   {
	$("#programme_id").html(""); 
	$('#programme_type').prop('selectedIndex',0);
   }


	</script>
@endsection
