@extends('../layouts.frontend')

@section('title-name')
Home
@endsection


@section('content')


    <!-- Start Banner 
    ============================================= -->
    <div class="banner-area">
        <div id="bootcarousel" class="carousel text-light top-pad text-dark slide animate_text" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner carousel-zoom">
                <div class="item active bg-cover" style="background-image: url({{asset('frontend/assets/img/banner/6.jpg')}});">
                    <div class="box-table">
                        <div class="box-cell shadow dark">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="content">
                                            <h2 data-animation="animated slideInDown">Achieved Your Career and Goal</h2>
                                            <p data-animation="animated slideInLeft">
                                               The style of training is aimed at making students feel confident in their surroundings and focused on getting them to become familiar with new technology equipment’s in the shortest time possible
                                            </p>
                                            <a data-animation="animated slideInUp" class="btn btn-theme effect btn-md" href="{{url('/our_programmes')}}">View Programmes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item bg-cover" style="background-image: url({{asset('frontend/assets/img/banner/9.jpg')}});">
                    <div class="box-table">
                        <div class="box-cell shadow dark">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="content">
                                            <h2 data-animation="animated slideInDown">PASSIONATE & EXCELLENT <strong>TRAINERS</strong></h2>
                                            <p data-animation="animated slideInLeft">
                                                You will be trained by tutors, many of whom are themselves professionally trained.
                                            </p>
                                            <a data-animation="animated slideInUp" class="btn btn-theme effect btn-md" href="#">View Programmes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Wrapper for slides -->

            <!-- Left and right controls -->
            <a class="left carousel-control shadow" href="#bootcarousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control shadow" href="#bootcarousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!-- End Banner -->



    <!-- Start Features 
    ============================================= -->
    <div class="features-area default-padding-bottom fixed bottom-less bg-color text-light">
        <div class="container">
            <div class="row">
                <div class="features">
                    <div class="equal-height col-md-4 col-sm-6">
                        <div class="item mariner">
                            <a href="#">
                                <div class="icon">
                                    <i class="ti-panel"></i>
                                </div>
                                <div class="info">
                                    <h4>Experienced & Qualified Faculty</h4>
                                    <p>
                                        Drawn from reputable universities in India and abroad, the highly qualified and experienced faculty is our greatest asset.
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="equal-height col-md-4 col-sm-6">
                        <div class="item brilliantrose">
                            <a href="{{url('/accommodation')}}">
                                <div class="icon">
                                    <i class="ti-home"></i>
                                </div>
                                <div class="info">
                                    <h4>Accommodation</h4>
                                    <p>
                                       Accomodations are provided to our students comming outside lagos, with affordable price range.
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="equal-height col-md-4 col-sm-6">
                        <div class="item casablanca">
                            <a href="#">
                                <div class="icon">
                                    <i class="ti-desktop"></i>
                                </div>
                                <div class="info">
                                    <h4>Online Learning Facility</h4>
                                    <p>
                                        We provide online classes to students who are not on campus and wants to follow up with their lectures
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    <!-- End Features -->


    <!-- Start About 
    ============================================= -->
    <div class="about-area default-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="about-items">
                    <div class="col-md-6 about-info">
                        <h3>Create your unique path of exploration and learning</h2>
                        <blockquote>
                           Without any shadow of doubt, it is the members of the teaching community who impact progress into the students
                        </blockquote>
                        <p>
                           The main aim of the technical education is that, it makes the students skilled and technically fit for the industries. Technical Education offers good opportunities for employments and it would be helpful to make successful career.
                        </p>
                        <a class="btn circle btn-theme effect btn-md" href="{{url('/about_us')}}">Know More</a>
                    </div>
                    <div class="col-md-6 thumb">
                        <div class="thumb">
                            <img src="{{asset('frontend/assets/img/about/2.jpg')}}" alt="Thumb">
                            <a href="https://www.youtube.com/watch?v=DKz_EEoJRs4" class="popup-youtube light video-play-button">
                                <i class="fa fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About -->


  





    <!-- Start Popular Courses
    ============================================= -->
    <div class="popular-courses-area weekly-top-items bg-gray default-padding bottom-less">
        <div class="container">
            <div class="row">
                <div class="site-heading text-center">
                    <div class="col-md-8 col-md-offset-2">
                        <h2>Popular Courses</h2>
                        <p>
                           Popular courses taken by students running a programme in our institute
                        </p>
                    </div>
                </div>
            </div>
             <div class="row">
                <div class="top-course-items">
                <style>
                    .h4_programme
                    {
                        min-height:40px;
                        max-height:40px;
                    }

                    </style>
                @foreach($popular_courses as $val)
                    <!-- Single Item -->
                    <div class="col-md-4 col-sm-6 equal-height">
                        <div class="item">
                            <div class="thumb">
                                <img src="{{asset('frontend/assets/img/courses/'.$val->disp_img."?".rand(1,9999999))}}" alt="Thumb">
                                <div class="overlay">
                                   
                                    <ul>
                                        <li><i class="fas fa-calendar"></i> {{$val->course_duration ." ".$val->course_duration_type}}</li>
                                       {{-- <li><i class="fas fa-list-ul"></i> 32</li> --}}
                                    </ul>
                                </div>
                            </div>
                            <div class="info">
                                <div class="meta">
                                    <ul>
                                        <li>
                                            <a href="#">{{$val->short_code}}</a>
    
                                        </li>
                                       
                                    </ul>
                                </div>
                                <h4 class="h4_programme">
                                    <a href="#">{{substr($val->course_name,0,70)}}</a>
                                </h4>
                               
                                <div class="footer-meta">
                                    <a class="btn btn-theme effect btn-sm" href="{{url('/course_details/'.encrypt($val->course_id))}}">View Details</a>
                                    <h4>₦{{number_format($val->course_price,2)}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Single Item -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- End Popular Courses -->
	
	
	

    <!-- Start Event 
    ============================================= -->
    <div class="event-area flex-less default-padding">
        <div class="container">
            <div class="row">
                <div class="site-heading text-center">
                    <div class="col-md-8 col-md-offset-2">
                        <h2>Upcoming Events</h2>
                        <p>
                            Recent and upcoming educational events listed here
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="event-items">

                   <style>
                   .ese img{
                       min-height: 380px !important;
                   }
                   </style>

                    @foreach($event_collection as $val)

                    <!-- Single Item -->
                    <div class="col-md-6 col-sm-6 equal-height" >
                        <div class="item" style="min-height:754px">
                            <div class="thumb ese">
                                <img src="{{asset('frontend/assets/img/event/'.$val->img_path)}}" alt="Thumb">
                            </div>
                            <div class="info">
                                <div class="info-box">
                                    <div class="date">
                                        <strong>{{substr($val->event_date,8,9)}}</strong> {{date("M, Y",strtotime($val->event_date))}}
                                    </div>
                                    <div class="content">
                                        <h4>
                                            <a href="#">{{substr($val->event_title,0,62)}} </a>
                                        </h4>
                                        <ul>
                                            <li><i class="fas fa-clock"></i> {{substr($val->event_start_time,0,5)}} - {{substr($val->event_end_time,0,5)}}</li>
                                            <li><i class="fas fa-map-marked-alt"></i> {{$val->event_venue}}</li>
                                        </ul>
                                        <p>
                                            {!! substr($val->event_content,0,130) !!}
                                        </p>
                                        <div class="bottom">
                                            <a href="{{url('/event_details/'.encrypt($val->event_id))}}" class="btn circle btn-dark border btn-sm">
                                                <i class="fas fa-chart-bar"></i> View Details
                                            </a>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                    @endforeach
                    
                    
                </div>
                <div class="more-btn col-md-12 text-center">
                    <a href="{{url('/events')}}" class="btn btn-theme effect btn-md">View All Events</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Event -->








@endsection

