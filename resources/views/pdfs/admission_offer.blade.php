<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>African Technical Training Centre Letter</title>

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
{{--   <img style="float: right; width:100px; margin-top:20px; margin-right:20px" src="{{asset("frontend/assets/img/logo.png")}}" alt=""> --}}
<div class="information">
	<table width="100%">
		<tr>
			<td align="left" style="width: 40%;">

				<pre>
                    <br />
<br><br><br/><br/>
<span style="font-weight: bold; font-size: 16px">{{-- African Technical Training Centre --}}</span><br/>
{{--6, OSENI CLOSE, MAGBON SEGUN BUS STOP, DANGOTE REFINERY NEW GATE, 
IBEJU LEKKI, LAGOS--}}
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
            <td colspan="3"><h2 style="text-align: center;color:#234a84">Provisional Offer of Admission</h2></td>
        </tr>
	</table>
</div>

	<div style="font-size: 13px; padding-left: 15px">
		<span style="font-size: 15px; font-weight: bold; margin-bottom:5px">
			Applicant Details
		</span><br/>
		<div class="company-address">
			Full Name:  {{$full_name}}
		</div>
		<div class="company-address">
			Batch No:  <strong>{{$batch_no}}</strong>
		</div>
		<div class="company-address">
			Application ID:  {{$full_application_no}}
		</div>
	

		{{--<div class="company-address">
			First Year Approximate Tuition*:  N{{number_format($fee,2)}}
		</div>--}}
		<div class="company-address">
			<strong>Condition:</strong>  This provisional offer is subject to meeting all admission requirements as shall be subsequently verified by the Institution
		</div>
		<div class="company-address">
			<strong>Validity:</strong>  This provisional offer of admission is valid for one week from today, and shall expire on <strong> {!! date("d F, Y", strtotime("+1 week")) !!}
		</div>
	</div>

<div style="padding-left: 15px; font-size: 13px;">
	<h4 >Dear {{strtoupper($full_name)}} </h4>
	<p>
		Congratulations! You have been offered a spot in <strong>Batch No {{$batch_no}}</strong> at the African Technical Technical Training Centre. On behalf of the faculty and staff, I want you to know how pleased
		we are that you have chosen to become part of the African Technical Training Centre community.  <br/>
		<br/>
		You have been offered provisional admission to study <strong>{{$programme_name}}</strong>  at  our institution with the following course description below:

	
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
		<br/>
	    Kindly note that this offer is conditioned on you meeting the following and other stipulated admission requirements: <br/><br/>
	</p>
	<p>
		<span style="font-weight: bold">1. ACCEPTANCE OF ADMISSION</span><br/>
		Kindly print, sign, scan your letter of admission and SUBMIT on the African Technical Training Centre Portal at <a style="color:blue" href="https://attcnigeria.org"> https://attcnigeria.org</a>, as you login to your account.
	</p>
	<p>
		<span style="font-weight: bold">2. TUITION FEE</span><br/>
		Kindly ensure that you have paid the school fee of <strong>N{{number_format($total_fee,2)}}</strong> only into the designated Institution account, and received receipts.<br/>
		This can also be done as soon as you login into the portal.
	</p>
	
	<p>
		<span style="font-weight: bold">3. AUTHENTIC AND APPROPRIATE DOCUMENTS</span><br/>
		It shall be your place to ensure that all documents uploaded are authentic, and that they meet specified programme requirements.

		 Once more, from the team at The African Technical Training Centre, congratulations. We look forward to meeting you soon. Best regards,<br/><br/>
		
		</p>
</div>

<div class="information" style="position: absolute; bottom: 0; width:100% !important;">
	<table width="100%">
		<tr>
			<td align="left" >
				{{--&copy; {{ date('Y') }} <img style="width: 13px; height: 13px" alt="" src="{{asset("frontend/assets/img/favicon.png")}}"/> African Technical Training Centre - All rights reserved.  --}}
			</td>
		</tr>

	</table>
</div>
</body>
</html>

