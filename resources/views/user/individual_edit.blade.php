<form id="edit_user" method="post" action="{{route("save_edits")}}" enctype="multipart/form-data">
	@csrf
	<input type="hidden" name="user_id" value="<?php echo $user_id ?>">
<div class="user-profile">
	<div class="up-head-w" style="background-image:url(<?php echo asset('img/profile.png') ?>)">
		<!--<div class="up-social">
            <a href="#"><i class="os-icon os-icon-twitter"></i></a><a href="#"><i class="os-icon os-icon-facebook"></i></a>
        </div>-->
		<div class="up-main-info">
			<div class="user-avatar-w">
				<div class="user-avatar">
					<img alt="" src="<?php echo asset("img/users/".$profile_collection[0]->pics )?>">
				</div>

					<input type="file" name="pic">
			</div>
			<h1 class="up-header">
				<?php echo $profile_collection[0]->title_name.' '.$profile_collection[0]->firstname." ".$profile_collection[0]->middlename."".$profile_collection[0]->lastname  ?>
			</h1>
			<h5 class="up-sub-header">
				Account Class : <?php echo $profile_collection[0]->user_type == 2 ? "Staff":"General User" ?>
			</h5>
		</div>
		<svg class="decor" width="842px" height="219px" viewBox="0 0 842 219" preserveAspectRatio="xMaxYMax meet" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g transform="translate(-381.000000, -362.000000)" fill="#FFFFFF"><path class="decor-path" d="M1223,362 L1223,581 L381,581 C868.912802,575.666667 1149.57947,502.666667 1223,362 Z"></path></g></svg>
	</div>
	<div class="up-controls">
		<div class="row">
			<div class="col-lg-6">
				<div class="value-pair">
					<div class="label">
						Status:
					</div>
					<?php
					switch($profile_collection[0]->status){
						case 0:
							echo '<div class="value badge badge-pill badge-warning">Inactive</div>';
							break;
						case 1:
							echo '<div class="value badge badge-pill badge-success">Active</div>';
							break;
						case 2:
							echo '<div class="value badge badge-pill badge-primary">Graduated</div>';
							break;
						case 3:
							echo '<div class="value badge badge-pill badge-danger">Expelled</div>';
							break;
					}
					?>

				</div>
				<div class="value-pair">
					<div class="label">
						Gender :
					</div>
					<div class="value">
						<?php echo $profile_collection[0]->gender==1?"Male":"Female" ?>
					</div>
				</div>
				<div class="value-pair">
					<div class="label">
						Registered Since:
					</div>
					<div class="value">
						<?php echo date('d F, Y h:m:s A',strtotime($profile_collection[0]->created_at)) ?>
					</div>
				</div>
			</div>
			 <div class="col-lg-12 text-right">
                @if(Auth::user()->can('edit-users'))
				<a class="btn btn-primary btn-sm" href="javascript:reset_password('{{encrypt($user_id)}}')"><i class="fa fa-lock"></i><span> Reset Password</span></a> 
				<a  class="btn btn-secondary btn-sm edit_this" href="javascript:edit_profile()"><i class="fa fa-pencil"></i> <span>Edit Profile</span></a> <a style="display:none" class="btn btn-danger btn-sm edit_btn" href="javascript:edit_profile()"><i class="fa fa-close"></i> <span>Cancel</span></a>
                <a  class="btn btn-primary btn-sm edit_this" href="{{url('/assign_permissions_to_user/'.encrypt($user_id))}}"><i class="fa fa-key"></i> <span>Assign Permission</span></a> <a style="display:none" class="btn btn-danger btn-sm edit_btn" href="javascript:edit_profile()"><i class="fa fa-close"></i> <span>Cancel</span></a>
               
			    @endif
		    </div>
			<!--<div class="col-lg-6 text-right">
                <a class="btn btn-primary btn-sm" href=""><i class="os-icon os-icon-link-3"></i><span>Add to Friends</span></a><a class="btn btn-secondary btn-sm" href=""><i class="os-icon os-icon-email-forward"></i><span>Send Message</span></a>
            </div>-->
		</div>
	</div>
	<div class="up-contents">
		<h5 class="element-header">
			Personal Details
		</h5>

		<div class="row">

			<div class="col-sm-3">
				<div class="form-group">
					<label for="title_id">Title</label>
					<select disabled class="form-control my-edit" id="title_id"  name="title_id">
						@if(!$title_collection->isEmpty())
							@foreach($title_collection as $val)
								<option @if($profile_collection[0]->title_id==$val->title_id) selected @endif value="{{ $val->title_id }}">{{ $val->title_name }}</option>
							@endforeach
						@endif
					</select>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label for=""> Firstname</label><input disabled name="firstname" value="<?php echo $profile_collection[0]->firstname ?>" class="form-control my-edit" type="text">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label for=""> Middlename</label><input disabled name="middlename" value="<?php echo $profile_collection[0]->middlename ?>" class="form-control my-edit" type="text">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label for=""> Lastname </label><input disabled name="lastname" value="<?php echo $profile_collection[0]->lastname?>" class="form-control my-edit" type="text">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					<label for=""> Email</label><input readonly value="<?php echo $profile_collection[0]->email ?>" class="form-control" type="text">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label for="">Phone No. </label><input disabled name="phone" value="{{$profile_collection[0]->phone}}" class="form-control my-edit" type="text">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label for="gender">Gender</label>
					<select disabled required class="form-control my-edit" id="gender"  name="gender">
						<option value="">Select Gender</option>
						<option value="1" @if($profile_collection[0]->gender==1) selected @endif>Male</option>
						<option value="2" @if($profile_collection[0]->gender==2) selected @endif>Female</option>
					</select>
				</div>
			</div>
		</div>
			<h5 class="element-header">
				Access Levels
			</h5>
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label for="gender">Status</label>
						<select disabled class="form-control my-edit" id="status"  name="status">
							<option value="">Select Status</option>
							<option value="1" @if($profile_collection[0]->status==1) selected @endif>Active</option>
							<option value="0" @if($profile_collection[0]->status==0) selected @endif>Inactive</option>
						</select>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label for="designation_id">Designation</label>
						<select disabled class="form-control my-edit" id="designation_id"  name="designation_id">
							@if(!$designation_collection->isEmpty())
								@foreach($designation_collection as $val)
									<option
											@if($profile_collection[0]->designation_id==$val->designation_id) selected @endif
											value="{{ $val->designation_id }}">{{ $val->designation }}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label for="rights_id">Roles (Access)</label>
						<select disabled class="form-control my-edit" id="rights_id"  name="rights_id">
							@if(!$roles_collection->isEmpty())
								@foreach($roles_collection as $val)
									<option
											@if($profile_collection[0]->role_id==$val->id) selected @endif
									value="{{ $val->id }}">{{ $val->name }}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
			</div>

			<div style="display:none" class="form-buttons-w edit_btn">
				<button style="cursor: pointer" class="btn btn-lg btn-danger edit_staff" type="submit"> Save Edits</button>
			</div>
		</form>

		<script>


        @if(Auth::user()->can('edit-users'))
		   function edit_profile()
		   {

					if ($('.my-edit').prop('disabled')) {

						$('.my-edit').removeAttr("disabled");
						$('.edit_btn').show();
						$('.edit_this').hide();
					}else
					{
						$('.my-edit').prop("disabled", true);
						$('.edit_btn').hide();
						$('.edit_this').show();
					}
		   }

		   function reset_password(value)
		   {
                var val = value;
					var toks=$("input[name='_token']").val();
                    	$.ajax(
								{
									type:"POST",
									data:{id:val,
										_token:toks
									},
									url:"{{route('reset_password')}}",
									beforeSend:function()
									{
										//$('div.user_feedback').html("...checking <img src='{{asset('_img/loading.gif')}}'/> ");
									},
									success: function(r)
									{
										
											if(r == 0)
											{
                                               sweetAlert("Oops...", "Password reset failed", "error");
											}else{
                                                sweetAlert("Success", "Password Reset was successful", "success");
											}
									}
								}

						);
		   }

        @endif
		</script>
    
	</div>
</div>
</form>