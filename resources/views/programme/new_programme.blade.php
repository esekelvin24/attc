<script>
	CKEDITOR.replace('course_description');
    CKEDITOR.replace('course_outcome');
    
</script>
<div class="content-box">
    
    <div class="row">
        <div class="col-sm-12">
                <form id="form" action="{{route('save_programme')}}" method="post" enctype="multipart/form-data"  role="form">
               @csrf

                 <div>

               <div  class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="department">
                                    Programme Image <span class="symbol required font"></span>
                                </label>
                                <br/><img style="display:none;"  height="120" width="120" id="blah" src="" alt="your image" /><br/>
                               
                                <input  onchange="setRequired()" value="{{old('disp_img')}}" autocomplete="off" class="form-control underline change_img" id="disp_img" placeholder="Enter Event Title" type="file" name="disp_img">
                                <span class="text-danger error-message here"></span>
                            </div>
                        </div>
                    </div>


                <div class="row">
                   
               
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="short_code">
                                Programme Name <span class="symbol required font"></span>
                            </label>
                            <input value="" autocomplete="off" class="form-control underline" required id="programme_name" placeholder="Enter Programme Name" type="text" name="programme_name">
                            <span class="text-danger error-message here"></span>
                        </div>
                    </div>
                </div>

                   
                  <hr>
                    <div class="row">
                        <div class="col-md-3">
                           <input checked  data-sub="1" id="c1" name="enable_programme" value="1" type="checkbox">
                           <label for="c1">Enable Programme</label>
                        </div>
                    </div>
                <hr>        



             <div class="row">
                <div style="padding-right:320px; padding-left:320px"  class="col text-center">
                    <button class="btn btn-primary btn-block btn-scroll btn-scroll-left ti-book create" type="submit"><span>SAVE PROGRAMME</span></button>
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
        
        $("#blah").show();

        document.getElementById("disp_img").required = true;
    }

    


</script>