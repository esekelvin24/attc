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
</style>
    <div class="content-box">
        <div class="row">
            <div class="col-sm-12">
		            <form id="form" action="{{route('save_edit_role')}}" method="post"  role="form">
			       @csrf
			       <div>
                       <input type="hidden" value="{{encrypt($role_collection[0]->id)}}" name="id">
	                   <div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="session_name">
										Name 
									</label>
									<input value="{{$role_collection[0]->name}}" autocomplete="off" class="form-control underline" required id="role_name" placeholder="Enter Role Name e.g Support Account" type="text" name="role_name">
									<span class="text-danger error-message here"></span>
								</div>
							</div>
						
							<div class="col-md-6">
								<div class="form-group">
									<label for="session_name">
										Slug 
									</label>
									<input disabled value="{{$role_collection[0]->slug}}" autocomplete="off" class="form-control underline" required id="role_slug" placeholder="Enter Role Slug e.g support-account" type="text" name="role_slug">
									<span class="text-danger error-message here"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="session_name">
										Description 
									</label>
									<textarea name="description" class="form-control">{{$role_collection[0]->description}}</textarea>
									<span class="text-danger error-message here"></span>
								</div>
							</div>
						</div>
                    
					<div class="row">
					<div class="col-md-12">
                       <fieldset>
                        <legend>Permissions:</legend>
						
						        <div class="checkbox clip-check check-info">
								@foreach($permission_collection as $val)
                                    <input {{isset($selected_permission[$val->id])?"checked":""}} data-sub="1" id="c{{$val->id}}" name="permission[]" value="{{$val->id}}" type="checkbox">
                                    <label for="c{{$val->id}}">{{$val->name}}</label>
                               
                                @endforeach    
                                </div>
						   
						</fieldset>
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
                         <button onclick="submitFormOkay = true;" class="btn btn-primary btn-block btn-scroll btn-scroll-left ti-book create" type="submit"><span>SAVE ROLE</span></button>
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
