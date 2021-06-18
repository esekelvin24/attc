@extends('../layouts.frontend')


@section('title-name')
Course Details
@endsection

@section('content')


    <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area shadow dark bg-fixed text-center text-light" style="background-image: url({{asset('frontend/assets/img/banner/13.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Courses</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="{{url('/our_programmes')}}">Our Programmes</a></li>
                         <li><a href="{{url('/programme_courses/'.encrypt($course_details[0]->programme_id))}}">{{$course_details[0]->programme_name}}</a></li>
                         <li class="active">{{$course_details[0]->course_name}}</li>
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
                        <h2>
                            {{$course_details[0]->course_name}}
                        </h2>
                        <div class="course-meta">
                            
                            <div class="item price">
                                <h4>Price</h4>
                                <h3><strong>₦ {{number_format($course_details[0]->course_price,2)}}</strong></h3>
                            </div>
                            <div class="align-right">
                                @if($course_details[0]->open_registration == 1)
                                <a class="btn btn-theme effect btn-sm" href="{{url('/apply?course_id='.encrypt($course_details[0]->course_id).'&programme_id='.encrypt($course_details[0]->programme_id))}}}">
                                    <i class="fas fa-chart-bar"></i> Apply Now
                                </a>
                                @else
                                   <div class="alert alert-danger" role="alert">
                                       <img width="20" height="20" src="{{asset('img/barred.png')}}" > Registration is closed for the course
                                    </div>
                                @endif
                            </div>
                        </div>
                        <img src="{{asset('frontend/assets/img/courses/'.$course_details[0]->cover_img."?".rand(1,9999999))}}" alt="Thumb">
                        <!-- Star Tab Info -->
                        <div class="tab-info">
                            <!-- Tab Nav -->
                            <ul class="nav nav-pills">
                                <li class="active">
                                    <a data-toggle="tab" href="#tab1" aria-expanded="true">
                                        Overview
                                    </a>
                                </li>
                               
                                <li>
                                    <a data-toggle="tab" href="#tab3" aria-expanded="false">
                                        Instructors
                                    </a>
                                </li>
                                
                            </ul>
                            <!-- End Tab Nav -->
                            <style>
                             .title ol
                            {
                                margin-top: 10px;
                            }
                           .title ul {
                               list-style: inside;
                                padding: 0;
                                }
                                li {
                                padding-left: 1.3em;
                                }
                             .title ul li:before {
                                
                                font-family: FontAwesome;
                                display: inline-block;
                                margin-left: -1.3em; /* same as padding-left set on li */
                                width: 1.3em; /* same as padding-left set on li */
                             }

                              .title .list li:before {
                                font-family: "Font Awesome 5 Free"; font-weight: 900; content: "\f105";
                                color:#002147;
                                top:6px;
                                position: relative;
                                top: 2px;
                                padding-right: 7px;
                                color: #002147;
                             }
                            </style>
                            <!-- Start Tab Content -->
                            <div class="tab-content tab-content-info">
                                <!-- Single Tab -->
                                <div id="tab1" class="tab-pane fade active in">
                                    <div class="info title">
                                        <h4>Objective and Content</h4>
                                        
                                        {!! $course_details[0]->course_description !!}
                                       
                                        <br/>
                                        <br/>
                                        <h4>Learning Outcomes</h4>
                                                               
                                        <ul class="list">
                                        {!! $course_details[0]->course_outcome !!}
                                        </ul>

                                    </div>
                                </div>
                                <!-- End Single Tab -->

                                <!-- Single Tab -->
                                <div id="tab3" class="tab-pane fade">
                                    <div class="info title">
                                        <div class="advisor-list-items">

                                            @foreach($instructor_list as $val)
                                            <!-- Advisor Item -->
                                            <div class="item">
                                                <div class="thumb">
                                                    <img src="{{asset('img/users/'.$val->pics)}}" alt="Thumb">
                                                </div>
                                                <div class="info">
                                                    <div class="author">
                                                        <h4>{{$val->firstname." ".$val->middlename." ".$val->lastname}}</h4>
                                                        <ul>
                                                            <li class="linkedin">
                                                                <a href="#"><i class="fab fa-linkedin"></i></a>
                                                            </li>
                                                            <li class="twitter">
                                                                <a href="#"><i class="fab fa-twitter"></i></a>
                                                            </li>
                                                          
                                                        </ul>
                                                    </div>
                                                    <span class="designation">{{$val->designation}}</span>
                                                    <p>{!! $val->lecturer_biography !!}</p>
                                                </div>
                                            </div>
                                            <!-- End Advisor Item -->
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Tab -->

                            </div>
                            <!-- End Tab Content -->
                        </div>
                        <!-- End Tab Info -->
                    </div>
                </div>
                <!-- End Course Info -->

                <!-- Start Course Sidebar -->
                <div class="col-md-3">
                    <div class="aside">
                        <!-- Sidebar Item -->
                        <div class="sidebar-item course-info">
                            <div class="title">
                                <h4>Course Features</h4>
                            </div>
                            <ul>
                                <li><i class="flaticon-translation"></i> Language  <span class="pull-right">English</span></li>
                              {{--  <li><i class="flaticon-faculty-shield"></i> Lectures  <span class="pull-right">23</span></li>  --}}
                                <li><i class="fa fa-calendar"></i> Duration  <span class="pull-right">{{$course_details[0]->course_duration ." ".$course_details[0]->course_duration_type}}</span></li>
                               {{--  <li><i class="flaticon-levels"></i> Level  <span class="pull-right">beginner</span></li>
                                <li><i class="flaticon-group-of-students"></i> Enrolled  <span class="pull-right">136</span></li> --}}
                            </ul>                        
                        </div>
                        <!-- End Sidebar Item -->
                       
                        <!-- Sidebar Item -->
                        <div class="sidebar-item similar-courses">
                            <div class="title">
                                <h4>Similar Courses</h4>
                            </div>
                            <ul>

                            @foreach($similar_courses as $val)
                                <li>
                                    <div class="thumb">
                                        <a href="{{url('/course_details/'.encrypt($val->course_id))}}">
                                            <img src="{{asset('frontend/assets/img/courses/'.$val->disp_img."?".rand(1,9999999))}}" alt="Thumb">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <a href="{{url('/course_details/'.encrypt($val->course_id))}}">{{$val->course_name}}</a>
                                        <div class="meta">
                                            <span>₦{{number_format($val->course_price,2)}}</span>
                                           
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