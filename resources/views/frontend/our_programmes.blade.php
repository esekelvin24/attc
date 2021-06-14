@extends('../layouts.frontend')


@section('title-name')
Our Programmes
@endsection

@section('content')


    <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area shadow dark bg-fixed text-center text-light" style="background-image: url({{asset('frontend/assets/img/banner/13.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Our Programmes</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="active">Our Programmes</li>
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

                    @foreach($programme_collections as $val)
                    <!-- Single Item -->
                    <div class="col-md-4 col-sm-6 equal-height">
                        <div class="item">
                            <div class="thumb">
                                <img src="{{asset('frontend/assets/img/programmes/{{--thumbnails/--}}'.$val->disp_img."?".rand(1,9999999))}}" alt="Thumb">
                                <div class="overlay">
                                    
                                </div>
                            </div>
                            <div class="info">
                               
                                <h4 class="h4_programme">
                                    <a href="#">{{substr($val->programme_name,0,70)}}</a>
                                </h4>
                               
                                <div class="footer-meta">
                                    <a href="{{url('/programme_courses/'.encrypt($val->programme_id))}}" class="btn btn-theme effect btn-sm" href="#">View Details</a>
                                    <h4>{{isset($course_array[$val->programme_id])?$course_array[$val->programme_id]:0}} Course(s)</h4>
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


@endsection