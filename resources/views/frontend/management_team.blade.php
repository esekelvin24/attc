@extends('../layouts.frontend')


@section('title-name')
Management Team
@endsection

@section('content')


    <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area shadow dark bg-fixed text-center text-light" style="background-image: url({{asset('frontend/assets/img/banner/13.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Management Team</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="#"></i> About</a></li>
                        <li class="active">Management Team</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Start Advisor ============================================= -->

<div class="advisor-area bg-gray default-padding bottom-less bg-cover">
        <div class="container">
            <div class="row">
                <div class="advisor-items col-3 text-light text-center">
                    <!-- Single item -->
                    @foreach($teamCollection as $val)
                    <a href="{{url('/management_team_details/'.encrypt($val->id))}}">
                    <div class="col-md-4 col-sm-6 single-item">
                        <div class="item">
                          
                            <div class="thumb">
                                <img src="{{asset('frontend/assets/img/team/'.$val->profile_url_img)}}" alt="Thumb">
                             {{--   <ul>
                                    <li class="facebook">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li class="twitter">
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li class="dribbble">
                                        <a href="#"><i class="fab fa-dribbble"></i></a>
                                    </li>
                                    <li class="youtube">
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                    </li>
                                </ul>--}}
                            </div>
                            
                            <div class="info">
                                <span>{{$val->company_designation}}</span>
                                <h4>{{$val->name}}</h4>
                            </div>
                        </div>
                    </div>
                    </a>
                    @endforeach
                    <!-- End Single item -->

                </div>
            </div>
        </div>
    </div>

    <!-- End Advisor -->



@endsection