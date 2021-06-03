@extends('../layouts.frontend')


@section('title-name')
Management Team Details
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
                        <li><a href="{{url('/management_team')}}"></i> Management Team</a></li>
                        <li class="active">{{$teamCollection[0]->name}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->


    <!-- Start Advisor Details 
    ============================================= -->
    <div class="advisor-details-area default-padding">
        <div class="container">
            <div class="row">
                <div class="advisor-info">
                    <!-- Start Thumbnail -->
                    <div class="col-md-5">
                        <div style="margin: auto; width: 50%; border: 3px solid #141541; padding: 10px;" class="thumb">
                            <img src="{{asset('frontend/assets/img/team/'.$teamCollection[0]->profile_url_img)}}" alt="Thumb">
                            <div class="info">
                                <h4>{{$teamCollection[0]->name}}</h4>
                                <p>
                                    {{$teamCollection[0]->company_designation}}
                                </p>
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
                                </ul>
                            --}}
                            </div>
                        </div>
                    </div>
                    <!-- End Thumbnail -->

                    <!-- Start Content -->
                    <div class="col-md-7 content">
                        
                        <!-- Star Tab Info -->
                        <div class="tab-info">
                            <!-- Tab Nav -->
                            <ul class="nav nav-pills">
                                <li class="active">
                                    <a data-toggle="tab" href="#tab1" aria-expanded="true">
                                        Biography
                                    </a>
                                </li>
                               
                            </ul>
                            <!-- End Tab Nav -->
                            <!-- Start Tab Content -->
                            <div class="tab-content tab-content-info">
                                <!-- Single Tab -->
                                <div id="tab1" class="tab-pane fade active in">
                                    <div class="info title">
                                       {!!$teamCollection[0]->biography!!}
                                    </div>
                                </div>
                                <!-- End Single Tab -->

                               
                            </div>
                            <!-- End Tab Content -->
                        </div>
                        <!-- End Tab Info -->

                    </div>
                    <!-- End Content -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Advisor Details -->



@endsection