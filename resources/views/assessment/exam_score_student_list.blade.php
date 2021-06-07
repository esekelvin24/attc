<div class="table-responsive">
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
				@php
						
								
				use App\AssessementWeight;
				use App\Session;

				$current_section = Session::where('session_status',1)->first();
				$current_section_id = isset($current_section->session_id)?$current_section->session_id:"";

				$max_exam_grade_obj = AssessementWeight::where('session_id',$current_section_id)->where('status',0)->first();
				
				$max_exam_grade = 0;
				

				@endphp

				@if (!isset($max_exam_grade_obj->exam)) {{-- This means the maximum exam weight has not been inputed for the session --}}
				
				<div align="center">
					<img width="150" height="150" src="{{asset('_img/barred.png')}}" >
					  <p> Exam scores can not be uploaded at the moment because the admin needs to set assessement weight for this session<p>
				  </div>



				@else
					 @php
						 $max_exam_grade = $max_exam_grade_obj->exam;
					 @endphp

							@if(count($student_list) > 0)
								<table id="dataTable1" class="table table-striped" style="width: 100% !important;">
									<thead>
										<tr>
											<th></th>
											<th>Student Name</th>
											<th>Course Title</th>
											<th>Short Code</th>
											<th>1st C.A</th>
											<th>2nd C.A</th>
											<th>Exam Score</th>
											<th>Total (%)</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th></th>
											<th>Student Name</th>
											<th>Course Title</th>
											<th>Short Code</th>
											<th>1st C.A</th>
											<th>2nd C.A</th>
											<th>Exam Score</th>
											<th>Total (%)</th>
										</tr>
									</tfoot>
									<tbody>
										
									@php
										$counter = 0;
									@endphp
										@foreach($student_list as $val)
											<tr>
												<td>{{$counter = $counter + 1}}</td>
												<td>{{$val->firstname." ".$val->middlename." ".$val->lastname}}</td>
												<td>{{$val->course_title}}</td>
												<td>{{$val->course_short_code}}</td>
												<td>{{$val->ca1}}</td>
												<td>{{$val->ca2}}</td>

											    <td> <input class="grades" required style="width:50px" value="{{$val->exam}}" type="text" id="" name="grades[{{$val->course_reg_id}}]" ></td>
											    <td>{{$total = $val->ca1 + $val->ca2 + $val->ca3 + $val->ca4 + $val->exam }}</td>
										</tr>
										@endforeach
								
									</tbody>
								</table>
					         @endif
                  @endif


				</div>

				
<script>
		$('#allcb').change(function(){

		if($(this).prop('checked')){
			var cnt = 0;
			$('tbody tr td input[type="checkbox"]').each(function(){
				$(this).prop('checked', true);
				cnt++;
			});
			//$("#button-group").show();
			//$("#button-group").text('Take action on '+cnt+' record(s) ' );
		}else{
			$('tbody tr td input[type="checkbox"]').each(function(){
				$(this).prop('checked', false);
			});
			//$("#button-group").hide();
			//$("#button-group").text("");
		}

		}); 

		var favorite = "";

		


		$('form#form').on('click','button.create',(function(e)
          {
			e.preventDefault();

			var favorite = -1;
			var numbersOnly = /^\d+$/;
			var decimalOnly = /^\s*-?[1-9]\d*(\.\d{1,2})?\s*$/;
			var uppercaseOnly = /^[A-Z]+$/;
			var lowercaseOnly = /^[a-z]+$/;
			var stringOnly = /^[A-Za-z0-9]+$/;

			var exam_grade_check = "passed";

			   $(".grades").each(function() {
                    //console.log(this.value);
					var value = this.value;
					
						if (value > {{$max_exam_grade}} )
						{
							exam_grade_check = "failed"
						}

                        if(testInputData(value,numbersOnly) === 0){
							if(favorite === -1)
							{
								favorite = 0;
							}else
							{
								favorite = favorite + 0;
							}	  
                        }else{

                            favorite = favorite + 1;
                        } 
                });
				
				if (exam_grade_check === "passed")	
				{	
					if (favorite === 0)
					{
						$('form#form').submit();
						
					}else if ($("#courses").val() == "")
					{
						swal("error!", "Select a course", "error");
					}else if (favorite === -1)
					{
						swal("error!", "No exam grade was inputted", "error");
					}else
					{
						swal("error!", "All fields are required", "error");
					}
				}else
				{
					swal("error!", "Exam score can not be above the maximum exam session grade", "error");
				}

			


		 }));
		 


		 
function testInputData(myfield, restrictionType) {
 
 var myData = myfield;
 if(myData!==''){
	 if(restrictionType.test(myData)){
		return 0;
	 }else{
	 return 1;
	 }
 }else{
	 return 1;
 }
 return;
 
}



		
</script>