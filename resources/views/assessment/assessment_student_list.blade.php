
<style>
fieldset {
    font-family: sans-serif;
    border: 5px solid #1F497D;
    background: white;
    border-radius: 5px;
    margin-top: 1px;
	padding-left:10px;
	padding-top:-20px;
}

fieldset legend {
    background: #1F497D;
    color: #fff;
    padding: 5px 10px ;*/
    font-size: 17px;
    border-radius: 5px;
    box-shadow: 0 0 0 5px #ddd;
    margin-left: 0px;
}
</style>

<form method = "POST" action="{{route('add_student_to_assessment')}}">
@csrf
<input type="hidden" name="assessment_id" value ="{{encrypt($assessment_id)}}">
<div class="row">
		<div class="col-md-12">
                <fieldset>
                        <legend>Students:</legend>
                            <table class="table table-bordered">
                            <tr>
                                  <th>
                                  Student ID
                                  </th>
                                   <th>
                                   Student Name
                                  </th>
                            </tr>
						    <div class="checkbox clip-check check-info">
								@foreach($student_collection as $val)
                                <tr>
                                  <td class="col-md-3">
                                      <input {{isset($selected_student[$val->id])?"checked":""}} data-sub="1" id="c{{$val->id}}" name="students[]" value="{{$val->id}}" type="checkbox">
                                      <label for="c{{$val->id}}"> SID{{str_pad($val->id, 4, "0", STR_PAD_LEFT)}}</label>
                                 </td>
                                 <td class="col-md-9">
                                       {{$val->firstname." ".$val->middlename." ".$val->lastname}}
                                 </td>
                                </tr>
                                @endforeach    
                            </div> 
                            </table>
				</fieldset>
        </div>				
</div>

<style>
                .content
                {
                text-align: center;
				margin-top:10px;
                }
                .inner
                {
                display:inline-block;
                }
                </style>
                       
 
 
                 <div class="content" >
                 <div class="inner" align="center" >
                 <div style ="min-width:350px !important" class="row">
                    
                     <div class="col-md-12">
                         <button onclick="submitFormOkay = true;" class="btn btn-primary btn-block btn-scroll btn-scroll-left ti-book create" type="submit"><span>ADD STUDENT</span></button>
                     </div>
                 </div>
                 </div>    
                </div>
</form>
