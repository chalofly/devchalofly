<?php
include "inc.php";
include "config/logincheck.php"; 

$randbookingid='OFF-'.rand(11111111,99999999);
$bookingMethod=trim($_REQUEST["bookingMethod"]);
unset($_SESSION["bookingData"]);

/*
$a=GetPageRecord('*','wig_flight_json_bkp',' id="'.decode(decode($_REQUEST['flightone'])).'" and agentId="'.$_SESSION['agentUserid'].'"');
$res=mysqli_fetch_array($a);

*/



if($bookingMethod==0){

	
$uniqueSessionId=base64_encode(time());

$basefareret=0; 

$ab=GetPageRecord('*','wig_flight_json_bkp',' id="'.decode(decode($_REQUEST['flighttwo'])).'" and agentId="'.$_SESSION['agentUserid'].'"');

$resret=mysqli_fetch_array($ab);



$finalAgentTax=$res['agentMarkup'];

$retrunflightoffline=offlineflight($_SESSION['agentUserid'],$resret['FLIGHT_NAME'],$resret['PCC']);

if($resret['id']!=''){
$str_arr = explode (",", $resret['agfare']);   
$basefareret = explode ("=", $str_arr[2]); 
$basefareret = $basefareret[1];
}




$a=GetPageRecord('*','wig_flight_json_bkp',' id="'.decode(decode($_REQUEST['flightone'])).'" and agentId="'.$_SESSION['agentUserid'].'"');
$res=mysqli_fetch_array($a);

$onewayflightoffline=offlineflight($_SESSION['agentUserid'],$res['FLIGHT_NAME'],$res['PCC']);
$str_arr = explode (",", $res['agfare']);   
$basefare = explode ("=", $str_arr[2]); 


$discountPrice=0;
$cashbackPrice=0;

if($res['discountType']==1 && $res["couponType"]==1){
$discountPrice=$res['discount'];
}

if($res['discountType']==2 && $res["couponType"]==1){
$discountPrice=trim(($res['discount']*($basefare[1]+$basefareret))/100);
}


if($res['discountType']==1 && $res["couponType"]==2){
$cashbackPrice=$res['discount'];
}

if($res['discountType']==2 && $res["couponType"]==2){
$cashbackPrice=trim(($res['discount']*($basefare[1]+$basefareret))/100);
}



$totalPayableAmount=($basefare[1]+$basefareret)-$discountPrice;


/*
if($_POST['flightone']!='' && $res['id']>0 && $res['id']!="" && $_POST['flightbooking']==1 && $totalwalletBalance>=$totalPayableAmount){


if($totalPayableAmount<900){
	exit();
}
*/


$bookingpro=1;

$adultmain=$_SESSION['ADT'];
$childmain=$_SESSION['CHD'];
$infantmain=$_SESSION['INF'];


$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['agentUserid'].'" '); 
$AgentWebsiteData=mysqli_fetch_array($rs);



$bl=GetPageRecord('*','taxMaster','id=1 ');
$taxData=mysqli_fetch_array($bl);


$source=$res['ORG_NAME'].'-'.$res['ORG_CODE'];
$destination=$res['DES_NAME'].'-'.$res['DES_CODE'];
$journeyDate=$res['DEP_DATE'];
$sector=$res['sector'];
$bookingDate=date('Y-m-d H:i:s');
$agentId=$_SESSION['agentUserid'];
$PCC=$res['FARE_TYPE'];
$flightName=$res['FLIGHT_NAME'];
$flightNo=$res['FLIGHT_NO'];
$arrivalTime=$res['ARRV_TIME'];
$arrivalDate=$res['ARRV_DATE'];
$departureTime=$res['DEP_TIME'];
$clientBaseFare=$res['DEP_TIME'];
$agentFixedMakup=$res['agentFixedMakup'];
$markup = '0';
$agentMarkup = '0';
$bookingType = '0'; 

if($res['F_CLASS']=='EC'){ $flightClass='Economy'; } else { $flightClass='Business'; } 

$totalBaggage=str_replace(':',': ',str_replace(',',', ',str_replace('=',': ',$res['FLIGHT_INFO'])));

$flightStop=$res['STOP'];
$agentCommision=$res['acom'];


	$clientFareOW = json_decode(taxBreakupFunc($res['clfare']));
	$bareFare = $clientFareOW->bareFare;
	$tax = $clientFareOW->tax;
	$totalFare = $clientFareOW->totalFare;

	//Price of admin fare onward flight

	$adminFareOW = json_decode(taxBreakupFunc($res['adfare']));
	$adminBaseFareOW = $adminFareOW->bareFare;
	$adminTaxOW = $adminFareOW->tax;
	$adminTotalOW = $adminFareOW->totalFare;
	

	//Price of agent fare onward flight

	$agentFareOW = json_decode(taxBreakupFunc($res['agfare']));
	$agentBaseFareOW = $agentFareOW->bareFare;
	$agentTaxOW = $agentFareOW->tax;
	$agentTotalOW = $agentFareOW->totalFare;

	if($taxData['applicableType']=='commission'){
		$agentFinalGST=(($_REQUEST['acom']*$taxData['valuePerc'])/100);
	}

	if($taxData['applicableType']=='totalfare'){
		$agentFinalGST=(($adminBaseFareOW*$taxData['valuePerc'])/100);
	}


$finalFlightname=$flightName;
$finalFareTypename=$PCC;


$namevalue ='uniqueSessionId="'.$uniqueSessionId.'",apiType="FS",source="'.$source.'",status=1,destination="'.$destination.'",journeyDate="'.$journeyDate.'",tripType="1",sector="'.$sector.'",bookingDate="'.$bookingDate.'",agentId="'.$agentId.'",bookingNumber="",pcc="'.$PCC.'",flightName="'.$flightName.'",flightNo="'.$flightNo.'",arrivalTime="'.$arrivalTime.'",arrivalDate="'.$arrivalDate.'",departureTime="'.$departureTime.'",clientBaseFare="'.$bareFare.'",clientTax="'.$tax.'",clientTotalFare="'.$totalFare.'",baseFare="'.$adminBaseFareOW.'",tax="'.$adminTaxOW.'",totalFare="'.$adminTotalOW.'",agentBaseFare="'.$agentBaseFareOW.'",agentTax="'.$agentTaxOW.'",agentTotalFare="'.$agentTotalOW.'",markup="'.$markup.'",agentMarkup="'.$agentMarkup.'",bookingType="'.$bookingType.'",flightClass="'.$flightClass.'",totalBaggage="'.$totalBaggage.'",flightStop="'.$flightStop.'",agentCommision="'.$agentCommision.'",taxApplicableType="'.$taxData['applicableType'].'",taxValuePerc="'.$taxData['valuePerc'].'",taxApplicableOn="'.$taxData['applicableOn'].'",agentFinalGST="'.$agentFinalGST.'",detailArray="'.addslashes($res['searchJson']).'",couponCode="'.$res['couponCode'].'",discountType="'.$res['discountType'].'",couponValue="'.$res['couponValue'].'",couponType="'.$res['couponType'].'",agentFixedMakup="'.$res['agentFixedMakup'].'"';  

$bookinglastId = addlistinggetlastid('flightBookingMaster',$namevalue); 


if($res["couponType"]==2){
$a11 ='agentId="'.$_SESSION['agentUserid'].'",amount="'.$cashbackPrice.'",remarks="Cashback offer",paymentMethod="Online",transactionId="'.encode($bookinglastId).'", paymentType="Credit",bookingId="'.encode($bookinglastId).'",bookingType="Flight",addedBy="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_balanceSheet',$a11);
}


for ($adult = 0; $adult <= $adultmain; $adult++){
	$guestname=addslashes($_POST['firstNameAdt'.$adult]);
}

$guestname = trim($guestname);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$companyName = trim($_POST['companyName']);
$gstNo = trim($_POST['gstNo']);
$gstEmail = trim($_POST['gstEmail']);
$address = addslashes($_POST['address']);


if($guestname!='' && $email!=''){
$rs5=GetPageRecord('*','clientMaster',' email="'.$email.'"'); 
$count=mysqli_num_rows($rs5);
$editresult=mysqli_fetch_array($rs5);
if($count>0){
$clientId = $editresult['id'];
}else{
$namevalue ='clientType="1",name="'.$guestname.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",addDate="'.date('Y-m-d h:i:s').'"';
$clientId = addlistinggetlastid('clientMaster',$namevalue);
}

}


$paxInfo='';

//-------------Adult-----------------
for ($adult = 0; $adult <= $adultmain; $adult++) { 

if(trim($_POST['titleAdt'.$adult])!=""){

$namevalue ='BookingId="'.$bookinglastId.'",bookingNumber="'.$bookinglastId.'",title="'.trim($_POST['titleAdt'.$adult]).'",firstName="'.trim($_POST['firstNameAdt'.$adult]).'",lastName="'.trim($_POST['lastNameAdt'.$adult]).'",dob="'.date('Y-m-d',strtotime($_POST['dobAdt'.$adult])).'",nationality="'.trim($_POST['nationalityAdt'.$adult]).'",passportNumber="'.trim($_POST['passportNumberAdt'.$adult]).'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="adult"';
addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue);

$paxInfo.='{
            "title": "'.trim($_POST['titleAdt'.$adult]).'",
            "first_name": "'.trim($_POST['firstNameAdt'.$adult]).'",
            "last_name": "'.trim($_POST['lastNameAdt'.$adult]).'",
            "type": "adult",
            "dob": "'.date('Y-m-d',strtotime($_POST['dobAdt'.$adult])).'",
            "nationality": "IN",
            "passport_num": ""
        },';
}

}


//-------------Child-----------------
for ($child = 0; $child <= $childmain; $child++){

if(trim($_POST['titleChd'.$child])!=""){
$namevalue ='BookingId="'.$bookinglastId.'",bookingNumber="'.$bookinglastId.'",title="'.trim($_POST['titleChd'.$child]).'",firstName="'.trim($_POST['firstNameChd'.$child]).'",lastName="'.trim($_POST['lastNameChd'.$child]).'",dob="'.date('Y-m-d',strtotime($_POST['dobChd'.$child])).'",nationality="'.trim($_POST['nationalityChd'.$child]).'",passportNumber="'.trim($_POST['passportNumberChd'.$child]).'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="child"';
addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue);

$paxInfo.='{
            "title": "'.trim($_POST['titleChd'.$adult]).'",
            "first_name": "'.trim($_POST['firstNameChd'.$adult]).'",
            "last_name": "'.trim($_POST['lastNameChd'.$adult]).'",
            "type": "child",
            "dob": "'.date('Y-m-d',strtotime($_POST['dobChd'.$adult])).'",
            "nationality": "IN",
            "passport_num": ""
        },';
}

}

for($infant = 0; $infant <= $infantmain; $infant++) { 

if(trim($_POST['titleInf'.$infant])!=""){

$namevalue ='BookingId="'.$bookinglastId.'",bookingNumber="'.$bookinglastId.'",title="'.trim($_POST['titleInf'.$infant]).'",firstName="'.trim($_POST['firstNameInf'.$infant]).'",lastName="'.trim($_POST['lastNameInf'.$infant]).'",dob="'.date('Y-m-d',strtotime($_POST['dobInf'.$infant])).'",nationality="'.trim($_POST['nationalityInf'.$infant]).'",passportNumber="'.trim($_POST['passportNumberInf'.$infant]).'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="infant"';
addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue); 


$paxInfo.='{
            "title": "'.trim($_POST['titleInf'.$adult]).'",
            "first_name": "'.trim($_POST['firstNameInf'.$adult]).'",
            "last_name": "'.trim($_POST['lastNameInf'.$adult]).'",
            "type": "infant",
            "dob": "'.date('Y-m-d',strtotime($_POST['dobInf'.$adult])).'",
            "nationality": "IN",
            "passport_num": ""
        },';

}

}


$dd=unserialize(stripslashes($res['searchJson']));
$total_price=$dd["total_price"];
$flight_keys=$dd["flight_keys"];
$currency=$dd["currency"];

$ADT=$_SESSION['ADT'];
$CHD=$_SESSION['CHD'];
$INF=$_SESSION['INF'];


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $flightSeriesBaseUrl.'api/v1/flights/series-book',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
	"query": {
		"nAdt": '.$ADT.',
		"nInf": '.$CHD.',
		"nChd": '.$INF.',
		"legs": [{
			"dst": "'.$res["ORG_NAME"].'",
			"src": "'.$res["DES_CODE"].'",
			"dep": "'.date('d/m/Y',strtotime($res["DEP_DATE"])).'"
		}]
	},
	"flight_keys": ["'.$res["ResultIndex"].'"],
	"total_price": '.$total_price.',
	"currency": "'.$currency.'",
	"paxes": ['.rtrim($paxInfo,',').'],
    "client_details": {
        "email": "'.$_REQUEST["email"].'",
        "phone": "'.$_REQUEST["phone"].'"
    },
    "agent_reference": "GFT'.encode($bookinglastId).'"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: text/plain',
    'api-key: '.$flightSeriesApiKey,
    'Cookie: JSESSIONID=B427FB57BC177CA88E49876BDE35E50B; _vaS19id=9eeb13793ff3a0d5c26c55f2bc62e5aa; ssid=t1'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$response = json_decode($response,true);

if($response["success"]==true){
$booking_reference=$response["_data"]["booking_reference"];	

$namevalue ='bookingNumber="'.$booking_reference.'"';
$where='id="'.$bookinglastId.'" and tripType="1"';
updatelisting('flightBookingMaster',$namevalue,$where); 

updatelisting('flightBookingPaxDetailMaster','bookingNumber="'.$booking_reference.'"','BookingId="'.$bookinglastId.'"'); 

deleteRecord('wig_flight_json_bkp','agentId="'.$_SESSION['agentUserid'].'" and uniqueSessionId="'.$_SESSION['uniqueSessionId'].'"');

?>
<script> 
window.parent.location.href = "<?php echo $fullurl; ?>flight-bookings"; 
</script>

<?php

}else{
echo "Something went wrong...<br>Please back to search page.";
exit();	
}







}

//}
?>