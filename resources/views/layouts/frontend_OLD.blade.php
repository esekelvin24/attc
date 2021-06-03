<?php
use App\Settings;
use App\Session as School_Session;
$c_name=Settings::select('value')->get();
$company_name=$c_name[0]->value;
$powered_by=$c_name[1]->value;
$maintenance_mode=$c_name[2]->value;


?>
<!DOCTYPE html >
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->

<!-- Mirrored from corpthemes.com/html/fusion/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Apr 2020 00:28:30 GMT -->
<head>

    <style>
        .modal-backdrop {
            z-index: 100000 !important;
        }

        .modal {
            padding-top:80px;
            z-index: 100001 !important;
        }
    </style>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Crack and Earn Network</title>

    <meta name="author" content="themesflat.com">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Bootstrap  -->
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend/stylesheets/bootstrap.css')}}" >

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend/stylesheets/style.css')}}">

    <!-- Responsive -->
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend/stylesheets/responsive.css')}}">

    <!-- Colors -->
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend/stylesheets/colors/color1.css')}}" id="colors">
      <link href="{{asset('bower_components/sweetalert/sweet-alert.css')}}" rel="stylesheet">
    <!-- Animation Style -->
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend/stylesheets/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend/stylesheets/mdb.css')}}">
    
    <!-- Favicon and touch icons  -->
   {{-- <link href="icon/apple-touch-icon-48-precomposed.png" rel="apple-touch-icon-precomposed" sizes="48x48">
    <link href="icon/apple-touch-icon-32-precomposed.png" rel="apple-touch-icon-precomposed">
    <link href="icon/favicon.png" rel="shortcut icon">
--}}
    
</head> 

@if($maintenance_mode == "false")

<body onselectstart='return false;' class="header-sticky page-loading">   
  <div class="loading-overlay">
  </div>
  
  <!-- Boxed -->
  <div class="boxed">
      <div id="site-header">
          <div class="flat-top">
              <div class="container">
                  <div class="row">
                      <div class="flat-wrapper">
                          <div class="custom-info">
                              <span>Have any questions?</span>
                              <span><i class="fa fa-phone"></i>+2349061256882</span>
                              <span><i class="fa fa-envelope"></i>info@crackandearn.com</span> 
                          </div>

                          <div class="social-links">
                              <a href="#">
                                  <i class="fa fa-twitter"></i>
                              </a>
                              <a href="#">
                                  <i class="fa fa-facebook"></i>
                              </a>
                              <a href="#">
                                  <i class="fa fa-behance"></i>
                              </a>
                              <a href="#">
                                  <i class="fa fa-spotify"></i>
                              </a>
                              <a href="#">
                                  <i class="fa fa-rss"></i>
                              </a>
                          </div>
                      </div><!-- /.flat-wrapper -->
                  </div><!-- /.row -->
              </div><!-- /.container -->
          </div><!-- /.flat-top -->
        
          <header id="header" class="header clearfix"> 
              <div class="header-wrap clearfix">
                  <div class="container">
                      <div class="row">
                          <div class="flat-wrapper">
                              <div id="logo" class="logo">
                                  <a href="index.html">
                                      <img height="70" width="70" src="{{asset('frontend/images/logo.png')}}" alt="images">
                                  </a>
                              </div><!-- /.logo -->
                              <div class="btn-menu">
                                  <span></span>
                              </div><!-- //mobile menu button -->
                         
                              <div class="nav-wrap">                                
                                  <nav id="mainnav" class="mainnav">
                                      
                                      <ul class="menu"> 
                                        <li><a href="{{url("/")}}">Home</a></li>
                                          <li><a href="{{url("/about")}}">About Us</a></li>
                                          <li><a href="{{url("/faq")}}">F.A.Q</a></li>
                                          {{-- <li><a href="{{url("/terms_and_conditions")}}">Terms & Conditions</a></li>  --}}
                                         {{-- <li><a href="{{url('/blog')}}">BLOG</a></li> --}}
                                          {{--<li><a href="{{url("/contact")}}">Contact Us</a></li>--}}

                                         @auth

                                             <li><a href="{{url("/dashboard")}}">Dashboard</a></li>
                                          
                                         @else

                                            <li><a href="#">Login/Register</a>
                                                <ul class="submenu">
                                                   <li><a data-toggle="modal" data-target="#modalLoginForm" href="javascript:void(0)">Login</a></li>
                                                    <li><a href="{{url('/register')}}">Register</a></li>         
                                                </ul><!-- /.submenu -->
                                           </li>

                                          @endauth



                                         
                                          
                                      </ul><!-- /.menu -->                                        
                                  </nav><!-- /.mainnav -->  
                              </div><!-- /.nav-wrap -->
                          </div><!-- /.flat-wrapper -->
                      </div><!-- /.row -->
                  </div><!-- /.container -->             
              </div><!-- /.header-inner --> 
          </header><!-- /.header -->
      </div><!-- /.site-header -->

      


      @yield('content')
   
     
     
      <!-- Footer -->
      <footer class="footer">
          <div class="footer-widgets">
              <div class="container">
                  <div class="row">
                      <div class="col-md-3">
                          <div class="widget widget_text style_1">
                              <div class="textwidget">
                                  <h3 style="color:white !important">Crack & Earn Network</h3>
                              </div>
                          </div><!-- /.widget_text -->
                      </div><!-- /.col-md-3 -->
                           
                           {{--<div class="col-md-3">
                            <div class="widget widget_recent_entries">
                                <h3 class="widget-title"><span class="style_1">R</span>ecent News</h3>
                                <ul>
                                    <li>
                                        <a href="blog-single.html">3 Reasons Your Business Needs A Budget Now</a>
                                        <span class="post-date">January 26, 2016</span>
                                    </li>
                                    <li>
                                        <a href="#">2016 Queensland Small Business Week</a>
                                        <span class="post-date">January 26, 2016</span>
                                    </li>
                                    <li>
                                        <a href="blog-single.html">The Tax Office doesn’t always get it right</a>
                                        <span class="post-date">January 26, 2016</span>
                                    </li>
                                </ul>
                            </div><!-- /.widget .widget_recent_entries -->
                        </div>--}}
                      

                      <div class="col-md-3">
                          <div class="widget widget_text information style_1">
                              <h3 class="widget-title"><span class="style_1">C</span>ontact Us</h3>
                              <div class="textwidget">
                                  <p><strong>Headquarters:</strong><br>Flat 7, 2nd Ave. Effab Estate, Life Camp Abuja.</p>
                                  <p>
                                      <i class="fa fa-phone ft-widget-margin-right-12"></i>  +2349061256882, +2348186015178 <br>
                                      <i class="fa fa-envelope-o ft-widget-margin-right-10"></i>  info@crackandearn.com
                                  </p>
                                  
                                  <p>
                                      <i class="fa fa-calendar ft-widget-margin-right-12"></i> Openned: 24hrs/7<br>
                                      
                                  </p>
                              </div>          
                          </div><!-- /.widget .widget_text information -->
                      </div><!-- /.col-md-3 -->

                      <div class="col-md-3">
                          <div class="widget widget_text style_1">
                              <h3 class="widget-title"><span class="style_1">G</span>et in Touch</h3>
                              <div class="textwidget">
                                  <form id="" method="POST" action="{{url('/send_contact_us')}}">
                                  @csrf
                                      <p><input id="name" name="name" type="text" value="" placeholder="Name" required="required"></p>

                                      <p><input id="email" name="email" type="email" value="" placeholder="Email" required="required"></p>

                                      <p><textarea name="message" placeholder="Message" required="required"></textarea></p>

                                      <p class="form-submit"><input name="submit" type="submit" id="submit" class="submit rounded" value="Send Mail">
                                      </p>
                                  </form>
                              </div><!-- /.textwidget -->          
                          </div><!-- /.widget .widget_text -->
                      </div><!-- /.col-md-3 -->
                  </div><!-- /.row -->
              </div><!-- /.container -->
          </div><!-- /.footer-content -->

          <div class="footer-content">
              <div class="container">
                  <div class="row">
                      <div class="flat-wrapper">
                          <div class="ft-wrap clearfix">
                              <div class="social-links">
                                  <a href="#"><i class="fa fa-twitter"></i></a>
                                  <a href="#"><i class="fa fa-facebook"></i></a>
                                  <a href="#"><i class="fa fa-behance"></i></a>
                                  <a href="#"><i class="fa fa-spotify"></i></a>
                                  <a href="#"><i class="fa fa-rss"></i></a>
                              </div>
                              <div class="copyright">
                                  <div class="copyright-content">
                                      Copyright © {{date('Y')}} Crack and Earn Network
                                  </div>
                              </div>
                          </div><!-- /.ft-wrap -->
                      </div><!-- /.flat-wrapper -->
                  </div><!-- /.row -->
              </div><!-- /.container -->
          </div><!-- /.footer-content -->
      </footer>

      <!-- Go Top -->
      <a class="go-top">            
      </a>   

  </div>
<!--------------------------  Login Modal ------------------------------>
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div style="max-width: 460px !important;" class="modal-dialog" role="document">
    <div  class="modal-content">
        <form id="login_form" action="{{ route('attempt_login') }}" method="post">
        @csrf

      <div class="modal-header text-center">
        <img height="70" width="70" src="{{asset('frontend/images/logo.png')}}" alt="images">
        <br/>
        {{-- <strong>Crack and Earn Network Limited</strong> --}}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

       @if(Session::get('login_error') != null) 
         <div class="alert alert-danger" role="alert">
            The username or password is incorrect
          </div>
       @endif 

      </div>

      
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fa fa-envelope prefix grey-text"></i>
          <input value="{{ Session::get('login_error') }}" name="email" type="email" id="defaultForm-email" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-email">Your email</label>
         
        </div>
        
        

        <div class="md-form mb-4">
          <i class="fa fa-lock prefix grey-text"></i>
          <input type="password" name="password" id="defaultForm-pass" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Your password</label>
        </div>

      </div>

      <div  class="btns-wrap">
      <a  href="javascript:display_forgotpassword()">
            <div style="padding-left:55px; margin-top:20px" class="wrap text-left">
                 Forgot Password?
            </div></a>
            <div style="margin-top:-40px; padding-bottom:10px; padding-right:10px" class="wrap text-right">
                <button style="background-color: #1b1c6e; color:white" class="btn ">Login</button>
            </div>
      </div>
    </form>

     <form id="forgot_password_form" style="display:none" action="{{ route('forgot_password') }}" method="post">
            @csrf
             @if(Session::get('forgot_password_error') != null) 
                <div class="alert alert-danger" role="alert">
                    {{Session::get('forgot_password_error')}}
                </div>
             @endif 

             @if(Session::get('forgot_password_success') != null) 
                <div class="alert alert-success" role="alert">
                    {{Session::get('forgot_password_success')}}
                </div>
             @endif 

            <div class="modal-body mx-3">
            <div class="md-form mb-4">
                <i class="fa fa-lock prefix grey-text"></i>
                <input required style type="email" name="recovery_email" id="recovery_email" class="form-control validate">
                <label data-error="wrong" data-success="right" for="defaultForm-pass">Email Address</label>
                </div>

                <div  class="btns-wrap">
                    <div style="padding-left:55px; margin-top:-20px" class="wrap text-left">
                        <a  href="javascript:hide_forgotpassword()">Login</a>
                    </div>
                    <div style="margin-top:-40px; padding-bottom:10px; padding-right:10px" class="wrap text-right">
                        <button style="background-color: #1b1c6e; color:white" class="btn ">Send Recovery Link</button>
                    </div>
                </div>
            </div>

     </form>
 

    </div>
  </div>
</div>
 <!-------------------------- End of Login Modal ------------------------------>
 
 
  <!-- Javascript -->
  <script type="text/javascript" src="{{asset('frontend/javascript/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('frontend/javascript/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('frontend/javascript/jquery.easing.js')}}"></script> 
  <script type="text/javascript" src="{{asset('frontend/javascript/owl.carousel.js')}}"></script>
  <script type="text/javascript" src="{{asset('frontend/javascript/jquery-waypoints.js')}}"></script>
  <script type="text/javascript" src="{{asset('frontend/javascript/imagesloaded.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('frontend/javascript/jquery.isotope.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('frontend/javascript/jquery-countTo.js')}}"></script> 
  <script type="text/javascript" src="{{asset('frontend/javascript/jquery.fancybox.js')}}"></script>
  <script type="text/javascript" src="{{asset('frontend/javascript/jquery.flexslider-min.js')}}"></script>
  <script type="text/javascript" src="{{asset('frontend/javascript/jquery.cookie.js')}}"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
  <script type="text/javascript" src="{{asset('frontend/javascript/gmap3.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('frontend/javascript/jquery-validate.js')}}"></script>
  <script type="text/javascript" src="{{asset('frontend/javascript/parallax.js')}}"></script>
  <script type="text/javascript" src="{{asset('frontend/javascript/main.js')}}"></script>
  <script type="text/javascript" src="{{asset('frontend/javascript/mdb.js')}}"></script>

  <!-- Revolution Slider -->
  <script type="text/javascript" src="{{asset('frontend/javascript/jquery.themepunch.tools.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('frontend/javascript/jquery.themepunch.revolution.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('frontend/javascript/slider.js')}}"></script>
  <script src="{{asset('bower_components/sweetalert/sweet-alert.min.js')}}"></script>

  <script>
     
     
      @if(Session::get('login_error') != null)
         $('#modalLoginForm').modal('show');
      @endif
      
      function display_forgotpassword()
      {
         $('#forgot_password_form').show();
         $('#login_form').hide();
      }

      function hide_forgotpassword()
      {
          $('#forgot_password_form').hide();
          $('#login_form').show(); 
      }


      @if(Session::get('forgot_password_success') != null || Session::get('forgot_password_error') != null) 
         display_forgotpassword();
         $('#modalLoginForm').modal('show');
        
      @endif

      @if(Session::get('contact_success'))

           Swal.Fire("Message sent!", "{{Session::get('contact_success')}}","success");

      @endif


  </script>

</body>
  
  <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5ce92e6c2135900bac12774f/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
  
 
    <!-- ========================
      Footer
    ========================== -->
    
@else
  <div style="width:100%; height: 100%; background-color: white; position: absolute;top:0;left:0; margin: 0 auto; text-align: center; padding-top: 30px">
    {{-- <img src="{{asset('frontend/images/fav/apple-icon-114x114.png')}}" /> --}}
    <h3>SITE IS UNDER MAINTENANCE</h3>
    <h4>We are installing critical updates. Please check back soon..</h4>
    <img  src="{{asset('img/maintenance.jpg')}}" />
  </div>
@endif
</html>

