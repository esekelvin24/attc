<?php
use Illuminate\Support\Facades\DB;
use App\Models\Maintab;
use App\Models\Subtab;
use App\Models\Subertab;
use App\Models\Settings;
use App\Models\Designation;
use App\Models\Department;
use App\Models\Session as School_Session;


//create wallet if users does not have a wallet


if(!is_null(Auth::user())){
    $maintenance_mode=Settings::select('value')->where('name','maintenance_mode')->get()[0]->value;
if($maintenance_mode == "false"){

$company_name=Settings::select('value')->where('name','company_name')->get()[0]->value;


$first_name_top=Auth::user()->firstname;
$last_name_top=Auth::user()->lastname;
$pic_top=Auth::user()->pics;

$user =  Auth::user();

$designation_id_top = $user->designation_id;

$designation_check = Designation::select('designation')->where('designation_id',$designation_id_top)->get();
 if(count($designation_check) > 0)
 {
     $designation_name_top = $designation_check[0]->designation;
 }else
 {
     $designation_name_top = "";
 }


   if($user->hasRole("developer")){//Super User
       foreach(Maintab::all() as $m)
       {
           $main_tab_id[]=	$m->main_tab_id;
           $main_tab_name[]=$m->main_tab_name;
           $main_tab_icons[]=$m->icon;
           $main_tab_permission_slug[]=$m->permission_slug;
       }
       foreach(Subtab::all() as $m)
       {
           $sub_tab_id[] =	$m->sub_tab_id;
           $main_sub_tab_id[]=$m->main_tab_id;
           $sub_tab_name[]=$m->sub_tab_name;
           $sub_tab_named_route[]=$m->sub_tab_named_route;
           $sub_tab_permission_slug[]=$m->permission_slug;

       }

   }else{

        $first_menu = Maintab::get();
        $second_menu = Subtab::get();
        $third_menu = Subertab::get();

        foreach( $first_menu as $m)
        {
            $main_tab_id[]=	$m->main_tab_id;
            $main_tab_name[]=$m->main_tab_name;
            $main_tab_icons[]=$m->icon;
           $main_tab_permission_slug[]=$m->permission_slug;
        }

        foreach($second_menu  as $m)
        {
            $sub_tab_id[] =	$m->sub_tab_id;
            $main_sub_tab_id[]=$m->main_tab_id;
            $sub_tab_name[]=$m->sub_tab_name;
            $sub_tab_named_route[]=$m->sub_tab_named_route;
            $sub_tab_permission_slug[]=$m->permission_slug;
        }

       foreach($third_menu as $m)
        {
            $suber_tab_id[] =	$m->suber_tab_id;
            $suber_tab_sub_id[]=$m->sub_tab_id;
            $suber_tab_name[]=$m->suber_tab_name;
            $suber_tab_named_route[]=$m->suber_tab_named_route;
            $suber_tab_permission_slug[]=$m->permission_slug;
        }

    }



$route = Route::current()->getName();
##CHECK IF IT EXISTS AT THE FIRST LEVEL
if($route=="dashboard") {
    //We are at the landing page
}
else //It doesn't exist,so check subtab i.e 2nd Level
{


  //The main question here is, does the user have the right to access current page?
    if(Subtab::select('main_tab_id', 'sub_tab_name')->where('sub_tab_named_route',$route)->exists())
    {
                $query = Subtab::select('sub_tab_id','main_tab_id', 'sub_tab_name','permission_slug')->where('sub_tab_named_route',$route)->get();
                
                foreach($query as $r)
                {
                    $URL_SECOND_LEVEL_MAIN_TAB_ID = $r -> main_tab_id;
                    $URL_SECOND_LEVEL_NAME = $r -> sub_tab_name;
                    //This is for checking if user should be here
                    $URL_SECOND_LEVEL_SUB_TAB_ID = $r->sub_tab_id;

                    $PERMISSION_SLUG = $r->permission_slug;
                }
                
                $permission_denied = false;
                //Now, we check if User really was assigned this right
                if(Auth::user()->can($PERMISSION_SLUG))
                {
                    //Now we can get the Main Tab Name
                    if(Maintab::select('main_tab_name','main_tab_id')->where('main_tab_id',$URL_SECOND_LEVEL_MAIN_TAB_ID)->exists())
                    {
                        $query = Maintab::select('main_tab_id','main_tab_name','permission_slug')->where('main_tab_id',$URL_SECOND_LEVEL_MAIN_TAB_ID)->get();
                        foreach($query as $r)
                        {
                            $URL_FIRST_LEVEL_NAME = $r -> main_tab_name;
                            $URL_FIRST_LEVEL_ID = $r -> main_tab_id;
                            $PERMISSION_SLUG = $r->permission_slug;
                        }

                       if(!Auth::user()->can($PERMISSION_SLUG))
                       {
                          
                          $permission_denied = true;
                       }
                    }
                }else{

                    
                     $permission_denied = true;
                }

                //User just typed in url name and should be redirected and warned and warning should be logged also if you have the time
                   if($permission_denied == true)
                   {
                    ?>
                    <script>
                        window.replace=url('/')+"/permission_denied";
                    </script>
                    <?php
                    header("Location:".url('/').'/permission_denied');
                            exit("You are warned");
                   }
                        
        }
        else{
               //Already handled! i.e the else part of the if Auth:user is null
        }
}
}else{
    //Maintenance mode things
?>
            <script>
            window.replace=url('/')+"/maintenance";
            </script>
<?php
header("Location:".url('/').'/maintenance');
exit();
        }
}else{
    //redirect me I'm in a non existing route
 ?>
<script>
    console.log("How did I get to dash_layout?");
    window.replace=url('/')+"/404";
</script>
<?php
header("Location:".url('/').'/404');
exit();
}



 
        $fees_amount = 0;
        $application_id = "";
        $accept_offer_upload = true;

        //checking for active application that has been approved 
        $application_details = DB::table('tbl_applications')
        ->where('user_id',Auth::user()->id)->where('status',1)
        ->where('action_1_status', 1)
        ->whereIn('payment_status',['3','0'])->get();

        
        if(count($application_details) > 0)
        {
             $application_id = $application_details[0]->application_id;
             
            if ($application_details[0]->accept_offer == 0)//if the user have not accepted the offer
            {
                $accept_offer_upload = false;

            }else
            {
               
                //checking if there are any application with a pending fees payment
                $fees_amount =  DB::table('tbl_application_courses')
                ->selectRaw('SUM(application_course_price) as total_amt')
                ->where('application_id',$application_id)
                ->first()->total_amt;
    
                
                //check if successful payment has been made for this application
                $payment_check = DB::table('tbl_payments')->where('application_id',$application_id)->where('paystack_status','success')->get();
                
                if(count($payment_check) > 0)
                {
                    $fees_amount = 0; //assign fees to zero because the application has been paid for
                }
            }
        }

?>


<!DOCTYPE html>
<html  lang="{{ app()->getLocale() }}">
<head>
    <title>{{$company_name}}</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="Augustine Nwabuwe" name="author">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="{{asset('bower_components/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <link href="{{asset('bower_components/dropzone/dist/dropzone.css')}}" rel="stylesheet">
    <link href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('bower_components/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet">
    <link href="{{asset('bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css')}}" rel="stylesheet">
    <link href="{{asset('bower_components/slick-carousel/slick/slick.css')}}" rel="stylesheet">
    <link href="{{asset('bower_components/sweetalert/sweet-alert.css')}}" rel="stylesheet">
    <link href="{{asset('css/main.css?version=4.4.0')}}" rel="stylesheet">
    <link href="{{asset('icon_fonts_assets/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet">
    <link href="{{asset('icon_fonts_assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("bower_components/vex/vex.css")}}" />
    <link rel="stylesheet" href="{{asset("bower_components/vex/vex-theme-flat-attack.css")}}" />
    <link rel="stylesheet" href="{{asset("bower_components/vex/vex-theme-default.css")}}" />
       <link href="{{asset("bower_components/time_picker/mdtimepicker.css")}}" rel="stylesheet" type="text/css">

    <!-- start: favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/img/favicon.png') }}">
    <!-- end: Favicon -->

    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
          @yield('required_css')
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->

    <style>
         
        #loader{
           /* opacity:0.8;*/
            background-color:white;
            position:fixed;
            width:100%;
            height:100%;
            top:0px;
            left:0px;
            z-index:1000;
            text-align:center;
        }
    </style>
    <style>
        .dropbtn {
        background-color: #201e5f;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        }

        .dropbtn:hover, .dropbtn:focus {
        background-color: #ff0000;
        }

        .dropdown {
        position: relative;
        display: inline-block;
        }

        .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        overflow: auto;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1000;
        }

        .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        }

        .dropdown a:hover {background-color: #ddd;}

        .show {display: block;}
        </style>
</head>
<body class="menu-position-side menu-side-left full-screen with-content-panel">
<div class="all-wrapper with-side-panel solid-bg-all">
    
    <div class="layout-w">
        <!--------------------
        START - Mobile Menu
        -------------------->
        <div class="menu-mobile menu-activated-on-click color-scheme-dark">
            <div class="mm-logo-buttons-w">
                <a class="mm-logo" href="{{route('dashboard')}}"> <img src="{{asset('img/mini_logo.png')}}" width="90" height="90" > <span>{{$company_name}}</span></a>
                <div class="mm-buttons">
                    {{--<div class="content-panel-open">
                        <div class="os-icon os-icon-grid-circles"></div>
                    </div>--}}
                    <div class="mobile-menu-trigger">
                        <div class="os-icon os-icon-hamburger-menu-1"></div>
                    </div>
                </div>
            </div>
            <div class="menu-and-user">
                <div class="logged-user-w">
                    <div class="avatar-w">
                        <img alt="" src="{{asset("img/users/$pic_top")}}">
                    </div>
                    <div class="logged-user-info-w">
                        <div class="logged-user-name">
                            {{$first_name_top.' '.$last_name_top}}
                        </div>
                        <div class="logged-user-role">
                            {{$designation_name_top}}
                        </div>
                    </div>
                </div>
                <!--------------------
                START - Mobile Menu List
                -------------------->
                <ul class="main-menu">
                    <li class="<?php if( Route::current()->getName()=='dashboard') echo "menu_colour" ?>  "  >
                        <a href="{{route('dashboard')}}">
                            <div class="icon-w">
                                <div class="icon-home"></div>
                            </div>
                            <span>Dashboard</span></a>
                    </li>
                    <li class="">
                        <a href="<?php echo url('/') ?>">
                            <div class="icon-w">
                                <div class="icon-arrow-left-circle"></div>
                            </div>
                            <span>Home Page</span>
                        </a>
                    </li>
                    <li class="">
                        <a class="profile" href="#">
                            <div class="icon-w">
                                <div class="fa fa-user"></div>
                            </div>
                            <span>My Profile</span>
                        </a>
                    </li>
                    
                        <?php
                        for($a=0;$a < count($main_tab_id);$a++) {
                            ?>
                            @if($main_tab_permission_slug[$a] !="" && $user->can( $main_tab_permission_slug[$a]))
                                <li class="has-sub-menu <?php
                                
                                    if(isset($URL_FIRST_LEVEL_ID))
                                    {
                                        if($main_tab_id[$a]==$URL_FIRST_LEVEL_ID)
                                            echo "menu_colour";
                                    }
                                    ?>">

                                        <a href="#">
                                            <div class="icon-w">
                                                <div class="<?php echo $main_tab_icons[$a] ?>"> </div>
                                            </div>
                                            <span><?php echo ucwords(strtolower($main_tab_name[$a])) ?></span></a>
                                        <ul class="sub-menu">
                                          
                                           @for($b=0;$b<count($sub_tab_id);$b++)
                                                @if($sub_tab_permission_slug[$b] !="" && $user->can($sub_tab_permission_slug[$b]))
                                                    @if($main_sub_tab_id[$b] == $main_tab_id[$a]) 
                                                    
                                                            <li>
                                                                <a href="<?php
                                                                if( $sub_tab_named_route[$b]!="" or is_null($sub_tab_named_route[$b]) )
                                                                    echo route($sub_tab_named_route[$b]);
                                                                else
                                                                    echo "#";
                                                                ?>"><?php echo $sub_tab_name[$b] ?></a>
                                                            </li>
                                                    @endif
                                                @endif
                                            @endfor
                                          
                                        </ul>
                                    </li>
                            @endif
                        <?php
                        }
                        ?>
                    <li>
                        <a href="#" onclick="document.getElementById('logout-form').submit();">
                            <div class="icon-w">
                                <div class="os-icon os-icon-log-out"></div>
                            </div>
                            <span>Log Out</span></a>
                    </li>
                </ul>
                <!--------------------
                END - Mobile Menu List
                -------------------->
            </div>
        </div>
        <!--------------------
        END - Mobile Menu
        -------------------->


        <!--------------------
        START - Main Menu
        -------------------->
        <div class="menu-w color-scheme-light color-style-transparent menu-position-side menu-side-left menu-layout-compact sub-menu-style-inside sub-menu-color-bright selected-menu-color-light menu-activated-on-click menu-has-selected-link">
            <div class="logo-w" style="margin: auto; width: 50%; padding: 5px;">
                <a class="logo" href="{{route('dashboard')}}">
                    <div class="animated bounce">
                        &nbsp;&nbsp; &nbsp;&nbsp; <img src="{{asset('img/logo.png')}}" alt="">
                    </div>
                    {{--<div class="logo-label animated fadeInUpBig">
                        {{$company_name}}
                    </div>--}}
                </a>
            </div>
            <div class="side-menu-magic animated fadeIn">
                <!-- END WIDGET CLOCK -->
                <div class="widget widget-primary widget-padding-sm">
                    <div class="widget-big-int plugin-clock">00:00</div>
                    <div class="widget-subtitle plugin-date">Loading...</div>
                    @if(Auth::user()->can('view-student-id'))
                        <span class="badge badge-warning" style="font-size:12px"> <span class="icon-hourglass"></span> Student ID : SID{{str_pad(Auth::user()->id, 4, "0", STR_PAD_LEFT)}} </span>
                    @endif
                </div>
                <!-- END WIDGET CLOCK -->
            </div>  
            {{--<div class="logged-user-w avatar-inline">
                <div class="logged-user-i">
                    <div class="avatar-w">
                        <img alt="" src="img/avatar1.jpg">
                    </div>
                    <div class="logged-user-info-w">
                        <div class="logged-user-name">
                            Maria Gomez
                        </div>
                        <div class="logged-user-role">
                            Administrator
                        </div>
                    </div>
                    <div class="logged-user-toggler-arrow">
                        <div class="os-icon os-icon-chevron-down"></div>
                    </div>
                    <div class="logged-user-menu color-style-bright">
                        <div class="logged-user-avatar-info">
                            <div class="avatar-w">
                                <img alt="" src="img/avatar1.jpg">
                            </div>
                            <div class="logged-user-info-w">
                                <div class="logged-user-name">
                                    Maria Gomez
                                </div>
                                <div class="logged-user-role">
                                    Administrator
                                </div>
                            </div>
                        </div>
                        <div class="bg-icon">
                            <i class="os-icon os-icon-wallet-loaded"></i>
                        </div>
                        <ul>
                            <li>
                                <a href="apps_email.html"><i class="os-icon os-icon-mail-01"></i><span>Incoming Mail</span></a>
                            </li>
                            <li>
                                <a href="users_profile_big.html"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a>
                            </li>
                            <li>
                                <a href="users_profile_small.html"><i class="os-icon os-icon-coins-4"></i><span>Billing Details</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="os-icon os-icon-others-43"></i><span>Notifications</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>--}}
            {{--<div class="menu-actions">
                <div class="messages-notifications os-dropdown-trigger os-dropdown-position-right">
                    <i class="os-icon os-icon-mail-14"></i>
                    <div class="new-messages-count">
                        12
                    </div>
                    <div class="os-dropdown light message-list">
                        <ul>
                            <li>
                                <a href="#">
                                    <div class="user-avatar-w">
                                        <img alt="" src="img/avatar1.jpg">
                                    </div>
                                    <div class="message-content">
                                        <h6 class="message-from">
                                            John Mayers
                                        </h6>
                                        <h6 class="message-title">
                                            Account Update
                                        </h6>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="user-avatar-w">
                                        <img alt="" src="img/avatar2.jpg">
                                    </div>
                                    <div class="message-content">
                                        <h6 class="message-from">
                                            Phil Jones
                                        </h6>
                                        <h6 class="message-title">
                                            Secutiry Updates
                                        </h6>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="user-avatar-w">
                                        <img alt="" src="img/avatar3.jpg">
                                    </div>
                                    <div class="message-content">
                                        <h6 class="message-from">
                                            Bekky Simpson
                                        </h6>
                                        <h6 class="message-title">
                                            Vacation Rentals
                                        </h6>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="user-avatar-w">
                                        <img alt="" src="img/avatar4.jpg">
                                    </div>
                                    <div class="message-content">
                                        <h6 class="message-from">
                                            Alice Priskon
                                        </h6>
                                        <h6 class="message-title">
                                            Payment Confirmation
                                        </h6>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-right">
                    <i class="os-icon os-icon-ui-46"></i>
                    <div class="os-dropdown">
                        <div class="icon-w">
                            <i class="os-icon os-icon-ui-46"></i>
                        </div>
                        <ul>
                            <li>
                                <a href="users_profile_small.html"><i class="os-icon os-icon-ui-49"></i><span>Profile Settings</span></a>
                            </li>
                            <li>
                                <a href="users_profile_small.html"><i class="os-icon os-icon-grid-10"></i><span>Billing Info</span></a>
                            </li>
                            <li>
                                <a href="users_profile_small.html"><i class="os-icon os-icon-ui-44"></i><span>My Invoices</span></a>
                            </li>
                            <li>
                                <a href="users_profile_small.html"><i class="os-icon os-icon-ui-15"></i><span>Cancel Account</span></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="messages-notifications os-dropdown-trigger os-dropdown-position-right">
                    <i class="os-icon os-icon-zap"></i>
                    <div class="new-messages-count">
                        4
                    </div>
                    <div class="os-dropdown light message-list">
                        <div class="icon-w">
                            <i class="os-icon os-icon-zap"></i>
                        </div>
                        <ul>
                            <li>
                                <a href="#">
                                    <div class="user-avatar-w">
                                        <img alt="" src="img/avatar1.jpg">
                                    </div>
                                    <div class="message-content">
                                        <h6 class="message-from">
                                            John Mayers
                                        </h6>
                                        <h6 class="message-title">
                                            Account Update
                                        </h6>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="user-avatar-w">
                                        <img alt="" src="img/avatar2.jpg">
                                    </div>
                                    <div class="message-content">
                                        <h6 class="message-from">
                                            Phil Jones
                                        </h6>
                                        <h6 class="message-title">
                                            Secutiry Updates
                                        </h6>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="user-avatar-w">
                                        <img alt="" src="img/avatar3.jpg">
                                    </div>
                                    <div class="message-content">
                                        <h6 class="message-from">
                                            Bekky Simpson
                                        </h6>
                                        <h6 class="message-title">
                                            Vacation Rentals
                                        </h6>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="user-avatar-w">
                                        <img alt="" src="img/avatar4.jpg">
                                    </div>
                                    <div class="message-content">
                                        <h6 class="message-from">
                                            Alice Priskon
                                        </h6>
                                        <h6 class="message-title">
                                            Payment Confirmation
                                        </h6>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>--}}
            {{--<div class="element-search autosuggest-search-activator">
                <input placeholder="Start typing to search..." type="text">
            </div>--}}
            <h1 class="menu-page-header">
                Page Header
            </h1>
            <ul class="main-menu">
                <li class="sub-header">
                    <span>Main Navigation</span>
                </li>
                <!-- start: menu -->
                <style>
                    .menu-w.sub-menu-style-inside.sub-menu-color-bright ul.main-menu > li.active > a span, .menu-w.sub-menu-style-inside.sub-menu-color-dark ul.main-menu > li.active > a span{
                        color:#1f1d5e !important;
                    }
                    .menu-w.sub-menu-style-inside.sub-menu-color-bright ul.main-menu > li.active > a .icon-w, .menu-w.sub-menu-style-inside.sub-menu-color-dark ul.main-menu > li.active > a .icon-w {
                        color: #1f1d5e !important;
                    }
                    li.menu_colour .sub-menu-w .sub-menu-i .sub-menu li a{
                        color:#1f1d5e !important;
                    }
                </style>
                   @include('inc.lefty')
                <!-- end: menu -->

            </ul>

        </div>
        <!--------------------
        END - Main Menu
        -------------------->
        <div class="content-w">
            <!--------------------
            START - Top Bar
            -------------------->
            <div class="top-bar color-scheme-transparent">
           <div class="d-none d-sm-block" style="text-align:center !important; width:100%;"> <h3 style="color: #234a84 !important;">{{$company_name}} </h3></div>
                <!--------------------
                START - Top Menu Controls
                -------------------->
                <div class="top-menu-controls">
                    {{--<div class="element-search autosuggest-search-activator">
                        <input placeholder="Start typing to search..." type="text">
                    </div>--}}
                    <!--------------------
                    START - Messages Link in secondary top menu
                    --------------------
                        <div class="messages-notifications os-dropdown-trigger os-dropdown-position-left">
                            <i class="os-icon os-icon-bell"></i>
                            <div class="new-messages-count">
                                12
                            </div>
                            <div class="os-dropdown light message-list">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <div class="message-content">
                                                <h6 class="message-from">
                                                    A new student just applied
                                                </h6>
                                                <h6 class="message-title">
                                                    Account Update
                                                </h6>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>  -->
                    <!--------------------
                    END - Messages Link in secondary top menu
                    --------------------><!--------------------
              START - Settings Link in secondary top menu
              -------------------->
                    {{--<div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
                        <i class="os-icon os-icon-ui-46"></i>
                        <div class="os-dropdown">
                            <div class="icon-w">
                                <i class="os-icon os-icon-ui-46"></i>
                            </div>
                            <ul>
                                <li>
                                    <a href="users_profile_small.html"><i class="os-icon os-icon-ui-49"></i><span>Profile Settings</span></a>
                                </li>
                                <li>
                                    <a href="users_profile_small.html"><i class="os-icon os-icon-grid-10"></i><span>Billing Info</span></a>
                                </li>
                                <li>
                                    <a href="users_profile_small.html"><i class="os-icon os-icon-ui-44"></i><span>My Invoices</span></a>
                                </li>
                                <li>
                                    <a href="users_profile_small.html"><i class="os-icon os-icon-ui-15"></i><span>Cancel Account</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>--}}
                    <!--------------------
                    END - Settings Link in secondary top menu
                    --------------------><!--------------------
              START - User avatar and menu in secondary top menu
              -------------------->
             
                    <div class="logged-user-w">
                        <div class="logged-user-i">
                            <div class="avatar-w">
                                <img alt="" src="{{asset("img/users/$pic_top")}}">
                            </div>

                            

                            <div class="logged-user-menu color-style-bright">
                                <div class="logged-user-avatar-info">
                                    <div class="avatar-w">
                                        <img alt="" src="{{asset("img/users/$pic_top")}}">
                                    </div>
                                  
                                    <div class="logged-user-info-w">
                                        <div class="logged-user-name">
                                            {{$first_name_top.' '.$last_name_top}}
                                        </div>
                                        <div class="logged-user-role">
                                           {{$designation_name_top}}
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-icon">
                                    <i class="os-icon os-icon-wallet-loaded"></i>
                                </div>
                                <ul>
                                    {{--<li>
                                        <a href="apps_email.html"><i class="os-icon os-icon-mail-01"></i><span>Incoming Mail</span></a>
                                    </li>
                                    <li>
                                        <a href="users_profile_big.html"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a>
                                    </li>
                                    <li>
                                        <a href="users_profile_small.html"><i class="os-icon os-icon-coins-4"></i><span>Billing Details</span></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="os-icon os-icon-others-43"></i><span>Notifications</span></a>
                                    </li>--}}
                                    <li>
                                        <a class="profile" href="#"><i class="os-icon os-icon-user"></i><span>Profile</span></a>
                                    </li>
                                    <li>
                                        <a onclick="
										 document.getElementById('logout-form').submit();" href="#"><i class="os-icon os-icon-signs-11"></i><span>Logout</span>
                                        </a>
                                        <form id="logout-form" action="<?php echo route('logout') ?>" method="POST" style="display: none;">
                                            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--------------------
                    END - User avatar and menu in secondary top menu
                    -------------------->
                </div>
                <!--------------------
                END - Top Menu Controls
                -------------------->
            </div>
            <!--------------------
            END - Top Bar
            --------------------><!--------------------
          START - Breadcrumbs
          -------------------->
            <ul class="breadcrumb">

                    <li class="breadcrumb-item animated bounce">
                        <a href="{{route('dashboard')}}">Home</a>
                    </li>
                @if(isset($URL_FIRST_LEVEL_NAME))
                    <li class="breadcrumb-item">
                        <a href="#">{{$URL_FIRST_LEVEL_NAME}}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span>{{$URL_SECOND_LEVEL_NAME}}</span>
                    </li>
                @endif

       
                 {{-- <li style="right: 35px; position: absolute; font-size:12px; "></li>  --}}
                  
                
            
            </ul>
            <!--------------------
            END - Breadcrumbs
            -------------------->
            {{--<div class="content-panel-toggler">
                <i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span>
            </div>--}}
            <div class="content-i">
            @include('inc.basic_notys')
                @yield('content')
                <!--------------------
                START - Sidebar
                -------------------->
                {{--<div class="content-panel">
                    <div class="content-panel-close">
                        <i class="os-icon os-icon-close"></i>
                    </div>
                    <div class="element-wrapper">
                        <h6 class="element-header">
                            Quick Links
                        </h6>
                        <div class="element-box-tp">
                            <div class="el-buttons-list full-width">
                                <a class="btn btn-white btn-sm" href="#"><i class="os-icon os-icon-delivery-box-2"></i><span>Create New Product</span></a><a class="btn btn-white btn-sm" href="#"><i class="os-icon os-icon-window-content"></i><span>Customer Comments</span></a><a class="btn btn-white btn-sm" href="#"><i class="os-icon os-icon-wallet-loaded"></i><span>Store Settings</span></a>
                            </div>
                        </div>
                    </div>
                    <!--------------------
                    START - Support Agents
                    -------------------->
                    <div class="element-wrapper">
                        <h6 class="element-header">
                            Support Agents
                        </h6>
                        <div class="element-box-tp">
                            <div class="profile-tile">
                                <a class="profile-tile-box" href="users_profile_small.html">
                                    <div class="pt-avatar-w">
                                        <img alt="" src="img/avatar1.jpg">
                                    </div>
                                    <div class="pt-user-name">
                                        John Mayers
                                    </div>
                                </a>
                                <div class="profile-tile-meta">
                                    <ul>
                                        <li>
                                            Last Login:<strong>Online Now</strong>
                                        </li>
                                        <li>
                                            Tickets:<strong><a href="apps_support_index.html">12</a></strong>
                                        </li>
                                        <li>
                                            Response Time:<strong>2 hours</strong>
                                        </li>
                                    </ul>
                                    <div class="pt-btn">
                                        <a class="btn btn-success btn-sm" href="apps_full_chat.html">Send Message</a>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-tile">
                                <a class="profile-tile-box" href="users_profile_small.html">
                                    <div class="pt-avatar-w">
                                        <img alt="" src="img/avatar3.jpg">
                                    </div>
                                    <div class="pt-user-name">
                                        Ben Gossman
                                    </div>
                                </a>
                                <div class="profile-tile-meta">
                                    <ul>
                                        <li>
                                            Last Login:<strong>Offline</strong>
                                        </li>
                                        <li>
                                            Tickets:<strong><a href="apps_support_index.html">9</a></strong>
                                        </li>
                                        <li>
                                            Response Time:<strong>3 hours</strong>
                                        </li>
                                    </ul>
                                    <div class="pt-btn">
                                        <a class="btn btn-secondary btn-sm" href="apps_full_chat.html">Send Message</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--------------------
                    END - Support Agents
                    --------------------><!--------------------
              START - Recent Activity
              -------------------->
                    <div class="element-wrapper">
                        <h6 class="element-header">
                            Recent Activity
                        </h6>
                        <div class="element-box-tp">
                            <div class="activity-boxes-w">
                                <div class="activity-box-w">
                                    <div class="activity-time">
                                        10 Min
                                    </div>
                                    <div class="activity-box">
                                        <div class="activity-avatar">
                                            <img alt="" src="img/avatar1.jpg">
                                        </div>
                                        <div class="activity-info">
                                            <div class="activity-role">
                                                John Mayers
                                            </div>
                                            <strong class="activity-title">Opened New Account</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-box-w">
                                    <div class="activity-time">
                                        2 Hours
                                    </div>
                                    <div class="activity-box">
                                        <div class="activity-avatar">
                                            <img alt="" src="img/avatar2.jpg">
                                        </div>
                                        <div class="activity-info">
                                            <div class="activity-role">
                                                Ben Gossman
                                            </div>
                                            <strong class="activity-title">Posted Comment</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-box-w">
                                    <div class="activity-time">
                                        5 Hours
                                    </div>
                                    <div class="activity-box">
                                        <div class="activity-avatar">
                                            <img alt="" src="img/avatar3.jpg">
                                        </div>
                                        <div class="activity-info">
                                            <div class="activity-role">
                                                Phil Nokorin
                                            </div>
                                            <strong class="activity-title">Opened New Account</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-box-w">
                                    <div class="activity-time">
                                        2 Days
                                    </div>
                                    <div class="activity-box">
                                        <div class="activity-avatar">
                                            <img alt="" src="img/avatar4.jpg">
                                        </div>
                                        <div class="activity-info">
                                            <div class="activity-role">
                                                Jenny Miksa
                                            </div>
                                            <strong class="activity-title">Uploaded Image</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--------------------
                    END - Recent Activity
                    --------------------><!--------------------
              START - Team Members
              -------------------->
                    <div class="element-wrapper">
                        <h6 class="element-header">
                            Team Members
                        </h6>
                        <div class="element-box-tp">
                            <div class="input-search-w">
                                <input class="form-control rounded bright" placeholder="Search team members..." type="search">
                            </div>
                            <div class="users-list-w">
                                <div class="user-w with-status status-green">
                                    <div class="user-avatar-w">
                                        <div class="user-avatar">
                                            <img alt="" src="img/avatar1.jpg">
                                        </div>
                                    </div>
                                    <div class="user-name">
                                        <h6 class="user-title">
                                            John Mayers
                                        </h6>
                                        <div class="user-role">
                                            Account Manager
                                        </div>
                                    </div>
                                    <a class="user-action" href="users_profile_small.html">
                                        <div class="os-icon os-icon-email-forward"></div>
                                    </a>
                                </div>
                                <div class="user-w with-status status-green">
                                    <div class="user-avatar-w">
                                        <div class="user-avatar">
                                            <img alt="" src="img/avatar2.jpg">
                                        </div>
                                    </div>
                                    <div class="user-name">
                                        <h6 class="user-title">
                                            Ben Gossman
                                        </h6>
                                        <div class="user-role">
                                            Administrator
                                        </div>
                                    </div>
                                    <a class="user-action" href="users_profile_small.html">
                                        <div class="os-icon os-icon-email-forward"></div>
                                    </a>
                                </div>
                                <div class="user-w with-status status-red">
                                    <div class="user-avatar-w">
                                        <div class="user-avatar">
                                            <img alt="" src="img/avatar3.jpg">
                                        </div>
                                    </div>
                                    <div class="user-name">
                                        <h6 class="user-title">
                                            Phil Nokorin
                                        </h6>
                                        <div class="user-role">
                                            HR Manger
                                        </div>
                                    </div>
                                    <a class="user-action" href="users_profile_small.html">
                                        <div class="os-icon os-icon-email-forward"></div>
                                    </a>
                                </div>
                                <div class="user-w with-status status-green">
                                    <div class="user-avatar-w">
                                        <div class="user-avatar">
                                            <img alt="" src="img/avatar4.jpg">
                                        </div>
                                    </div>
                                    <div class="user-name">
                                        <h6 class="user-title">
                                            Jenny Miksa
                                        </h6>
                                        <div class="user-role">
                                            Lead Developer
                                        </div>
                                    </div>
                                    <a class="user-action" href="users_profile_small.html">
                                        <div class="os-icon os-icon-email-forward"></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--------------------
                    END - Team Members
                    -------------------->
                </div>--}}
                <!--------------------
                END - Sidebar
                -------------------->
            </div>
        </div>
    </div>
    <div class="display-type"></div>
</div>
<div class="modal fade profile_modal" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body profile-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


    @if($accept_offer_upload == false )
        <!-- Modal Change First Password -->
        <div class="modal fade horizontal upload_offer_letter"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-lg" >
                <div class="modal-content">
                    <button onclick="document.getElementById('logout-form').submit();" class="btn-danger"><i class="fa fa-sign-out"></i>LOGOUT</button>
                    <div class="modal-header" style="flex-direction: column !important; align-items: center !important; ">
                        <img src="{{asset('img/offer_letter.gif')}}" /><br/>
                        <h3 class="modal-title text-primary" id="myModalLabel" style="text-align: center">Congratulations!</h3><br/>
                        <p style="text-align: center">Your have successfully gain a provisional offer with us!<br/>
                           You must however upload your signed acceptance letter which was sent to your email to proceed.
                        </p>
                    </div>

                    <div class="modal-body">
                        <form id="upload_offer" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div align="center" class="col-md-12">
                                Application ID: <strong>{{'ATTC-'.str_pad($application_details[0]->batch_id, 4, "0", STR_PAD_LEFT).'-'.$application_details[0]->application_id}}</strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Signed Acceptance Letter <span class="symbol required"></span>
                                        </label>
                                        <input autocomplete="off" name="completed_offer_letter" class="form-control" type="file">
                                        <span class="text-danger error-message"></span>
                                    </div>
                                    <button type="submit" class="btn btn-o btn-primary save_offer_letter">
                                        Upload Document
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
    @endif

    
    @if($fees_amount != 0)
        <!-- Modal Change First Password -->
        <div class="modal fade horizontal pay_acceptance_fee"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-lg" >
                <div class="modal-content">
                   
                    <div class="modal-header" style="flex-direction: column !important; align-items: center !important; ">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <img style="width:50px; height:50px" src="{{asset('img/logo.png')}}" /><br/>
                        {{-- <h3 class="modal-title text-primary" id="myModalLabel" style="text-align: center">Congratulations!</h3><br/> --}}
                       
                                <h4 style="text-align: center; "> You have an outstanding tuition fees payment of </h4>
                                <strong style="text-align: center; "><h2 id="fees_modal_amt">N{{number_format($fees_amount,2)}}</h2></strong>
                         
                       
                    </div>

                    <div class="modal-body">
                    
                       @php
                        $payment_check = DB::table('tbl_payments')->where('application_id',$application_details[0]->application_id)->where('paystack_status','99')->get();
                       @endphp
                       @if(count($payment_check) > 0)

                       <div align="center">
                             <img width="100" height="100" src="{{asset('img/barred.png')}}" >
                            <p>Your request has been sent and it is awaiting confirmation from admin, when the confirmation is done you will be able to gain full access to your course materials </p>
                       </div>
                        

                       @else
                        <p class="payment_options" style="text-align: center; font-size:17px"> Kindly Select a payment options </p></p>
                        <div class="row payment_options"> 
                                @if(Auth::user()->can('pay-with-debit-card'))
                                    <div align="center" class="col-md-4">       
                                        <a id="pay_with_card" href="#" data-href="{{route("payment",["type"=> encrypt(1), "id" =>encrypt($application_id)])}}" class="  pay_acceptance_fee_btn" style="margin: 0 auto;">
                                                <img height="120" width="160" src="{{asset('frontend/assets/img/debit_card.png')}}" ><br/>
                                                <h5> Pay with Debit Card</h5>
                                        </a>  
                                    </div> 
                                @endif
                               <div align="center" class="col-md-4">
                                    &nbsp;&nbsp;
                               </div>
                             @if(Auth::user()->can('pay-with-bank-transfer'))
                                <div align="center" class="col-md-4">
                                    <a href="javascript:pay_with_bank_transfer()">
                                    <img height="120" width="160" src="{{asset('frontend/assets/img/bank_transfer-512.png')}}" >
                                    <h5> Bank Transfer</h5>
                                    </a>
                                </div>
                             @endif
                        </div>

                    @if(Auth::user()->can('pay-with-bank-transfer'))
                       <div class="bank_transfer_interface" style="display:none">
                        <form id="bank_transfer" method="post" action="{{route('bank_transfer_completed')}}">
                           @csrf
                          <input type="hidden" id="banK_transfer_app_id" name="banK_transfer_app_id" value="{{encrypt($application_details[0]->application_id)}}">
                        </form>

                        <a href="javascript:show_payment_options()" class="btn btn-sm btn-danger text-white "><i class="fa fa-times"></i> Cancel</a><br/><br/>
                        <p>Kindly make a bank transfer into our company's account number below and click the <strong>"I have made the transfer"</strong> button to complete transaction</p>
                        </div>

                        <div style="display:none" class="row bank_transfer_interface">
                           <div style="border-color: rgba(201, 76, 76, 0.3); border-style: solid;" align="center" class="col-md-12">
                             <p><strong>Bank Name</strong>: Sterling Bank</p>
                             <p><strong>Account Name</strong>: African Technical Training Centre Limited</p>
                             <p><strong>Account No.</strong>: 0502565792</p>
                           </div>
                           <div>
                           <hr>
                           <div align="center">
                               <p> <font style="color:red; font-weight:bold">Note:</font> Kindly enter your Application ID (<strong id="complete_app_id">{{'ATTC-'.str_pad($application_details[0]->batch_id, 4, "0", STR_PAD_LEFT).'-'.$application_details[0]->application_id}}</strong>) on the transaction description, failure to do so will cause a delay in confirming your payment</p>
                               <button onclick="$('form#bank_transfer').submit()" class="btn btn-success"><i class="fa fa-check"></i> I have made the transfer</button>
                           </div>
                           
                        </div>
                       </div>
                        @endif {{-- End of if can pay with bank transfer--}}

                        @endif
                    </div>
                    <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    
                </div>
            </div>
        </div>
    @endif


    @if(isset($psw))
        <!-- Modal Change First Password -->
        <div class="modal fade horizontal edit_area"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header" style="flex-direction: column !important; align-items: center !important; ">
                        <img src="{{asset('img/p1.gif')}}" /><br/>
                        <h3 class="modal-title text-primary" id="myModalLabel" style="text-align: center">Compulsory Password Change!</h3><br/>
                        <p style="text-align: justify">You are using the default password assigned during staff creation. Kindly enter your new password.<br/>
                            Ensure that your passwords are unique and are at least 6 characters long.
                        </p>
                    </div>

                    <div class="modal-body">
                        <form id="new_pass" action="" method="post">
                            {{  csrf_field()  }}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Password <span class="symbol required"></span>
                                        </label>
                                        <input name="password1" class="form-control" placeholder="Enter Password" type="password">
                                        <span class="text-danger error-message"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Repeat Password <span class="symbol required"></span>
                                        </label>
                                        <input name="password2" placeholder="Confirm Password" class="form-control check" type="password">
                                        <span class="text-danger error-message"></span>
                                    </div>
                                    <button type="submit" class="btn btn-o btn-primary save">
                                        Save Changes
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
    @endif




<div style=" display:none" id="loader">
  
    <img  src="{{asset('img/loader.gif')}}" >
   
</div>




<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('bower_components/time_picker/mdtimepicker.js')}}"></script>
<script src="{{asset('bower_components/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('bower_components/moment/moment.js')}}"></script>
<script src="{{asset('bower_components/chart.js/dist/Chart.min.js')}}"></script>
<script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('bower_components/jquery-bar-rating/dist/jquery.barrating.min.js')}}"></script>
<script src="{{asset('bower_components/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('bower_components/bootstrap-validator/dist/validator.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('bower_components/dropzone/dist/dropzone.js')}}"></script>
<script src="{{asset('bower_components/editable-table/mindmup-editabletable.js')}}"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<script src="{{asset('bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('bower_components/tether/dist/js/tether.min.js')}}"></script>
<script src="{{asset('bower_components/slick-carousel/slick/slick.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/js/dist/util.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/js/dist/alert.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/js/dist/button.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/js/dist/carousel.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/js/dist/collapse.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/js/dist/dropdown.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/js/dist/modal.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/js/dist/tab.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/js/dist/tooltip.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/js/dist/popover.js')}}"></script>
<script src="{{asset('bower_components/jquery.blockUI.js')}}"></script>
<script src="{{asset('bower_components/sweetalert/sweet-alert.min.js')}}"></script>
<script src="{{asset('js/demo_customizer.js?version=4.4.0')}}"></script>
<script src="{{asset('js/main.js?version=4.4.0')}}"></script>
<script src="{{asset("bower_components/vex/vex.combined.min.js")}}"></script>

<script src="{{asset('js/sweetalert2.js')}}"></script>


<script>

 

    var templatePlugins = function(){

        var tp_clock = function(){

            function tp_clock_time(){
                var now     = new Date();
                var hour    = now.getHours();
                var minutes = now.getMinutes();

                hour = hour < 10 ? '0'+hour : hour;
                minutes = minutes < 10 ? '0'+minutes : minutes;

                $(".plugin-clock").html(hour+"<span>:</span>"+minutes);
            }
            if($(".plugin-clock").length > 0){

                tp_clock_time();

                window.setInterval(function(){
                    tp_clock_time();
                },10000);

            }
        }

        var tp_date = function(){

            if($(".plugin-date").length > 0){

                var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];

                var now     = new Date();
                var day     = days[now.getDay()];
                var date    = now.getDate();
                var month   = months[now.getMonth()];
                var year    = now.getFullYear();

                $(".plugin-date").html(day+", "+month+" "+date+", "+year);
            }

        }

        return {
            init: function(){
                tp_clock();
                tp_date();
            }
        }
    }();
    templatePlugins.init();

    $('body').on('click','button.save_profile_pic',function(e){
        e.preventDefault();
        var allowExt=['jpg','jpeg','png'];
        var filename= $("input[name='pic']").val();
        if(filename==""){
            vex.dialog.alert({
                unsafeMessage: `<div style="text-align: center"><img src="img/barred.png" style="width:100px;height:100px; display: block; margin:0 auto; text-align:center" />
                                    File is required</div>`,
            });
        }
        else if(!allowExt.includes(filename.split('.')[1])){
            vex.dialog.alert({
                unsafeMessage: `<div style="text-align: center"><img src="img/barred.png" style="width:100px;height:100px; display: block; margin:0 auto; text-align:center" />
                                    The file doesn't meet file upload type requirements. Only pdfs and image formats are allowed</div>`,
            });
        }
        else{
            var formData = new FormData($('form#pic')[0]);
            $.ajax(
                {
                    type:"POST",
                    data:formData,
                    url:"{{route('submit_profile_pic')}}",
                    cache:false,
                    contentType:false,
                    processData:false,
                    beforeSend:function()
                    {
                        $('body').block({ message: null });
                    },
                    error: function(r)
                    {
                        $('body').unblock();
                        vex.dialog.alert({
                            unsafeMessage: `<div style="text-align: center"><img src="img/barred.png" style="width:100px;height:100px; display: block; margin:0 auto; text-align:center" />
                                    There were errors, please try again</div>`,
                        });
                    },
                    success: function(r)
                    {
                        $('body').unblock();
                        vex.dialog.alert({
                            unsafeMessage: `<div style="text-align: center"><img src="{{asset('img/success.png')}}" style="width:100px;height:100px; display: block; margin:0 auto; text-align:center" />
                                    Profile picture successfully changed</div>`,
                        });
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    }

                }
            );
        }
    });
    $('body').on('click','a.profile',function(){
        $.ajax(
            {
                type:"GET",
                url:"{{route('profile')}}",
                cache:false,
                contentType:false,
                processData:false,
                beforeSend:function()
                {
                    //$('form#upload_offer').block({ message: null });
                },
                error: function(r)
                {
                    //$('form#upload_offer').unblock();
                    vex.dialog.alert({
                        unsafeMessage: `<div style="text-align: center"><img src="img/barred.png" style="width:100px;height:100px; display: block; margin:0 auto; text-align:center" />
                                    There were errors, please try again</div>`,
                    });
                },
                success: function(r)
                {
                    $('div.profile-body').html(r);
                    $('.profile_modal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                }

            }
        );
    });




/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}


/*
    
    $(".has-sub-menu ").click(function() {
   
   if(!$(this).is('.active')) { // .
   
       $(" .has-sub-menu").removeClass('active');
        $(this).addClass('active');
   }else
   {
        $(" .has-sub-menu").removeClass('active');
   
   }
   
   
 });*/
</script>

 @if($fees_amount != 0) 
        <script src="https://js.paystack.co/v1/inline.js"></script>
        <script id="paystack"></script>
   @endif

  


    <script>

    

       @if($fees_amount != 0) 




       function pay_with_bank_transfer()
        {
            $(".bank_transfer_interface").show('fast');
            $(".payment_options").hide('fast');
        }

        function show_payment_options()
        {
            $(".bank_transfer_interface").hide('fast');
            $(".payment_options").show('fast');
        }

            $(".pay_acceptance_fee").modal
            (
                {
                    backdrop:'static',
                    keyboard:false
                }
            );

            $('body').on('click','a.pay_acceptance_fee_btn',function(e){
                e.preventDefault();
                var route = $(this).data("href");
                $.ajax(
                            {
                                type:"GET",
                                cache:false,
                                contentType:false,
                                processData:false,
                                url:route,
                                beforeSend:function()
                                {
                                    $('body').block();
                                },
                                error: function(r)
                                {
                                    $('body').unblock(); 
                                },
                                success: function(r)
                                {
                                    $('body').unblock();
                                    $('.pay_acceptance_fee').modal('hide');
                                    $('#paystack').html(r);
                                    payWithPaystack();
                                }
                            }

                        );
            });
        @endif

        jQuery(document).ready(function() {
            vex.defaultOptions.className = 'vex-theme-flat-attack';
            $('body').on('click','button[data-action]',function(e)
            {
                e.preventDefault();
                var no=$(this).data("id");
                var action=$(this).data("action");
                var the_route="{{route('application_level_approval')}}";
                if(action==1) {
                    vex.dialog.confirm({
                        unsafeMessage: `Irreversible process detected! <br/>Do you want to ${action == 1 ? 'APPROVE' : 'REJECT'} this application?`,
                        callback: function (value) {
                            if (value) {
                                $.ajax(
                                    {
                                        type: "GET",
                                        url: `${the_route}/${no}/${action}`,
                                        beforeSend: function () {
                                            $('div.modal-content').block();
                                        },
                                        success: function (r) {
                                            $('div.modal-content').unblock();
                                            vex.dialog.alert({
                                                unsafeMessage: `
                                  <div style="text-align: center">
                                    <img src="img/success.png" style="width:100px;height:100px; display: block; margin:0 auto; text-align:center" />
                                    Application has been approved!
                                    </div>
                                    `,
                                                className:'vex-theme-default'
                                            });

                                            setTimeout(function(){
                                                window.location.reload()
                                            },3000);
                                        }
                                    }
                                );
                            }
                        }
                    })
                }
                else{
                    vex.dialog.prompt({
                        message: 'Kindly enter specific reason for rejecting student:',
                        className:'vex-theme-flat-attack',
                        placeholder: 'enter reason',
                        callback: function (value) {
                            if (value) {
                                $.ajax(
                                    {
                                        type: "GET",
                                        data:{
                                            reason: value
                                        },
                                        url: `${the_route}/${no}/${action}`,
                                        beforeSend: function () {
                                            $('div.modal-content').block();
                                        },
                                        success: function (r) {
                                            $('div.modal-content').unblock();
                                            vex.dialog.alert({
                                                unsafeMessage: `
                                <div style="text-align: center">
                                    <img src="img/success.png" style="width:100px;height:100px; display: block; margin:0 auto; text-align:center" />
                                    Application has been rejected and applicant has been notified!
                                </div>
                                    `,
                                                className:'vex-theme-default'
                                            });

                                            setTimeout(function(){
                                                window.location.reload()
                                            },3000);
                                        }
                                    }
                                );
                            }
                            else{
                                vex.dialog.alert({
                                    unsafeMessage: `
                                    <div style="text-align: center">
                                    <img src="img/barred.png" style="width:100px;height:100px; display: block; margin:0 auto; text-align:center" />
                                    You must specify a reason for rejecting application
                                    </div>
                                    `,
                                    className:'vex-theme-default'
                                })
                            }
                        }
                    });
                }
            });

            @if($accept_offer_upload == false)
            $('body').on('click','button.save_offer_letter',function(e){
                e.preventDefault();
                var allowExt=['jpg','jpeg','pdf','png'];
                var filename= $("input[name='completed_offer_letter']").val();
                if(filename==""){
                    vex.dialog.alert({
                        unsafeMessage: `<div style="text-align: center"><img src="img/barred.png" style="width:100px;height:100px; display: block; margin:0 auto; text-align:center" />
                                    File is required</div>`,
                    });
                }
                else if(!allowExt.includes(filename.split('.')[1])){
                    vex.dialog.alert({
                        unsafeMessage: `<div style="text-align: center"><img src="img/barred.png" style="width:100px;height:100px; display: block; margin:0 auto; text-align:center" />
                                    The file doesn't meet file upload type requirements. Only pdfs and image formats are allowed</div>`,
                    });
                }
                else{
                    var formData = new FormData($('form#upload_offer')[0]);
                    $.ajax(
                        {
                            type:"POST",
                            data:formData,
                            url:"{{route('submit_offer_letter')}}",
                            cache:false,
                            contentType:false,
                            processData:false,
                            beforeSend:function()
                            {
                                $('form#upload_offer').block({ message: null });
                            },
                            error: function(r)
                            {
                                $('form#upload_offer').unblock();
                                vex.dialog.alert({
                                    unsafeMessage: `<div style="text-align: center"><img src="img/barred.png" style="width:100px;height:100px; display: block; margin:0 auto; text-align:center" />
                                    There were errors, please try again</div>`,
                                });
                            },
                            success: function(r)
                            {
                                $('form#upload_offer').unblock();
                                vex.dialog.alert({
                                    unsafeMessage: `<div style="text-align: center"><img src="img/success.png" style="width:100px;height:100px; display: block; margin:0 auto; text-align:center" />
                                    Uploaded successfully</div>`,
                                });
                                setTimeout(function(){
                                    vex.closeAll();
                                    $(".upload_offer_letter").modal('hide');
                                     window.location.reload();
                                },2000)
                            }

                        }
                    );
                }
            })
            @endif
            

            $('body').on('click','tr[data-id]',function(e)
            {
                e.preventDefault();
                var no=$(this).data("id");
                var the_route="{{url('/application_details/')}}";
                $.ajax(
                    {
                        type:"GET",
                        url:`${the_route}/${no}`,
                        beforeSend:function()
                        {
                            $('table').block();
                        },
                        success: function(r)
                        {
                            $('table').unblock();
                            $('div.modal-body').html(r);
                            $('.general_modal').modal({
                                backdrop: 'static',
                                keyboard: false
                            });
                        }
                    }
                );
            });

            if ($('#dataTable').length) {
                $('#dataTable').DataTable({
                    "scrollX": true
                });
            }
            //SOLVE BOOTSTRAP INPUT ISSUE
            $('.general_modal').on('shown.bs.modal', function() {
                $(document).off('focusin.modal');
            });

           

            @if($accept_offer_upload == false)
            $(".upload_offer_letter").modal
            (
                {
                    backdrop:'static',
                    keyboard:false
                }
            );
            @endif

            @if(isset($psw))
            $(".edit_area").modal
            (
                {
                    backdrop:'static',
                    keyboard:false
                }
            );

            $('form#new_pass').on('blur','input',(function(e)
            {
                var $this=$(this);
                if($.trim($this.val())!="")
                {
                    //validate
                    $this.next('span.error-message').html('');
                    $this.closest('div.form-group').removeClass('has-error');
                    $this.closest('div.form-group').addClass('has-success');
                }

            }));

            $('button.save').click(function(e){
                    e.preventDefault();
                    var formData = new FormData($('form#new_pass')[0]);
                    var password1=$.trim($("input[name='password1']").val());
                    var password2=$.trim($("input[name='password2']").val());
                    if(password1=="" || password2=="")
                    {
                        
                        
                    }

                    else if(password1==password2)
                    {

                        $.ajax(
                            {
                                type:"POST",
                                data:formData,
                                cache:false,
                                contentType:false,
                                processData:false,
                                url:"{{route('first_changepsw')}}",
                                beforeSend:function()
                                {
                                    $('form#new_pass').block();
                                },
                                error: function(r)
                                {
                                    $('form#new_pass').unblock();
                                    const errors = r.responseJSON.errors;
                                    //clear any previous errors
                                    $('span.error-message').html('');
                                    $('div.has-error').removeClass('has-error');
                                    $.each(errors,function(index,value)
                                        {
                                            $('input[name="'+index+'"]').next('span.error-message').html(''+value);
                                            $('input[name"'+index+'"]').closest('div.form-group').addClass('has-error');
                                        }
                                    );
                                },
                                success: function(r)
                                {
                                    $('.edit_area').modal('hide');
                                    $('form#new_pass').unblock();
                                   
                                    Swal.fire(
                                        'Awesome!',
                                        'New password successfully set!',
                                        'success'
                                    );
                                    $('span.error-message').html('');
                                    $('div.has-error').removeClass('has-error');
                                    $('div.has-success').removeClass('has-success');
                                    //clear all items
                                    $('form#new_pass')[0].reset();


                                }
                            }

                        );
                    }else
                    {
                        
                          Swal.fire(
                                        'Error',
                                        'Passwords must match',
                                        'error'
                                    );
                    }

                }
            );
            @endif
        });
    </script>


<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
@yield('required_js')
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
@yield('additional_js')
</body>

</html>
