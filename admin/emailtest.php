<?php
session_start();
include "inc.php";
//include "config/mail.php";

$fromemail='info@chalofly.com';

$email='shiwansh@yopmail.com';

$subject='Test';

$mailbody='Hello World';

$ccmail='';

$file_name='';

senddesignedmail($fromemail,$email,$subject,$mailbody,$ccmail,$file_name,$fullurl);

exit();
