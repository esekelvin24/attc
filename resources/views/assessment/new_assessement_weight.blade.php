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
		            <form id="form" action="{{route('save_assessement_weight')}}" method="post"  role="form">
			       @csrf
			       <div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="assessement_type">Assessment Type</label>
								<select onchange="get_fields(this.value)" required autocomplete="off" class="form-control" id="assessement_type"  name="assessement_type">
									<option value="" >--Please Select Assessment Type--</option>
                                    <option value="1">2 CA, 1 Exam</option>
                                    <option value="2">3 CA, 1 Exam</option>
                                    <option value="3">4 CA, 1 Exam</option>
								</select>
							</div>
						</div>
					</div>

					
                    <div id="ca_test">   
                        
                    </div>
						

						

				<div class="row">
					<div class="col-md-6">
						<button class="btn btn-primary btn-block btn-scroll btn-scroll-left ti-book create" type="submit"><span>SAVE</span></button>
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


function get_fields(value)
{
    var ca = "";
    
    for(var i = 1; i <= parseInt(value) + 1; i++)
    {
       // console.log(i);

        ca = ca +  '<div class="row">' +
							'<div class="col-md-6">' +
								'<div class="form-group">' +
									'<label for="course_title">' +
									'	CA '+i+' <span class="symbol required font"></span>' +
									'</label>' +
									'<input  autocomplete="off" class="form-control underline" required  placeholder="Enter CA Grade" type="text"  name="ca_grade[]">'+
									'<span class="text-danger error-message here"></span>' +
								'</div>' +
							'</div>'+
        '</div>';
    }

    ca = ca + '<div class="row">' +
							'<div class="col-md-6">' +
								'<div class="form-group">' +
									'<label for="course_title">' +
									'	C.A Duration <span class="symbol required font"></span>' +
									'</label>' +
									'<input  autocomplete="off" class="form-control underline" required id="ca_duration" placeholder="Enter C.A duration in minutes" type="text" name="ca_duration">' +
									'<span class="text-danger error-message here"></span>' +
								'</div>' +
							'</div>' +
						'</div>';

    ca = ca + '<div class="row">' +
							'<div class="col-md-6">' +
								'<div class="form-group">' +
									'<label for="course_title">' +
									'	Exam <span class="symbol required font"></span>' +
									'</label>' +
									'<input  autocomplete="off" class="form-control underline" required id="exam_grade" placeholder="Enter Exam  Grade" type="text" name="exam_grade">' +
									'<span class="text-danger error-message here"></span>' +
								'</div>' +
							'</div>' +
						'</div>';

                        ca = ca + '<div class="row">' +
							'<div class="col-md-6">' +
								'<div class="form-group">' +
									'<label for="course_title">' +
									'	Exam Duration<span class="symbol required font"></span>' +
									'</label>' +
									'<input  autocomplete="off" class="form-control underline" required id="exam_duration" placeholder="Enter exam duration in minutes" type="text" name="exam_duration">' +
									'<span class="text-danger error-message here"></span>' +
								'</div>' +
							'</div>' +
						'</div>';

    $("#ca_test").html(ca);
}

$('form#form').on('click','button.create',(function(e)
{
			e.preventDefault();
			
			var exam_grade=$.trim($("input#exam_grade").val());
			//var assessement_id=$.trim($("input#assessement_id").val());

            var myForm = document.forms.form;
            var myControls = myForm.elements['ca_grade[]'];
            var x = "";
            var text = "";
            var sum_score = 0;

            for (var i = 0; i < myControls.length; i++) {
                var aControl = myControls[i];
               
                x = aControl.value;
                sum_score = sum_score + parseInt(x);
                if (isNaN(x) || x < 1) {
                    text = text + "Input not valid";
                } else {
                    text = text + "";
                }

            }

            x = $("#exam_grade").val();
            sum_score = sum_score +  parseInt(x);

            if (isNaN(x) || x < 1) {
                    text = text + "Input not valid";
                } else {
                    text = text + "";
                }
                console.log(sum_score);
            if (text == "")
            {
                 if (sum_score > 100 || sum_score < 100)
                 {
                    swal("error!", "Total course grade must be equal to 100", "error"); 
                 }else
                 {
                    $('form#form').submit();
                     //console.log(sum_score);
                 }

            }else
            {
                swal("error!", "Kindly enter a valid grade", "error"); 
            }





            /*if (isNaN(x) || x < 1 || x > 10) {
                    text = "Input not valid";
                } else {
                    text = "Input OK";
                }



			if(degree_class && degree_name && degree_short_name)
				
			else
				swal("error!", "All fields are compulsory", "error");*/
}));

	
	</script>
@endsection
