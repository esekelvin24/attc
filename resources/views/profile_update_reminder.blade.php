@extends('../layouts.dash_layout')

@section('required_css')
@endsection

@section('content')

<style>


h1 {
  font-size: 32px;
  text-align: center;
}

p {
  font-size: 20px;
  line-height: 1.5;
  margin: 40px auto 0;
  max-width: 640px;
}

pre {
  background: #eee;
  border: 1px solid #ccc;
  font-size: 16px;
  padding: 20px;
}

form {
  margin: 40px auto 0;
}

label {
  display: block;
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
}

input {
  border: 2px solid #333;
  border-radius: 5px;
  color: #333;
  font-size: 22px;
  margin: 0 0 20px;
  padding: .1rem 1rem;
  
  min-width:20px;

}

button {
  background: #1b1c6e;
  border: 2px solid #333;
  border-radius: 5px;
  color: white;
  font-size: 16px;
  font-weight: bold;
  padding: 1rem;
  cursor: pointer;
}

button:hover {
  background: #333;
  border: 2px solid #333;
  color: #fff;
}

.main {
  background: #fff;
  border: 5px solid #ccc;
  border-radius: 10px;
  margin: 40px auto;
  padding: 40px;
  width: 80%;
  max-width: 700px;
}

</style>

<div class="content-box">
    <div class="row">
        <div class="col-sm-12">
            <div class="element-wrapper">
                <h6 class="element-header">
                    Profile Update Reminder
                </h6>

          @if($code == 1)

            <div align="center">
                <img width="80" height="80" src="{{asset('img/success.png')}}" ><br/><br/>
               <div class="alert alert-success col-sm-12 col-md-6" role="alert">
                 {{$message}}
                </div>  
            </div>
            
          @else

           <div align="center">
                <img width="100" height="100" src="{{asset('img/barred.png')}}" >
               <div class="alert alert-danger col-sm-12 col-md-6" role="alert">
                 {{$message}}
                </div>
                <a class="profile" href="#"><button class="profile"  id="continue" type="button">Update Profile</button></a>
                 
            </div>

          @endif


            


               
</div>
</div>
</div>
</div>

@endsection


@section('additional_js')

    <script>

 
function playNow()
{
		window.location = "{{url('/')}}/new_gameplay";
}


    

// Jquery Dependency

$("input[data-type='currency']").on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() { 
      formatCurrency($(this), "blur");
    }
});


function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.
  
  // get input value
  var input_val = input.val();
  
  // don't validate empty input
  if (input_val === "") { return; }
  
  // original length
  var original_len = input_val.length;

  // initial caret position 
  var caret_pos = input.prop("selectionStart");
    
  // check for decimal
  if (input_val.indexOf(".") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(".");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);
    
    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "00";
    }
    
    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val = "₦" + left_side + "." + right_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = "₦" + input_val;
    
    // final formatting
    if (blur === "blur") {
      input_val += ".00";
    }
  }
  
  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}








function testInputData(myfield, restrictionType) {
 
 var myData = myfield;
 if(myData!==''){
     if(restrictionType.test(myData)){
        return 0;
     }else{
     return 1;
     }
 }else{
     return 1;
 }
 return;
 
}
	
	</script>
@endsection
