<?php

session_start();

$otp = trim($_POST['otp']);
$email = trim($_POST['email']);



if(
    empty($_SESSION['email_otp']) ||
    empty($_SESSION['otp_email'])
){

    echo json_encode([
        "status" => false,
        "message" => "OTP not generated"
    ]);

    exit;
}



// Expiry check
if((time() - $_SESSION['otp_time']) > 300){

    unset($_SESSION['email_otp']);

    echo json_encode([
        "status" => false,
        "message" => "OTP Expired"
    ]);

    exit;
}



if(
    $_SESSION['email_otp'] == $otp &&
    $_SESSION['otp_email'] == $email
){

    $_SESSION['email_verified'] = true;

    echo json_encode([
        "status" => true,
        "message" => "Email Verified"
    ]);

} else {

    echo json_encode([
        "status" => false,
        "message" => "Invalid OTP"
    ]);
}