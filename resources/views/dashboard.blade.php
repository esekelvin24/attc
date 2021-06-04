@extends('layouts.dash_layout')

@section('content')



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
                   @endif  
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