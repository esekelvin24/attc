

<script>
	CKEDITOR.replace('ckeditor1');
</script>

    <div class="content-box">
		@if(Session::get('event_success'))
		<div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
			Event created successfully!
		</div>
		<br/>
		@endif
        <div class="row">
            <div class="col-sm-12">
		            <form enctype="multipart/form-data" id="form" action="{{route('save_event')}}" method="post"  role="form">
			       @csrf
			       <div>
					   
	                   <div class="row">

							<div class="col-md-6">
								<div class="form-group">
									<label for="department">
										Title <span class="symbol required font"></span>
									</label>
									<input value="{{old('event_title')}}" autocomplete="off" class="form-control underline" required id="event_title" placeholder="Enter Event Title" type="text" name="event_title">
									<span class="text-danger error-message here"></span>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="department">
										Venue <span class="symbol required font"></span>
									</label>
									<input value="{{old('venue')}}" autocomplete="off" class="form-control underline" required id="venue"  type="text" name="venue" placeholder="Enter Event Venue">
									<span class="text-danger error-message here"></span>
								</div>
							</div>
                        <br/>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="department">
										Date <span class="symbol required font"></span>
									</label>
									<input value="{{old('event_date')}}" autocomplete="off" class="form-control underline" required id="event_date" placeholder="Enter Event Date" type="text" name="event_date">
									<span class="text-danger error-message here"></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="department">
										Start Time <span class="symbol required font"></span>
									</label>
									<input value="{{old('start_time')}}" autocomplete="off" class="form-control underline" required id="start_time" placeholder="Enter Start Time" type="text" name="start_time">
									<span class="text-danger error-message here"></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="department">
										End Time <span class="symbol required font"></span>
									</label>
									<input value="{{old('end_time')}}" autocomplete="off" class="form-control underline" required id="end_time" placeholder="Enter End Time" type="text" name="end_time">
									<span class="text-danger error-message here"></span>
								</div>
							</div>
						</div>

						<div  class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="department">
										Banner Image <span class="symbol required font"></span>
									</label>
									<br/><img style="display:none" height="120" width="120" id="blah" src="#" alt="your image" /><br/>
									<input value="{{old('banner_image')}}" autocomplete="off" class="form-control underline" required id="banner_image"  type="file" name="banner_image">
									<span class="text-danger error-message here"></span>
								</div>
							</div>

							
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									
									<div class="element-box">
										<h5 class="form-header">
										 Event Content
										</h5>
										<textarea style="width:100%"  id="ckeditor1" name="ckeditor1" rows="10" required>{{old('ckeditor1')}}</textarea>
									   </div>
									<span class="text-danger error-message here"></span>
								</div>
							</div>
						</div>

						<div class="form-check">
							<label class="form-check-label"><input  onchange="show_attachment()" name="att_chkbox" id="att_chkbox" class="form-check-input" type="checkbox" >Add Attachment</label>
						</div>

						<div id="attachment_div" style="display:none" class="row">
							<div class="col-md-6">
								<div class="form-group">
									
									<input value="{{old('attachment_file')}}" autocomplete="off" class="form-control underline"  id="attachment_file" placeholder="Enter News Title" type="file" name="attachment_file">
									<span class="text-danger error-message here"></span>
								</div>
							</div>
						</div>
                        <br/>


				

			    <div class="content" >
                 <div class="inner" align="center" >
                 <div style ="max-width:350px !important" class="row">
                    
                     <div class="col-md-12">
                         <button  class="btn btn-primary btn-block btn-scroll btn-scroll-left ti-book create" type="submit"><span>CREATE EVENT</span></button>
                     </div>
                 </div>
                 </div>    
                </div>

                <span class="clearfix"></span>

               </div>
                  </form>
            </div>
        </div>
    </div>

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

