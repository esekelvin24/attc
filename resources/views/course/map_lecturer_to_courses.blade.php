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
				
			  
				<div class="col-sm-6">
					<div class="form-group">
						<label for="programme_id">Programme</label>
						<select onchange="dd(this.value)" required autocomplete="off" class="form-control" id="programme_id"  name="programme_id">
							<option value="" selected>--Please Select Programme --</option>
							@if(!$program_collection->isEmpty())
								@foreach($program_collection as $val)
									<option value="{{ $val->programme_id }}">{{ $val->programme_name }}</option>
								@endforeach
							@endif
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


				 function dd(id)
				 {
					
					if ($("#lecturer").val() == "")
					{

                      Swal.fire('Error!','Select a Lecturer','error');
					}else
					{

						
						$.ajax(
									{
										type:"POST",
										data:{
											lecturer : $("#lecturer").val(),
											id : id,
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



				 }


   function reset_selection_field() 
   {

	$('#programme_id').prop('selectedIndex',0);
   }


	</script>
@endsection
