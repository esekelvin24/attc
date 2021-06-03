
<?php


use App\Models\Settings;

$c_name=Settings::select('value')->get();
$company_name=$c_name[0]->value;
$powered_by=$c_name[1]->value;
$maintenance_mode=$c_name[2]->value;
$maintenance_mode;
?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- End CSRF Token -->
    <title>Management System</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="Augustine Nwabuwe" name="author">

    <!-- start: favicon -->
    <link rel="shortcut icon" href="{{ asset('img/fav/favicon.ico') }}">
    <!-- end: Favicon -->
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="{{asset('bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('bower_components/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('bower_components/dropzone/dist/dropzone.css')}}" rel="stylesheet">
    <link href="{{asset('bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css')}}" rel="stylesheet">
    <link href="{{asset('bower_components/slick-carousel/slick/slick.css')}}" rel="stylesheet">
    <link href="{{asset('css/main.css?version=4.4.0')}}" rel="stylesheet">
</head>
<body class="auth-wrapper" style=" background: url({{asset('img/bg.jpg')}}) no-repeat center center fixed; 
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;">
@if($maintenance_mode == "true")
    <div class="content-box">
        <div class="big-error-w" style="width:80%">
            <img width="60%" src="{{asset('img/maintenance.jpg')}}" />
            <h5>
                SITE IS UNDER MAINTENANCE
            </h5>
            <h4>
                We are installing critical updates. Please check back soon..
            </h4>

        </div>

    </div>
@else
    @guest
    <div class="all-wrapper menu-side with-pattern">
        <div class="auth-box-w">
            <div class="logo-w">
                <img height="75" width="150" alt="" class="center-block animated pulse delay-4s slower" src="{{asset('img/logo.png')}}">
                <p class="animated bounceIn" style="font-weight: bold; font-size:25px">{{$company_name}}</p>
            </div>
            <h4 class="auth-header">
                Login
            </h4>

             @if(Session::get('login_error') != null) 
                <div class="alert alert-danger" role="alert">
                    The username or password is incorrect
                </div>
            @endif 
            <form action="{{ route('attempt_login') }}" method="post">
                @csrf
                <div class="form-group animated fadeInUp {{ $errors->isNotEmpty() ? 'has-error' : '' }}">
                    <label for="">Email</label><input value="{{ old('email') }}" name="email" autofocus required  class="form-control " placeholder="Enter your email" type="text">
                    @if ($errors->has('email'))
                        <span class="text-danger">
                         <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                </div>
                <div class="form-group animated fadeInUp {{ $errors->isNotEmpty() ? 'has-error' : '' }}">
                    <label for="">Password</label><input  name="password"  class="form-control" placeholder="Enter your password" type="password">
                    <div class="pre-icon os-icon os-icon-fingerprint"></div>
                </div>
                <div class="buttons-w">
                    <button class="btn btn-primary btn-lg animated zoomInUp">Log me in</button>
                </div>
            </form>
            <div style="text-align: center; padding-bottom: 10px">
                &copy; 2018 - <?php echo date('Y') ?> <span class="text-bold text-uppercase"> {{$company_name}} </span>. <br/><span>Powered by {{$powered_by}} - All rights reserved</span>
            </div>
        </div>

    </div>
    @else
        <script type="text/javascript">
            window.location = `{{route('dashboard')}}`
        </script>
    @endguest
@endif
</body>
</html>
