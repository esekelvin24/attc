@extends('../layouts.frontend')


@section('title-name')
Accommodation
@endsection

@section('content')


    <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area shadow dark bg-fixed text-center text-light" style="background-image: url({{asset('frontend/assets/img/banner/30.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Accommodation</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                       
                        <li class="active">Accommodation</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->
    

    <!-- Start Blog
    ============================================= -->
    <div class="blog-area single full-blog left-sidebar full-blog default-padding">
        <div class="container">
            <div class="row">
                <div class="blog-items">
                    <div class="blog-content col-md-8">

                        <div class="single-item">
                            <div class="item">
                                <!-- Start Post Thumb -->
                                <div class="thumb">
                                    <a href="#">
                                        <img src="{{asset('frontend/assets/img/accommodation/accommodation.jpg')}}" alt="Thumb">
                                    </a>
                                </div>
                                <!-- Start Post Thumb -->

                                <div class="info">
                                    
                                    
                                    <div class="content">
                                       
                                        <h3>Student Accommodation</h3>
                                        <p>
                                           It’s important to us that your accommodation is safe and of a good standard. The University’s eligible properties are signed up to the student
                                        </p>
                                        <p>
                                           Our accommodation guarantee applies to all new students who are starting a full-time course at ATTC in Lagos. Accept your offer to study with us and reserve your room.
                                        </p>
                                        <h3>Accommodation options</h3>
                                        <p>
                                           We have a hostel on campus, and our apartments are within easy walking distance. Each hostel or house is different, as are the social opportunities and surroundings.
                                        </p>

                                        <h5>Our properties are:</h5>

                                         <ul class="list">
                                            @foreach($accommodation_list as $val)
                                              <li><i class="fas fa-angle-right"></i> <a href="{{url('/accommodation/'.encrypt($val->accommodation_id))}}"><u>{{$val->accommodation_name}}</u></a></li>
                                            @endforeach
                                        </ul>
                                        <br/>
                                        <br/>
                                        <h4>How to apply</h4>
                                       <p>  Once you’ve decided where you’d like to live, simply <a href="#"><u>apply online</u></a>.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Start Sidebar -->
                    <div class="sidebar col-md-4">
                        <aside>
                           <style>
                             
                           </style>
                          
                            <div s class="sidebar-item recent-post my_side_menu">
                                <ul>
                                    <li class="side_active">
                                        <div class="info">
                                            <a class ="my_link_active side_menu_padding" href="#">Accommodation</a>
                                        </div>
                                    </li>
                                     @foreach($accommodation_list as $val)
                                    <li>
                                        <div class="info">
                                            <a class="side_menu_padding"  href="{{url('/accommodation/'.encrypt($val->accommodation_id))}}">{{$val->accommodation_name}}</a>
                                        </div>
                                    </li>
                                    @endforeach
                                   
                                </ul>
                            </div>
                            
                            </div>
                            
                        </aside>
                    </div>
                    <!-- End Start Sidebar -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog -->



@endsection