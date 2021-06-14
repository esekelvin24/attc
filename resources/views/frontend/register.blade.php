@extends('../layouts.frontend')


@section('title-name')
Registration
@endsection

@section('content')


<style>

.my-fieldset {
    font-family: sans-serif;
    border: 5px solid #161644;
    background: white;
    border-radius: 5px;
    margin-top: 1px;
	padding-left:10px;
	padding-top:-20px;
}

.my-fieldset .my-legend {
    background: #161644;
    color: #fff;
    padding: 5px 10px ;*/
    font-size: 17px;
    border-radius: 5px;
    box-shadow: 0 0 0 5px #ddd;
    margin-left: 0px;
}



.modal-header {
    border-bottom: none
}

.modal-title {
    font-size: 25px;
    font-weight: 700;
    color: #1A237E
}

.modal-body {
    font-style: italic;
    font-size: 15px;
    font-weight: 500;
    color: #1A237E
}

.checkbox-form {
    background: #ecedf1;
    color: #002147;
    margin-top: 10px;
    padding: 7px 5px 5px 10px;
    cursor: pointer;
    border-radius: 1px
}

.learn {
    text-decoration: none;
    color: #fff
}

.add-list {
    height: 45px;
    line-height: 27px;
    background-color: #D32F2F;
    color: #fff !important
}


fieldset {
    font-family: sans-serif;
    border: 1px solid #1F497D;
    background: white;
    border-radius: 5px;
    margin-top: 1px;
	padding-left:10px;
	padding-right:10px;
}

fieldset legend {
    background: #1F497D;
    width:280px;
    font-size:18px;
    color: #fff;
    padding: 5px 10px ;*/
    font-size: 17px;
    border-radius: 5px;
    box-shadow: 0 0 0 5px #ddd;
    margin-left: 0px;
}


</style>


    <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area shadow dark bg-fixed text-center text-light" style="background-image: url({{asset('frontend/assets/img/banner/13.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>user Registration</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="active">User Registration</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <div class="container">
<br/>


      

        <form class="form-horizontal" action="{{route('sumbit_registration')}}" method="post"   enctype="multipart/form-data">
        @csrf
        <fieldset>

        <!-- Form Name -->
        <legend><b>Pernsonal Information</b></legend><br>



        <div class="form-group"> 
          <div class="col-md-4 selectContainer">
             <label class="">Title <span class="text-danger"><b>*</b></span></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                    <select required name="title" id="title" class="form-control selectpicker">
                    @foreach($title_collections as $val)
                        <option {{old('title')==$val->title_id?"selected":""}} value="{{$val->title_id}}">{{$val->title_name}}</option>
                    @endforeach
                    </select>
                    @if ($errors->has('title'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-4 selectContainer">
            <label >FIRST NAME <span class="text-danger"><b>*</b></span></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input required placeholder="Enter your first name" class="form-control" value="{{old('firstname')}}" name="firstname" id="firstname">
                    @if ($errors->has('firstname'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
           
            <div class="col-md-4 selectContainer">
             <label >MIDDLE NAME</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input placeholder="Enter your middle name" class="form-control" value="{{old('middlename')}}" name="middlename" id="middlename">
                    @if ($errors->has('middlename'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('middlename') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
        </div>


         <div class="form-group"> 
            
            <div class="col-md-4 selectContainer">
            <label class="">LAST NAME <span class="text-danger"><b>*</b></span></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                   <input required placeholder="Enter your last name" class="form-control" value="{{old('lastname')}}" name="lastname" id="lastname">
                    @if ($errors->has('lastname'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-4 selectContainer">
             <label class="">NATIONALITY <span class="text-danger"><b>*</b></span></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-passport"></i></span>
                    <input required placeholder="Enter your nationality" class="form-control" value="{{old('nationality')}}" name="nationality" id="nationality">
                    @if ($errors->has('nationality'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('nationality') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            
             <div class="col-md-4 selectContainer">
                <label class="">STATE OF ORIGIN <span class="text-danger"><b>*</b></span></label>
               <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                    <select name="state_of_origin" id="state_of_origin" class="form-control selectpicker">
                        <option selected value="">-- SELECT A STATE --</option>
                    @foreach($states_collection as $val)
                        <option {{old('state_of_origin')==$val->state_id?"selected":""}} value="{{$val->state_id}}">{{$val->state}}</option>
                    @endforeach
                    </select>
                     @if ($errors->has('state_of_origin'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('state_of_origin') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            
        </div>

         <div class="form-group"> 

           <div class="col-md-4 selectContainer">
                <label class="">GENDER <span class="text-danger"><b>*</b></span></label>
               <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                    <select name="gender" id="gender" class="form-control selectpicker">
                        <option  value="">-- SELECT A GENDER --</option>
                        <option {{old('gender')=="1"?"selected":""}}  value="1">Male</option>
                        <option {{old('gender')=="2"?"selected":""}}  value="2">Female</option>
                   
                    </select>
                     @if ($errors->has('gender'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-4 selectContainer">
                <label class="">DATE OF BIRTH <span class="text-danger"><b>*</b></span></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input placeholder="YYYY-mm-dd" autocomplete="off" required class="form-control" value="{{old('date_of_birth')}}" name="date_of_birth" id="date_of_birth">
                </div>
                 @if ($errors->has('date_of_birth'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="col-md-4 selectContainer">
             <label class="">RELIGION <span class="text-danger"><b>*</b></span></label>
               <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                    <select  name="religion" id="religion" class="form-control selectpicker">
                        <option selected value="">-- SELECT RELIGION --</option>
                        <option {{old('religion')=="Christianity"?"selected":""}} value="Christianity">Christianity</option>
                        <option {{old('religion')=="Islam"?"selected":""}} value="Islam">Islam</option>
                        <option {{old('religion')=="Myth"?"selected":""}} value="Myth">Myth</option>
                        <option {{old('religion')=="Hinduism"?"selected":""}} value="Hinduism">Hinduism</option>
                        <option {{old('religion')=="Buddhism"?"selected":""}} value="Buddhism">Buddhism</option>
                       
                    </select>
                     @if ($errors->has('religion'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('religion') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
         
            
        </div>
</fieldset>

<fieldset>
        <!-- Form Name -->
        <legend><b>Contact Information</b></legend><br>

        
        <div class="form-group"> 
        
           

            <div class="col-md-6 selectContainer">
                <label class="">PERMANET RESIDENCE STATE <span class="text-danger"><b>*</b></span></label>
               <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                    <select   name="permanent_state_of_residence" id="permanent_state_of_residence" class="form-control selectpicker">
                        <option value="">-- SELECT A STATE --</option>
                    @foreach($states_collection as $val)
                        <option {{old('permanent_state_of_residence')==$val->state_id?"selected":""}} value="{{$val->state_id}}">{{$val->state}}</option>
                    @endforeach
                    </select>
                     @if ($errors->has('permanent_state_of_residence'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('permanent_state_of_residence') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-6 selectContainer">
                <label class="">CURRENT ADDRESS STATE <span class="text-danger"><b>*</b></span></label>
               <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                    <select  name="current_state_of_residence" id="current_state_of_residence" class="form-control selectpicker">
                        <option value="">-- SELECT A STATE --</option>
                    @foreach($states_collection as $val)
                        <option {{old('current_state_of_residence')==$val->state_id?"selected":""}} value="{{$val->state_id}}">{{$val->state}}</option>
                    @endforeach
                    </select>
                     @if ($errors->has('c_state_of_residence'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('current_state_of_residence') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            
         </div>

        

         <div class="form-group"> 
        
            <div class="col-md-6 selectContainer">
             <label class="">PERMANET ADDRESS <span class="text-danger"><b>*</b></span></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-building"></i></span>
                    <textarea required placeholder="Enter your permanet address" rows="3" class="form-control" value="" name="permanent_residence" id="permanent_residence">{{old('permanent_residence')}}</textarea>
                   @if ($errors->has('permanent_residence'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('permanent_residence') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
        
            <div class="col-md-6 selectContainer">
             <label class="">CURRENT ADDRESS <span class="text-danger"><b>*</b></span></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-building"></i></span>
                    <textarea required placeholder="Enter your current address" rows="3" class="form-control" value="" name="current_residence" id="current_residence">{{old('current_residence')}}</textarea>
                    @if ($errors->has('current_residence'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('current_residence') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
         </div>

<div class="form-group">
         <div class="col-md-6 selectContainer">
                <label class="">PHONE NUMBER <span class="text-danger"><b>*</b></span></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input required placeholder="Enter your phone number" class="form-control" value="{{old('phone_number')}}" name="phone_number" id="phone_number">
                    @if ($errors->has('phone_number'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                    @endif
                </div>
         </div>
        <div class="col-md-6 selectContainer">
               <label class=>EMAIL <span class="text-danger"><b>*</b></span></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                    <input autocomplete="off" required placeholder="Enter your email" class="form-control" value="{{old('email')}}" name="email" id="email">
                    @if ($errors->has('email'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
        </div>
</div>
 
    <div class="form-group">        
            <div class="col-md-6 selectContainer">
                <label class="">Password <span class="text-danger"><b>*</b></span></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input autocomplete="off" required placeholder="Enter your password" type="password" class="form-control" value="" name="password" id="password">
                    @if ($errors->has('password'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
         
            <div class="col-md-6 selectContainer">
                <label class="">Confirm Password <span class="text-danger"><b>*</b></span></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input required placeholder="Enter your confirm password" type="password" class="form-control" value="" name="confirm_password" id="confirm_password">
                    @if ($errors->has('confirm_password'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
        </div>

            <br/>
            

        <hr>
      

        {{--
        <!-- Success message -->
        <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>
        --}}
        <!-- Button -->
        <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div  align="center"><br>
        <button type="submit" class="btn btn-warning create" >SUBMIT <span class="fa fa-paper-plane"></span></button>
        </div>
        </div>

        </fieldset>
        </form>



</div>
    </div><!-- /.container -->

@section('additional_js')
<script>

        var total_checked = 0;
        var xx = new Intl.NumberFormat('NGN', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
        });

       
       @if(Session::get('success'))
            Swal.fire('Success','{{Session::get('success')}}','success');
       @endif

       @if(Session::get('error'))
           Swal.fire('Oops!','{{Session::get('error')}}','error');
       @endif
        
       @if($errors->any())
       {
           Swal.fire('Oops!','An error occurred while trying to submit your form','error');
       }
       @endif

        
        /*--------------------------Apply checkbox select ---------------------*/
           $(function()
           {
               $('.my_price').each(function () {
                total_checked += this.checked ?parseFloat($(this).data("id")): 0 ;  
              }); 
           });
           
       
        $('.my_price').change(function() {
           
            total_checked = 0;
            $('.my_price').each(function () {
                total_checked += this.checked ?parseFloat($(this).data("id")): 0 ;  
            }); 
            
            $("#price_div").html("Total: ₦"+xx.format(total_checked));         
        });
        /*--------------------------End Apply checkbox select ---------------------*/  
        $('#date_of_birth').datepicker({
            format: 'yyyy-mm-dd'
        });

        
</script>
@endsection

@endsection

