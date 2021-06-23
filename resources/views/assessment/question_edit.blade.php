
    <div class="content-box">
		@if(Session::get('assessement_success'))
		<div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
			Course created successfully!
		</div>
		@endif
        <div class="row">
            <div class="col-sm-12">
		            <form id="form" action="{{route('save_question_edit')}}" method="post"  role="form">
				   @csrf
					<input type="hidden" name="id" value="{{base64_encode($question_details->question_id)}}" >
			       <div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="assessement_type">Questions</label>
								<textarea name="question" class="form-control" role="6" cols="4">{{$question_details->question}}</textarea>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<div class="form-row">
								<div class="col">
									<label>A</label>
								  <input name="options[]" value="{{$question_details->option_1}}" type="text" class="form-control" placeholder="Option 1">
								</div>
								<div class="col">
									<label>B</label>
								  <input  name="options[]" value="{{$question_details->option_2}}" type="text" class="form-control" placeholder="Option 2">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-row">
								<div class="col"><br/>
									<label>C</label>
								<input name="options[]" value="{{$question_details->option_3}}" type="text" class="form-control" placeholder="Option 3">
								</div>

								<div class="col"><br/>
									<label>D</label>
								  <input name="options[]" value="{{$question_details->option_4}}" type="text" class="form-control" placeholder="Option 4">
								</div>
							  </div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-row">
								<div class="col"><br/>
									<label>Answer</label>
								<select id="answer" name="answer" class="form-control">
									<option value="">-- Select Answer --</option>
									<option {{$question_details->answer == 1?"selected":""}} value="1">A</option>
									<option {{$question_details->answer == 2?"selected":""}} value="2">B</option>
									<option {{$question_details->answer == 3?"selected":""}} value="3">C</option>
									<option {{$question_details->answer == 4?"selected":""}} value="4">D</option>
								</select>
									
								</div>

						    </div>
					</div>
					</div>

                <br/>
				<div class="row">
					<div class="col-md-12">
						<button class="btn btn-primary btn-block btn-scroll btn-scroll-left ti-book create" type="submit"><span>SAVE</span></button>
					</div>
			   </div>

                <span class="clearfix"></span>

               </div>
                  </form>
            </div>
        </div>
    </div>

    <script>



$('form#form').on('click','button.create',(function(e)
{
			    e.preventDefault();

			     if ()
                 {
                    swal("error!", "Total course grade must be equal to 100", "error"); 
                 }else
                 {
                    $('form#form').submit();
                     //console.log(sum_score);
                 }
}));

	
	</script>

