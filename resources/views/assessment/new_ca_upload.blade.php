@extends('../layouts.dash_layout')

@section('required_css')
@endsection


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

        <div class="row">
		<div class="col-sm-12">
		            <form enctype="multipart/form-data" id="form"  action="{{route("save_ca_upload")}}" method="post"  role="form">
			       @csrf
			       <div>

					   <div class="row">
						   <div class="col-sm-6">
							   <div class="form-group">
								   <label for="short_code">Course</label>
								   <select required autocomplete="off" class="form-control" id="short_code"  name="short_code">
									   <option value="" selected>--Select a Course--</option>
									   @if(!$course_collection->isEmpty())
										   @foreach($course_collection as $val)
											   <option value="{{ $val->course_id }}">{{ $val->course_name }}</option>
										   @endforeach
									   @endif
								   </select>
							   </div>
						   </div>
					   </div>

					   <div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="assessment_type">Assessment Type</label>
								<select required autocomplete="off" class="form-control" id="assessment_type"  name="assessment_type">
									<option value="" >--Select Assessment Type--</option>
									@for($i = 1; $i <= 4; $i++)
								         <option value="{{$i}}" >{{get_ca_text($i)}} C.A Test</option>
									@endfor

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
									
								</select>
							</div>
						</div>
					   </div>

					   <div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="faculty">
									Questions <span class="symbol required font"></span>
								</label>
								<input required value="" autocomplete="off" class="form-control underline" id="question" type="file" name="question">
								<span class="text-danger error-message here"></span>
							</div>
						</div>
					</div>





				<div class="row">
					<div class="col-md-6">
						<button class="btn btn-primary btn-block btn-scroll btn-scroll-left ti-book create" type="submit"><span>UPLOAD QUESTIONS</span></button>
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
			$(document).ready(function(){
				$("button.create").click(function(e){
					e.preventDefault();
					var type=$("input[name='question']").val().split('.')[1];
					if(type=="csv" || type=="CSV"){
						$("form#form").submit();
					}else{
						alert("Only CSV files are allowed for uploads");
					}
				})

			});		
	</script>
@endsection
