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
              <form enctype="multipart/form-data" id="form" action="{{route('save_edit_event')}}" method="post"  role="form">
               @csrf
               <div>
                @foreach ($event_collection as $val)


               <input value="{{$event_id}}" id="event_id" name="event_id" required type="hidden" >
                   <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="department">
                                    Title <span class="symbol required font"></span>
                                </label>
                                <input value="{{$val->event_title}}" autocomplete="off" class="form-control underline" required id="event_title" placeholder="Enter event Title" type="text" name="event_title">
                                <span class="text-danger error-message here"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="department">
                                    Venue <span class="symbol required font"></span>
                                </label>
                                <input value="{{$val->event_venue}}" autocomplete="off" class="form-control underline" required id="venue"  type="text" name="venue" placeholder="Enter Event Venue">
                                <span class="text-danger error-message here"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="department">
                                    Date <span class="symbol required font"></span>
                                </label>
                                <input value="{{$val->event_date}}" autocomplete="off" class="form-control underline" required id="event_date" placeholder="Enter Event Date" type="text" name="event_date">
                                <span class="text-danger error-message here"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="department">
                                    Start Time <span class="symbol required font"></span>
                                </label>
                                <input value="{{$val->event_start_time}}" autocomplete="off" class="form-control underline" required id="start_time" placeholder="Enter Start Time" type="text" name="start_time">
                                <span class="text-danger error-message here"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="department">
                                    End Time <span class="symbol required font"></span>
                                </label>
                                <input value="{{$val->event_end_time}}" autocomplete="off" class="form-control underline" required id="end_time" placeholder="Enter End Time" type="text" name="end_time">
                                <span class="text-danger error-message here"></span>
                            </div>
                        </div>
                    </div>

                    <div  class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="department">
                                    Banner Image <span class="symbol required font"></span>
                                </label>
                                <br/><img height="120" width="120" id="blah" src="{{asset("frontend/assets/img/event/".$val->img_path)}}" alt="your image" /><br/>
                                <input onchange="setRequired()" value="{{old('banner_image')}}" autocomplete="off" class="form-control underline" id="banner_image" placeholder="Enter Event Title" type="file" name="banner_image">
                                <span class="text-danger error-message here"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                
                                
                                    <h5 class="form-header">
                                     Event Content
                                    </h5>
                                <textarea cols="80" id="ckeditor1" name="ckeditor1" rows="10" required>{{$val->event_content}}</textarea>
                                   
                                <span class="text-danger error-message here"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <label  class="form-check-label"><input {{$val->file == 1?'checked value=1':'value=0'}}   onchange="show_attachment()" name="att_chkbox" id="att_chkbox" class="form-check-input" type="checkbox">Add Attachment</label>
                    </div>

                    @if($val->file == 1)
                        <div style="background-color:cornflowerblue; padding-top:3px; padding-bottom:3px;" id="attached_file" class="form-check col-md-3">
                            <label class="form-check-label"><input onchange="show_attachment2()" checked  name="att_chkbox2" id="att_chkbox2" class="form-check-input" type="checkbox"><font style="color:blue">{{$val->file_path}}</font></label>
                        </div>
                    @endif


                    <div id="attachment_div" style="display:none"  class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                
                                <input value="{{old('attachment_file')}}" autocomplete="off" class="form-control underline" id="attachment_file" placeholder="Enter event Title" type="file" name="attachment_file">
                                <span class="text-danger error-message here"></span>
                            </div>
                        </div>
                    </div>

                    <br/>

                   @endforeach

            <div class="row">
                <div style="padding-right:320px; padding-left:320px"  class="col text-center">
                    <button class="btn btn-primary btn-block btn-scroll btn-scroll-left ti-book create" type="submit"><span>SAVE Event</span></button>
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
        
        

        document.getElementById("banner_image").required = true;
    }

    


</script>