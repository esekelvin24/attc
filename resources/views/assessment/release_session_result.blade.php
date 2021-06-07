@extends('../layouts.dash_layout')

@section('required_css')

@endsection


@section('content')

<div class="content-i" >
    <div class="content-box">
        @if(Session::get('update_success'))
    <div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
        {{Session::get('update_success')}}
    </div>
    <br/>
    @endif
    <form method="POST" action="{{route('save_release_session_result')}}">
        @csrf
        <div class="row">
            <div class="col-3">
            <table class="table table-bordered">
                <thead>
                    <th>Session Name</th>
                    <th>Show Result</th>
                </thead>
                <tbody>

                    @foreach($session_list as $val)
                    <tr>
                    <td><strong>{{$val->session_name}}</strong></td>
                            <td>
                                <div  class="checkbox clip-check check-success" style="margin-top:-2px !important">
                                <input class="class{{$val->session_id}}" onclick="setValue(this.className)" {{$val->show_result==1?"checked": ""}} data-sub="3" id="{{$val->session_id}}" name="sess[]" value="{{$val->session_id}}" type="checkbox">
                                <label for="{{$val->session_id}}"> </label>
                                </div>
                            </td>
                    </tr>
                    @endforeach
                    <tr>
                        
                        <td colspan="2">
                            <button  type="submit" class="btn btn-success"> Save </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
       
     </form>
   
    </div>
</div>


<script>



</script>


@endsection

@section('required_js')
@endsection




