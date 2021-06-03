@extends('layouts.dash_layout')

@section('content')

<style>
.rounded-corners {
    -moz-border-radius: 20px;
    -webkit-border-radius: 20px;
    -khtml-border-radius: 20px;
    border-radius: 20px;
	 border: 1px solid red;
	 padding-top:10px;
}
fieldset {
    font-family: sans-serif;
    border: 5px solid #1F497D;
    background: white;
    border-radius: 5px;
    margin-top: 1px;
	padding-left:5px;
	padding-right:5px;
	padding-top:-20px;
}

fieldset legend {
    background: #1F497D;
    color: white;
    padding: 5px 10px ;
    font-size: 17px;
    border-radius: 5px;
    box-shadow: 0 0 0 5px #ddd;
    margin-left: 0px;
}
legend span
{
	background: #1F497D !important;
}
</style>
	<div class="content-box">
		<div class="row">
			<div class="col-sm-12">
				<div class="element-wrapper">
					<h6 class="element-header">
						Create New User
					</h6>
					<div class="element-content">
						<div class="row">
                            <div class="col-md-12 col-lg-12">
							    <div class="element-wrapper">
								<div class="element-box">
									<form id="formValidate"  >
										@csrf
										<fieldset class="form-group">
											<legend><span>Personal Information</span></legend>
											<div id="container" class="form-group" style="margin-top: 20px">
												<div id="staff-container"> </div>
												<input id="staff_pic" type="file" name="staff_pic" /><br/>
												<span style="font-size: 13px; color:darkslategrey">Select a Staff Image.Only JPEG, PNG &amp; GIF formats.  Image should not be larger than 300 KB</span>
											</div>

											<div class="row">
												<div class="col-sm-12 col-md-3 col-lg-3">
													<div class="form-group">
														<label for="designation">Title</label>
														<select class="form-control" id="title"  name="title">
															<option value="" selected >Select Title</option>
															@if(!$title_collection->isEmpty())
																@foreach($title_collection as $val)
																	<option value="{{ $val->title_id }}">{{ $val->title_name }}</option>
																@endforeach
															@endif
														</select>
													</div>
												</div>
											
												<div class="col-sm-12 col-md-3 col-lg-3">
													<div class="form-group">
														<label for=""> First Name</label><input value="{!! old('firstname') !!}" autocomplete="off" name="firstname" class="form-control" data-error="Please input your First Name" placeholder="First Name" required="required" type="text">
														<div class="help-block form-text with-errors form-control-feedback"></div>
													</div>
												</div>
												<div class="col-sm-12 col-md-3 col-lg-3">
													<div class="form-group">
														<label for=""> Middle Name</label><input value="{!! old('middlename') !!}" autocomplete="off" name="middlename" class="form-control" data-error="Please input your Middle Name" placeholder="Middle Name" type="text">
														<div class="help-block form-text with-errors form-control-feedback"></div>
													</div>
												</div>
												<div class="col-sm-12 col-md-3 col-lg-3">
													<div class="form-group">
														<label for="">Last Name</label><input value="{!! old('lastname') !!}" autocomplete="off" name="lastname" class="form-control" data-error="Please input your Last Name" placeholder="Last Name" required="required" type="text">
														<div class="help-block form-text with-errors form-control-feedback"></div>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-sm-12 col-md-3 col-lg-3">
													<div class="form-group">
														<label for="gender">Gender</label>
														<select class="form-control" id="gender"  name="gender">
															<option value="" selected >Select Gender</option>
															<option value="1">Male</option>
															<option value="2">Female</option>
														</select>
													</div>
												</div>
											
												<div class="col-sm-12 col-md-3 col-lg-3">
													<div class="form-group">
														<label for="gender">Branch</label>
														<select class="form-control" id="branch"  name="branch">
															<option value="" selected >Select Branch</option>
																@foreach($branch_collections as $val)
																 <option value="{{$val->branch_code}}">{{$val->branch_name}}</option>
																@endforeach
															
														</select>
													</div>
												</div>
												<div class="col-sm-12 col-md-3 col-lg-3">
													<div class="form-group">
														<label for="department">Department</label>
														<select onchange="get_designation(this.value)" class="form-control" id="department"  name="department">
															<option value="" selected >Select Department</option>
															@if(!$department_collection->isEmpty())
																@foreach($department_collection as $val)
																	<option value="{{ $val->department_id }}">{{ $val->department_name }}</option>
																@endforeach
															@endif
														</select>
													</div>
												</div>
												<div class="col-sm-12 col-md-3 col-lg-3">
													<div class="form-group">
														<label for="designation">User Designation</label>
														<select class="form-control" id="designation"  name="designation">	
														</select>
													</div>
												</div>
												<div class="col-sm-12 col-md-3 col-lg-3">
													<div class="form-group">
														<label for="">Phone</label><input value="{!! old('phone') !!}" autocomplete="off" name="phone" class="form-control" data-error="Please input your phone number" placeholder="Phone Number" required="required" type="text">
														<div class="help-block form-text with-errors form-control-feedback"></div>
													</div>
												</div>
											</div>
										</fieldset>

										<div class="row">

										        
											</div>



										<fieldset class="form-group">
											<legend><span>User Access, Views & Privileges</span></legend>
											@if($god_eye)
											{{--<div class="form-check">
												<label class="form-check-label"><input name="god_eye" class="form-check-input" type="checkbox">Make Global Admin</label>
											</div>
											<br/>--}}
											@endif

											


											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label for="role_id">User Roles</label>
														<select class="form-control" id="role"  name="role">
															<option value="" selected >Select Role</option>
															@if(!$roles_collection->isEmpty())
																@foreach($roles_collection as $val)
																	<option value="{{ $val->id }}">{{ $val->name }}</option>
																@endforeach
															@endif
														</select>
													</div>
												</div>
                                                <style>
                                                    .label-success {
                                                        background-color: #5cb85c;
                                                        color: #ffffff !important;
                                                    }
                                                    .label-danger {
                                                        background-color: #d9534f;
                                                        color: #ffffff !important;
                                                    }
                                                </style>
												<div class="col-sm-6">
													<div class="form-group">
														<label for="email">
															Email address <span class="symbol required"></span>
														</label>

														<input value="{!! old('email') !!}" autocomplete="off" class="form-control underline" id="email" placeholder="Enter Email Address" type="text" name="email">
														<div class="help-block form-text with-errors user_feedback form-control-feedback">No Email specified</div>
													</div>
												</div>
											</div>
										</fieldset>

										<style>
											input.hidden{
												display:none !important;
											}
										</style>


										<div id="here">

										</div>

										@if(!$roles_collection->isEmpty()  )
											<div class="form-buttons-w">
												<button style="cursor: pointer" class="btn btn-lg btn-danger create_staff" type="submit"> Submit</button>
											</div>
										@endif
									</form>
								</div>
							</div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('additional_js')
	<script src="{{asset('bower_components/bootstrap-checkbox/bootstrap-checkbox.js')}}"></script>
	<script src="{{asset('bower_components/jquery-simple-tree.js')}}"></script>
	<script>

	function get_designation(value)
	{
		          var val = value;
					var toks=$("input[name='_token']").val();
                    	$.ajax(
								{
									type:"POST",
									data:{id:val,
										_token:toks
									},
									url:"{{route('get_designation')}}",
									beforeSend:function()
									{
										//$('div.user_feedback').html("...checking <img src='{{asset('_img/loading.gif')}}'/> ");
									},
									success: function(r)
									{
										
											$('#designation').html(r);
									}
								}

						);
					
	}
		$(document).ready(function() {
			//$('#basic').simpleTree();

			$('input[data-sub]').on('click',function(e)
			{
				var whr=$(this).data('sub');

				if($(this).is(":checked")){
					$("input[data-suber="+whr+"]").prop("checked", true);
				}else{
					$("input[data-suber="+whr+"]").removeAttr("checked");
				}
			});


			$('input[data-suber]').click(function(e)
			{
				var whr=$(this).data('suber');

				if($(this).is(":checked")){
					$("input[data-sub="+whr+"]").prop("checked", true);
				}
				else
				{

					if($("input[data-suber="+whr+"]:checked").length==0)
					{
						$("input[data-sub="+whr+"]").removeAttr("checked");
					}

				}
			});
		});

		$('body').on('click','.nav-tabs > li a',function(){
			$('.nav-tabs > li').removeClass('attention');
			$(this).parent('li').addClass('attention');
		});

		//user pic and other uploads manipulation
		$("#staff_pic").on('change', function() {

			var iden=$(this).attr('id');

			if(iden=="staff_pic")
			{
				var ext1=$.trim($('input[name="staff_pic"]').val().split('.').pop().toLowerCase());
				if(($.inArray(ext1, ['gif','png','jpg','jpeg']) == -1)  )
				{
					$('input[name="staff_pic"]').val("");
					$("#user-container").empty();
					sweetAlert("Oops...", "Invalid File Formats. Only Image File Formats like jpg, png, gif Allowed!", "error");
				}
				else
				{

					if (typeof(FileReader) == "undefined")
					{
						alert("Your browser doesn't support HTML5, Please use an upgraded version of Chrome or Mozilla Firefox");
					}
					else
					{

						var container = $("#user-container");

						//remove all previous selected files
						container.empty();

						//create instance of FileReader
						var reader = new FileReader();
						reader.onload = function(e) {
							$("<img />", {
								"src": e.target.result,
								"width": 150,
								"height":150,
								"class":"img-rounded"
							}).appendTo(container);
						}

						reader.readAsDataURL($(this)[0].files[0]);
					}
				}
			}

		});


		//all resets
		$('form#formValidate')[0].reset();
		$('select').val("");
		$("input[type=checkbox]").removeAttr("checked");
		$("input.views:first").prop("checked",true);

		//check and uncheck functionality for views
		$('input.views').on('click',function(e)
		{
			if($(this).is(":checked"))
			{
				$("input.views").not(this).removeAttr("checked");
				//$(this).prop("checked",true);
			}
		});

		//Email
		$('form').on('keyup','input#email',function(e)
				{
					var val=$.trim($(this).val());
					var toks=$("input[name='_token']").val();

					if(val!="" && val.length>3)
					{
						$.ajax(
								{
									type:"POST",
									data:{email:val,
										_token:toks
									},
									url:"{{route('username_check')}}",
									beforeSend:function()
									{
										$('div.user_feedback').html("...checking <img src='{{asset('_img/loading.gif')}}'/> ");
									},
									success: function(r)
									{
										if(r=="exists")
										{
											$('div.user_feedback').removeClass("label-inverse").removeClass("label-success").addClass("label-danger");
											$('div.user_feedback').html("...Already taken <i style='color:white' class='fa fa-times-circle'></i> ");
										}
										else if(r=="available")
										{
											$('div.user_feedback').removeClass("label-inverse").removeClass("label-danger").addClass("label-success").html("Email Available <i style='color:white' class='fa fa-check-circle'></i>");
										}
									}
								}

						);
					}else{
						$('div.user_feedback').removeClass("label-success").removeClass("label-danger").addClass("label-inverse").html("Email must be more than 3 characters");
					}
				}
		);

		//Rights things
		$('form').on('change','select#role_id',function(e)
		{

			var id=$(this).val();
			var toks=$("input[name='_token']").val();
			if(id!=="")
			{
				$.ajax(
						{
							type:"POST",
							data:{role_id:id,
								_token:toks
							},
							url:"{{ route('get_user_role') }}",
							beforeSend:function()
							{
								$('select#rights_id').block({ message: null });
							},
							success: function(r)
							{
								$('select#rights_id').unblock();

								$('div#here').html(r);
							}
						}

				);
			}else{
				$('div#here').html("Kindly select a Global Role in order to edit associated privileges");
			}

		});

		//not("[name='username']")

		$('form#formValidate').on('click','button.create_staff',(function(e)
		{
			e.preventDefault();

			var formData = new FormData($('form#formValidate')[0]);

			var isUsernameClear=!$('div.user_feedback').hasClass("label-success");
			//var main_menu=$('input[data-main]:checked').length;

			/*if(main_menu==0)
			{
				e.preventDefault();
				sweetAlert("Oops...", "You must assign at least one privilege to Staff", "error");
			}
			else*/ if(isUsernameClear)
			{
				sweetAlert("Oops...", "Kindly fix Email Error", "error");
			}
			else
			{
				$.ajax(
						{
							type:"POST",
							data:formData,
							url:"{{route('save_user')}}",
							cache:false,
							contentType:false,
							processData:false,
							beforeSend:function()
							{
								$('form#formValidate').block({ message: null });
							},
							error: function(r)
							{
                               




								$('form#formValidate').unblock();

								const errors = r.responseJSON.errors;
								var first=true;

								//clear any previous errors
								$('div.error-message').html('');
								$('div.has-error').removeClass('has-error');
                                var error = "";
                                var messages = "";
								$.each(errors,function(index,value)
								{
									
									messages = messages + '<li><i class="fa fa-exclamation-triangle text-danger"></i> ' +value[0]+"</li>";
								})

                                $("#here").html("<ul>"+messages+"</ul>")
                                $("#here").addClass("rounded-corners");
							},
							success: function(r)
							{
                                
								for (var i = 0; i < r.length; i++) 
								    {
										var r = data[i];
									}
								$('form#formValidate').unblock();

								//clear any previous errors
								$('div.error-message').html('');
								$('div.has-error').removeClass('has-error');
								$('div.has-success').removeClass('has-success');
								//clear all items
								$("#user-container").empty();
								$('form#formValidate')[0].reset();
								$('div#here').html("");
								$('div.others_docs_here').html("");

								$('html, body').animate({scrollTop:$('body').offset().top-90},2000);
								Swal.fire("success!", "New User Created.", "success");
							}

						}

				);
			}






		}));

	</script>
@endsection