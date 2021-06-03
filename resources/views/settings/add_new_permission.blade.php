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
		            <form id="form" action="{{route('save_permission')}}" method="post"  role="form">
			       @csrf
			       <div>

	                   <div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="session_name">
										Name 
									</label>
									<input value="" autocomplete="off" class="form-control underline" required id="permission_name" placeholder="Enter Permission Name e.g View Post" type="text" name="permission_name">
									<span class="text-danger error-message here"></span>
								</div>
							</div>
						
							<div class="col-md-6">
								<div class="form-group">
									<label for="session_name">
										Slug 
									</label>
									<input value="" autocomplete="off" class="form-control underline" required id="permission_slug" placeholder="Enter Permission Slug e.g view-post" type="text" name="permission_slug">
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
									<textarea name="description" class="form-control"></textarea>
									<span class="text-danger error-message here"></span>
								</div>
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
                         <button onclick="submitFormOkay = true;" class="btn btn-primary btn-block btn-scroll btn-scroll-left ti-book create" type="submit"><span>SAVE PERMISSION</span></button>
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
