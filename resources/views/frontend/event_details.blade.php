@extends('../layouts.frontend')


@section('title-name')
Event Details
@endsection

@section('content')


    <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area shadow dark bg-fixed text-center text-light" style="background-image: url({{asset('frontend/assets/img/banner/13.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Events</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="{{url('/events')}}">Events</a></li>
                         <li class="active">{{$event_details[0]->event_title}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->


    <!-- Start Course Details 
    ============================================= -->
    <div class="course-details-area default-padding">
        <div class="container">
            <div class="row">

    <!-- Start Course Info -->
                <div class="col-md-9">
                    <div class="courses-info">
    
    <style>

                        
/* ============================================================== 
     # Event
=================================================================== */


 .info-box {
  padding: 10px 0px;
  display: flex;
}

 .info-box .date {
  font-family: 'Poppins', sans-serif;
  text-align: center;
  min-width: 75px;
  text-transform: uppercase;
  font-weight: 600;
  letter-spacing: 0.5px;
  margin-top: -3px;
}

 .info-box .date strong {
  font-size: 15px;
  font-weight: 800;
  line-height: 1;
  color: #ffb606;
  display: block;
}

 .info-box .content {
  padding-left: 30px;
  margin-left: 30px;
  position: relative;
  z-index: 1;
}

 .info-box .content::after {
  position: absolute;
  left: 0;
  top: 0;
  content: "";
  height: 30px;
  width: 1px;
  background: #e7e7e7;
}

 .info-box .content h4 {
  font-weight: 600;
  margin-bottom: 20px;
  line-height: 1.4;
  margin-top: -3px;
}

 .info-box .content a:hover {
  color: #ffb606;
}

 .info-box .content ul li {
  display: inline-block;
  margin-right: 12px;
  padding-right: 15px;
  position: relative;
  z-index: 1;
}

 .info-box .content ul li i {
  color: #ffb606;
  margin-right: 5px;
  font-size: 18px;
  position: relative;
  top: 2px;
}

i.fas.fa-clock {
  font-weight: 500;
}

 .info-box .content ul li::after {
  position: absolute;
  right: 0;
  top: 5px;
  content: "";
  height: 20px;
  width: 1px;
  background: #e7e7e7;
}

 .info-box .content ul {
  margin-bottom: 15px;
}



                        </style>


                       <h2>
                            {{ $event_details[0]->event_title }}
                        </h2>
                      
                         <div class="info-box">
                                     <div class="date">
                                        <strong>{{substr($event_details[0]->event_date,8,9)}}</strong> {{date("M, Y",strtotime($event_details[0]->event_date))}}
                                    </div>
                                    <div class="content">
                                       <ul>
                                            <li><i class="fas fa-clock"></i> {{substr($event_details[0]->event_start_time,0,5)}} - {{substr($event_details[0]->event_end_time,0,5)}}</li>
                                            <li><i class="fas fa-map-marked-alt"></i> {{$event_details[0]->event_venue}}</li>
                                        </ul>
                                    </div>
                        </div>
                       
                        @if($event_details[0]->img_path !="no_image.jpg")
                        <img style="width:100%" src="{{asset('frontend/assets/img/event/'.$event_details[0]->img_path)}}" alt="Thumb">
                        @endif
                        <!-- Star Tab Info -->
                        <div class="tab-info">
                            <!-- Tab Nav -->
                           
                            <!-- End Tab Nav -->
                           
                            <!-- Start Tab Content -->
                            <div class="tab-content tab-content-info">
                               

                                <!-- Single Tab -->
                                <div id="tab3" class="tab-pane fade">
                                    <div class="info title">
                                        <div class="advisor-list-items">

                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Tab -->

                            </div>
                            <!-- End Tab Content -->
                        </div>
                        <!-- End Tab Info -->
                    </div>


                        <!-- Star Tab Info -->
                        <div class="tab-info">
                            <!-- Tab Nav -->
                            <ul class="nav nav-pills">
                                <li class="active">
                                    <a data-toggle="tab" href="#tab1" aria-expanded="true">
                                        Overview
                                    </a>
                                </li>
                                @if($event_details[0]->file == 1)
                                <li>
                                    <a target="_blank" href="{{asset('file_upload/events/'.$event_details[0]->file_path)}}"><i class="fa fa-download"></i> Download Attachement</a>
                                </li>
                                @endif
                            </ul>
                            <!-- End Tab Nav -->
                            <!-- Start Tab Content -->
                            <div class="tab-content tab-content-info">
                                <!-- Single Tab -->
                                <div id="tab1" class="tab-pane fade active in">
                                    <div class="info title">
                                        

                                    {!! $event_details[0]->event_content !!}


                                    </div>
                                </div>
                                <!-- End Single Tab -->
                       </div> 
                       </div>
                </div>
                <!-- End Course Info -->


                <!-- Start Course Sidebar -->
                <div class="col-md-3">
                    <div class="aside">
                       
                        <!-- Sidebar Item -->
                        <div class="sidebar-item similar-courses">
                            <div class="title">
                                <h4>Other Events</h4>
                            </div>
                            <ul>

                            @foreach($other_events as $val)
                                <li>
                                    <div class="thumb">
                                        <a href="{{url('/event_details/'.encrypt($val->event_id))}}">
                                            <img src="{{asset('frontend/assets/img/event/'.$val->img_path)}}" alt="Thumb">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <a href="{{url('/event_details/'.encrypt($val->event_id))}}">{{$val->event_title}}</a>
                                        <div class="meta">
                                            <span> <strong style="color:#ffb606">{{substr($val->event_date,8,9)}}</strong> {{date("M, Y",strtotime($val->event_date))}}</span>
                                           
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                                
                            </ul>
                        </div>
                        <!-- End Sidebar Item -->
                    </div>
                </div>
                <!-- End Course Sidebar -->
            </div>
        </div>
    </div>
    <!-- End Course Details -->





    
@endsection