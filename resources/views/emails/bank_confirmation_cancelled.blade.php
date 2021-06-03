<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>ATTC Payment Successful</title>
  <style type="text/css">
    body {margin: 0; padding: 0; min-width: 100%!important;}
    img {height: auto;}
    .content {width: 100%; max-width: 600px;}
    .header {padding: 40px 30px 20px 30px;}
    .innerpadding {padding: 30px 30px 30px 30px;}
    .borderbottom {border-bottom: 1px solid #f2eeed;}
    .subhead {font-size: 15px; color: #ffffff; font-family: sans-serif; letter-spacing: 10px;}
    .h1, .h2, .bodycopy {color: #153643; font-family: sans-serif;}
    .h1 {font-size: 33px; line-height: 38px; font-weight: bold;}
    .h2 {padding: 0 0 15px 0; font-size: 24px; line-height: 28px; font-weight: bold;}
    .bodycopy {font-size: 16px; line-height: 22px;}
    .button {text-align: center; font-size: 18px; font-family: sans-serif; font-weight: bold; padding: 0 30px 0 30px;}
    .button a {color: #ffffff; text-decoration: none;}
    .footer {padding: 20px 30px 15px 30px;}
    .footercopy {font-family: sans-serif; font-size: 14px; color: #ffffff;}
    .footercopy a {color: #ffffff; text-decoration: underline;}

    @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
      body[yahoo] .hide {display: none!important;}
      body[yahoo] .buttonwrapper {background-color: transparent!important;}
      body[yahoo] .button {padding: 0px!important;}
      body[yahoo] .button a {background-color: #98b834; padding: 15px 15px 13px!important;}
      body[yahoo] .unsubscribe {display: block; margin-top: 20px; padding: 10px 50px; background: #2f3942; border-radius: 5px; text-decoration: none!important; font-weight: bold;}
    }

    /*@media only screen and (min-device-width: 601px) {
      .content {width: 600px !important;}
      .col425 {width: 425px!important;}
      .col380 {width: 380px!important;}
      }*/

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

<body yahoo bgcolor="#f6f8f1">
<table width="100%" bgcolor="#f6f8f1" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      <!--[if (gte mso 9)|(IE)]>
      <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td>
      <![endif]-->
      <table bgcolor="#ffffff" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td bgcolor="#141541" class="header"> 
            <table width="70" align="left" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="70" style="padding: 0 20px 20px 0;">
                  <img class="fix" src="{{asset("frontend/assets/img/logo-light.png")}}" width="120" height="120" border="0" alt="" />
                </td>
              </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            <table width="425" align="left" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td>
            <![endif]-->
            <table class="col425" align="left" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 400px;">
              <tr>
                <td height="70">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="subhead" style="padding: 0 0 0 3px;">
                        Notification of
                      </td>
                    </tr>
                    <tr>
                      <td class="h2" style="padding: 5px 0 0 0; color: #ffc000">
                        Cancelled Transaction
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
          </td>
        </tr>
        <tr>
          <td class="innerpadding borderbottom">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="h2">
                  Dear <strong>{{strtoupper($full_name)}}</strong>,
                </td>
              </tr>
              <tr>
                <td class="bodycopy">
                  <br/>
                  
                 We are sorry to inform you that your bank transfer payment has been cancelled for the application below.<br/><br/>
                 <p>Programme Name: <strong>{{$programme_name}}</strong></p>
                 <p>Application ID: <strong>  {{'ATTC-'.str_pad($application_collection[0]->batch_id, 4, "0", STR_PAD_LEFT).'-'.$application_collection[0]->application_id}}</strong></p>
                 <br/>

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

                  <br/>
                  You can be able to make payment using other payment options or click <a href="{{url('/contact')}}">here</a> to an admin if you encounter any challenges


                </td>
              </tr>

              <tr>
                <td class="bodycopy">
                  <br/>
                  Best Regards,<br/>
                  Management
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td class="innerpadding borderbottom">

            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
          </td>
        </tr>

        <tr>
          <td class="innerpadding bodycopy">

          </td>
        </tr>
        <tr>
          <td class="footer" bgcolor="#44525f">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" class="footercopy">
                  &reg; Copyright {{date('Y')}} African Technical Training Centre.
                  All rights reserved<br/>
                </td>
              </tr>
             
            </table>
          </td>
        </tr>
      </table>
     
    </td>
  </tr>
</table>
</body>
</html>
