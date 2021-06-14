<script>
	CKEDITOR.replace('course_description');
    CKEDITOR.replace('course_outcome');
    
</script>
<div class="content-box">
    
    <div class="row">
        <div class="col-sm-12">
                <form id="form" action="{{route('save_course')}}" method="post" enctype="multipart/form-data"  role="form">
               @csrf

                
               <div>

               <div  class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="department">
                                    Course Image <span class="symbol required font"></span>
                                </label>
                                <br/><img height="120" width="120" id="blah" src="" alt="your image" /><br/>
                               
                                <input required  onchange="setRequired()" value="{{old('disp_img')}}" autocomplete="off" class="form-control underline change_img" id="disp_img" placeholder="Enter Event Title" type="file" name="disp_img">
                                <span class="text-danger error-message here"></span>
                           </div>
                        </div>
                    </div>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="programme_id">Programme</label>
                            <select onchange="get_programme_list()" required autocomplete="off" class="form-control" id="programme"  name="programme">
                                <option value="" selected>--SELECT PROGRAMME--</option>
                                @if(!$programme_collection->isEmpty())
                                    @foreach($programme_collection as $val)
                                        <option value="{{ $val->programme_id }}">{{ $val->programme_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
               
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="short_code">
                                Course Name <span class="symbol required font"></span>
                            </label>
                            <input value="" autocomplete="off" class="form-control underline" required id="course_name" placeholder="Enter Course Name" type="text" name="course_name">
                            <span class="text-danger error-message here"></span>
                        </div>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="short_code">
                                    Duration <span class="symbol required font"></span>
                                </label>
                               <select  required autocomplete="off" class="form-control" id="course_duration"  name="course_duration">
                                <option value="" >--SELECT DURATION--</option>
                                @for($i = 1; $i < 10; $i++)
                                   <option  value="{{$i}}" >{{$i}}</option>
                                @endfor
                               </select>
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="short_code">
                                    Duration Type <span class="symbol required font"></span>
                                </label>
                               <select  required autocomplete="off" class="form-control" id="duration_type"  name="duration_type">
                                <option value="" >--SELECT DURATION TYPE--</option>
                                <option  value="Day(s)" >Day(s)</option>
                                <option  value="Week(s)" >Week(s)</option>
                                <option  value="Month(s)" >Month(s)</option>
                               
                            </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="short_code">
                                    Price <span class="symbol required font"></span>
                                </label>
                                <input  value="" autocomplete="off" class="form-control underline" required id="course_price" placeholder="Enter Price" type="text" name="course_price">
                                <span class="text-danger error-message here"></span>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="short_code">
                                    Title <span class="symbol required font"></span>
                                </label>
                                <input  value="" autocomplete="off" class="form-control underline" required id="title" placeholder="Enter Title" type="text" name="title">
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
                                <input  value="" autocomplete="off" class="form-control underline" required id="short_code" placeholder="Enter Short Code" type="text" name="short_code">
                                <span class="text-danger error-message here"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                    <h5 class="form-header">
                                     Course Description
                                    </h5>
                                <textarea style="width:100%" id="course_description" name="course_description" rows="10" required></textarea>
                                   
                                <span class="text-danger error-message here"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                    <h5 class="form-header">
                                     Course Outcome
                                    </h5>
                                <textarea style="width:100%" cols="80" id="course_outcome" name="course_outcome" rows="10" required></textarea>
                                   
                                <span class="text-danger error-message here"></span>
                            </div>
                        </div>
                    </div>

                    



             <div class="row">
                <div style="padding-right:320px; padding-left:320px"  class="col text-center">
                    <button class="btn btn-primary btn-block btn-scroll btn-scroll-left ti-book create" type="submit"><span>SAVE COURSE</span></button>
                </div>
           </div>

            <span class="clearfix"></span>

           </div>

          
              </form>
        </div>
    </div>
</div>

<script>

function change_img()
{
    $(".change_img").show('fast');
    $(".default_img").hide('fast');
    $("#disp_img").attr("disabled", false);
    $('#disp_img').prop('required',true);
}

function cancel_chng_img()
{
    $(".change_img").hide('fast');
    $(".default_img").show('fast');
    $("#disp_img").attr("disabled", true);
     $('#disp_img').prop('required',false);
}

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

    $("#disp_img").change(function() {
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
            $("#attached_file").hide();
            
        }
    }

    function show_attachment2()
    {
        
        if(document.getElementById('att_chkbox2').checked) {
            $("#attachment_div").show();
            $("#att_chkbox").val(1);
        } else {
            $("#att_chkbox").val(0);
            $("#attachment_div").hide();
            $('#attachment_file').prop('required',false);
            $('#att_chkbox').prop('checked',false);
            $("#attached_file").hide();
            
        }
    }


    function setRequired()
    {
        
        

        document.getElementById("disp_img").required = true;
    }

    


</script>