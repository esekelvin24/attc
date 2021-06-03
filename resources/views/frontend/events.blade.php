@extends('../layouts.frontend')


@section('title-name')
Events
@endsection

@section('content')


    <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area shadow dark bg-fixed text-center text-light" style="background-image: url({{asset('frontend/assets/img/banner/13.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Latest Events</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        
                        <li class="active">Events</li>
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

                    @foreach( $event_collection as $val)
                        <!-- Single Item -->
                        <div class="item">
                            <div class="col-md-5 thumb" style="background-image: url({{asset('frontend/assets/img/event/'.$val->img_path)}});"></div>
                            <div class="col-md-7 info">
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
                        <!-- End Single Item -->
                        @endforeach

                    </div>
                </div>
                <div class="more-btn col-md-12 text-center">
                    <a href="#" class="btn btn-theme effect btn-md">Load More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Event -->



@endsection