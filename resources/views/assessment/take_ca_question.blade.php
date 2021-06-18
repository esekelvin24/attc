@extends('../layouts.dash_layout')

@section('required_css')

@endsection


@section('content')
	<div class="content-box">
		<div class="element-wrapper">
			
			<div class="element-box">
				<div id="page" class="table-responsive">
					<style>
						.form-inline{
							display: block !important;
						}
						ul.pagination a {
							position: relative;
							display: block;
							padding: 0.5rem 0.75rem;
							margin-left: -1px;
							line-height: 1.25;
							color: #047bf8;
							background-color: #fff;
							border: 1px solid #dee2e6;
						}


				   </style>



              @if(!isset($passed_assessment_collection[$assessment_id]) ||  (!isset($completed_assessment_collection[$assessment_id]) && substr($assessment_details->start_date,0,10)." ".$assessment_details->start_time < date('Y-m-d H:i:s')))

                    
									@if ( date("Y-m-d H:m:s") < substr($assessment_details->expiration_date,0,10)." ".$assessment_details->expiration_time && $authorise_to_take_assessment == true)
											
									
									<h5>Title: {{$course_details->course_name}}  </h5>
									<h5>Short Code: {{$course_details->short_code}}  </h5>
									<h5>Type: Continue Assessment {{$assessment_details->assessment_type}} </h5>  
									<h5>Duration : {{$global_assessment_weight->ca_duration}} minutes </h5>

										<h5>Instructions:</h5>
									<div style="border-style:solid; padding:20px">
												<strong>Before beginning the exam:</strong><br>
												<div style="margin-left:15px">
													1. &nbsp;&nbsp;&nbsp;Make sure you have good internet connection <br/>
													2. &nbsp;&nbsp;&nbsp;If you are taking your exam late in the day. it is recommended that you reboot your computer before beginning to free up memory resource from other programs on your computer<br/>
													3. &nbsp;&nbsp;&nbsp;Shut down all instant messaging tools (Skype, Facebook, WhatsApp, MSN Message) and email programs as the can conflict with the portal<br/>
													4. &nbsp;&nbsp;&nbsp;Maximize your browser window before starting the test. Minimizing the browser window during the exam can prevent the submission of your exam.<br/>
												</div> <br/>

												<strong>During the exam:</strong><br>
												<div style="margin-left:15px">
													1. &nbsp;&nbsp;&nbsp;Do not resize (minimize) the browser during the test <br/>
													2. &nbsp;&nbsp;&nbsp;Never click on the "Back" button on your browser. This will take you out of the test<br/>
													3. &nbsp;&nbsp;&nbsp;Click the "Next" button to navigate to the next question and note that you can not go back to the previous question <br/> 
													
												</div> <br/>
												<strong>Instructions accessing the exam:</strong><br>
												<div style="margin-left:15px">
													1. &nbsp;&nbsp;&nbsp;Do not resize (minimize) the browser during the test <br/>
													2. &nbsp;&nbsp;&nbsp;Never click on the "Back" button on your browser. This will take you out of the test<br/>
													3. &nbsp;&nbsp;&nbsp;Click the "Next" button to navigate to the next question and note that you can not go back to the previous question <br/> 
													
												</div> <br/>
									</div><br/>
									<div id="start" align="right" style="padding-right">
										<a id="start_assessment" class="btn btn-success text-white"> Start Test</a>
									</div>

									@elseif($authorise_to_take_assessment == false)

											<div align="center">
												<img width="150" height="150" src="{{asset('img/barred.png')}}" >
												<p> You are not authorise to take this assessment<p>
											</div>

									@else
									
											<div align="center">
												<img width="150" height="150" src="{{asset('img/barred.png')}}" >
												<p> This assessment has expired<p>
											</div>

									@endif
				@elseif (substr($assessment_details->start_date,0,10)." ".$assessment_details->start_time < date('Y-m-d H:i:s'))

					<div align="center">
						<img width="150" height="150" src="{{asset('img/barred.png')}}" >
						<p> C.A is closed at the moment please try again later<p>
					</div>
				@else
					
						<div align="center">
							<img width="150" height="150" src="{{asset('img/barred.png')}}" >
						<p> You have already taken this C.A  <p>
						</div>
				
				@endif

				</div>
			</div>
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




$('div#start').on('click','#start_assessment',(function(e)
		{
			var toks=$("input[name='_token']").val();
			
			$.ajax(
						{
							type:"POST",
							data:{id:'{{base64_encode($assessment_details->assessment_id)}}', _token:toks, from:'{{base64_encode("home")}}'},
							url:"{{ route('next_question') }}",
							beforeSend:function()
							{
								$('table').block({ message: null });
								
							},
							success: function(r)
							{
								$("#page").html(r);
							}
						}

				);
			
		}));






	if ($('#dataTable1').length) {
	$('#dataTable1').DataTable({ buttons: ['copy', 'excel', 'pdf'] });
	}




	</script>
@endsection
