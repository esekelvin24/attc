<?php
use Illuminate\Support\Facades\DB;
$states = DB::table('tbl_states')->get();
?>
<form id="edit_user" method="post" action="{{route("save_edits_profile")}}" enctype="multipart/form-data">
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

					<input style="display:none" class="edit_btn" type="file" name="pic">
			</div>
			<h1 class="up-header">
				<?php echo $profile_collection[0]->title_name.' '.$profile_collection[0]->firstname." ".$profile_collection[0]->middlename."".$profile_collection[0]->lastname  ?>
			</h1>
			<h5 class="up-sub-header">
				Account Class : <?php echo $profile_collection[0]->user_type == 2 ? "Staff":"Student" ?>
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
		   <div class="col-lg-6 text-right">
                <a class="btn btn-primary btn-sm" href="{{url('/change_my_password')}}"><i class="fa fa-lock"></i><span> Change My Password</span></a> <a  class="btn btn-secondary btn-sm edit_this" href="javascript:edit_profile()"><i class="fa fa-pencil"></i> <span>Edit Profile</span></a> <a style="display:none" class="btn btn-danger btn-sm edit_btn" href="javascript:edit_profile()"><i class="fa fa-close"></i> <span>Cancel</span></a>
            </div>
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
					<label for=""> Firstname</label><input required disabled name="firstname" value="<?php echo $profile_collection[0]->firstname ?>" class="form-control my-edit" type="text">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label for=""> Middlename</label><input  disabled name="middlename" value="<?php echo $profile_collection[0]->middlename ?>" class="form-control my-edit" type="text">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label for=""> Lastname </label><input required disabled name="lastname" value="<?php echo $profile_collection[0]->lastname?>" class="form-control my-edit" type="text">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					<label for=""> Email</label><input disabled value="<?php echo $profile_collection[0]->email ?>" class="form-control" type="text">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label for="">Phone No. </label><input required disabled name="phone" value="{{$profile_collection[0]->phone}}" class="form-control my-edit" type="text">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label for="gender">Gender</label>
					<select required disabled class="form-control my-edit" id="gender"  name="gender">
						<option value="">Select Gender</option>
						<option value="1" @if($profile_collection[0]->gender==1) selected @endif>Male</option>
						<option value="2" @if($profile_collection[0]->gender==2) selected @endif>Female</option>
					</select>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label for="gender">Branch</label>
					<select required disabled class="form-control" id="branch"  name="branch">
						<option value="">Select a Branch</option>
						@foreach($branch as $val)
						  <option value="{{$val->branch_code}}" @if($profile_collection[0]->branch_id == $val->branch_code) selected @endif>{{$val->branch_name}}</option>
						@endforeach

					</select>
				</div>
			</div>
		</div>
		
	

			<div style="display:none" class="form-buttons-w edit_btn">
				<button style="cursor: pointer" class="btn btn-lg btn-danger edit_staff" type="submit"> Save Edits</button>
			</div>

		</form>


		<script>

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

		</script>

		<!--<div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs bigger">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#tab_overview">Activity</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab_sales">Daily Sales</a>
                    </li>
                </ul>
                <ul class="nav nav-pills smaller d-none d-md-flex">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#">Today</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#">7 Days</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#">14 Days</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#">Last Month</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="tab_overview">
                    <div class="timed-activities padded">
                        <div class="timed-activity">
                            <div class="ta-date">
                                <span>21st Jan, 2017</span>
                            </div>
                            <div class="ta-record-w">
                                <div class="ta-record">
                                    <div class="ta-timestamp">
                                        <strong>11:55</strong> am
                                    </div>
                                    <div class="ta-activity">
                                        Created a post called <a href="#">Register new symbol</a> in Rogue
                                    </div>
                                </div>
                                <div class="ta-record">
                                    <div class="ta-timestamp">
                                        <strong>2:34</strong> pm
                                    </div>
                                    <div class="ta-activity">
                                        Commented on story <a href="#">How to be a leader</a> in <a href="#">Financial</a> category
                                    </div>
                                </div>
                                <div class="ta-record">
                                    <div class="ta-timestamp">
                                        <strong>7:12</strong> pm
                                    </div>
                                    <div class="ta-activity">
                                        Added <a href="#">John Silver</a> as a friend
                                    </div>
                                </div>
                                <div class="ta-record">
                                    <div class="ta-timestamp">
                                        <strong>9:39</strong> pm
                                    </div>
                                    <div class="ta-activity">
                                        Started following user <a href="#">Ben Mosley</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="timed-activity">
                            <div class="ta-date">
                                <span>3rd Feb, 2017</span>
                            </div>
                            <div class="ta-record-w">
                                <div class="ta-record">
                                    <div class="ta-timestamp">
                                        <strong>9:32</strong> pm
                                    </div>
                                    <div class="ta-activity">
                                        Added <a href="#">John Silver</a> as a friend
                                    </div>
                                </div>
                                <div class="ta-record">
                                    <div class="ta-timestamp">
                                        <strong>5:14</strong> pm
                                    </div>
                                    <div class="ta-activity">
                                        Commented on story <a href="#">How to be a leader</a> in <a href="#">Financial</a> category
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="timed-activity">
                            <div class="ta-date">
                                <span>21st Jan, 2017</span>
                            </div>
                            <div class="ta-record-w">
                                <div class="ta-record">
                                    <div class="ta-timestamp">
                                        <strong>11:55</strong> am
                                    </div>
                                    <div class="ta-activity">
                                        Created a post called <a href="#">Register new symbol</a> in Rogue
                                    </div>
                                </div>
                                <div class="ta-record">
                                    <div class="ta-timestamp">
                                        <strong>2:34</strong> pm
                                    </div>
                                    <div class="ta-activity">
                                        Commented on story <a href="#">How to be a leader</a> in <a href="#">Financial</a> category
                                    </div>
                                </div>
                                <div class="ta-record">
                                    <div class="ta-timestamp">
                                        <strong>9:39</strong> pm
                                    </div>
                                    <div class="ta-activity">
                                        Started following user <a href="#">Ben Mosley</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_sales">
                    <div class="el-tablo">
                        <div class="label">
                            Unique Visitors
                        </div>
                        <div class="value">
                            12,537
                        </div>
                    </div>
                    <div class="el-chart-w"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas height="282" id="lineChart" width="1132" style="display: block; height: 188px; width: 755px;" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
                <div class="tab-pane" id="tab_conversion"></div>
            </div>
        </div>-->
	</div>
</div>
</form>