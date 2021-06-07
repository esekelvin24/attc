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
					

                @if(count($course_collection) > 0)
					<table id="dataTable1" class="table table-striped" style="width: 100% !important;">
						<thead>
							<tr>
                                <th><input type="checkbox" name="allcb" id="allcb"></th>
								<th>Course Title</th>
								<th>Short Code</th>
								
								<!-- <th>Status</th> --->
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th></th>
								<th>Course Title</th>
								<th>Short Code</th>
							</tr>
						</tfoot>
						<tbody>
						
							@foreach($course_collection as $val)
								<tr>
								<td><input {{  in_array($val->short_code, $lect_map_history, TRUE)? "checked":""}}   onchange="setVal()" class="theClass" type="checkbox" id="courses" value="{{$val->short_code}}"  name="courses[]" ></td>
								<td>{{$val->course_title}}</td>
									<td>{{$val->short_code}}</td>
								</tr>
							 @endforeach
                        @endif
						</tbody>
					</table>
					<div align="center">
						<button type="submit" class="btn btn-success create"> Map to Course</button>
					</div>
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




		       $.each($("input[class='theClass']:checked"), function(){
                    favorite = $(this).val();
					console.log(favorite);
                });

				$("#my_check").val(favorite);
				favorite = "";

		}); 

		var favorite = "";

        function setVal()
		{
                
				$.each($("input[class='theClass']:checked"), function(){
                    favorite = $(this).val();
					console.log(favorite);
                });

				$("#my_check").val(favorite);
				favorite = "";
		}


		$('form#form').on('click','button.create',(function(e)
          {
			e.preventDefault();

			course_sel = $("#my_check").val();

			if (course_sel != "")
            {
				$('form#form').submit();

            }else
            {
				$('form#form').submit();
               // swal("error!", "Kindly select a course", "error"); 
            }


         }));



		
</script>