
    <style>
    .md-card {
							background: #fff;
							position: relative;
							-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.12), 0 1px 2px rgba(0,0,0,.24);
							box-shadow: 0 1px 3px rgba(0,0,0,.12), 0 1px 2px rgba(0,0,0,.24);
							border: none;
						}


						.uk-container-center {
							margin-left: auto;
							margin-right: auto;
						}

						
					@media (min-width: 960px)
					{
						.uk-width-large-2-3, .uk-width-large-4-6 {
							width: 66.666%;
						}
						[class*=uk-width] {
							box-sizing: border-box;
							width: 100%;
						}
						
					}

					h1, h2, h3, h4, h5, h6 {
						font-family: Roboto,"Helvetica Neue",Helvetica,Arial,sans-serif;
						font-weight: 500;
					}
					.uk-h2, h2 {
						font-size: 24px;
						line-height: 30px;
					}
					h1, h2, h3, h4, h5, h6 {
						margin: 0 0 15px 0;
						font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
						font-weight: 400;
						color: #444;
						text-transform: none;
					}

					.backToQuestion, .nextQuestion, .questions li.question, .questions li.question .responses, .questions li.question .responses .correct, .questions li.question .responses .incorrect, .quizResults, .startQuiz {
						display: none;
					}
					.md-btn-large {
						line-height: 42px!important;
						font-size: 16px!important;
					}
					.md-btn {
						background: #fff;
						border: none;
						border-radius: 2px;
						-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.12), 0 1px 2px rgba(0,0,0,.24);
						box-shadow: 0 1px 3px rgba(0,0,0,.12), 0 1px 2px rgba(0,0,0,.24);
						min-height: 31px;
						min-width: 70px;
						padding: 2px 16px;
						text-align: center;
						text-shadow: none;
						text-transform: uppercase;
						-webkit-transition: all 280ms ease;
						transition: all 280ms ease;
						color: #212121;
						-webkit-box-sizing: border-box;
						box-sizing: border-box;
						cursor: pointer;
						-webkit-appearance: none;
						display: inline-block;
						vertical-align: middle;
						font: 500 14px/31px Roboto,sans-serif!important;
					}
					a {
						color: #1e88e5;
						-webkit-tap-highlight-color: transparent;
					}
					a, button {
						outline: 0!important;
					}
					.uk-link, a {
						color: #07D;
						text-decoration: none;
						cursor: pointer;
					}
					a {
						background: 0 0;
					}
					user agent stylesheet
					a:-webkit-any-link {
						color: -webkit-link;
						cursor: pointer;
						text-decoration: underline;
					}
					ol.questions, ol.questions li, ul.answers, ul.answers li, ul.responses, ul.responses li {
						margin: 0;
						padding: 0;
						list-style-type: none;
					}

					</style>
@php
	
	$question_no = Session::get('current_session_count') + 1;
    
	$selected_answer = "";
	$selected_answer_arr = array();
	$index = 0;
	if (Session::get('current_session_count')!=null)
	{
		$index = Session::get('current_session_count');
	}
	    // print_r(Session::get('current_session_count'));
		$index = Session::get('current_session_count')==""?0:Session::get('current_session_count');
	if (Session::get('user_response_arr') != null)
	{
		$selected_answer_arr = Session::get('user_response_arr');
	}
    
	if (count($selected_answer_arr) > 0)
	{
		if (isset($selected_answer_arr[$index]))
		    $selected_answer = $selected_answer_arr[$index]["response"];
	}

	//



	




	
		 

@endphp

<h2 class="quizName" id="slickQuiz-name" style="display: block;"><span>Test: </span>{{$course_details->course_name}} C.A</h2>
<div style="padding-left:0px;"><strong> Time Left is <span id="time">00:00</span> Seconds</strong></div><br/>			


					<div style="padding:20px;" class="md-card uk-width-large-2-3 uk-container-center">
						<div class="md-card-content large-padding">
						
							<div id="slickQuiz" aria-labelledby="slickQuiz-name" aria-live="polite" aria-relevant="additions" role="form">
								<div class="quizArea">
									<div class="quizHeader" style="display: block;"><div class="quizDescription"><p></p></div>
										<!-- where the quiz main copy goes -->
										<a class="md-btn md-btn-large md-btn-primary startQuiz" href="#" role="button" style="display: none;">Get Started!</a>
									</div>
									<!-- where the quiz gets built -->
								 <form id="form1">
								 <input type="hidden" name="selected_ans" id="selected_ans" value="{{$selected_answer}}" />
                                 
                                       
									   <div id="display_message" class="questionCount">
									   <input type="hidden" name="unique_ref" id="unique_ref" value="0xf27b1d7d98d20da2"><input type="hidden" name="id" id="id" value="733">Question <span class="current">{{$question_no}}</span> of <span class="total">{{count($questions)}}</span>
									  <br/>
                                      <br/>
									  
									  


										 <h5><i>{{$question_no}}. {{$questions[$index]->question}}</i></h5>
										   <ul class="answers">
											<div class="uk-width-medium-2-5">

											
											    <p>
													<input {{$selected_answer==1?"checked":""}} onclick="setAnswer(this.value)" type="radio" value="1" class="answer" name="answer" id="answer">
													<label for="answer1" class="inline-label">{{$questions[$index]->option_1}}</label>
												</p>
												
												<p>
													<input {{$selected_answer==2?"checked":""}}  onclick="setAnswer(this.value)" type="radio" value="2" class="answer" name="answer" id="answer">
													<label for="answer2" class="inline-label">{{$questions[$index]->option_2}}</label>
												</p>
												
												<p>
													<input {{$selected_answer==3?"checked":""}}  onclick="setAnswer(this.value)" type="radio" value="3" class="answer" name="answer" id="answer">
													<label for="answer3" class="inline-label">{{$questions[$index]->option_3}}</label>
												</p>
												
												<p>
													<input {{$selected_answer==4?"checked":""}}  onclick="setAnswer(this.value)" type="radio" value="4" class="answer" name="answer" id="answer">
													<label for="answer4" class="inline-label">{{$questions[$index]->option_4}}</label>
												</p>
											
											</div>		

												<input type="hidden" name="prev_quest" id="prev_quest" value="{{$index}}">
												
												<a href="#" id="prev" class="md-btn md-btn-large nextQuestion" role="button" style="display: inline-block;"><i class="fa fa-arrow-left"></i> PREV </a>

										        <a href="#" id="next" class="md-btn md-btn-large nextQuestion" role="button" style="display: inline-block;">NEXT <i class="fa fa-arrow-right"></i></a>
								 </ul></div>
								 </form>
												
			
							</div>
						</div>
			</div>
			 <script>
			
			function setAnswer(value)
			{
				//alert(value);
				$("#selected_ans").val(value);
			}

            $('form#form1').on('click','#next',(function(e)
            {
                var toks=$("input[name='_token']").val();
                $.ajax(
                            {
                                type:"POST",
                                data:{ answer:$("#selected_ans").val(), _token:toks, from:'{{base64_encode("next_page")}}'},
                                url:"{{ route('next_question') }}",
                                beforeSend:function()
                                {
                                    $('table').block({ message: null });
                                    
                                },
                                success: function(r)
                                {
                                    $("#page").html(r);
                                }
                            }

                    );
                
            }));


			$('form#form1').on('click','#prev',(function(e)
            {

				
                var toks=$("input[name='_token']").val();
                $.ajax(
                            {
                                type:"POST",
                                data:{ answer:$("#selected_ans").val(), _token:toks, from:'{{base64_encode("prev_page")}}', prev: $('#prev_quest').val()},
                                url:"{{ route('prev_question') }}",
                                beforeSend:function()
                                {
                                    $('table').block({ message: null });
                                    
                                },
                                success: function(r)
                                {
                                    $("#page").html(r);
                                }
                            }

                    );
                
            }));



@php


             
			$content = Cache::get(Session::get('assessment_id').'_'.Auth::user()->id);

          

			$content_arr = explode(":",$content);
			$hr = $content_arr[0];
			$min = $content_arr[1];
			$sec = $content_arr[2];

			echo "
					var hour= ".$hr.";
					var min = ".$min.";
					var sec = ".$sec.";
			";	

@endphp



var tim;
       
	   //*****var f = new Date();
	   function f1() {
		   clearTimeout(tim);
		   f2();
		   //document.getElementById("time").innerHTML = "Your started your Exam at " + f.getHours() + ":" + f.getMinutes();
	   }
	   
	   function f2() {
		   //alert(min);
		   if (parseInt(sec) > 0 || parseInt(min) > 0) {
			   sec = parseInt(sec) - 1;
			   if (sec < 1 && parseInt(min) > 0 )
			   {
				   min = parseInt(min) - 1;
				   sec = 60;
			   }
			   document.getElementById("time").innerHTML = ""+hour+":"+min+":" + sec+"";
			   tim = setTimeout("f2()", 1000);
			   
			   var toks=$("input[name='_token']").val();
			   $.ajax(
                            {
                                type:"POST",
                                data: {  _token:toks, val: ""+hour+":"+min+":" + sec+""},
                                url:"{{ route('this_log') }}",
                                beforeSend:function()
                                {
                                    
                                },
                                success: function(r)
                                {
                                  
                                }
                            }

                    );


		   }
		   else {
			var toks=$("input[name='_token']").val();
			   $.ajax(
                            {
                                type:"POST",
                                data: {  _token:toks, val: ""+hour+":"+min+":" + sec+""},
                                url:"{{ route('this_log') }}",
                                beforeSend:function()
                                {
                                    
                                },
                                success: function(r)
                                {
                                  
                                }
                            }

                );  
			   
			   
			   alert("time up");
			   

			   var toks=$("input[name='_token']").val();
                $.ajax(
                            {
                                type:"POST",
                                data:{ answer:$("#selected_ans").val(), _token:toks, from:'{{base64_encode("end_ca")}}'},
                                url:"{{ route('next_question') }}",
                                beforeSend:function()
                                {
                                    $('table').block({ message: null });
                                    
                                },
                                success: function(r)
                                {
                                    $("#page").html(r);
                                }
                            }

                );
		   }
	   }
	   
			
		$( document ).ready(function() {
		f1();
		});

			


			 </script>
			 
			 
			 
			 </div>