<?php
function createTimeArrDept($time)
{
    $finalDate = date("H:i", strtotime(date("Y-m-d") . " " . $time));
    return $finalDate;
}

$Rurl = APISEARCH;
$FlightCabinClass="2";

if ($cabinclass == "ECONOMY") {
    $FlightCabinClass = "2";
}
if ($cabinclass == "PREMIUM_ECONOMY") {
    $FlightCabinClass = "3";
}
if ($cabinclass == "BUSINESS") {
    $FlightCabinClass = "4";
}

if ($cabinclass == "PremiumBusiness") {
    $FlightCabinClass = "5";
}

if ($cabinclass == "FIRST") {
    $FlightCabinClass = "6";
}


$TokenId = $_SESSION["tbotokenId"];
$dirflt = "false";
$oneflt = "false";
$prefer = "";

$type = "MultiCity";

$ip = $_SERVER["REMOTE_ADDR"];
$_SESSION["EndUserIp"] = $ip;

if ($tripType == "1") {
    $journeyDate = date("Y-m-d", strtotime($journeyDateOne));
    $returnDate = "";
} else {
    $journeyDate = date("Y-m-d", strtotime($journeyDateOne));
    $returnDate = date("Y-m-d", strtotime($journeyDateRound));
}

$fromdestexp = explode("-", $fromDestinationFlight);
$todestexp = explode("-", $toDestinationFlight);

$adult = $ADT;
$child = $CHD;
$infant = $INF;
$toalPax = $adult + $child + $infant;
if ($_SESSION["directflight"] == 1) {
    $dirflt = "true";
} else {
    $dirflt = "false";
}
$oneflt = "false";
$prefer = "";
$departdate = $journeyDate;
$returnDate = $returnDate;
$origin = $fromdestexp[0];
$destination = $todestexp[0];

$toalPaxFinal = $ADT + $CHD + $INF;
$toalPax = $ADT + $CHD;

$segments1='{
      "Origin": "'.$origin.'",
      "Destination": "'.$destination.'",
      "FlightCabinClass": "'.$FlightCabinClass.'",
      "PreferredDepartureTime": "'.$departdate.'T00: 00: 00",
      "PreferredArrivalTime": "'.$departdate.'T00: 00: 00"
    }';

$segments2='';
if($fromDestinationFlight2!="" && $toDestinationFlight2!="" && $journeyDate2!=""){
	$segments2.=',{
      "Origin": "'.explode('-',$fromDestinationFlight2)[0].'",
      "Destination": "'.explode('-',$toDestinationFlight2)[0].'",
      "FlightCabinClass": "'.$FlightCabinClass.'",
      "PreferredDepartureTime": "'.$journeyDate2.'T00: 00: 00",
      "PreferredArrivalTime": "'.$journeyDate2.'T00: 00: 00"
    }';
}

$segments3='';
if($fromDestinationFlight3!="" && $toDestinationFlight3!="" && $journeyDate3!=""){
	$segments3.=',{
      "Origin": "'.explode('-',$fromDestinationFlight3)[0].'",
      "Destination": "'.explode('-',$toDestinationFlight3)[0].'",
      "FlightCabinClass": "'.$FlightCabinClass.'",
      "PreferredDepartureTime": "'.$journeyDate3.'T00: 00: 00",
      "PreferredArrivalTime": "'.$journeyDate3.'T00: 00: 00"
    }';
}

$segments4='';
if($fromDestinationFlight4!="" && $toDestinationFlight4!="" && $journeyDate4!=""){
	$segments4.=',{
      "Origin": "'.explode('-',$fromDestinationFlight4)[0].'",
      "Destination": "'.explode('-',$toDestinationFlight4)[0].'",
      "FlightCabinClass": "'.$FlightCabinClass.'",
      "PreferredDepartureTime": "'.$journeyDate4.'T00: 00: 00",
      "PreferredArrivalTime": "'.$journeyDate4.'T00: 00: 00"
    }';
}
$segments5='';
if($fromDestinationFlight5!="" && $toDestinationFlight5!="" && $journeyDate5!=""){	
	$segments5.=',{
      "Origin": "'.explode('-',$fromDestinationFlight5)[0].'",
      "Destination": "'.explode('-',$toDestinationFlight5)[0].'",
      "FlightCabinClass": "'.$FlightCabinClass.'",
      "PreferredDepartureTime": "'.$journeyDate5.'T00: 00: 00",
      "PreferredArrivalTime": "'.$journeyDate5.'T00: 00: 00"
    }';
}

$string=($segments1.$segments2.$segments3.$segments4.$segments5);
	$opta = '{
        "EndUserIp" : "'.$ip.'",
        "TokenId" : "'.$TokenId.'",
        "AdultCount" : "'.$adult.'",
        "ChildCount" : "'.$child.'",
        "InfantCount" : "'.$infant.'",
        "JourneyType" : "3",
        "PreferredAirlines" : "",
        "Segments" : [
           '.$string.'
        ]
    }';

$search_result = [];

try {
	$req = $opta;
    $req = file_put_contents("FLYTBOJSON/SearchReq2.txt", "$req");
    $postdata = file_get_contents("FLYTBOJSON/SearchReq2.txt", "$req"); //Take JSON input from Postman Client
    //echo $postdata; //exit;
    $header = ["Content-Type: application/json", "Accept-Encoding: gzip"];
    $restCaller = new RestApiCaller();
    $flightRes = $restCaller->post($Rurl, $postdata, $header);
    $result = file_put_contents(
        "FLYTBOJSON/" . $agentId . "_TBOSearchRes2.txt",
        "$flightRes"
    );
    $search_result = json_decode($flightRes, true);
} catch (Exception $e) {
    $errhdng = "Technical Error !!";
    $errmsg = "Sorry Due To Some Technical Issue, Flights Result Are Not Found.";
    exit();
}

$publishFareInner2 = 0;
$NetFareInner2 = 0;
$fareTypeInnerDetail = "";
$flightTypeStatus = 1; // for TBO

$_SESSION["search_result"] = $search_result;
$TraceId = $search_result["Response"]["TraceId"];
$_SESSION["TraceId"] = $TraceId;
if (is_array($search_result["Response"]["Results"][0])) {
    $WSResult = $search_result["Response"]["Results"][0];
} else {
    $WSResult = $search_result;
}


foreach($WSResult as $valArray){
	
	$PARAM_DATA=addslashes(serialize($valArray));
	$ResultIndex = $valArray["ResultIndex"];
	
    $IsBookableIfSeatNotAvailable = $valArray["IsBookableIfSeatNotAvailable"];
    $Source = $valArray["Source"];
   
    if($valArray["IsLCC"]==true){
		$IsLCC = 1;
	}else{
		$IsLCC = 0;
	}
   
    $ResultFareType = $valArray["ResultFareType"];

	if($valArray["IsRefundable"] == true){
        $refstatus = "1";
    }else{
        $refstatus = "0";
    }
    
	$remarks = $valArray["AirlineRemark"];
	$BaseFare = round($valArray["Fare"]["BaseFare"]);
    $Tax = round($valArray["Fare"]["Tax"]);
    $PublishedFare = round($valArray["Fare"]["PublishedFare"]);
    $CommissionEarned = round(
        $valArray["Fare"]["CommissionEarned"] + $valArray["Fare"]["PLBEarned"]
    );
    $OfferedFare = round($valArray["Fare"]["OfferedFare"]); //offered fare
    $FareBasisCode = $valArray["FareClassification"]["Color"];
	
	if($NoOfSeatAvailable){
        $NoOfSeatAvailable = $NoOfSeatAvailable;
    }else{
        $NoOfSeatAvailable = "9";
    }

    if($FareBasisCode){
        $FareBasisCode = $FareBasisCode;
    }else{
        $FareBasisCode = "";
    }
	
	$TAX_BREAKUP = "ab=" . $BaseFare . ",ay=0,at=" . $Tax;
	
	/* TBO Markup */
    $fareTypeInnerDetail = $FareBasisCode; //PCC
    $flightTypeStatus = 2;
    $FIXEDID = "";
    $api = "TBO";

    $flightType = "D";
    $totalTax = round($Tax);

    $i = 1;
    $baseFare = 0;
    $surcharge = 0;

    if ($FareBasisCode == "RosyBrown") {
        $totalPaxFare = $PublishedFare - $totalTax;
    } else {
        $totalPaxFare = round($BaseFare);
    }
	
	$getCalCost = calculateflightcost(
        encode($agentid),
        trim(str_replace(" ", " ", $airline)),
        $flightType,
        $FareBasisCode,
        $toalPax,
        $totalPaxFare,
        $totalTax
    );
    $getCalCost2 = calculateflightcostForAgent(
        encode($agentid),
        trim(str_replace(" ", " ", $airline)),
        $flightType,
        $FareBasisCode,
        $toalPax,
        $totalPaxFare,
        $totalTax
    );
    $getAgentTaxonly = calculateflightcostForAgentMarkup(
        encode($agentid),
        trim(str_replace(" ", " ", $airline)),
        $flightType,
        $FareBasisCode,
        $toalPax,
        $totalPaxFare,
        $totalTax
    );

    if ($totalPaxFare == getAgentCommission($totalPaxFare,trim(str_replace(" ", "", $airline)),$ResultFareType)) {
        $netamount = round($getCalCost[1]);
    } else {
        $netamount = round(
            $getCalCost2[1] -
                getAgentCommission(
                    $totalPaxFare,
                    trim(str_replace(" ", "", $airline)),
                    $ResultFareType
                )
        );
    }

    $flightinfodata = explode("|", $flightList->FLIGHT_INFO);
    $rsAPI = GetPageRecord("*", "sys_userMaster", "id=1");
    $getapimarkup = mysqli_fetch_array($rsAPI);
	
	if (
        $getapimarkup["tboApiMarkup"] != "" &&
        $getapimarkup["tboApiMarkup"] > 0
    ) {
        $apimarkup = round(
            ($getCalCost2[1] * $getapimarkup["tboApiMarkup"]) / 100
        );
    } else {
        $apimarkup = 0;
    }
	
	$adfare =
        "baseFare=" .
        $totalPaxFare .
        ",tax=" .
        $totalTax .
        ",totalFare=" .
        ($totalPaxFare + $totalTax);
    $agfare =
        "baseFare=" .
        $getCalCost2[2] .
        ",tax=" .
        ($getCalCost2[0] + $apimarkup) .
        ",totalFare=" .
        ($getCalCost2[1] + $apimarkup);
    $clfare =
        "baseFare=" .
        $getCalCost2[2] .
        ",tax=" .
        $getCalCost2[0] .
        ",totalFare=" .
        $getCalCost2[1];
    $nefareamountnew = round($OfferedFare + $getCalCost["3"]);
	
	$adminMarkup = $getCalCost2[1] - ($totalPaxFare + $totalTax);
    $totaldisplayTax =
        $getCalCost2[0] + $adminMarkup + $apimarkup - $getAgentTaxonly[0];

    $getNetFare = calculateflightcostForAgentNetFare(
        encode($agentid),
        trim(str_replace(" ", "", $airline)),
        $flightType,
        $FareBasisCode,
        $toalPax,
        $OfferedFare,
        $totalTax
    );
    $netamount = $getNetFare[0];
	
	$commissiondeff = round($CommissionEarned);
	
	$netFareBeforecomm = $getCalCost2[1] + $apimarkup - $commissiondeff;

	if($commissiondeff > 0){
		$tds = round(($commissiondeff * 5) / 100);
        $gst = round(($commissiondeff * 18) / 100);
        $netFareBeforecomm = $netFareBeforecomm + $tds + $gst;
	}
		
	$agentFixedMakup = round(
            agentfixmarkup(
                encode($agentid),
                trim(str_replace(" ", "", $airline)),
                $flightType,
                $FareBasisCode,
                $toalPax,
                $getCalCost2[1],
                $totalTax
            )
        );

	foreach($valArray["Segments"] as $Segments){
		
		$fno = $Segments[0]["Airline"]["FlightNumber"];
		$PC = $Segments[0]["Airline"]["FareClass"];
		$airline = $Segments[0]["Airline"]["AirlineName"];
		$airlinecode = $Segments[0]["Airline"]["AirlineCode"];
		$NoOfSeatAvailable = $Segments[0]["NoOfSeatAvailable"];
		$flight_segment = count($Segments)-1;
		$dep_code = $Segments[0]["Origin"]["Airport"]["AirportCode"];
		$depcityy = $Segments[0]["Origin"]["Airport"]["CityName"];
		
		$msdate2 = $Segments[0]["Origin"]["DepTime"];
		$msdate2 = explode("T", $msdate2);
		
		$arr_codee = $Segments[count($Segments)-1]["Destination"]["Airport"]["AirportCode"];
		$arrcityy = $Segments[count($Segments)-1]["Destination"]["Airport"]["CityName"];
		
		$msdate1 = $Segments[count($Segments)-1]["Destination"]["ArrTime"];
		$msdate1 = explode("T", $msdate1);
		
		$S_CODE = $dep_code . "-" . $arr_codee;
		$CN_CODE = $airlinecode . " " . $fno;
		$FLIGHT_INFO = $Segments[0]["Baggage"] . "," . $Segments[0]["CabinBaggage"];
		$Duration=0;
		for($i=0;$i<count($Segments);$i++){
			$Duration+=$Segments[$i]["Duration"];
		}
		$AccumulatedDuration = intdiv($Duration, 60)."H :".$Duration % 60 ." M";
$namevalue ='UID="",TID="'.$TraceId.'",ResultIndex="'.$ResultIndex.'",ORG_CODE="'.$dep_code.'",apiType="tbo",ORG_NAME="'.$depcityy.'",DES_CODE="'.$arr_codee.'",DES_NAME="'.$arrcityy.'",DEP_DATE="'.$msdate2['0'].'",DEP_TIME="'.createTimeArrDept($msdate2['1']).'",ARRV_DATE="'.$msdate1['0'].'",ARRV_TIME="'.createTimeArrDept($msdate1['1']).'",FLIGHT_CODE="'.trim($airlinecode).'",FLIGHT_NAME="'.$airline.'",FLIGHT_NO="'.trim($fno).'",FARE_TYPE="'.$ResultFareType.'",SEAT="'.$NoOfSeatAvailable.'",STOP="'.$flight_segment.'",AMT="'.$getCalCost2[1].'",DISPLAY_AMT="'.$PublishedFare.'",DUR="'.$AccumulatedDuration.'",S_CODE="'.$S_CODE.'",CN_CODE="'.$CN_CODE.'",OI="",PCC="'.$FareBasisCode.'",TAX_BREAKUP="0",FLIGHT_INFO="'.$FLIGHT_INFO.'",NET_FARE="'.$OfferedFare.'",refundyes="'.$refstatus.'",AirlineRemark="",F_CLASS="'.$PC.'",SECTOR="",adfare="'.$adfare.'",agfare="'.$agfare.'",clfare="'.$clfare.'",CON_DETAILS="",PARAM_DATA="'.addslashes(serialize($valArray)).'",agentId="'.$_SESSION['agentUserid'].'",searchJson="'.addslashes(serialize($Segments)).'",tripType=3,acom="'.$commissiondeff.'",IsLCC="'.$IsLCC.'",netFareBeforecomm="'.(($getCalCost2[1]+$apimarkup)-$commissiondeff).'",agentMarkup="'.$getAgentTaxonly[0].'",adminMarkup="'.$adminMarkup.'",totalTax="'.$totaldisplayTax.'",uniqueSessionId="'.$_SESSION['uniqueSessionId'].'",finalPayAmount="'.$netFareBeforecomm.'",agentFixedMakup="'.$agentFixedMakup.'"';


addlistinggetlastid("wig_flight_json_bkp", $namevalue);
		
		
		
	}
	
}
?>