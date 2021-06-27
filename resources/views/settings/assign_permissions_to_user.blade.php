@extends('../layouts.dash_layout')

@section('required_css')
@endsection

@section('content')

<style>
fieldset {
    font-family: sans-serif;
    border: 5px solid #1F497D;
    background: white;
    border-radius: 5px;
    margin-top: 1px;
	padding-left:10px;
	padding-top:-20px;
}

fieldset legend {
    background: #1F497D;
    color: #fff;
    padding: 5px 10px ;*/
    font-size: 17px;
    border-radius: 5px;
    box-shadow: 0 0 0 5px #ddd;
    margin-left: 0px;
}


.box.box-info {
    border-top-color: #1F1D5E;
}
.box {
	padding:20px;
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgb(0 0 0 / 10%);
}
</style>

<div class="content-box">
		@if(Session::get('course_success'))
		<div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
			Course created successfully!
		</div>
		@endif
        <div class="row">
            <div class="col-sm-12">
		            <form id="form" action="{{route('save_assign_special_perm')}}" method="post"  role="form">
			       @csrf
			       <div>
					
        <div class="box box-info">

            <h4>Assigning Special Permission</h4>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
			 
				<div class="box-body">
 <table id="tblmarketerinfo" class="table table-bordered"> 
                      
                <tbody>
                     <tr class="even pointer">
                          <th style="min-width:200px" scope="row"  bgcolor="#F5F7FA">Name:</th>
                          <td class=""> {{$check_if_exist[0]->firstname." ".$check_if_exist[0]->middlename." ".$check_if_exist[0]->lastname}}</td>
						  <th scope="row" bgcolor="#F5F7FA">Email:</th>
                          <td class="">{{$check_if_exist[0]->email}}</td>
                     
                         <th scope="row" bgcolor="#F5F7FA">Current Role:</th>
                         <td class="">{{$user_role_details[0]->name}}</td>
                 </tr>
                </tbody>

                <tbody>
                  <tr class="even pointer">
                         <th scope="row" bgcolor="#F5F7FA">Permissions Associated with Current Role:</th>
                         <td class="pull-xs-left col-sm-9 col-xs-8" colspan="5">
                          @foreach($role_permission_collection as $val)
                                            <label class="badge badge-warning">{{$val->name}}</label>
                          @endforeach
						  </td>
                  </tr>
                </tbody>
                <tbody>
                        <tr class="even pointer">
                            <th scope="row" bgcolor="#F5F7FA">Special Permissions:</th>
                             <td class="pull-xs-left col-sm-9 col-xs-8" colspan="5">  
								@foreach($selected_special_permission as $index => $val)                       
												<label class="badge badge-warning">{{$val}}</label>
								@endforeach 
							  </td>		
				 </tr>
                </tbody>                          
</table>


					<form id="form" action="{{route('save_assign_special_perm')}}" method="post"  role="form">
						@csrf
						<div class="row">
									<div class="col-md-12">
										<fieldset>
										<input type="hidden" name="user_id" value="{{encrypt($check_if_exist[0]->id)}}">
											<legend>Assign Permissions:</legend>
													<div class="checkbox clip-check check-info">
													@foreach($permission_collection as $val)
														<input {{isset($selected_special_permission[$val->id])?"checked":""}} data-sub="1" id="c{{$val->id}}" name="permission[]" value="{{$val->id}}" type="checkbox">
														<label for="c{{$val->id}}">{{$val->name}}</label>
													@endforeach    
													</div>
										</fieldset>
									</div>				
						</div>
					</form>
				  </div>
		    </div>
					
	            
				
                 <style>
					.content
					{
					text-align: center;
					margin-top:10px;
					}
					.inner
					{
					display:inline-block;
					}
                </style>
                       
                 <div class="content" >
                 <div class="inner" align="center" >
                 <div style ="min-width:350px !important" class="row">
                    
                     <div class="col-md-12">
                         <button onclick="submitFormOkay = true;" class="btn btn-primary btn-block btn-scroll btn-scroll-left ti-book create" type="submit"><span>Update</span></button>
                     </div>
                 </div>
                 </div>    
                </div>      

                <span class="clearfix"></span>

               </div>
                  </form>
            </div>
        </div>
    </div>
@endsection

@section('additional_js')
    <script>

	
	</script>
@endsection
