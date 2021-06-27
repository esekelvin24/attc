@extends('../layouts.dash_layout')

@section('required_css')

@endsection

  @php
       $days = [
        7 => 'Sunday',
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday'
    ];
   @endphp

@section('content')
	<div class="content-box">
		<div class="element-wrapper">
			<h6 class="element-header">
				All Classes (@if( $time_table_list->isEmpty() ) 0 @else{{$time_table_list->count()}}@endif)
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
					
                    <div class="row" style="border: outset #202076; margin-bottom:10px;">
                       <div class="col-md-1"><strong>From:</strong></div>  <div class="col-md-2"> {{date('d M Y',strtotime($this_week_sd))}} </div> <div class="col-md-1"><strong>To:</strong> </div>  <div class="col-md-2"> {{date('d M Y',strtotime($this_week_ed))}} </div>
                    </div>

					 <table id="dataTable" class="table table-striped" style="width: 100% !important; table-layout: fixed;">
                                    <thead>
                                    <tr>
                                        <th style="width:10px">S/N</th>
                                        <th>DATE</th>
                                        <th>DAY</th>
                                        <th>COURSE NAME</th>
                                        <th>TIME START</th>
                                        <th>TIME END</th>
                                        <th>ZOOM LINK</th>
                                        <th align="center">ZOOM ID</th>
                                        <th align="center">ZOOM PASS</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th style="width:10px">S/N</th>
                                        <th>DATE</th>
                                        <th>DAY</th>
                                        <th>COURSE NAME</th>
                                        <th>TIME START</th>
                                        <th>TIME END</th>
                                        <th>ZOOM LINK</th>
                                        <th align="center">ZOOM ID</th>
                                        <th align="center">ZOOM PASS</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @if(count($time_table_list))
                                    @foreach($time_table_list as $k=>$val)
                                        <tr >
                                            <td style="width:10px">{{$k+1}}</td>
                                             <td>{{date('d M Y',strtotime($val->lecture_date))}}</td>
                                            <td>{{$days[$val->day]}}</td>
                                            <td>{{$val->course_name}}</td>
                                            <td>{{date('h:m A',strtotime($val->start_time))}}</td>
                                            <td>{{date('h:m A',strtotime($val->end_time))}}</td>
                                            
                                           
                                            @if($val->zoom_link=="")
                                            <td class="text-danger"> Unavailable</td>
                                            @else
                                             <td><a target="_blank" href="{{$val->zoom_link}}">{{$val->zoom_link}}</a></td>
                                            @endif

                                            @if($val->zoom_id=="")
                                            <td align="center" class="text-danger"> Unavailable</td>
                                            @else
                                             <td> {{$val->zoom_id}}</td>
                                            @endif

                                             @if($val->zoom_password=="")
                                             <td align="center" class="text-danger"> Unavailable</td>
                                             @else
                                             <td> {{$val->zoom_password}}</td>
                                             @endif

                                           
                                        </tr>
                                    @endforeach
                                    @endif
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