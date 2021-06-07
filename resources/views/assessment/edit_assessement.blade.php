<div class="row">
	
		<div class="col-sm-12">
		            <form id="form"  action="{{route("save_edit_assessement")}}" method="post"  role="form">
			       @csrf
			       <div>

				   <input type="hidden" value="{{$assessement_id}}" id="assessement_id" name="assessement_id"/>

				   <div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="faculty">
								Start Date <span class="symbol required font"></span>
							</label>
							<input required value="{{$assessement_collection[0]->start_date}}" autocomplete="off" class="form-control underline each" id="start_date" placeholder="Enter Date" type="text" name="start_date">
							<span class="text-danger error-message here"></span>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="faculty">
								Start Time <span class="symbol required font"></span>
							</label>
							<input required value="{{$assessement_collection[0]->start_time}}" autocomplete="off" class="form-control underline each" id="start_time" placeholder="Enter Time" type="text" name="start_time">
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
							<input required value="{{$assessement_collection[0]->expiration_date}}" autocomplete="off" class="form-control underline each" id="expiration_date" placeholder="Enter Date" type="text" name="expiration_date">
								<span class="text-danger error-message here"></span>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="faculty">
									Expiration Time <span class="symbol required font"></span>
								</label>
								<input required value="{{$assessement_collection[0]->expiration_time}}" autocomplete="off" class="form-control underline each" id="expiration_time" placeholder="Enter Date" type="text" name="expiration_time">
								<span class="text-danger error-message here"></span>
							</div>
						</div>
					</div>


				<div class="row">
					<div class="col-md-6">
						<button class="btn btn-primary btn-block btn-scroll btn-scroll-left ti-book create" type="submit"><span>UPDATE ASSESSEMENT</span></button>
					</div>
			   </div>

                		
		
                <span class="clearfix"></span>

               </div>
		
   
</form>
            </div>
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