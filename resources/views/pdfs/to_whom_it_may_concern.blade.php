<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>African Technical Training Centre</title>

	<style type="text/css">
		@page {
			margin: 0px;
		}
		body {
			margin: 0px;
		}
		* {
			font-family: Verdana, Arial, sans-serif;
		}
		a {
			color: #fff;
			text-decoration: none;
		}
		table {
			font-size: x-small;
		}
		tfoot tr td {
			font-weight: bold;
			font-size: x-small;
		}
		.invoice table {
			margin: 15px;
		}
		.invoice h3 {
			margin-left: 15px;
		}

		.information .logo {
			margin: 5px;
		}
		.information table {
			padding: 10px;
		}

		#table, #table td, #table th {
		border: 1px solid black;
		padding:3px;
		text-align:left;
		}

		#table {
		width: 100%;
		border-collapse: collapse;
		}

		body{
			background-image: url("{{asset('img/letterhead.png')}}");
			/* Full height */
			height: 100%;
			/* Center and scale the image nicely */
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
	</style>

</head>
<body>
{{-- <img style="float: right; width:100px; margin-top:20px; margin-right:20px" src="{{asset("frontend/assets/img/logo.png")}}" alt=""> --}}
<div class="information">
    
	<br/><br/><br/><br/><br/><br/><br/><br/>
	<br/>
	<table width="100%">
			<tr>
				<td align="left" style="width: 40%;">
                  <br/> <br/>
				  <strong style="padding-left:25px; "> {{$application_id}} </strong>
				</td>
			

				</td>
				<td align="right" style="width: 40%;">
			</tr>
			<tr>
				<td colspan="3"><h1 style="text-align: center;color:#234a84">TO WHOM IT MAY CONCERN</h1></td>
			</tr>
	</table>
</div>
    <br/>
	<div align="center"><h4>This is to Certify that</h4></div>
    <br/>   
	<div align="center"><h3><i>{{$student_full_name}}</i></h3></div>
<hr>

  <div align="center"><h5>Has satisfactorily completed training in</h5></div>

  <div align="center"><h2>{{$programme_name}}</h2></div>

<hr>
 
  <div style="padding:30px;" align="center"><h5>And has passed the prescribed examinations(s).<br/>
  He/She is awaiting his/her Certificate which would be issued to him/her as soon as it is available from our headquarters in Indian</h5></div>


<br/>
<br/>
<br/>

<div style="padding:10px;" align="right"><img style="float: right; width:100px; margin-top:20px; margin-right:30px" src="{{asset("img/seal.png")}}" alt=""></div>



</body>
</html>

