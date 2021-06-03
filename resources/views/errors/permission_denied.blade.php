@extends('../layouts.dash_layout')

@section('required_css')
@endsection

@section('content')
    <div class="content-box">
		
        <div class="row">
            <div align="center" class="col-sm-12">
		          <img width="100" height="100" src="{{asset('img/barred.png')}}" >
                  <p>You do not have permission to access this page, please contact admin </p>
            </div>
        </div>
    </div>
@endsection

@section('additional_js')
  

@endsection
