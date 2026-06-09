<?php 

session_start();



if(!empty($_REQUEST['mobapp']) && $_REQUEST['mobapp']==1){

$_SESSION['mobileapppage']=1;

}





if(!empty($_REQUEST['mobileapppage']) && $_SESSION['mobileapppage']==1){

include "mobilehomepage.php"; 

} else {

include "flightpage.php"; 
//include "flightpage1.php"; 
//include "flightpage_new.php"; 

}



?>

 