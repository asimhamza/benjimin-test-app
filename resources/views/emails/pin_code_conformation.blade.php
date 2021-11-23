
@extends('emails.layout')
@section('emailBody')
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <!-- LOGO -->
    <tr>
        <td align="center">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 10px 10px 10px;">
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
        <td align="center" style="padding: 0px 10px 0px 10px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#ffffff" valign="top" style="padding: 40px 30px 0px 30px; border-radius: 4px 4px 0px 0px;">
                      <h1 style="font-size: 24px; font-weight: 600; margin: 0; font-family: 'Poppins', sans-serif;">Hello!</h1>
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
    <!-- COPY BLOCK -->
    <tr>
        <td align="center" style="padding: 0px 10px 0px 10px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
              <!-- COPY -->
              <tr>
                <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">
                  <p style="margin: 0;">Your 6-digit pin code is {{$data['pin']}}.</p> <br>
                </td>
              </tr>
              <!-- COPY -->
              <tr>
                <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">
                  <p style="margin: 0;">If you have any questions, You can contact us. we're always happy to help out.</p>
                </td>
              </tr>
              <!-- COPY -->
              <tr>
                <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 0px 0px; color: #666666; font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;">
                  <p style="margin: 0;">Thank you</p>
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


    <!-- FOOTER -->
    <tr>
        <td align="center" style="padding: 10px 10px 50px 10px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
              <!-- PERMISSION REMINDER -->
              <tr>
                <td bgcolor="#ffffff" align="left" style="padding: 10px 30px 30px 30px; color: #aaaaaa; font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 400; line-height: 18px;">
                  <p style="margin: 0;">You received this email because you just signed up for a new account. If it looks weird, just contact and we're always happy to help out.</p>
                </td>
              </tr>
		      <!-- COPYRIGHT -->
              <tr>
                <td align="center" style="padding: 30px 30px 30px 30px; color: #333333; font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 400; line-height: 18px;">
                  <p style="margin: 0;">Copyright © {{date('Y')}} Admin. All rights reserved.</p>
                </td>
              </tr>
            </table>
         
        </td>
    </tr>
</table>
@endsection
