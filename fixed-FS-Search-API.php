<?php  
include "inc.php";  
include "config/logincheck.php";


$newSessionId = trim($_SESSION['uniqueId']);

$tripType = trim($_REQUEST['?tripType']);

$fromDestinationFlight = trim($_REQUEST['fromDestinationFlight']);

$toDestinationFlight = trim($_REQUEST['toDestinationFlight']);

$journeyDateOne = trim($_REQUEST['journeyDateOne']);

$journeyDateRound = trim($_GET['journeyDateRound']);

$ADT = trim($_REQUEST['ADT']);

$CHD = trim($_REQUEST['CHD']);

$INF = trim($_REQUEST['INF']);

$PC = trim($_REQUEST['PC']);

$toalPaxFinal=$ADT+$CHD+$INF;

$toalPax=$ADT+$CHD+$INF;

$_SESSION['ADT']=$ADT;

$_SESSION['CHD']=$CHD;

$_SESSION['INF']=$INF;



if($tripType=='1'){ 
	 $journeyDate = date('Ymd',strtotime($journeyDateOne));
	 $returnDate = '';
}else{ 
	 $journeyDate = date('Ymd',strtotime($journeyDateOne));
	 $returnDate = date('Ymd',strtotime($journeyDateRound));
}

$fromdestexp = explode('-',$fromDestinationFlight);

$ORG_CODE=$fromdestexp[0];
$ORG_NAME=$fromdestexp[1];

$todestexp = explode('-',$toDestinationFlight);

$DES_CODE=$todestexp[0];
$DES_NAME=$todestexp[1];


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $flightSeriesBaseUrl.'api/v1/flights/series-search?segment='.$fromdestexp[0].'-'.$todestexp[0].'-'.$journeyDate.'&pax='.$ADT.'-'.$CHD.'-'.$INF,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'api-key: '.$flightSeriesApiKey,
    'Cookie: JSESSIONID=B427FB57BC177CA88E49876BDE35E50B; _vaS19id=9eeb13793ff3a0d5c26c55f2bc62e5aa; ssid=t1'
  ),
));

$responseAK = curl_exec($curl);


$resultAK=json_decode($responseAK,true);



foreach($resultAK["_data"]["flights"] as $data){

	$infant_price = $data["infant_price"];
	$child_price = $data["child_price"];
	$adult_price = $data["adult_price"];
	$total_price = $data["total_price"];
	$totalPaxFare=round($total_price);
	$FLIGHT_INFO ='7 Kg,15 Kg';
	$flightType='D';
	$currency = $data["currency"];
	$non_refundable = $data["non_refundable"];
	$SEAT = $data["seats_available"];
	$key = $data["key"];
	$duration=$data["segments"][0]["duration"]; //minutes
	$STOP = count($data["segments"]);
	
	if($non_refundable==true){
		$refundyes=0;
	}else{
		$refundyes=1;
	}


	$minutes = $duration;
$hours = floor($minutes / 60); // Get the number of whole hours
$minutes = $minutes % 60; // Get the remainder of the hours
$dur= $hours.'H '.$minutes.'M';
	

	if($tripType=='1'){
	/*One Way Segment*/
		$ARRV_DATE = date("Y-m-d",strtotime($data["segments"][0]["legs"][0]["arrival_time"]));
		$ARRV_TIME = date("H:i",strtotime($data["segments"][0]["legs"][0]["arrival_time"]));
		$DEP_DATE = date("Y-m-d",strtotime($data["segments"][0]["legs"][0]["departure_time"]));
		$DEP_TIME = date("H:i",strtotime($data["segments"][0]["legs"][0]["departure_time"]));
	}else{
	/*Return Segment*/
		$ARRV_DATE = date("Y-m-d",strtotime($data["segments"][0]["legs"][0]["arrival_time"]));
		$ARRV_TIME = date("H:s",strtotime($data["segments"][0]["legs"][0]["arrival_time"]));
		$DEP_DATE = date("Y-m-d",strtotime($data["segments"][1]["legs"][0]["departure_time"]));
		$DEP_TIME = date("H:s",strtotime($data["segments"][1]["legs"][0]["departure_time"]));
	}

	$FARE_TYPE='GOFS';
	$S_CODE=$fromdestexp[0]."-".$todestexp[0];

	$FLIGHT_NAME = $data["segments"][0]["legs"][0]["airline"];
	$FLIGHT_NO = $data["segments"][0]["legs"][0]["flight_number"];

	$totalTax=0;	
	$airline = $FLIGHT_NAME;
	
	$rsAPIs=GetPageRecord('name','sys_flightName','iataCode="'.$airline.'"');  
	$iatacoderes=mysqli_fetch_array($rsAPIs); 
	
 $airline = $iatacoderes['name'];
	
	$getCalCost=calculateflightcost(encode($agentid),$airline,$flightType,$FARE_TYPE,$toalPax,$totalPaxFare,$totalTax);
	
	$getCalCost2=calculateflightcostForAgent(encode($agentid),$airline,$flightType,$FARE_TYPE,$toalPax,$totalPaxFare,$totalTax);
	
	
	$getAgentTaxonly=calculateflightcostForAgentMarkup(encode($agentid),$airline,$flightType,$FARE_TYPE,$toalPax,$totalPaxFare,$totalTax);
	
	$getNetFare=calculateflightcostForAgentNetFare(encode($agentid),$airline,$flightType,$FARE_TYPE,$toalPax,$NET_FARE,$totalTax);
	
	$netamount = $getNetFare[0];
	
	$rsAPI=GetPageRecord('*','sys_userMaster','id=1');  
	$getapimarkup=mysqli_fetch_array($rsAPI); 
	
	if($getapimarkup['airiqApiMarkup']!='' && $getapimarkup['airiqApiMarkup']>0){ 
		$apimarkup=round($getCalCost2[1]*$getapimarkup['airiqApiMarkup']/100);
	} else { 
		$apimarkup=0;
	}
	
	
	$adfare='baseFare='.$totalPaxFare.',tax='.$totalTax.',totalFare='.($totalPaxFare+$totalTax);

	$agfare='baseFare='.$getCalCost2[2].',tax='.($getCalCost2[0]+$apimarkup).',totalFare='.($getCalCost2[1]+$apimarkup);

	$clfare='baseFare='.$getCalCost[2].',tax='.$getCalCost[0].',totalFare='.$getCalCost[1];
	
	?>
	<script>
//	alert('<?php echo $FARE_TYPE; ?>');
	</script>
	<?php
	
	$adminMarkup=($getCalCost2[1]-$getCalCost[1]);
	$totaldisplayTax=($getCalCost2[0]+$adminMarkup+$apimarkup)-($getAgentTaxonly[0]);
	
	$nefareamountnew=round($NET_FARE+$getCalCost['3']);
	
	$agentFixedMakup=round(agentfixmarkup(encode($agentid),$airline,$flightType,$FARE_TYPE,$toalPax,$getCalCost2[1],$totalTax));

	$agentFixedMakup=round(agentfixmarkup(encode($agentid),trim(str_replace(' ','',$airline)),$flightType,$FARE_TYPE,$toalPax,$getCalCost2[1],$totalTax));

$getFullName=GetPageRecord('name','sys_flightName','1 and iataCode="'.$FLIGHT_NAME.'" order by id asc');
$getFullName1=mysqli_fetch_array($getFullName);

$FLIGHT_INFO='15 KG,7KG';
	
$namevalue ='

 UID="",TID=""

 ,ResultIndex="'.$key.'"

 ,FIXEDID=""

 ,ORG_CODE="'.$ORG_CODE.'"

 ,apiType="FS"

 ,ORG_NAME="'.$ORG_NAME.'"

 ,DES_CODE="'.$DES_CODE.'"

 ,DES_NAME="'.$DES_NAME.'"

 ,DEP_DATE="'.$DEP_DATE.'"

 ,DEP_TIME="'.$DEP_TIME.'"

 ,ARRV_DATE="'.$ARRV_DATE.'"

 ,ARRV_TIME="'.$ARRV_TIME.'"

 ,FLIGHT_CODE="'.trim($FLIGHT_NAME).'"

 ,FLIGHT_NAME="'.$getFullName1["name"].'"

 ,FLIGHT_NO="'.trim($FLIGHT_NO).'"

 ,FARE_TYPE="'.$FARE_TYPE.'"

 ,SEAT="'.$SEAT.'"

 ,STOP="'.$STOP.'"

 ,AMT="'.$getCalCost2[1].'"

 ,DISPLAY_AMT="'.$AMT.'"

 ,DUR="'.$dur.'"

 ,S_CODE="'.$S_CODE.'"

 ,CN_CODE="'.$CN_CODE.'"

 ,OI=""

 ,PCC="'.$FARE_TYPE.'"

 ,TAX_BREAKUP="0"

 ,FLIGHT_INFO="'.$FLIGHT_INFO.'"

 ,agentFixedMakup="'.$agentFixedMakup.'"

 ,NET_FARE="'.$getCalCost2[1].'"

 ,refundyes=""

 ,AirlineRemark=""

 ,F_CLASS=""

 ,SECTOR="'.$flightType.'"

,uniqueSessionId="'.$_SESSION['uniqueSessionId'].'"

 ,CON_DETAILS=""

 ,PARAM_DATA="",agentId="'.$_SESSION['agentUserid'].'"

 ,searchJson="'.addslashes(serialize($data)).'"

 ,tripType=1

 ,acom="0"

 ,netFareBeforecomm="'.($getCalCost2[1]+$apimarkup).'"

 ,adfare="'.$adfare.'",agfare="'.$agfare.'",clfare="'.$clfare.'",agentMarkup="'.$getAgentTaxonly[0].'",adminMarkup="'.$adminMarkup.'",totalTax="'.$totaldisplayTax.'"';

addlistinggetlastid('wig_flight_json_bkp',$namevalue); 



	
}
?>