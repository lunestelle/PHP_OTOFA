<?php
$resetLink = "http://localhost/PHP_Sakaycle/views/reset_password.php?email=" . urlencode($email) . "&token=" . urlencode($token);
$emailContent = '
  <html>
  <head>
    <title>Password Reset</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      .reset-button {
        display: inline-block;
        background-color: #FF4200;
        color: #fff;
        text-decoration: none !important;
        font-weight: 500;
        margin-top: 35px;
        text-transform: uppercase;
        font-size: 14px;
        padding: 10px 24px;
        border-radius: 50px;
        transition: background-color 0.3s ease;
      }
   
      .reset-button:hover {
        background-color: #FF6A36;
      }
    </style>
  </head>
  <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8" style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif;">
      <tr>
        <td>
          <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td style="height:80px;">&nbsp;</td>
            </tr>
            <tr>
              <td style="text-align:center;">
                <a href="http://localhost/PHP_Sakaycle/views/index.php" title="logo" target="_blank" style="font-size: 48px; font-weight: bold; color: #FF4200; text-decoration: none;">Sakay<span style="color: #000;">cle.</span></a>
              </td>
            </tr>
            <tr>
              <td style="height:20px;">&nbsp;</td>
            </tr>
            <tr>
              <td>
                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                  <tr>
                    <td style="height:40px;">&nbsp;</td>
                  </tr>
                  <tr>
                    <td style="padding:0 35px;">
                      <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:"Rubik",sans-serif;">Password Reset</h1>
                      <span style="display:inline-block; vertical-align:middle; margin:2px 0 26px; border-bottom:1px solid #cecece; width:70%;"></span>
                      <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                        We have received a request to reset your password. To proceed with the password reset, please click the button below. If you did not initiate this password reset, you can ignore this email.
                      </p>
                      <a href="' . $resetLink . '" style="color: #fff;" class="btn reset-button">Reset Password</a>
                    </td>
                    </tr>
                    <tr>
                      <td style="height:40px;">&nbsp;</td>
                    </tr>
                  </table>
                </td>
              <tr>
                <td style="height:20px;">&nbsp;</td>
              </tr>
              <tr>
                <td style="text-align:center;">
                  <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; '.date("Y").' Sakaycle</p>
                </td>
              </tr>
              <tr>
                <td style="height:80px;">&nbsp;</td>
              </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
  </html>
';
?>