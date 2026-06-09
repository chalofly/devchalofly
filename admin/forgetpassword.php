<?php
include "config/database.php";
include "config/function.php";
include "config/setting.php";
include "config/mail.php";


if ($_POST['email'] != '' && $_POST['action'] == 'forgotpassword') {
  $username = clean($_POST['email']);

  $rs = GetPageRecord('*', 'sys_userMaster', 'email="' . $username . '" and (userType=1 or userType=0) and status=1');
  $user = mysqli_fetch_array($rs);



  if ($user['id'] != '') {


    $subject = 'Request Forgot Password';
    $randPass = rand(999999, 100000);
    $mailbody = 'Dear ' . $user['firstName'] . ' ' . $user['lastName'] . ',<br /><br /> 

You have received this communication in response to the request for your forgot password. System account password to be sent to you via e-mail.<br /><br /> 

Temporary Password: ' . $randPass . '<br /><br /> 

Please change your password as soon as possible, to ensure total privacy and confidentiality.<br /><br />  

If you did not request for your password to be reset, please contact us.
<br /><br />     
We hope to see you onboard again soon!<br /><br /> 

Thank You
';

    $fromemail = '';

    send_attachment_mail($fromemail, $username, $subject, $mailbody, $ccmail, $file_name);


    $namevalue = 'password="' . md5($randPass) . '"';
    $where = 'email="' . $username . '"';

    updatelisting('sys_userMaster', $namevalue, $where);
  }
}


$rsa = GetPageRecord('*', 'sys_userMaster', 'id=1');
$logincolor = mysqli_fetch_array($rsa);
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password - <?php echo $systemName; ?></title>
  <?php include "headerinc.php"; ?>

  <style>
    .subbtnfor {
      background-color: #000a9b !important;
      border-radius: 8px !important;
      border: none !important;
      margin-top: 20px !important;
    }

    .icon-field .form-control {
      background-color: #f7f8fa !important;
      height: 45px !important;
    }
	
	 .auth-left { background: linear-gradient(90deg, #ECF0FF 0%, #FAFBFF 100%); width: 50%; }
 .auth-right { width: 50%; }
 .max-w-464-px { max-width: 464px; }
 .icon-field .icon { position: absolute; top: 12px; inset-inline-start: 0; width: 40px; display: flex ; justify-content: center; align-items: center; font-size: 1.25rem; color: var(--text-secondary-light); }
 .icon-field .form-control { background-color: #f7f8fa !important; height: 45px !important; border-radius: 15px; border: 1px solid #c0b6b6; }
 .subbtnfor { background-color: #000a9b !important; border-radius: 8px !important; border: none !important; margin-top: 20px !important;     height: 43px;}
 a{color:#000;}
  </style>
</head>

<body>

  <section class="auth bg-base d-flex flex-wrap">
    <div class="auth-left d-lg-block d-none">
      <div class="d-flex align-items-center flex-column h-100 justify-content-center">
        <img src="https://travbizz.online/crm/assets/images/auth/auth-img.png" alt="">
      </div>
    </div>
    <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
      <div class="max-w-464-px mx-auto w-100">
        <div>
          <a class="mb-40 max-w-290-px">
            <img src="profilepic/<?php echo stripslashes($logincolor['invoiceLogo']); ?>" style="height:50px;" />
          </a>
          <h4 class="mb-12" style="font-size: 33px; font-weight: 600 !important; margin: 30px 0px !important;">Forgot Password</h4>
          <?php if ($user['id'] != '' && $_POST['action'] == 'forgotpassword') {
          } else { ?> <p class="mb-32 text-secondary-light text-lg" style="font-size: 18px;">Enter Register Email Id</p><?php } ?>
          <?php if ($user['id'] == '' && $_POST['action'] == 'forgotpassword') { ?>
            <p class="text-lg text-secondary-light mb-32" style="color:#CC0000; "><strong>This email id not register with us.</strong></p>
          <?php } ?>

          <?php if ($user['id'] != '' && $_POST['action'] == 'forgotpassword') { ?>
            <p class="text-lg text-secondary-light mb-32" style="color:#009900;  "><strong>Updated password sent to your register email id</strong></p>
			<a href="login.html" class="text-primary-600 fw-medium" style="margin-top: 20px; display: block; text-align: center; background-color: #00a1e5; color: #fff; width: fit-content; padding: 8px 16px; border-radius: 6px;">Account Login   <img src="https://chalofly.com/admin/images/forward.png" style="width: 20px; margin-left: 3px;" /></a>
          <?php } ?>
        </div>
        <?php if ($user['id'] != '' && $_POST['action'] == 'forgotpassword') {
        } else { ?>
          <form id="loginForm" method="post">
            <div class="icon-field mb-16">
              <span class="icon top-50 translate-middle-y">
                <iconify-icon icon="mage:email"></iconify-icon>
              </span>
              <input name="email" type="email" id="email" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Email">
              <input type="hidden" name="action" value="forgotpassword">
            </div>



            <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-10 subbtnfor"> Submit</button>
            <a href="login.html" class="text-primary-600 fw-medium" style="margin-top:20px; display:block; text-align: center; background-color: #00a1e5; color: #fff; ">Account Login</a>





          </form>
        <?php } ?>
      </div>
    </div>
  </section>



  <script>
    // ================== Password Show Hide Js Start ==========
    function initializePasswordToggle(toggleSelector) {
      $(toggleSelector).on('click', function() {
        $(this).toggleClass("ri-eye-off-line");
        var input = $($(this).attr("data-toggle"));
        if (input.attr("type") === "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });
    }
    // Call the function
    initializePasswordToggle('.toggle-password');
    // ========================= Password Show Hide Js End ===========================
  </script>

  <script src="assets/jquery.md5.min.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript" charset="utf-8">
    jQuery(document).ready(function($) {
      $('#submitfrm').click(function() {
        $('#userpass').val($.MD5($('#userpass').val()));
        $('#loginForm').submit();
      });
    });
  </script>

</body>

</html>