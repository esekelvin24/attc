
<div class="content-box">
    
    <div class="row">
        <div class="col-sm-12">
                <form id="form" action="{{route('save_timetable')}}" method="post" enctype="multipart/form-data"  role="form">
               @csrf

                
               <div>

              


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="programme_id">Programme</label>
                            <select onchange="get_course_list(this.value)" required autocomplete="off" class="form-control" id="programme"  name="programme">
                                <option value="" selected>--SELECT PROGRAMME--</option>
                                @if(!$programme_collection->isEmpty())
                                    @foreach($programme_collection as $val)
                                        <option value="{{ encrypt($val->programme_id) }}">{{ $val->programme_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
               
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="short_code">
                                Course <span class="symbol required font"></span>
                            </label>
                            <select required class="form-control" name="course" id="course">
                                  <option value=""> Select Course </option>
                            </select>
                            <span class="text-danger error-message here"></span>
                        </div>
                    </div>
                </div>

                <div class="row">

                   <div class="col-sm-6">
                        <div class="form-group">
                            <label for="short_code">
                                Date Range <span class="symbol required font"></span>
                            </label>
                            <input autocomplete="off" onchange="get_timetable_date_range()" class="form-control my_date" id="date_range" name="date_range"  >
                            <span class="text-danger error-message here"></span>
                        </div>
                   </div>

                  

                </div>

                
                <div id="range">

                </div>


                    

                    

                   
                    
<br/>


             <div class="row">
                <div style="padding-right:320px; padding-left:320px"  class="col text-center">
                    <button class="btn btn-primary btn-block btn-scroll btn-scroll-left ti-book create" type="submit"><span>SAVE TIMETABLE</span></button>
                </div>
           </div>

            <span class="clearfix"></span>

           </div>

          
              </form>
        </div>
    </div>
</div>

<script>

function get_course_list(value)
{

 
                   $.ajax(
								 {
									 type:"POST",
									 data:{
										 id : value,
										 _token:$("input[name='_token']").val()
									 },
									 url:"{{route('get_courses_by_programme_id')}}",
									 beforeSend:function()
									  {
										  $('form#form').block({ message: null }); 
									  },
									  success: function(r)
									  {							  
										 $('form#form').unblock(); 
							              $("#course").html(r);
											// swal("success!", "Operation was successful", "success");
										     //location.reload();
									  }
								 }
				 
						     );

}

 function get_timetable_date_range()
 {

     if ($('#date_range').val() != "" )
        $.ajax(
				{
									 type:"POST",
									 data:{
										 date_range : $('#date_range').val(),
										 _token:$("input[name='_token']").val()
									 },
									 url:"{{route('get_timetable_date_range')}}",
									 beforeSend:function()
									  {
										  $('form#form').block({ message: null }); 
									  },
									  success: function(r)
									  {							  
										 $('form#form').unblock(); 
							              $("#range").html(r);
											// swal("success!", "Operation was successful", "success");
										     //location.reload();
									  }
				}	 
		);
 }

    

          $('.my_date').daterangepicker({
			
			singleDatePicker: false,
			locale: {
				format: "YYYY-MM-DD"
			}
			});



			

            </script>