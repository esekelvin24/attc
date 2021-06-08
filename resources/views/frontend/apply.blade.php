@extends('../layouts.frontend')


@section('title-name')
Apply for a programme
@endsection

@section('content')

<style>

.my-fieldset {
    font-family: sans-serif;
    border: 5px solid #161644;
    background: white;
    border-radius: 5px;
    margin-top: 1px;
	padding-left:10px;
	padding-top:-20px;
}

.my-fieldset .my-legend {
    background: #161644;
    color: #fff;
    padding: 5px 10px ;*/
    font-size: 17px;
    border-radius: 5px;
    box-shadow: 0 0 0 5px #ddd;
    margin-left: 0px;
}



.modal-header {
    border-bottom: none
}

.modal-title {
    font-size: 25px;
    font-weight: 700;
    color: #1A237E
}

.modal-body {
    font-style: italic;
    font-size: 15px;
    font-weight: 500;
    color: #1A237E
}

.checkbox-form {
    background: #ecedf1;
    color: #002147;
    margin-top: 10px;
    padding: 7px 5px 5px 10px;
    cursor: pointer;
    border-radius: 1px
}

.learn {
    text-decoration: none;
    color: #fff
}

.add-list {
    height: 45px;
    line-height: 27px;
    background-color: #D32F2F;
    color: #fff !important
}

</style>


    <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area shadow dark bg-fixed text-center text-light" style="background-image: url({{asset('frontend/assets/img/banner/13.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Apply</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="active">Apply for programmes</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <div class="container">
<br/>

@php
    $account = Auth::user()->user_type;

@endphp

@if($account == 1)
         
   @if( Auth::user()->email_verified_at ==  null)

            <div style="min-height:400px;" align="center">
                <img width="100" height="100" src="{{asset('img/barred.png')}}" >
                <p>You email address has not been verified, kindly click on the link sent to your email during registration<p>
            </div>
   @else

                @if(Session::get('application_success'))

                    <div style="min-height:400px;" align="center">
                        <img width="100" height="100" src="{{asset('img/success.png')}}" >
                        <p>{!!Session::get('application_success')!!}<p>
                    </div>
                @else

                    <form class="form-horizontal" action="{{route('sumbit_application')}}" method="post"  id="form" enctype="multipart/form-data">
                    @csrf
                    <fieldset>

                    <!-- Form Name -->
                    <legend><center><h2><b>Application Form</b></h2></center></legend><br>






                    <div class="form-group"> 
                    <label class="col-md-4 control-label">PROGRAMMES</label>
                        <div class="col-md-4 selectContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <select required name="programme" id="programme" class="form-control selectpicker">
                                @foreach($programme_collections as $val)
                                    <option value="{{$val->programme_id}}">{{$val->programme_name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group"> 
                    <label class="col-md-4 control-label">HIGHEST ACADEMIC QUALIFICATIONS</label>
                        <div class="col-md-4 selectContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <select required name="qualification" id="qualification" class="form-control selectpicker">
                                    <option value="">Select a qualification</option>
                                    @foreach($qualification_collections as $val)
                                    <option value="{{$val->qualification_id}}">{{$val->qualification_name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    {{--
                    <div class="form-group"> 
                    <label class="col-md-4 control-label">ACADEMIC QUALIFICATIONS</label>
                        <div class="col-md-4 selectContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <textarea required name="academic_qualification" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    --}}

                    <!-- Select Start -->
                    <div class="form-group">
                        <label class="col-md-4 control-label">ACADEMIC QUALIFICATIONS UPLOAD</label>
                        <div class="drag-drop-body col-md-4 col-sm-12 selectContainer">
                            <div class="drag-area">
                                <div style="color:#002147" class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                    <header>Drag & Drop to Upload File</header>
                                    <span>OR</span>
                                    <button id="academic_btn_visible" type="button">Browse File</button>
                                    <input required id="academic_qualification_upload" name="academic_qualification_upload" style="display:none" type="file" hidden>
                                    <span id="file_name"></span>
                                </div>
                            </div>
                        </div>
                    <!-- Select Basic -->

                    <div class="form-group"> 
                    <label class="col-md-4 control-label">PREVIOUS EXPERIENCE</label>
                        <div class="col-md-4 selectContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <textarea required name="previous_experience" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Select Start -->
                    <div class="form-group">
                        <label class="col-md-4 control-label">PREVIOUS EXPERIENCE UPLOAD</label>
                        <div class="drag-drop-body col-md-4 col-sm-12 selectContainer">
                            <div class="drag-area_exp">
                                <div style="color:#002147" class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                    <header class="header_exp">Drag & Drop to Upload File</header>
                                    <span>OR</span>
                                    <button id="experience_btn_visible" type="button">Browse File</button>
                                    <input required id="previous_experience_upload" name="previous_experience_upload" style="display:none" type="file" hidden>
                                    <span id="file_name_exp"></span>
                                </div>
                            </div>
                        </div>
                    <!-- Select Basic -->

                    <fieldset class="my-fieldset">
                                                            
                        <legend class="my-legend">Course List</legend>
                        <div class="row">
                                                                                
                        
                            
                                <div class="modal-body mt-0"> 
                                    <div class="mt-3">
                                    @foreach($course_collection as $val)
                                        <div class="p-2 rounded checkbox-form">
                                            <div class="form-check checked"> <input data-id="{{$val->course_price}}" id="{{$val->course_price}}" {{$val->course_id ==  $course_id?"checked":""}} name="course[]" style="min-height:1px !important;" class="my_price" type="checkbox" value="{{$val->course_id}}" id="flexCheckDefault-1"> <label class=" newsletter form-check-label" for="flexCheckDefault-1"> {{$val->short_code}} {{$val->course_name}} | {{$val->course_duration}} Weeks | ₦{{$val->course_price}}  </label> </div>
                                        </div> 
                                    @endforeach
                                        
                                    </div>
                                </div>

                        </div>
                        </fieldset>
                        <br/>
                        
                        <div id="wpforms-570-field_19-container" class="wpforms-field wpforms-field-checkbox" data-field-id="19"><label class="wpforms-field-label" for="wpforms-570-field_19">ATTESTATION <span class="wpforms-required-label">*</span></label></div>
                        <div class="p-2 rounded checkbox-form">
                                <div class="form-check checked"> <input name="attestation" id="attestation" style="min-height:1px !important;" class="" type="checkbox" > <label class=" newsletter form-check-label" for="flexCheckDefault-1"> I hereby confirm that the above information provided are correct. I accept responsibility for any information found to be untrue.  </label> </div>
                            
                        </div> 

                    <hr>
                    <div >
                    <br/>
                    @if($price != 0)
                        <h3 id="price_div">Total: ₦ {{number_format($price,2)}}</h4>
                    @else
                        <h3 id="price_div"></h4>
                    @endif
                    </div>

                    {{--
                    <!-- Success message -->
                    <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>
                    --}}
                    <!-- Button -->
                    <div class="form-group">
                    <label class="col-md-4 control-label"></label>
                    <div  align="center"><br>
                    <button type="submit" class="btn btn-warning create" >SUBMIT <span class="fa fa-paper-plane"></span></button>
                    </div>
                    </div>

                    </fieldset>
                    </form>
                @endif {{-- End if application success --}}
    @endif {{-- End if verified email at --}}
@else
       <div style="min-height:400px;" align="center">
                <img width="100" height="100" src="{{asset('img/barred.png')}}" >
                <p>You may not able to apply with your staff account<p>
            </div>
@endif


</div>
    </div><!-- /.container -->

@section('additional_js')
<script>

        var total_checked = 0;
        var xx = new Intl.NumberFormat('NGN', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
        });

        

        $('form#form').on('click','button.create',(function(e)
		{
			e.preventDefault();
			
			var academic_qualification_upload = $("input#academic_qualification_upload").val();
			//var previous_experience_upload = $.trim($("input#previous_experience_upload").val());
			var programme = $("select#programme").val();
            var qualification = $("select#qualification").val();
            var attestation = $("input#attestation").val();
          
           
            if(!programme)
                Swal.fire("Error", "Programme field is compulsory", "error");
			else if(!qualification)
				Swal.fire("Error", "Academic Qualification is compulsory", "error");
            else if(!academic_qualification_upload)
				Swal.fire("Error", "Academic Qualification Document is compulsory", "error");
            else if(!total_checked)
                Swal.fire("Error", "kindly select a course", "error");
            else if(! $('#attestation').is(':checked'))
                Swal.fire("Error", "Attestation check box is not checked", "error");
			else
				$('form#form').submit();

		}));


        
        /*--------------------------Apply checkbox select ---------------------*/
           $(function()
           {
               $('.my_price').each(function () {
                total_checked += this.checked ?parseFloat($(this).data("id")): 0 ;  
              }); 
           });
           
       
        $('.my_price').change(function() {
           
            total_checked = 0;
            $('.my_price').each(function () {
                total_checked += this.checked ?parseFloat($(this).data("id")): 0 ;  
            }); 
            
            $("#price_div").html("Total: ₦"+xx.format(total_checked));         
        });
        /*--------------------------End Apply checkbox select ---------------------*/  
</script>
@endsection

@endsection

