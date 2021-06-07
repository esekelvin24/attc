
<div class="content-box">
    @if(Session::get('cross_course_success'))
    <div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
        News created successfully!
    </div>
    <br/>
    @endif
    <div class="row">
        <div class="col-sm-12">
                <form id="form" action="{{route('save_edited_cross_course')}}" method="post"  role="form">
               @csrf

               @foreach ($cross_course_collection as $cour)
                   
                <input required id="cross_course_id" name="cross_course_id" value="{{$cour->cross_course_id}}" type="hidden" >
               <div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="programme_id">Programme Type</label>
                            <select onchange="get_programme_list()" required autocomplete="off" class="form-control" id="programme_type"  name="programme_type">
                                <option value="" selected>--Please Select Programme Type--</option>
                                @if(!$program_type_collection->isEmpty())
                                    @foreach($program_type_collection as $val)
                                        <option {{$programme_type_id==$val->program_type_id?'selected':''}} value="{{ $val->program_type_id }}">{{ $val->program_type_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="programme_id">Programme</label>
                            <select required autocomplete="off" class="form-control" id="programme_id"  name="programme_id">
                                <option value="" selected>--Please Select Programme--</option>
                                @if(!$programme_collection->isEmpty())
                                    @foreach($programme_collection as $val)
                                        <option {{$cour->programme_id==$val->programme_id?'selected':''}} value="{{ $val->programme_id }}">{{ $val->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="programme_id">Course</label>
                            <select required autocomplete="off" class="form-control" id="course_id"  name="course_id">
                                <option value="" selected>--Please Select Course--</option>
                                @if(!$course->isEmpty())
                                    @foreach($course as $val)
                                        <option {{$course_id==$val->course_id?'selected':''}} value="{{ $val->course_id }}">{{ $val->course_title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="short_code">
                                    Short Code <span class="symbol required font"></span>
                                </label>
                                <input disabled value="{{$course_short_code}}" autocomplete="off" class="form-control underline" required id="short_code" placeholder="Enter Short Code" type="text" name="short_code">
                                <span class="text-danger error-message here"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="credit_unit">
                                    Credit Unit <span class="symbol required font"></span>
                                </label>
                                <input value="{{$cour->cross_course_unit}}" autocomplete="off" class="form-control underline" required id="credit_unit" placeholder="Enter Credit Unit" type="text" name="credit_unit">
                                <span class="text-danger error-message here"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select required autocomplete="off" class="form-control" id="category"  name="category">
                                    <option value="" selected>--Please Select Category--</option>
                                    <option {{$cour->cross_course_category==1?'selected':''}} value="1">Mandatory</option>
                                    <option {{$cour->cross_course_category==2?'selected':''}} value="2">Elective</option>
                                </select>
                            </div>
                        </div>
                    </div>


                     
                    @php
                    $prog_id = $cross_course_collection[0]->programme_id;

                    $options = '<option value = ""> Select a Year </option>';

                    $duration = DB::table('tbl_programmes')->where('programme_id',$prog_id)->first()->duration;

                    for ($i = 1; $i < $duration + 1; $i++)
                    {
                            //
                        $selected = $i==$cour->cross_course_year?" selected":"";
                        $options = $options.' <option '.$selected.'  value ="'.$i.'" >'.$i.'</option>';
                    }



                    @endphp

                    <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="Year">
                            Year <span class="symbol required font"></span>
                        </label>
                        <select required name="year" id="year" class="form-control underline">
                            {!! $options !!} 
                        </select>
                        <span class="text-danger error-message here"></span>
                    </div>
                    </div>
                    </div>



                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="semester">
                                    Semester <span class="symbol required font"></span>
                                </label>
                                <select required name="semester" id="semester" class="form-control underline">
                                    <option {{$cour->cross_course_semester==1?"selected":""}} value="1">1</option>
                                    <option {{$cour->cross_course_semester==2?"selected":""}} value="2">2</option>
                                </select>
                                <span class="text-danger error-message here"></span>
                            </div>
                        </div>
                    </div>



            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-primary btn-block btn-scroll btn-scroll-left ti-book create" type="submit"><span>SAVE CHANGES</span></button>
                </div>
           </div>

            <span class="clearfix"></span>

           </div>

           @endforeach
              </form>
        </div>
    </div>
</div>

<script>

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