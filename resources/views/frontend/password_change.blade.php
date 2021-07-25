@extends('../layouts.frontend')


@section('title-name')
Password Recovery
@endsection

@section('content')


    <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area shadow dark bg-fixed text-center text-light" style="background-image: url({{asset('frontend/assets/img/banner/13.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Password Recovery</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        
                        <li class="active">Password Recovery</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Start Event 
    ============================================= -->
    <div class="event-area default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="event-items">
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

                        #submit_btn
                        {
                            background:#0c1791;
                            color:white;
                        }

                         #submit_btn:hover
                        {
                            background:#3741b8;
                            color:white;
                        }
                        </style>

                        @if(isset($unique_id))

                        
   
                                       
                        <div class="container log_me_in" style="text-align: center;">
                           <form method="POST" action="{{route('save_changed_password')}}">
                           @csrf
                           <input type="hidden" name="unique_id" value="{{$unique_id}}"> 
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="content" >
                                <div class="inner" align="center" >
                                    <div style ="min-width:350px !important; text-align:left !important; padding-left:" class="row">
                                        <label style="padding-left:20px;"><strong>New Password</strong></label>
                                        <div class="col-md-12">
                                        <input min="6" autocomplete="off" value="" required="" name="new_password" placeholder="Enter New Password" class="form-control" type="password">
                                        </div>
                                    </div><br/>
                                   <div style ="min-width:350px !important; text-align:left !important; padding-left:" class="row">
                                        <label style="padding-left:20px;"><strong>Confirm Password</strong></label>
                                        <div class="col-md-12">
                                        <input min="6" autocomplete="off" value="" required="" name="confirm_password" placeholder="Enter Confirm Password" class="form-control" type="password">
                                        </div>
                                    </div>
                                    <br/><br/>
                                    <div style ="min-width:350px !important; margin-top:10px;" class="row">
                                        <div class="col-md-12">
                                            <button id="submit_btn"  class="btn btn-primary btn-block btn-scroll btn-scroll-left" type="submit"><span>Change Password</span></button>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            </form>
                        </div>


                   

                        @else
                                        <div align="center">
                                            <img width="150" height="150" src="{{asset('img/barred.png')}}" >
                                            <p> Your password recovery link has expired<p>
                                        </div>
                        @endif

                    </div>
                </div>
               
            </div>
        </div>
    </div>
    <!-- End Event -->



@endsection