@extends('layouts.dash_layout')

@section('content')


<style>
.card{ box-shadow: 0 0px 2px 0 rgba(0, 0, 10, 0.2), 0 10px 15px 0 rgba(0, 100, 200, 0.19); transition: all 0.3s ease-in-out;}
.card::after {content: '';position: absolute; z-index: -1;opacity: 0;border-radius: 5px; box-shadow: 0 5px 15px rgba(0,0,0,0.3);
  transition: opacity 0.3s ease-in-out;
}
.card:hover { box-shadow: 0 0px 0.5px 0 rgba(0, 0, 0, 0.5), 0 0px 0px 0 rgba(0, 0, 0, 0.19);} 
.card:hover::after {opacity: 1; }/* Fade in the pseudo-element with the bigger shadow */
.card .header .icon{ /*border: 2px solid red;*/ margin:3px 0px 10px 0px;text-align:center;}
.card .header .icon-text{margin:10px 0px 20px 0px;text-align:center;}
.card .header .count{ /*border: 2px solid red;*/ margin:5px 0px 0px 0px; }
.card .header .count-text{ /*border: 2px solid red;*/ margin:20px 0px 55px 0px; }
.card .header .count h1{ text-align:center;	font-weight: 600;font-size: 2.7em;}
.card .header .count h2{text-align:center;font-weight: 600;font-size: 1em;}
.card .header .count h1 a{ color:#333;font-weight: 600;/*text-decoration: none;*/}
.card .header .text {margin: 7px 2px;text-align:center;}
.card .header .text .title { margin:20px 0px 20px 0px;font-weight:600;line-height: 1.4em;color: navy;font-size:1.2em;}
.card .header .text .title a {margin:20px 0px 20px 0px; font-weight:600; line-height: 1.4em;color: navy;/*text-decoration: none;*/}
.grading {background: rgba(255,255,255,1);
background: -moz-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(237,237,237,1) 0%, rgba(246,246,246,1) 47%, rgba(246,246,246,1) 84%);
background: -webkit-gradient(left top, right top, color-stop(0%, rgba(255,255,255,1)), color-stop(0%, rgba(237,237,237,1)), color-stop(47%, rgba(246,246,246,1)), color-stop(84%, rgba(246,246,246,1)));
background: -webkit-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(237,237,237,1) 0%, rgba(246,246,246,1) 47%, rgba(246,246,246,1) 84%);
background: -o-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(237,237,237,1) 0%, rgba(246,246,246,1) 47%, rgba(246,246,246,1) 84%);
background: -ms-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(237,237,237,1) 0%, rgba(246,246,246,1) 47%, rgba(246,246,246,1) 84%);
}

.grading2{
padding: 3px 0px 3px 0px;
margin-bottom:10px;
background: rgba(255,255,255,0.02);
background: -moz-linear-gradient(left, rgba(255,255,255,0.02) 0%, rgba(255,255,255,0.05) 3%, rgba(231,244,249,1) 100%);
background: -webkit-gradient(left top, right top, color-stop(0%, rgba(255,255,255,0.02)), color-stop(3%, rgba(255,255,255,0.05)), color-stop(100%, rgba(231,244,249,1)));
background: -webkit-linear-gradient(left, rgba(255,255,255,0.02) 0%, rgba(255,255,255,0.05) 3%, rgba(231,244,249,1) 100%);
background: -o-linear-gradient(left, rgba(255,255,255,0.02) 0%, rgba(255,255,255,0.05) 3%, rgba(231,244,249,1) 100%);
background: -ms-linear-gradient(left, rgba(255,255,255,0.02) 0%, rgba(255,255,255,0.05) 3%, rgba(231,244,249,1) 100%);
background: linear-gradient(to right, rgba(255,255,255,0.02) 0%, rgba(255,255,255,0.05) 3%, rgba(231,244,249,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e7f4f9', GradientType=1 );}

</style>

@if(true)
   
        <div class="content-box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <h6 class="element-header">
                            Portal Dashboard
                        </h6>
                        <div class="element-content">
                        <div class="row">








                                {{-- <div class="col-sm-4 col-xxxl-3">
                                    <a class="element-box el-tablo" href="#">
                                        <div class="label">
                                            New Customers
                                        </div>
                                        <div class="value">
                                            125
                                        </div>
                                        <div class="trending trending-down-basic">
                                            <span>9%</span><i class="os-icon os-icon-arrow-down"></i>
                                        </div>
                                    </a>
                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @if(false)
                <div class="row"><!-- Top row-->
                        <div class="col-md-4 col-sm-12 col-lg-3">
                            <div class="card grading2">
                                <div class="header">
                                            <div class="icon">
                                                <a href="dashboard" style="font-size: 60px;"><i class="fa fa-user-o"></i></a>
                                            </div>
                                       
                                            <div class="count">
                                                <h1>20</h1>
                                            </div>
                                            <div class="text">
                                                <h4 class="title">Active Students</h4>
                                            </div>
                                </div>				
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12 col-lg-3">
                            <div class="card grading2">
                                <div class="header">
                                            <div class="icon">
                                                <a href="dashboard" style="font-size: 60px;"><i class="fa fa-file-o"></i></a>
                                            </div>
                                       
                                            <div class="count">
                                                <h1>20</h1>
                                            </div>
                                            <div class="text">
                                                <h4 class="title">No of Applications</h4>
                                            </div>
                                </div>				
                            </div>
                        </div>


                        <div class="col-md-4 col-sm-12 col-lg-3">
                            <div class="card grading2">
                                <div class="header">
                                            <div class="icon">
                                                <a href="dashboard" style="font-size: 60px;"><i class="fa fa-book"></i></a>
                                            </div>
                                       
                                            <div class="count">
                                                <h1>3</h1>
                                            </div>
                                            <div class="text">
                                                <h4 class="title">Assigned Courses</h4>
                                            </div>
                                </div>				
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12 col-lg-3">
                            <div class="card grading2">
                                <div class="header">
                                            <div class="icon">
                                                <a href="dashboard" style="font-size: 60px;"><i class="fa fa-users"></i></a>
                                            </div>
                                       
                                            <div class="count">
                                                <h1>3</h1>
                                            </div>
                                            <div class="text">
                                                <h4 class="title">My Students</h4>
                                            </div>
                                </div>				
                            </div>
                        </div>

                         <div class="col-md-4 col-sm-12 col-lg-3">
                            <div class="card grading2">
                                <div class="header">
                                            <div class="icon">
                                                <a href="dashboard" style="font-size: 60px;"><i class="fa fa-book"></i></a>
                                            </div>
                                       
                                            <div class="count">
                                                <h1>3</h1>
                                            </div>
                                            <div class="text">
                                                <h4 class="title">Total Registered Courses</h4>
                                            </div>
                                </div>				
                            </div>
                        </div>

                        
                </div>
                @endif

            <div class="support-index">
                <div class="">                   
                   @if(Auth::user()->can('view-application-on-dashboard')) 
                   <div class="support-tickets-header">
                        <div class="tickets-control">
                            <h5>
                                All Applications (@if(isset($all_application_collection) && !$all_application_collection->isEmpty()){{$all_application_collection->count()}}@else{{"0"}}@endif)
                            </h5>
                        </div>
                    </div>  
                        <div class="element-box">
                      <div class="table-responsive">
                                <style>
                                    .form-inline{
                                        display: block !important;
                                    }
                                    ul.pagination a {
                                        position: relative;
                                        display: block;
                                        padding: 0.5rem 0.75rem;
                                        margin-left: -1px;
                                        line-height: 1.25;
                                        color: #047bf8;
                                        background-color: #fff;
                                        border: 1px solid #dee2e6;
                                    }
                                </style>
                                <table id="dataTable" class="table table-striped" style="width: 100% !important; table-layout: fixed;">
                                    <thead>
                                    <tr>
                                        <th style="width:10px">S/N</th>
                                        <th>STATUS</th>
                                       {{--  <th>APPLICANT</th>  --}}
                                        <th>PROGRAMME</th>
                                        <th>APPLIED ON</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th style="width:10px">S/N</th>
                                         <th>STATUS</th>
                                       {{--  <th>APPLICANT</th>  --}}
                                        <th>PROGRAMME</th>
                                        <th>APPLIED ON</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($all_application_collection as $k=>$val)
                                        <tr data-id="{{$val->application_id}}" style="cursor: pointer">
                                            <td style="width:10px">{{$k+1}}</td>
                                            <td>
                                                @if($val->action_1_status==0) <strong class="text-info"><i class="fa fa-spinner"></i> Pending </strong>@elseif($val->action_1_status==1) <strong class="text-success"><i class="fa fa-check"></i> Approved </strong>  @elseif($val->action_1_status==2)<strong class="text-danger"><i class="fa fa-times"></i> Rejected </strong>  @endif
                                            </td>
                                           {{-- <td><strong>{{$val->firstname.' '.$val->lastname}}</strong></td> --}}
                                            <td>{{$val->programme_name}}</td>
                                            <td>{{date('d-m-y h:m A',strtotime($val->created_at))}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                   @endif  {{-- End can view application on dashboard --}}  

                </div>
            </div> 

              












        </div>
    
    @else
        <div class="content-box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <h6 class="element-header">
                            Portal Dashboard
                        </h6>
                        <div class="element-content">
                            <div class="row">
                                Welcome to the portal landing page. Kindly use the menu on your left to maximize your ePortal landing page.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    @endif

    
    <!-- / Modal Change First Password -->
    <!-- General Modal -->
    <div class="modal fade general_modal" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <!-- //End General Modal -->
@endsection

@section('additional_js')

  
@endsection