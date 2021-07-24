<!DOCTYPE html>
<html lang="en">



<head>
<script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="African Technical Training Center">

    <!-- ========== Page Title ========== -->
    <title>@yield('title-name')</title>

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="{{asset('frontend/assets/img/favicon.png')}}" type="image/x-icon">

    <!-- ========== Start Stylesheet ========== -->
    <link href="{{asset('frontend/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/frontend/assets/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('frontend/assets/css/flaticon-set.css')}}" rel="stylesheet" />
    <link href="{{asset('frontend/assets/css/themify-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('frontend/assets/css/magnific-popup.css')}}" rel="stylesheet" />
    <link href="{{asset('frontend/assets/css/owl.carousel.min.css')}}" rel="stylesheet" />
    <link href="{{asset('frontend/assets/css/owl.theme.default.min.css')}}" rel="stylesheet" />
    <link href="{{asset('frontend/assets/css/animate.css')}}" rel="stylesheet" />
    <link href="{{asset('frontend/assets/css/bootsnav.css')}}" rel="stylesheet" />
    <link href="{{asset('frontend/style.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/responsive.css')}}" rel="stylesheet" />
        <link href="{{asset('frontend/assets/css/drag-and-drop.css')}}" rel="stylesheet" />
        <link href="{{asset('frontend/assets/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
        
        
    <!-- ========== End Stylesheet ========== -->


    <!-- ========== Google Fonts ========== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800" rel="stylesheet">
    
    <style> 

   @auth
    @media (max-width: 576px)
    {
       nav.navbar.bootsnav .navbar-brand {
           
            margin: 0px 180px 0px 0px !important;
       }
    }
    @endauth   
    
         
@media (min-width: 576px) {
    .modal-dialog {
    max-width: 400px;
    }
    .modal-dialog .modal-content {
        padding: 1rem;
    }
    }
    .modal-header .close {
    margin-top: -1.5rem;
    }
    
    .form-title {
    margin: -1rem 0rem 2rem;
    }
    
    .btn-round {
    border-radius: 3rem;
    background: #141541;
    color:white;
    }

    .btn-round:hover {
         color:#ffb606;
    }
    
    .delimiter {
    padding: 1rem;
    }
    
    .social-buttons .btn {
    margin: 0 0.5rem 1rem;
    }
    
    .signup-section {
    padding: 0.3rem 0rem;
    }

    .swal2-select {
        display:none;
    }
    </style>
</head>

<body>

    <!-- Preloader Start -->
    <div class="se-pre-con"></div>
    <!-- Preloader Ends -->

    <!-- Start Header Top 
    ============================================= -->
    <div class="top-bar-area bg-dark inc-border text-light">
        <div class="container">
            <div class="row">
                
                <div class="col-md-8 address-info text-left">
                    <div class="info">
                        <ul>
                            <li class="social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </li>
                           
                            <li>
                                <i class="fas fa-phone"></i> Contacts <strong>+234 09014067496 | 08118052403 | 07038260210</strong>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4 link text-right">
                    <ul>
                    @auth 
                     <form id="logout-form" action="<?php echo route('logout') ?>" method="POST" style="display: none;">
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
                    </form>
                        <li>
                            <a onclick="document.getElementById('logout-form').submit();" href="#"><i class="fas fa-sign-out-alt"></i> LOGOUT</a>
                        </li>
                        <li>
                            <a  href="{{url('/dashboard')}}"> <i class="fa fa-home"></i> PORTAL</a>
                        </li>
                        
                    @else
                        <li>
                            <a data-toggle="modal" data-target="#loginModal" href="#"><i class="fa fa-lock"></i> Login</a>
                        </li>
                    @endauth
                    </ul>
                </div>                
            </div>
        </div>
    </div>
    <!-- End Header Top -->

    <!-- Header 
    ============================================= -->
    <header id="home">

        <!-- Start Navigation -->
        <nav class="navbar top-pad navbar-default attr-border-none navbar-fixed navbar-transparent white bootsnav">

            <!-- Start Top Search -->
            <div class="container">
                <div class="row">
                    <div class="top-search">
                        <div class="input-group">
                            <form action="#">
                                <input type="text" name="text" class="form-control" placeholder="Search">
                                <button type="submit">
                                    <i class="ti-search"></i>
                                </button>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Top Search -->

            <div class="container">

                <!-- Start Atribute Navigation -->
                <div  class="attr-nav ">
                    <ul class="visible-xs visible-sm ">
                     @auth 
                         <li>
                            <a  href="{{url('/dashboard')}}"><icon class="fa fa-home"></icon> PORTAL</a> </li>  
                            <li><a onclick="document.getElementById('logout-form').submit();" href="#"><i class="fas fa-sign-out-alt"></i> LOGOUT</a>
                        </li>
                        </li>
                     @else

                        <li>
                            <a data-toggle="modal" data-target="#loginModal" href="#"><icon class="fa fa-lock"></icon> Login</a>
                        </li>
                        

                     @endauth
                    </ul>
                </div>        
                <!-- End Atribute Navigation -->

                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{asset('frontend/assets/img/logo-light.png')}}" class="logo logo-display" alt="Logo">
                        <img src="{{asset('frontend/assets/img/logo.png')}}" class="logo logo-scrolled" alt="Logo">
                    </a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                         <li>
                            <a href="{{route('welcome')}}">Home</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" >About</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('about_us')}}">About Us</a></li>
								<li><a href="{{route('management_team')}}">Management Team</a></li>
                            </ul>
                        </li>
						 <li>
                            <a href="{{route('apply')}}">Apply</a>
                        </li>
                         <li>
                            <a href="{{route('our_programmes')}}">Our Programmes</a>
                        </li>
                        <li>
                            <a href="{{route('events')}}">Events</a>
                        </li>
                       
                       
                        <li>
                            <a href="{{url('/contact')}}">contact</a>
                        </li>
                    </ul>
                    
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>
        <!-- End Navigation -->

    </header>
    <!-- End Header -->

    @yield('content')


<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header border-bottom-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-title text-center">
               <h4>Login</h4>
            </div>
            
             @error('email')
                <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                </div>
             @enderror
               
           
            <div class="d-flex flex-column text-center">
            <form action="{{ route('login') }}" method="post">
                @csrf
                 <div class="form-group">
                   <input value="{{ old('email') }}" type="email" class="form-control" id="email1" name="email" placeholder="Your email address...">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password1" name="password" placeholder="Your password...">
                </div>
                 @error('password')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                 @enderror
                <button type="submit" class="btn  btn-block btn-round">Login</button>
            </form>
            
            <div class="text-center text-muted delimiter"><a href="#">forgot password?</a></div>
                <div class="modal-footer d-flex justify-content-center">
                    <div class="signup-section">New User? <a href="{{url('/register')}}" class="text-info"> Register</a>.</div>
                </div>
            </div>
        </div>
        </div>
       
    </div>
</div>

      

    
    <!-- Start Footer 
    ============================================= -->
    <footer class="bg-dark text-light">
        <div class="container">
            <div class="f-items default-padding">
                <div class="row">
                    <!-- Single item -->
                    <div class="col-md-5 col-sm-6 item equal-height">
                        <div class="f-item about">
                            <h4>About</h4>
                            <p>
                               AFRICAN TECHNICAL TRAINING CENTER (a subsidiary of VERITY ROCK LIMITED) was established to provide high calibre skills development programs to rural populaces, who otherwise do not have access to training of this nature. <br/><br/><a class="btn circle btn-theme effect btn-sm" href="#">Read More</a>
                            </p>
                           
                        </div>
                    </div>
                    <!-- End Single item -->

                    <!-- Single item -->
                    <div class="col-md-2 col-sm-2 item equal-height">
                        <div class="f-item link">
                            <h4>Categories</h4>
                            <ul>
                                <li>
                                    <a href="{{url('/our_programmes')}}"><i class="ti-angle-right"></i> All Programmes</a>
                                </li>
                                <li>
                                    <a href="{{url('/events')}}"><i class="ti-angle-right"></i> Event</a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    <!-- End Single item -->

                    <!-- Single item -->
                    <div class="col-md-2 col-sm-2 item equal-height">
                        <div class="f-item link">
                            <h4>Support</h4>
                            <ul>
                               
                                <li>
                                    <a href="{{url('/contact')}}"><i class="ti-angle-right"></i> Contact Us</a>
                                </li>
                               
                               
                            </ul>
                        </div>
                    </div>
                    <!-- End Single item -->
					
					 <!-- End Single item -->
					 <div class="col-md-3 col-sm-6 item equal-height">
                        <div class="f-item about">
                            <h4>Contact</h4>
                            
                            <ul>
                                <li>
                                    <p>Email <span><a href="mailto:info@example.com">info@attcnigeria.org</a></span></p>
                                </li>
                                <li>
                                    <p>6, Oseni Close, magbon Segun Bus Stop, Dangote Refinery New Gate, Ibeju Lekki, Lagos</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single item -->

                </div>
            </div>
        </div>

        <!-- Start Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; Copyright 2021. All Rights Reserved by African Trainning Centre</p>
                    </div>
                    <div class="col-md-6 text-right link">
                        <ul>
                            <li>
                                <a href="#">Terms of user</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Bottom -->
    </footer>
    <!-- End Footer -->

    <!-- jQuery Frameworks
    ============================================= -->
    <script src="{{asset('frontend/assets/js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/equal-height.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.appear.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/modernizr.custom.13711.js')}}"></script>
    <script src="{{asset('frontend/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/wow.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/progress-bar.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/count-to.js')}}"></script>
    <script src="{{asset('frontend/assets/js/YTPlayer.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/loopcounter.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bootsnav.js')}}"></script>
    <script src="{{asset('frontend/assets/js/main.js')}}"></script>
    <script src="{{asset('frontend/assets/js/drag-and-drop.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/sweetalert2.js')}}"></script>
    
     
    @yield('additional_js')

    @php
        use Illuminate\Support\Facades\DB;

        $email_verified = false;
        if(isset(request()->confirm_email) && filter_var(decrypt(request()->confirm_email), FILTER_VALIDATE_EMAIL))
        {
            $check = DB::table('users')->where("email_verified_at",NULL)->where("email",decrypt(request()->confirm_email))->get();
            if(count($check) > 0)
            {
                $update = DB::table('users')->where("email_verified_at",NULL)->where("email",decrypt(request()->confirm_email))->update(["email_verified_at" => NOW()]);
                if ($update)
                {
                    $email_verified = true;
                }
            }
        }
        
    @endphp

    <script>
    


    @if($email_verified == true)
       Swal.fire('Success','Your account has been verified','success');
    @endif

     @error('email')
         @if ($message != 'The email has already been taken.')
            $(document).ready(function() {             
                $('#loginModal').modal('show');
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            });
         @endif
     @enderror

     @php
         $target = redirect()->intended()->getTargetUrl( );
         $intended_route = explode("?",$target);

     
     @endphp
    

    @if(($intended_route[0] == url('/apply') || $intended_route[0] == url('/dashboard')) && Route::currentRouteName() != "register")
         $(document).ready(function() {             
            $('#loginModal').modal('show');
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
         });
    @php
           // dd(Route::currentRouteName());

             if (Route::currentRouteName() != "welcome")
             {
                  $target = redirect()->intended()->getTargetUrl( );
                 
             }else
             {
                request()->session()->put('url.intended', $target);
             }
         @endphp
    @endif
   
</script>

</body>

</html>