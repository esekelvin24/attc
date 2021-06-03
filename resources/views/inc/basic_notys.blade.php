        @if(Session('success'))
            <div class="alert alert-success" style="margin-top:3px; margin-bottom:0;">
                {{Session('success')}}
            </div> 
        @endif

        @if(Session('error'))
            <div class="alert alert-danger" style="margin-top:3px; margin-bottom:0">
                {{Session('error')}}
            </div>
        @endif

        @if(count($errors)>0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger" style="margin-top:3px; margin-bottom:0">
                    {{$error}}
                </div>
            @endforeach
       @endif