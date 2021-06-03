
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


                        <div class="row">
									<div class="col-md-12">
										<fieldset>
										
											<legend>Assigned Permissions to Menu:</legend>
                                                        <div class="row">
                                                            
                                                            @foreach($permission_collection as $val)
                                                                <div style="padding-left:10px;" class="col-md-3 col-sm-3">
                                                                    <input {{$menu_permission_slug==$val->slug?"checked":""}} type="radio" id="permission" name="permission" value="{{encrypt($val->slug)}}">
                                                                    <label for="male">{{$val->name}}</label><br>
                                                                </div>
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
                       
            @if(Auth::user()->can('save-menu-permission'))
 
                 <div class="content" >
                 <div class="inner" align="center" >
                 <div style ="min-width:350px !important" class="row">
                    
                     <div class="col-md-12">
                         <button onclick="submitFormOkay = true;" class="btn btn-primary btn-block btn-scroll btn-scroll-left ti-book create" type="submit"><span>SAVE</span></button>
                     </div>
                 </div>
                 </div>    
                </div>
            @endif