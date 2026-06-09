<?php 
include "inc.php"; 
include "config/logincheck.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);


$newSessionId = trim($_SESSION['uniqueId']);
$tripType = trim($_REQUEST['tripType']);
$fromDestinationFlight = trim($_REQUEST['fromDestinationFlight']);
$toDestinationFlight = trim($_REQUEST['toDestinationFlight']);
$journeyDateOne = trim($_REQUEST['journeyDateOne']);
$journeyDateRound = trim($_GET['journeyDateRound']);

$ADT = trim($_REQUEST['ADT']);
$cabinclass = trim($_REQUEST['PC']);
$CHD = trim($_REQUEST['CHD']);
$INF = trim($_REQUEST['INF']);
$PC = trim($_REQUEST['PC']);
$toalPaxFinal=$ADT+$CHD+$INF;
$toalPax=$ADT+$CHD;

if($tripType=='1'){ 
	 $journeyDate = date('Y-m-d',strtotime($journeyDateOne));
	 $returnDate = '';
}else{ 
	 $journeyDate = date('Y-m-d',strtotime($journeyDateOne));
	 $returnDate = date('Y-m-d',strtotime($journeyDateRound));
}

$fromdestexp = explode('-',$fromDestinationFlight);
$todestexp = explode('-',$toDestinationFlight);

if (strstr($fromdestexp[1],'India')=='India' && strstr($todestexp[1],'India')=='India') {
  $SECTOR = 'D';
} else {
  $SECTOR = 'I';
}

 
 
 // **************** TBO API **************************
 
include dirname(__FILE__).'/FLYTBOAPI/APIConstants.php';
include dirname(__FILE__).'/FLYTBOAPI/RestApiCaller.php';
include dirname(__FILE__).'/FLYTBOAPI/FlightAuthentication.php';


// Token Generate 
if(!isset($_SESSION['tbotokenId']) || $_SESSION['tbotokenId']=='')

{

	include dirname(__FILE__).'/FLYTBOAPI/FlightAuthentication2.php';

	$_SESSION['tbotokenId']=$json['TokenId'];

}	

 include dirname(__FILE__).'/FLYTBOAPI/FlightSearch2.php';
 

updatelisting('wig_flight_json_bkp','endSearch=1',' uniqueSessionId="'.$_SESSION['uniqueSessionId'].'"  ');

?>