
<div class="content-box">
    
    <div class="row">
        <div class="col-sm-12">
                <form id="form" action="{{route('save_update_timetable')}}" method="post" enctype="multipart/form-data"  role="form">
               @csrf

                
               <div>

              


                <div class="row">
                   
                   
                <input type="hidden"  value="{{encrypt($timetable_collection[0]->id)}}" autocomplete="off"  class="form-control" id="attendance_id" name="attendance_id"  >
                           
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="short_code">
                                Course <span class="symbol required font"></span>
                            </label>
                            <input disabled value="{{$timetable_collection[0]->course_name}}" autocomplete="off" class="form-control" id="course_name" name="course_name"  >
                            <span class="text-danger error-message here"></span>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label>Date</label>
                        <input readonly class="form-control" name="dates" value="{{$timetable_collection[0]->lecture_date}}">
                    </div>
                    <div class="col-md-4">
                        <label>Start Time</label>
                        <input style="background:white" required class="form-control my_time" name="start_time" value="{{$timetable_collection[0]->start_time}}">
                    </div>
                    <div class="col-md-4">
                        <label>End Time</label>
                        <input style="background:white" required class="form-control my_time" name="end_time" value="{{$timetable_collection[0]->end_time}}">
                    </div>
             </div>
              <div class="row">
                    <div class="col-md-4">
                        <label>Zoom Link</label>
                        <input  class="form-control" name="zoom_link" value="{{$timetable_collection[0]->zoom_link}}">
                    </div>
                    <div class="col-md-4">
                        <label>Zoom ID</label>
                        <input class="form-control" name="zoom_id" value="{{$timetable_collection[0]->zoom_id}}">
                    </div>
                    <div class="col-md-4">
                        <label>Zoom Password</label>
                        <input class="form-control" name="zoom_password" value="{{$timetable_collection[0]->zoom_password}}">
                    </div>
             </div>
             <script>
                    $(".my_time").mdtimepicker(
                        {
                            format:"hh:mm",
                            theme:"blue"
                        }
                    ); //Initializes the time picker	
             </script>

                

                
            


                    

                    

                   
                    
<br/>


             <div class="row">
                <div style="padding-right:320px; padding-left:320px"  class="col text-center">
                    <button class="btn btn-primary btn-block btn-scroll btn-scroll-left ti-book create" type="submit"><span>UPDATE TIMETABLE</span></button>
                </div>
           </div>

            <span class="clearfix"></span>

           </div>

          
              </form>
        </div>
    </div>
</div>

<script>



    

          $('.my_date').daterangepicker({
			
			singleDatePicker: false,
			locale: {
				format: "YYYY-MM-DD"
			}
			});



			

            </script>