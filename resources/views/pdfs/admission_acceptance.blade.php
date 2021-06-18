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
	<table width="100%">
		<tr>
			<td align="left" style="width: 40%;">

				<pre>
                    <br />
<br><br><br/><br/>
<span style="font-weight: bold; font-size: 16px">{{-- African Technical Training Centre --}}</span><br/>
{{--6, OSENI CLOSE, MAGBON SEGUN BUS STOP, DANGOTE REFINERY NEW GATE, 
IBEJU LEKKI, LAGOS --}}
<br />
Date: {{date("d F, Y")}}
</pre>
			</td>
			<td align="center">
			
			<br/>

			</td>
			<td align="right" style="width: 40%;">
		</tr>
        <tr>
            <td colspan="3"><h2 style="text-align: center;color:#234a84">Admission Acceptance Letter</h2></td>
        </tr>
	</table>
</div>

	<div style="font-size: 13px; padding-left: 15px">
		<span style="font-size: 15px; font-weight: bold">
			Applicant Details
		</span><br/>

		<div class="company-address">
			Full Name:  {{strtoupper($full_name)}}
		</div>
		<div class="company-address">
			Application ID:  {{$full_application_no}}
		</div>
		
		<div class="company-address">
			Programme Name:  {{$programme_name}}
		</div>
		
		{{--<div class="company-address">
			First Year Approximate Tuition*:  N{{number_format($fee,2)}}
		</div>--}}
		<div class="company-address">
			<strong>Condition:</strong>  This provisional offer of admission is subject to meeting all admission requirements as shall be subsequently verified by the Training Centre
		</div>
		<div class="company-address">
			<strong>Validity:</strong>  This provisional offer of admission is valid for one week from today, and shall expire on  <strong>{!! date("d F, Y", strtotime("+1 week")) !!}</strong>
		</div>

	</div>



<div style="padding-left: 15px; font-size: 13px;">

<p><span style="font-weight: bold">COURSES</span></p>
<table id="table">
		  <tr>
		    <th><strong>S/N</strong></th>
			<th><strong>Short Code</strong></th>
			<th><strong>Course Name</strong></th>
			<th><strong>Duration</strong></th>
			<th style="text-align:right"><strong>Amount</strong></th>
		  </tr>
		  @php
			  $count = 1;
			  $total_fee = 0;
		  @endphp

		  @foreach($application_courses as $val)
		  <tr>
				<td>{{$count}}</td>
				<td>{{$val->short_code}}</td>
				<td>{{$val->course_name}}</td>
				<td>{{$val->course_duration}} {{$val->course_duration_type}}</td>
				<td>{{number_format($val->application_course_price,2)}}</td>
			</tr>

			 @php
			  $count = $count + 1;
			  $total_fee = $total_fee + $val->application_course_price;
		    @endphp		   
		   @endforeach
		    <tr style="text-align:right"> <td colspan="4"><strong>Total:</strong></td> <td> <strong>N @php echo number_format($total_fee,2) @endphp<strong></td> </tr>
		   
		</table>

	<p>
		<span style="font-weight: bold">SUBMISSION REQUIREMENTS</span>
	<ul>
		<li>Print, sign, scan and upload this “acceptance letter” when you log into the ATTC portal</li>
		{{-- <li>Submit a personal statement of a minimum of 200 words (an essay describing your aims and your interests as well as your reason for choosing the programme)</li> --}}
	</ul>
	</p>
	<p>
		<span style="font-weight: bold">TERMS AND CONDITIONS: </span>
		<i>Please, read instructions carefully before signing</i><br/><br/>
		<span>By accepting this offer, I acknowledge that I will only be accepted into the above stated programme provided that all academic conditions and other submission requirements have been met, and all documents have been validated by the institution’s appropriate admissions office. By the submission, I declare that all documents are, to the best of my knowledge, genuine. I understand that this offer is valid only for the intake date mentioned above. Should I decide to postpone my studies to a later date, this offer will be void and my application will need to be re-assessed. All fees and charges are inclusive of VAT.<span>
	

	</p>

	<table width="100%" style="padding:10px 20px">
		<tr>
			<td style="text-align: left">Applicant's signature:................................</td>
			<td style="text-align: left">&nbsp;&nbsp; Date:................................</td>
		</tr>
		<tr>
			<td style="text-align: left">Guardian's Signature:.................................</td>
			<td style="text-align: left">&nbsp;&nbsp; Date:................................</td>
		</tr>
	</table>
<p style="text-align: center">(Applicants below the age of 18 must have this Acceptance Letter read and signed by their guardian)</p>
</div>

<div class="information" style="position: absolute; bottom: 0; width:100% !important;">
	<table width="100%">
		<tr>
			<td align="left" >
			{{--	<strong>* There may be additional fees depending on the Programme Type</strong>  --}}
			</td>
		</tr>
		<tr>
			<td align="left" >
				{{-- &copy; {{ date('Y') }} <img style="width: 13px; height: 13px" alt="" src="{{asset("frontend/assets/img/favicon.png")}}"/> African Technical Training Centre - All rights reserved.--}}
			</td>
		</tr>

	</table>
</div>
</body>
</html>

