<?php
session_start();
include "inc.php"; 
$email = trim($_POST['email']);
// Email validation
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

    echo json_encode([
        "status" => false,
        "message" => "Invalid Email"
    ]);

    exit;
}

// Rate limit
if(isset($_SESSION['last_otp_time']) && (time() - $_SESSION['last_otp_time']) < 60){

    echo json_encode([
        "status" => false,
        "message" => "Please wait 60 seconds"
    ]);

    exit;
}
else{
unset($_SESSION['email_verified']);
unset($_SESSION['email_otp']);
unset($_SESSION['otp_email']);
}
// Generate OTP
$otp = rand(100000,999999);
$_SESSION['email_otp'] = $otp;
$_SESSION['otp_email'] = $email;
$_SESSION['otp_time'] = time();
$_SESSION['last_otp_time'] = time();

// Email Subject
$subject = "Your Email Verification OTP";

// Email Body
$mailbody = '

<table width="100%"
border="1"
cellpadding="10"
cellspacing="0"
style="border-collapse:collapse;
font-family:Arial;">

<tr>
<td align="center">

<h2>Email Verification</h2>

<p>
Your OTP code is:
</p>

<h1>'.$otp.'</h1>

<p>
OTP valid for 5 minutes.
</p>

</td>
</tr>

</table>

';
// Send Mail
senddesignedmail( $email, $subject, $mailbody, '');



echo json_encode([
    "status" => true,
    "message" => "OTP Sent Successfully"
]);