<?php 
include "inc.php"; 
include "config/logincheck.php";

$newSessionId = trim($_SESSION['uniqueId']);
$tripType = trim($_REQUEST['tripType']);
$cabinclass = trim($_REQUEST['PC']);
$ADT = trim($_REQUEST['ADT']);
$CHD = trim($_REQUEST['CHD']);
$INF = trim($_REQUEST['INF']);
$PC = trim($_REQUEST['PC']);
$toalPaxFinal=$ADT+$CHD+$INF;
$toalPax=$ADT+$CHD;

$fromDestinationFlight = trim($_REQUEST['fromDestinationFlight']);
$toDestinationFlight = trim($_REQUEST['toDestinationFlight']);
$journeyDateOne = trim($_REQUEST['journeyDateOne']);
$journeyDate = date('Y-m-d',strtotime($journeyDateOne));
$journeyDateRound = trim($_GET['journeyDateRound']);

$fromDestinationFlight2 = trim($_REQUEST['fromDestinationFlight2']);
$toDestinationFlight2 = trim($_REQUEST['toDestinationFlight2']);
$journeyDate2 = trim($_REQUEST['journeyDate2']);
$journeyDate2 = date("Y-m-d", strtotime($journeyDate2));

$fromDestinationFlight3 = trim($_REQUEST['fromDestinationFlight3']);
$toDestinationFlight3 = trim($_REQUEST['toDestinationFlight3']);
$journeyDate3 = trim($_REQUEST['journeyDate3']);
$journeyDate3 = date("Y-m-d", strtotime($journeyDate3));

$fromDestinationFlight4 = trim($_REQUEST['fromDestinationFlight4']);
$toDestinationFlight4 = trim($_REQUEST['toDestinationFlight4']);
$journeyDate4 = trim($_REQUEST['journeyDate4']);
$journeyDate4 = date("Y-m-d", strtotime($journeyDate4));

$fromDestinationFlight5 = trim($_REQUEST['fromDestinationFlight5']);
$toDestinationFlight5 = trim($_REQUEST['toDestinationFlight5']);
$journeyDate5 = trim($_REQUEST['journeyDate5']);
$journeyDate5 = date("Y-m-d", strtotime($journeyDate5));

$fromdestexp = explode('-',$fromDestinationFlight);
$todestexp = explode('-',$toDestinationFlight);


if(strstr($fromdestexp[1],'India')=='India' && strstr($todestexp[1],'India')=='India') {
  $SECTOR = 'D';
}else{
  $SECTOR = 'I';
}

 
 // **************** TBO API **************************
 
include dirname(__FILE__).'/FLYTBOAPI/APIConstants.php';
include dirname(__FILE__).'/FLYTBOAPI/RestApiCaller.php';
include dirname(__FILE__).'/FLYTBOAPI/FlightAuthentication.php';

// Token Generate 
if(!isset($_SESSION['tbotokenId']) || $_SESSION['tbotokenId']==''){
	include dirname(__FILE__).'/FLYTBOAPI/FlightAuthentication2.php';
	$_SESSION['tbotokenId']=$json['TokenId'];
}
$_SESSION['tbotokenId']=$json['TokenId'];


include dirname(__FILE__).'/FLYTBOAPI/FlightSearch2MultiCity.php';

updatelisting('wig_flight_json_bkp','endSearch=1',' uniqueSessionId="'.$_SESSION['uniqueSessionId'].'"  ');

?>