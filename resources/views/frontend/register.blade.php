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


      

        <form class="form-horizontal" action="{{route('sumbit_application')}}" method="post"  id="form" enctype="multipart/form-data">
        @csrf
        <fieldset>

        <!-- Form Name -->
        <legend><center><h2><b>Registration Form</b></h2></center></legend><br>






        <div class="form-group"> 
          <div class="col-md-4 selectContainer">
             <label class="">Title</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                    <select required name="programme" id="programme" class="form-control selectpicker">
                    @foreach($title_collections as $val)
                        <option value="{{$val->title_id}}">{{$val->title_name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4 selectContainer">
            <label >FIRST NAME</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input class="form-control" value="" name="" id="">
                </div>
            </div>
           
            <div class="col-md-4 selectContainer">
             <label >MIDDLE NAME</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input class="form-control" value="" name="" id="">
                </div>
            </div>
        </div>


         <div class="form-group"> 
            
            <div class="col-md-4 selectContainer">
            <label class="">LAST NAME</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                   <input class="form-control" value="" name="" id="">
                </div>
            </div>
            <div class="col-md-4 selectContainer">
             <label class="">NATIONALITY</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input class="form-control" value="" name="" id="">
                </div>
            </div>
             <div class="col-md-4 selectContainer">
                <label class="">STATE OF ORIGIN</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                   <input class="form-control" value="" name="" id="">
                </div>
            </div>
        </div>

         <div class="form-group"> 
            <div class="col-md-4 selectContainer">
               <label class=>EMAIL</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                    <input class="form-control" value="" name="" id="">
                </div>
            </div>
            <div class="col-md-4 selectContainer">
                <label class="">DATE OF BIRTH</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input class="form-control" value="" name="" id="">
                </div>
            </div>
         
            <div class="col-md-4 selectContainer">
                <label class="">PHONE NUMBER</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input class="form-control" value="" name="" id="">
                </div>
            </div>
        </div>

        <div class="form-group"> 
        
            <div class="col-md-4 selectContainer">
             <label class="">RELIGION</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-building"></i></span>
                   <input class="form-control" value="" name="" id="">
                </div>
            </div>
         </div>

        

         <div class="form-group"> 
        
            <div class="col-md-12 selectContainer">
             <label class="">PERMANET ADDRESS</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-building"></i></span>
                    <textarea rows="3" class="form-control" value="" name="" id=""></textarea>
                </div>
            </div>
         </div>

          <div class="form-group"> 
        
            <div class="col-md-12 selectContainer">
             <label class="">CURRENT ADDRESS</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-building"></i></span>
                    <textarea rows="3" class="form-control" value="" name="" id=""></textarea>
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

        

        $('form#form').on('click','button.create',(function(e)
		{
			e.preventDefault();
			
			var academic_qualification_upload = $("input#academic_qualification_upload").val();
			//var previous_experience_upload = $.trim($("input#previous_experience_upload").val());
			var programme = $("select#programme").val();
            var qualification = $("select#qualification").val();
            var attestation = $("input#attestation").val();
          
           
            if(!programme)
                Swal.fire("Error", "Programme field is compulsory", "error");
			else if(!qualification)
				Swal.fire("Error", "Academic Qualification is compulsory", "error");
            else if(!academic_qualification_upload)
				Swal.fire("Error", "Academic Qualification Document is compulsory", "error");
            else if(!total_checked)
                Swal.fire("Error", "kindly select a course", "error");
            else if(! $('#attestation').is(':checked'))
                Swal.fire("Error", "Attestation check box is not checked", "error");
			else
				$('form#form').submit();

		}));


        
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
</script>
@endsection

@endsection

