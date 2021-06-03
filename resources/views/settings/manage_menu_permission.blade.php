@extends('../layouts.dash_layout')

@section('required_css')
@endsection

@section('content')
    <div class="content-box">
		@if(Session::get('course_success'))
		<div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
			Course created successfully!
		</div>
		@endif
        <div class="row">
            <div class="col-sm-12">
		           <form id="form" @if(Auth::user()->can('save-menu-permission')) action="{{route('save_menu_permission')}}" @endif method="post"  role="form">
			       @csrf
			       <div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
								  
									<label for="category">Menu</label>
									<select name="menu" onchange="get_menu_permission(this.value)" class="selectpicker form-control">
                                      <option>::SELECT MENU::</option>
									<optgroup label="Main Menu">
										@foreach($main_menu as $val)
												<option value="{{encrypt("tbl_main_tab~".$val->main_tab_id."~main_tab_id")}}">{{$val->main_tab_name}}</option>	
										@endforeach
                                    </optgroup>

									<optgroup label="Second Layer Menu">
										 @foreach($sub_tab as $val)
												<option value="{{encrypt("tbl_sub_tab~".$val->sub_tab_id."~sub_tab_id")}}">{{$val->sub_tab_name}}</option>
										@endforeach
                                    </optgroup>

									<optgroup label="Third Layer Menu">
                                        @foreach($suber_tab as $val)
												<option value="{{encrypt("tbl_suber_tab~".$val->suber_tab_id."~suber_tab_id")}}">{{$val->suber_tab_name}}</option>
										@endforeach
                                    </optgroup>
										
									</select>
								</div>
							</div>
						</div>

						<div class="role">
                            <div id="permission_div" class="col-md-12">
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

function get_menu_permission(menu)
		{
           

		   $.ajax(
								 {
									 type:"POST",
									 data:{
										 menu : menu,
										 _token:$("input[name='_token']").val()
									 },
									 url:"{{route('get_role_menu_list')}}",
									 beforeSend:function()
									  {
										  $('form#form').block({ message: null }); 
									  },
									  success: function(r)
									  {							  
										 $('form#form').unblock(); 
							              $("#permission_div").html(r);
										
										     //location.reload();
									  }
								 }
				 
						     );
			
		}

	
	</script>
@endsection
