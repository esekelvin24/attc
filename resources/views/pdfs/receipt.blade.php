<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Receipt of Payment</title>
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
		#watermark {
			position: fixed;
			bottom:   0px;
			left:     0px;
			z-index:  -1000;

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
	</style>

</head>
<body>
{{-- <img style="float: right; width:250px" src="{{asset("_img/top_right.png")}}" alt=""> --}}
<div id="watermark">
	<img src="{{asset("img/watermark.png")}}" height="100%" width="100%" />
</div>
<div class="information">
	<table width="100%">
		<tr>
			<td align="left" style="width: 40%;">

				<pre>
                    <br />
<br><br><br/><br/>
<span style="font-weight: bold; font-size: 16px">African Technical Training Centre</span><br/>
6, OSENI CLOSE, MAGBON SEGUN BUS STOP, DANGOTE REFINERY NEW GATE, 
IBEJU LEKKI, LAGOS
<br />
Date: {{date("d F, Y")}}
</pre>
			</td>
			<td align="center">
				<img src="{{asset("frontend/assets/img/logo.png")}}" style="display:block;width:100px;margin-top: 40px;margin-left:auto;margin-right:auto;text-align: center " alt="">
			<br/>

			</td>
			<td align="right" style="width: 40%;">
				
			</td>
		</tr>
        <tr>
            <td colspan="3"><h2 style="text-align: center;color:#234a84">Receipt of Payment</h2></td>
        </tr>
	</table>
</div>

	<div style="font-size: 13px; padding-left: 15px">
		<span style="font-size: 15px; font-weight: bold">
			Applicant Details
		</span><br/>
		<div class="company-address">
			Full Name:   {{strtoupper($full_name)}}
		</div>
		{{--<div class="company-address">
			Mat. No.:   strtoupper($full_name)
		</div>--}}
		<div class="company-address">
			Programme Name:   {{$programme_name}}
		</div>
		<div class="company-address">
			Application No:   {{'ATTC-'.str_pad($application_collection[0]->batch_id, 4, "0", STR_PAD_LEFT).'-'.$application_collection[0]->application_id}}
		</div>
		<div class="company-address">
			Payment Method:   {{$payment_method}}
		</div>
		<div class="company-address" style="font-weight:bold">
			Payment Ref:   {{$reference}}
		</div>

	</div>

<div style="padding-left: 15px; font-size: 16px;">
	

	
	 <table id="table">
                            <thead>
                                <tr>
                                    <th>S/No.</th>
                                    <th>Name</th>
									 <th>Duration</th>
                                    <th style="text-align:right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $total_registered_course = 0;
                                foreach($application_courses as $courses_val){ 
                                ?>
                               <tr> <td>1</td><td><?php echo $courses_val->course_name ?></td> <td><?php echo $courses_val->course_duration." ".$courses_val->course_duration_type ?></td> <td align="right">N<?php echo number_format($courses_val->application_course_price,2) ?></td> </tr>
                               <?php $total_registered_course = $total_registered_course + $courses_val->application_course_price; } ?>
                               <tr style="text-align:right"> <td colspan="3"><strong>Total:</strong></td> <td> <strong>N<?php echo number_format($total_registered_course,2) ?><strong></td> </tr>
                            </tbody>
                    </table>
</div>

<div class="information" style="position: absolute; bottom: 0; width:100% !important;">
	<table width="100%">
	
		<tr>
			<td align="left" >
				&copy; {{ date('Y') }} <img style="width: 13px; height: 13px" alt="" src="{{asset("frontend/assets/img/favicon.png")}}"/> African Technical Training Centre Portal - All rights reserved.
			</td>
		</tr>

	</table>
</div>
</body>
</html>

