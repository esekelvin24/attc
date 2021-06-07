
@php
    
    use App\Http\Controllers\Utilities;
    
    $shw_result = Utilities::get_result_display();

@endphp




<h4>Assessement Beakdown</h4>
<br/>
<table class="table table-bordered">
    <thead align="center">
        
        <th>Course</th>  <th>First CA</th>  <th>Second CA</th>  <th>Third CA</th> <th>Fourth CA</th>  <th>Exam</th>
       
    </thead>
    <tbody>

      @if(count($ca_record) >0)
        @foreach($ca_record as $val)
            <tr align="center">
                <td>{{$val->course_title}}</td>

                @php
                
                   $assessement_details = DB::table('tbl_assessement_creation')
                  // ->where('assessement_type',1)
                   ->where('course_short_code',$val->course_short_code)
                   ->where('session_id',$val->session_id);

                   $date = $assessement_details->pluck("expiration_date","assessement_type");
                   $time = $assessement_details->pluck("expiration_time","assessement_type");
                   
                   //date("Y-m-d H:m:s") > $assessement_details->expiration_date." ".$assessement_details->expiration_time
                @endphp

             @if(isset($date[1]))
             

                
                @if (date("Y-m-d H:m:s") > substr($date[1],0,10)." ".$time[1] )	
                   <td>{{$val->ca1}}</td>
                @else
                   <td></td>
                @endif
             @else
                 <td></td>
             @endif
            

             @if(isset($date[2]))
                @if (date("Y-m-d H:m:s") > substr($date[2],0,10)." ".$time[2] )	
                   <td>{{$val->ca2}}</td>
                @else
                   <td></td>
                @endif
             @else
                 <td></td>
             @endif

            
                
             @if(isset($date[3]))
                @if (date("Y-m-d H:m:s") < substr($date[3],0,10)." ".$time[3] )	
                <td>{{$val->ca3}}</td>
                @else
                    <td></td>
                @endif
            @else
                <td></td>
            @endif

            
            @if(isset($date[4]))
                @if (date("Y-m-d H:m:s") < substr($date[4],0,10)." ".$time[4] )	
                   <td>{{$val->ca4}}</td>
                @else
                   <td></td>
                @endif
            @else
               <td></td>
            @endif

                @if($shw_result[$val->session_id] == 1)
                   <td>{{$val->exam}}</td>
                @else
                    <td></td>
                @endif


            </tr>
        @endforeach
    @endif
    </tbody>

</table>



