@extends('../layouts.dash_layout')

@section('required_css')

@endsection


@section('content')
	<div class="content-box">
		<div class="element-wrapper">
			<h6 class="element-header">
				All My Certificate (@if( $all_application_collection->isEmpty() ) 0 @else{{$all_application_collection->count()}}@endif)
			</h6>
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
                                       {{-- <th>STATUS</th>  --}}
                                        
                                        <th>PROGRAMME</th>
                                        <th class="col-md-5">COURSES</th>  
                                        <th>APPLIED ON</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th style="width:10px">S/N</th>
                                        {{-- <th>STATUS</th> --}}
                                       
                                        <th>PROGRAMME</th>
                                       <th>COURSES</th> 
                                        <th>APPLIED ON</th>
                                         <th>ACTION</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($all_application_collection as $k=>$val)
                                        <tr >
                                            <td style="width:10px">{{$k+1}}</td>
                                           {{-- <td>
                                                @if($val->action_1_status==0) <strong class="text-info"><i class="fa fa-spinner"></i> Pending </strong>@elseif($val->action_1_status==1) <strong class="text-success"><i class="fa fa-check"></i> Approved </strong>  @elseif($val->action_1_status==2)<strong class="text-danger"><i class="fa fa-times"></i> Rejected </strong>  @endif
                                            </td> --}}
                                           
                                            <td>{{$val->programme_name}}</td>
                                            <td>
                                              
                                             
                                              @if(isset($course_arr[$val->application_id]))
                                                    @php
                                                             $arr = $course_arr[$val->application_id];
                                                    @endphp
                                                    @foreach($arr as $index => $value)
                                                            <label style="margin:5px;" class="badge badge-warning">{{$value["course_name"]}}</label>
                                                    @endforeach
                                               @endif

                                            </td>
                                            <td>{{date('d-m-y h:m A',strtotime($val->created_at))}}</td>
                                            <td><a target="_blank" href="{{url('/my_pdf_certificate/'.encrypt($val->application_id))}}" class="text-white btn btn-success btn-sm"><i class ="fa fa-file"></i> View Certificate</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                    </table>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade edit_area" role="dialog">
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
	<!-- //End Modal -->


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

@section('required_js')
@endsection


@section('additional_js')
    <script>
        jQuery(document).ready(function() {
            vex.defaultOptions.className = 'vex-theme-flat-attack';
           


           


        });
    </script>
@endsection