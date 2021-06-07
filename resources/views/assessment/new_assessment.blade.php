



@section('content')
    <div class="content-box">
		
		@if(Session::get('assessement_success'))
		<div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
			{{Session::get('assessement_success')}}
		</div>
        @endif

        @if(Session::get('ca_error'))
		<div class="alert alert-danger" style="margin-top:3px; margin-bottom:0">
			{{Session::get('ca_error')}}
		</div>
		@endif

		@if ($assessment_session_type > 0)

        <div class="row">
		<div class="col-sm-12">
		            <form id="form"  action="{{route("save_assessement")}}" method="post"  role="form">
			       @csrf
			       <div>

					   <div class="row">
						   <div class="col-sm-6">
							   <div class="form-group">
								   <label for="dean">Course</label>
								   <select required autocomplete="off" class="form-control" id="course_id"  name="course_id">
									   <option value="" selected>--Select a Course--</option>
									   @if(!$course_collection->isEmpty())
										   @foreach($course_collection as $val)
											   <option value="{{ $val->course_id }}">{{ $val->course_name }}</option>
										   @endforeach
									   @endif
								   </select>
							   </div>
						   </div>
					   

					     @php
											function get_ca_text($value)
											{
												if ($value == 1 )
													return "1st";
													
												if ($value == 2 )
													return "2nd";

												if ($value == 3 )
													return "3rd";

												if ($value == 4 )
													return "4th";

											}	
									@endphp
									
					   
						<div class="col-sm-6">
							<div class="form-group">
								<label for="dean">Assessment Type</label>
								<select required autocomplete="off" class="form-control" id="ca_no"  name="ca_no">
									<option value="" >--Select assessment type--</option>
									@for($i = 1; $i <= $assessment_session_type + 1; $i++)
								         <option value="{{$i}}" >{{ get_ca_text($i) }} C.A Test</option>
									@endfor

									
									
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="faculty">
									Start Date <span class="symbol required font"></span>
								</label>
								<input required value="" autocomplete="off" class="form-control underline each" id="start_date" placeholder="Enter Date" type="text" name="start_date">
								<span class="text-danger error-message here"></span>
							</div>
						</div>
					
						<div class="col-md-6">
							<div class="form-group">
								<label for="faculty">
									Start Time <span class="symbol required font"></span>
								</label>
								<input required value="" autocomplete="off" class="form-control underline each" id="start_time" placeholder="Enter Time" type="text" name="start_time">
								<span class="text-danger error-message here"></span>
							</div>
						</div>
					</div>

					   <div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="faculty">
									Expiration Date <span class="symbol required font"></span>
								</label>
								<input required value="" autocomplete="off" class="form-control underline each" id="expiration_date" placeholder="Enter Date" type="text" name="expiration_date">
								<span class="text-danger error-message here"></span>
							</div>
						</div>
					
						<div class="col-md-6">
							<div class="form-group">
								<label for="faculty">
									Expiration Time <span class="symbol required font"></span>
								</label>
								<input required value="" autocomplete="off" class="form-control underline each" id="expiration_time" placeholder="Enter Time" type="text" name="expiration_time">
								<span class="text-danger error-message here"></span>
							</div>
						</div>
					</div>

				
			    <div class="content" >
                 <div class="inner" align="center" >
                 <div style ="min-width:350px !important" class="row">
                    
                     <div class="col-md-12">
                         <button  class="btn btn-primary btn-block btn-scroll btn-scroll-left ti-book create" type="submit"><span>CREATE ASSESSMENT</span></button>
                     </div>
                 </div>
                 </div>    
                </div>

                		
		
                <span class="clearfix"></span>

               </div>
		
   
                </form>
            </div>
		</div>
		@else

					<div align="center">
						<img width="150" height="150" src="{{asset('img/barred.png')}}" >
						<p> Kindly contact the admin to set assessment weight for this session<p>
					</div>

		@endif
    </div>


    <script>



			$('#expiration_date').daterangepicker({
			
			singleDatePicker: true,
			locale: {
				format: "YYYY-MM-DD"
			}
			});


			$('#start_date').daterangepicker({
			
			singleDatePicker: true,
			locale: {
				format: "YYYY-MM-DD"
			}
			});

			$(document).ready(function(){

			$('#expiration_time').mdtimepicker(
				{
					format:'hh:mm',
					theme:'blue'
				}
			); //Initializes the time picker	

			$('#start_time').mdtimepicker(
				{
					format:'hh:mm',
					theme:'blue'
				}
			); //Initializes the time picker
			});		
	</script>

