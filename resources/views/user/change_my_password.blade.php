@extends('../layouts.dash_layout')

@section('required_css')
@endsection

@section('content')



    <div class="content-box">
		@if(Session::get('password_success'))
		<div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
			{{Session::get('password_success')}}
		</div>
		<br/>
		@endif
		@if(Session::get('password_error'))
		<div class="alert alert-danger" style="margin-top:3px; margin-bottom:0">
			{{Session::get('password_error')}}
		</div>
		<br/>
		@endif
		
        <div class="row">
            <div class="col-sm-12">
		            <form enctype="multipart/form-data" id="form" action="{{route('save_password_change')}}" method="post"  role="form">
			       @csrf
			       <div>
					   
	                   <div class="row">

							<div class="col-md-4">
								<div class="form-group">
									<label for="department">
										Old Password <span class="symbol required font"></span>
									</label>
									<input value="" autocomplete="off" class="form-control underline" required id="old_password" placeholder="Enter Old Password" type="password" name="old_password">
									<span class="text-danger error-message here"></span>
								</div>
							</div>
						</div>

						 <div class="row">

							<div class="col-md-4">
								<div class="form-group">
									<label for="department">
										New Password <span class="symbol required font"></span>
									</label>
									<input value="" autocomplete="off" class="form-control underline" required id="password"  type="password" name="password" placeholder="Enter New Password">
									<span class="text-danger error-message here"></span>
								</div>
							</div>
                        <br/>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="department">
										Confirm Password <span class="symbol required font"></span>
									</label>
									<input value="" autocomplete="off" class="form-control underline" required id="password_confirmation" placeholder="Enter Confirm Password" type="password" name="password_confirmation">
									<span class="text-danger error-message here"></span>
								</div>
							</div>
							
						</div>

						


				<div class="row">
					<div class="col-md-4">
						<button class="btn btn-primary btn-block btn-scroll btn-scroll-left ti-book create" type="submit"><span>CHANGE PASSWORD</span></button>
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


        

		$('#event_date').daterangepicker({
  
  				singleDatePicker: true,
				  locale: {
                    format: "YYYY-MM-DD"
				  }
		});

		function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function(e) {
			$('#blah').attr('src', e.target.result);
			$('#blah').show();
			}
			
			reader.readAsDataURL(input.files[0]);
		}
		}

		$("#banner_image").change(function() {
		  readURL(this);
		});

		function show_attachment()
		{
			
			if(document.getElementById('att_chkbox').checked) {
				$("#attachment_div").show();
				$('#attachment_file').prop('required',true);
				$("#att_chkbox").val(1);
			} else {
				$("#att_chkbox").val(0);
				$("#attachment_div").hide();
				$('#attachment_file').prop('required',false);
			}
		}


		$(document).ready(function(){

			$('#start_time').mdtimepicker(
				{
					format:'hh:mm',
					theme:'blue'
				}
			); //Initializes the time picker

			$('#end_time').mdtimepicker(
				{
					format:'hh:mm',
					theme:'blue'
				}
			); //Initializes the time picker

	    });

		

	
	</script>
@endsection
