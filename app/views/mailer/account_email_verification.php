<div>
  <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8" style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;">
    <tr>
      <td>
        <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td style="height:50px;">&nbsp;</td>
          </tr>
          <tr>
            <td style="text-align:center;">
              <img class="logo" src="public/assets/images/logo-icon.png" alt="">
              <a href="<?= ROOT ?>" title="logo" target="_blank" style="width: 100px;"> <img src="public/assets/images/logo-email.png" alt="OTOFA Logo"></a>
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
                    <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;">Email Verification</h1>
                    <span style="display:inline-block; vertical-align:middle; margin:2px 0 26px; border-bottom:1px solid #cecece; width:70%;"></span>
                    <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                      Dear <?= $_SESSION['first_name'] ?>,
                    </p>
                    <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                      Thank you for signing up with Sakaycle! To ensure the security of your account, we need to verify your email address.
                    </p>
                    <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                      Please click the button below to verify your email address. This verification link will expire in 24 hours.
                    </p>
                    <a href="<?= $_SESSION['verification_link']?>" style="display: inline-block; background-color: #FF4200; color: #fff; text-decoration: none !important; font-weight: 500; margin-top: 20px; text-transform: uppercase; font-size: 14px; padding: 10px 24px; border-radius: 50px; transition: background-color 0.3s ease; color: #fff;" class="btn reset-button">Verify Email</a>
                    
                    <p style="color:#455056; font-size:13px; font-weight: 600; line-height:24px; margin:15px;">
                      If you did not sign up for Sakaycle, please ignore this email. Someone may have entered your email address by mistake.
                    </p>
                    <p style="color:#455056; font-size:15px;line-height:24px; margin-top: 15px;">
                      Thank you for choosing Sakaycle. We look forward to providing you with a great experience!
                    </p>
                    <p style="color:#455056; font-size:15px;line-height:24px; margin-top: 15px;">
                      Best regards,<br>
                      The Sakaycle Team
                    </p>
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
                <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <?php echo date("Y"); ?> Sakaycle</p>
              </td>
            </tr>
            <tr>
              <td style="height:50px;">&nbsp;</td>
            </tr>
        </table>
      </td>
    </tr>
  </table>
</div>