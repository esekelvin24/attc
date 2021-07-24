@extends('../layouts.frontend')


@section('title-name')
Our Programmes | Courses
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
                         <li class="active">{{$programme_details[0]->programme_name}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->


    <!-- Start Popular Courses
    ============================================= -->
    <div class="popular-courses-area weekly-top-items default-padding bottom-less">
        <div class="container">
            <div class="row">
                <div class="top-course-items">
                <style>
                    .h4_programme
                    {
                        min-height:40px;
                        max-height:40px;
                    }

                    </style>

            @if(count($course_collection) > 0)
                @foreach($course_collection as $val)
                    <!-- Single Item -->
                    <div class="col-md-4 col-sm-6 equal-height">
                        <div class="item">
                            <div class="thumb">
                                <img src="{{asset('frontend/assets/img/courses/'.$val->disp_img."?".rand(1,9999999))}}" alt="Thumb">
                                <div class="overlay">
                                   
                                    <ul>
                                        <li><i class="fas fa-calendar"></i> {{$val->course_duration." ".$val->course_duration_type}}</li>
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
                @else
                                        <div align="center">
                                            <img width="150" height="150" src="{{asset('img/barred.png')}}" >
                                            <p> There is no course available for this programme<p>
                                        </div>

                @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Popular Courses -->

@endsection