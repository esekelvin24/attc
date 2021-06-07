@extends('../layouts.dash_layout')

@section('required_css')
@endsection

@section('content')
    <div class="content-box">
		@if(Session::get('cross_course_success'))
		<div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
			Cross Course created successfully!
		</div>
		@endif
        <div class="row">
            <div class="col-sm-12">
		            <form id="form" action="{{route('save_cross_course')}}" method="post"  role="form">
			       @csrf
			       <div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="programme_id">Programme Type</label>
								<select onchange="get_programme_list(this.value)" required autocomplete="off" class="form-control" id="programme_type"  name="programme_type">
									<option value="" selected>--Please Select Programme Type--</option>
									@if(!$program_type_collection->isEmpty())
										@foreach($program_type_collection as $val)
											<option value="{{ $val->program_type_id }}">{{ $val->program_type_name }}</option>
										@endforeach
									@endif
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="programme_id">Programme</label>
								<select onchange="get_course_by_programme(this.value)" required autocomplete="off" class="form-control" id="programme_id"  name="programme_id">
									
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="course_id">Course</label>
								<select onchange="get_selected_course_details(this.value)" required autocomplete="off" class="form-control" id="course_id"  name="course_id">
									
								</select>
							</div>
						</div>
					</div>
					 
					
				<div id="course_details">	
					
			    </div>





				<div class="row">
					<div class="col-md-6">
						<button class="btn btn-primary btn-block btn-scroll btn-scroll-left ti-book create" type="submit"><span>CREATE COURSE</span></button>
					</div>
			   </div>

                <span class="clearfix"></span>

               </div>
                  </form>
            </div>
        </div>
    </div>
@endsection

@section('additional_js')
    <script>

        function get_course_by_programme(value)
		{
			$.ajax(
								 {
									 type:"POST",
									 data:{
										 id : value,
										 _token:$("input[name='_token']").val()
									 },
									 url:"{{route('get_course_by_programme')}}",
									 beforeSend:function()
									  {
										  $('form#form').block({ message: null }); 
									  },
									  success: function(r)
									  {							  
										 $('form#form').unblock(); 
							              $("#course_id").html(r);
											// swal("success!", "Operation was successful", "success");
										     //location.reload();
									  }
								 }
				 
						     );
		}

		function get_programme_list(value)
		{
           

		   $.ajax(
								 {
									 type:"POST",
									 data:{
										 id : value,
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


		function get_selected_course_details(value)
		{
           
			$.ajax(
								 {
									 type:"POST",
									 data:{
										 id : value,
										 _token:$("input[name='_token']").val()
									 },
									 url:"{{route('get_selected_course_details')}}",
									 beforeSend:function()
									  {
										  $('form#form').block({ message: null }); 
									  },
									  success: function(r)
									  {							  
										 $('form#form').unblock(); 
										  $('#course_details').html(r);
											// swal("success!", "Operation was successful", "success");
										     //location.reload();
									  }
								 }
				 
						     );

			

		}
		

	
	</script>
@endsection
