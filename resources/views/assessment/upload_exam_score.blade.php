@extends('../layouts.dash_layout')

@section('required_css')

@endsection



@section('content')
	<div class="content-box">
		<div class="element-wrapper">
			
			@if(Session::get('upload_success'))
			<div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
				{{Session::get('upload_success')}}
			</div>
			<br/>
			@endif

			@if(Session::get('upload_error'))
			<div class="alert alert-danger" style="margin-top:3px; margin-bottom:0">
				{{Session::get('upload_error')}}
			</div>
			<br/>
			@endif


		<form action="{{route('save_upload_exam_result')}}" method="POST" id="form" name="form">
	@csrf
            <div class="row">
				
				<div class="col-sm-2">
					<div class="form-group">
						<label for="programme_id">Session</label>
						<select onchange="reset_selection_field()" required autocomplete="off" class="form-control" id="session_id"  name="session_id">
							<option value="" selected>--Please Select Session--</option>
							@if(!$session_collection->isEmpty())
								@foreach($session_collection as $val)
									<option {{$current_section_id==$val->session_id?"selected":""}} value="{{ $val->session_id }}">{{ $val->session_name }}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label for="programme_id">Course</label>
						<select onchange="get_student_list(this.value)" required autocomplete="off" class="form-control" id="courses"  name="courses">
							<option value="" selected>--Please Select Course--</option>
							@if(!$course_collection->isEmpty())
								@foreach($course_collection as $val)
									<option value="{{ $val->short_code }}">{{ $val->course_title }}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
			
				

				<div style="margin-top:24px;" class="col-sm-1">
					<div class="form-group">
						<label for="programme_id"></label>
						<button type="submit" class="btn btn-success create"> Upload </button>
					</div>
				</div>
			</div>

           <!-- <input type="hidden" id="my_check" name="my_check"  > -->

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

			function get_programme_list()
		      {
				 
		                    $.ajax(
								 {
									 type:"POST",
									 data:{
										 id : $("#programme_type").val(),
										 _token:$("input[name='_token']").val()
									 },
									 url:"{{route('get_programmes_for_types')}}",
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


				 function get_student_list(get_course_list)
				 {
					
					$.ajax(
								 {
									 type:"POST",
									 data:{
										 session_id:$("#session_id").val(),
										 id : get_course_list,
										 _token:$("input[name='_token']").val()
									 },
									 url:"{{route('upload_exam_score_student_list')}}",
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
	
	$('#programme').prop('selectedIndex',0);
   }


	</script>
@endsection
