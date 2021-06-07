@extends('../layouts.dash_layout')

@section('required_css')
@endsection

@section('content')
    <div class="content-box">
		@if(Session::get('course_success'))
		<div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
			Course created successfully!
		</div>
		@endif
        <div class="row">
            <div class="col-sm-12">
		            <form id="form" action="{{route('save_course')}}" method="post"  role="form">
			       @csrf
			       <div>
					<div class="row">
						<div class="col-sm-6">
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
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="programme_id">Programme</label>
								<select onchange="get_programme_duration_selection()" required autocomplete="off" class="form-control" id="programme_id"  name="programme_id">
									
								</select>
							</div>
						</div>
					</div>
	                   <div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="course_title">
										Course Title <span class="symbol required font"></span>
									</label>
									<input value="{{old('course_title')}}" autocomplete="off" class="form-control underline" required id="course_title" placeholder="Enter Course Title" type="text" name="course_title">
									<span class="text-danger error-message here"></span>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="short_code">
										Short Code <span class="symbol required font"></span>
									</label>
									<input value="{{old('short_code')}}" autocomplete="off" class="form-control underline" required id="short_code" placeholder="Enter Short Code" type="text" name="short_code">
									<span class="text-danger error-message here"></span>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="credit_unit">
										Credit Unit <span class="symbol required font"></span>
									</label>
									<input value="{{old('credit_unit')}}" autocomplete="off" class="form-control underline" required id="credit_unit" placeholder="Enter Credit Unit" type="text" name="credit_unit">
									<span class="text-danger error-message here"></span>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="category">Category</label>
									<select required autocomplete="off" class="form-control" id="category"  name="category">
										<option value="" selected>--Please Select Category--</option>
										<option value="1">Mandatory</option>
										<option value="2">Elective</option>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="Year">
										Year <span class="symbol required font"></span>
									</label>
									<select required name="year" id="year" class="form-control underline">
										<option value="">Select a Year</option>
									</select>
									<span class="text-danger error-message here"></span>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="semester">
										Semester <span class="symbol required font"></span>
									</label>
									<select required name="semester" id="semester" class="form-control underline">
										<option {{old('semester')==1?"selected":""}} value="1">1</option>
										<option {{old('semester')==2?"selected":""}} value="2">2</option>
									</select>
									<span class="text-danger error-message here"></span>
								</div>
							</div>
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

function get_programme_list()
		{
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


function get_programme_duration_selection()
		{
		   $.ajax(
								 {
									 type:"POST",
									 data:{
										 id : $("#programme_id").val(),
										 _token:$("input[name='_token']").val()
									 },
									 url:"{{route('get_programmes_duration_selection')}}",
									 beforeSend:function()
									  {
										  $('form#form').block({ message: null }); 
									  },
									  success: function(r)
									  {							  
										 $('form#form').unblock(); 
							              $("#year").html(r);
											// swal("success!", "Operation was successful", "success");
										     //location.reload();
									  }
								 }
				 
						     );
			
		}


    
		$('form#form').on('click','button.create',(function(e)
		{
			e.preventDefault();
			if($.trim($("select#year").val()) == "")
				{
					swal("error!", "year field is compulsory", "error");
				}else
				{
					$('form#form').submit();
				}
		}));

	</script>



@endsection
