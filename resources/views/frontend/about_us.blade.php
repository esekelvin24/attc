@extends('../layouts.frontend')


@section('title-name')
About Us
@endsection

@section('content')


    <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area shadow dark bg-fixed text-center text-light" style="background-image: url({{asset('frontend/assets/img/banner/30.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>About Us</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="#"></i> About</a></li>
                        <li class="active">About Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    
    <!-- Start About 
    ============================================= -->
    <div class="about-area default-padding">
        <div class="container">
            <div class="row">
            
                <div class="about-items">
                    <div class="col-md-12 about-info">
                        
                       
                        <p>
                          AFRICAN TECHNICAL TRAINING CENTER (a subsidiary of VERITY ROCK LIMITED) was established to provide high calibre skills development programs to rural populaces, who otherwise do not have access to training of this nature. African technical training teaches the skills needed to design, develop, implement, maintain, support or operate a particular technology or related application, product or service. We have served and still serving all our clients in different fields of service.
                        </p>
                        <h4>Our clients</h4>
                      
                        <ul class="list">
                                            <li><i class="fas fa-angle-right"></i> LLOYDS INSULATION INTERNATIONAL FZE</li>
                                            <li><i class="fas fa-angle-right"></i> THE 7th COMPANY OF CHINA NATIONAL CHEMICAL ENGINEERING FZE</li>
                                            <li><i class="fas fa-angle-right"></i> PAHARPUR NIGERIA FZE</li>
                                            <li><i class="fas fa-angle-right"></i> CEMERE CONSTRUCTION FZE</li>
                                            <li><i class="fas fa-angle-right"></i> GTA POWER MECH FZE</li>
                                            <li><i class="fas fa-angle-right"></i> OFFSHORE INFRASTRUCTURE FZE</li>
                                            <li><i class="fas fa-angle-right"></i> CHEMI-TECH DMCC(BR)FZE NIGERIA</li>
                                            <li><i class="fas fa-angle-right"></i> CEEC NORTHEAST NO.2 ELECTRIC POWER CONSTRUCTION NIGERIACOMPANY LIMITED</li>
                        </ul>
                        <br/>
                        <h4>Aims</h4>
                        <p>
                        The main aim of the technical education is that, it makes the students skilled and technically fit for the industries. Technical Education offers good opportunities for employments and it would be helpful to make successful career.
                        </p>

                        <p>
                        At African Technical Training Center we recognize the growing shortage of skilled manpower in the oil and gas industry. We have put together a number of bespoke training courses for the oil and gas operators, service companies as well as government petroleum ministries.
                        </p>

                        <p>
                        Our courses are designed and delivered by highly experienced specialist and industry experts from leading research institutes in America, India and China.
                        </p>                   
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
    <!-- End About -->


    <!-- Start Portfolio
    ============================================= -->
    <div id="portfolio" class="portfolio-area default-padding">
        <div class="container">
            <div class="row">
                <div class="site-heading text-center">
                    <div class="col-md-8 col-md-offset-2">
                        <h2>Our Gallery</h2>
                        <p>
                            
                        </p>
                    </div>
                </div>
            </div>
            <div class="portfolio-items-area text-center">
                <div class="row">
                    <div class="col-md-12 portfolio-content">
                        <div class="mix-item-menu active-theme">
                            <button class="active" data-filter="*">All</button>
                            <button data-filter=".campus">Campus</button>
                            <button data-filter=".teachers">Teachers</button>
                            <button data-filter=".students">Students</button>
                        </div>
                        <!-- End Mixitup Nav-->

                        <div class="row magnific-mix-gallery masonary text-light">
                            <div id="portfolio-grid" class="portfolio-items col-3">

                                <div class="pf-item campus">
                                    <div class="item-effect">
                                        <img src="{{asset('frontend/assets/img/about/8.jpg')}}" alt="thumb" />
                                        <div class="overlay">
                                            <h4>Front Gate</h4>
                                            <a href="{{asset('frontend/assets/img/about/8.jpg')}}" class="item popup-link"><i class="fa fa-plus"></i></a>
                                            <a href="#"><i class="fas fa-link"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="pf-item campus ">
                                    <div class="item-effect">
                                        <img src="{{asset('frontend/assets/img/about/9.jpg')}}" alt="thumb" />
                                        <div class="overlay">
                                            <h4>Office Sector</h4>
                                            <a href="{{asset('frontend/assets/img/about/9.jpg')}}" class="item popup-link"><i class="fa fa-plus"></i></a>
                                            <a href="#"><i class="fas fa-link"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="pf-item  students">
                                    <div class="item-effect">
                                        <img src="{{asset('frontend/assets/img/about/2.jpg')}}" alt="thumb" />
                                        <div class="overlay">
                                            <h4>Class room with projector facility</h4>
                                            <a href="{{asset('frontend/assets/img/about/2.jpg')}}" class="item popup-link"><i class="fa fa-plus"></i></a>
                                            <a href="#"><i class="fas fa-link"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="pf-item students campus">
                                    <div class="item-effect">
                                        <img src="{{asset('frontend/assets/img/about/5.jpg')}}" alt="thumb" />
                                        <div class="overlay">
                                            <h4>Muster point</h4>
                                            <a href="{{asset('frontend/assets/img/about/5.jpg')}}" class="item popup-link"><i class="fa fa-plus"></i></a>
                                            <a href="#"><i class="fas fa-link"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="pf-item campus">
                                    <div class="item-effect">
                                        <img src="{{asset('frontend/assets/img/about/1.jpg')}}" alt="thumb" />
                                        <div class="overlay">
                                            <h4>Welding Booth</h4>
                                            <a href="{{asset('frontend/assets/img/about/1.jpg')}}" class="item popup-link"><i class="fa fa-plus"></i></a>
                                            <a href="#"><i class="fas fa-link"></i></a>
                                        </div>
                                    </div>
                                </div>
                                  <div class="pf-item campus students">
                                    <div class="item-effect">
                                        <img src="{{asset('frontend/assets/img/about/4.jpg')}}" alt="thumb" />
                                        <div class="overlay">
                                            <h4> Practical training location</h4>
                                            <a href="{{asset('frontend/assets/img/about/4.jpg')}}" class="item popup-link"><i class="fa fa-plus"></i></a>
                                            <a href="#"><i class="fas fa-link"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="pf-item campus students">
                                    <div class="item-effect">
                                        <img src="{{asset('frontend/assets/img/about/7.jpg')}}" alt="thumb" />
                                        <div class="overlay">
                                            <h4> Accommodation area</h4>
                                            <a href="{{asset('frontend/assets/img/about/7.jpg')}}" class="item popup-link"><i class="fa fa-plus"></i></a>
                                            <a href="#"><i class="fas fa-link"></i></a>
                                        </div>
                                    </div>
                                </div>

                                 <div class="pf-item campus students">
                                    <div class="item-effect">
                                        <img src="{{asset('frontend/assets/img/about/3.jpg')}}" alt="thumb" />
                                        <div class="overlay">
                                            <h4> Badminton Court & gym facility</h4>
                                            <a href="{{asset('frontend/assets/img/about/3.jpg')}}" class="item popup-link"><i class="fa fa-plus"></i></a>
                                            <a href="#"><i class="fas fa-link"></i></a>
                                        </div>
                                    </div>
                                </div>

                                

                                

                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Portfolio -->



@endsection