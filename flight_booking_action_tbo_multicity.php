<?php
include "inc.php";
include "config/logincheck.php";  
include 'FLYTBOAPI/APIConstants.php';
include 'FLYTBOAPI/RestApiCaller.php';

$totalwalletBalance=0; 
$totalwalletBalanceOffline=0; 
if($_SESSION['agentUserid']!='' && $_SESSION['agentUserid']>0){ 
$rs8=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet','agentId="'.$_SESSION['agentUserid'].'" and paymentType="Credit"   ');  
$agentCreditAmt=mysqli_fetch_array($rs8);  


$rs8=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet','agentId="'.$_SESSION['agentUserid'].'" and paymentType="Debit"  ');  
$agentDebitAmt=mysqli_fetch_array($rs8);  
$totalwalletBalance=($agentCreditAmt['totalcreditAmt']-$agentDebitAmt['totaldebitAmt']);

}
 

/*if($_SESSION['randval']!=($_REQUEST['coid']-$_REQUEST['totalAmountToPay']))
{
   ?>
<script>
alert('Something Went Wrong. Please Try Again.');
window.parent.location.href = "<?php echo $fullurl; ?>"; 
</script>   
   <?php
   exit();
}*/

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

$uniqueSessionId=base64_encode(time());
 
$pnrResponse1="";
$pnrResponse2="";

$basefareret=0; 
$passengerDetailArr=array();

$randbookingid='OFF-'.rand(11111111,99999999);

$a=GetPageRecord('*','wig_flight_json_bkp',' id="'.decode(decode($_REQUEST['flightone'])).'"  ');
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

if($_POST['flightone']!='' && $res['id']>0 && $res['id']!="" && $_POST['flightbooking']==1 && $totalwalletBalance>=$_REQUEST['totalAmountToPay']){
		 
if($_REQUEST['totalAmountToPay']<900){
	exit();
}

$bookingpro=1;
   

		#################################### Meal Baggage SSR #############################################

        	$ssr_result= $_SESSION['SSR']; 
        	$mealpref= $ssr_result['Response']['MealDynamic']['0'];  
        	$baggagepref= $ssr_result['Response']['Baggage']['0'];
        	$seatref= $ssr_result['Response']['SeatDynamic']['0']['SegmentSeat']['0']['RowSeats'];

		#################################### Meal Baggage SSR #############################################
	
	
   
/*  foreach((array) unserialize(stripslashes($res['PARAM_DATA'])) as $layoverFlight){
  
 $adultmain=$layoverFlight->adt;
 $childmain=$layoverFlight->chd;
 $infantmain=$layoverFlight->inf;
  }*/
 
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
$PCC=$res['PCC'];
$flightName=$res['FLIGHT_NAME'];
$flightNo=$res['FLIGHT_NO'];

$arrivalTime=$res['ARRV_TIME'];
$arrivalDate=$res['ARRV_DATE'];
$departureTime=$res['DEP_TIME'];
$clientBaseFare=$res['DEP_TIME'];
$markup = '0';
$agentMarkup = '0';
$bookingType = '0'; 
if($res['F_CLASS']=='EC'){ $flightClass='Economy'; } else { $flightClass='Business'; } 
$arr=explode("|",unserialize(stripslashes($res['searchJson']))->FLIGHT_INFO);
$totalBaggage=str_replace(':',': ',str_replace(',',', ',str_replace('=',': ',$arr[2])));
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

  
 // hidden field for baggage meal and seat dynamic 
$baseFareInn=$_REQUEST['baseFareInn'];
$TaxAndFeeInn=$_REQUEST['TaxAndFeeInn'];
$BaggageFeeInn=$_REQUEST['BaggageFeeInn'];
$MealFeeInn=$_REQUEST['MealFeeInn'];
$SeatFeeInn=$_REQUEST['SeatFeeInn'];
$SeatPriceInn=$_REQUEST['SeatPriceInn'];
$SeatNoInn=$_REQUEST['SeatNoInn'];

$asector=$_REQUEST['asector'];
$abaggage=$_REQUEST['abaggage'];
$ameal=$_REQUEST['ameal'];



// For Return Flight
$BaggageFeeInn2=$_REQUEST['BaggageFeeInn2'];
$MealFeeInn2=$_REQUEST['MealFeeInn2'];
$SeatFeeInn2=$_REQUEST['SeatFeeInn2'];
$SeatPriceInn2=$_REQUEST['SeatPriceInn2'];
$SeatNoInn2=$_REQUEST['SeatNoInn2'];

$asector2=isset($_REQUEST['asector2'])?$_REQUEST['asector2']:"";
$abaggage2=isset($_REQUEST['abaggage2'])?$_REQUEST['abaggage2']:"";
$ameal2=isset($_REQUEST['ameal2'])?$_REQUEST['ameal2']:"";


$totalAmountToPay=$_REQUEST['totalAmountToPay'];
  $totalAmountToPayForSSR=$_REQUEST['totalAmountToPayForSSR'];
 
// check onhold flight
$isOnHoldFlight=0;
if(isset($_REQUEST['onholdFlight']) && $_REQUEST['onholdFlight']==1)
{
	$isOnHoldFlight=1;
}  

$_SESSION['isOnHoldFlight'] = $isOnHoldFlight;
  
  
//-------------------Booking Entry------------------------- 


$finalAgentTax=$res['agentMarkup'];

 


$finalFlightname=$flightName;
$finalFareTypename=$PCC;


 
  
$namevalue ='uniqueSessionId="'.$uniqueSessionId.'",source="'.$source.'",apiType="tbo",status=1,destination="'.$destination.'",journeyDate="'.$journeyDate.'",tripType="1",sector="'.$sector.'",bookingDate="'.$bookingDate.'",agentId="'.$agentId.'",bookingNumber="",pcc="'.$PCC.'",flightName="'.$flightName.'",flightNo="'.$flightNo.'",arrivalTime="'.$arrivalTime.'",arrivalDate="'.$arrivalDate.'",departureTime="'.$departureTime.'",clientBaseFare="'.$bareFare.'",clientTax="'.$tax.'",clientTotalFare="'.$totalFare.'",baseFare="'.$adminBaseFareOW.'",tax="'.$adminTaxOW.'",totalFare="'.$adminTotalOW.'",agentBaseFare="'.$agentBaseFareOW.'",agentTax="'.$agentTaxOW.'",agentTotalFare="'.($totalAmountToPay-$totalAmountToPayForSSR).'",markup="'.$markup.'",agentMarkup="'.$agentMarkup.'",bookingType="'.$bookingType.'",flightClass="'.$flightClass.'",totalBaggage="'.$totalBaggage.'",flightStop="'.$flightStop.'",agentCommision="'.$agentCommision.'",taxApplicableType="'.$taxData['applicableType'].'",taxValuePerc="'.$taxData['valuePerc'].'",taxApplicableOn="'.$taxData['applicableOn'].'",agentFinalGST="'.$agentFinalGST.'",detailArray="'.addslashes($res['searchJson']).'",couponCode="'.$res['couponCode'].'",discountType="'.$res['discountType'].'",couponValue="'.$res['couponValue'].'",couponType="'.$res['couponType'].'", isOnHoldFlight="'.$isOnHoldFlight.'",searchArrey="'.addslashes($res['PARAM_DATA']).'"';

$bookinglastId = addlistinggetlastid('flightBookingMaster',$namevalue); 



$a ='bookingId="'.$bookinglastId.'",bookingType="flight",agentId="'.$AgentWebsiteData['id'].'",amount="'.$_REQUEST['totalAmountToPay'].'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_balanceSheet',$a); 
 

 
 // insert SSR Details 
 
$namevalueSRR ='BookingId="'.$bookinglastId.'",baseFareInn="'.$baseFareInn.'",TaxAndFeeInn="'.$TaxAndFeeInn.'",BaggageFeeInn="'.$BaggageFeeInn.'",MealFeeInn="'.$MealFeeInn.'",SeatFeeInn="'.$SeatFeeInn.'",SeatPriceInn="'.$SeatPriceInn.'",SeatNoInn="'.$SeatNoInn.'",asector="'.$asector.'",abaggage="'.$abaggage.'",ameal="'.$ameal.'",BaggageFeeInn2="'.$BaggageFeeInn2.'",MealFeeInn2="'.$MealFeeInn2.'",SeatFeeInn2="'.$SeatFeeInn2.'",SeatPriceInn2="'.$SeatPriceInn2.'",SeatNoInn2="'.$SeatNoInn2.'",asector2="'.$asector2.'",abaggage2="'.$abaggage2.'",ameal2="'.$ameal2.'",totalAmountToPay="'.$totalAmountToPay.'"';  

$flghtSSRLastId = addlistinggetlastid('flight_booking_ssr_details',$namevalueSRR); 


// Update SSR Details in booking Master table
	$allSeatPrice=$SeatPriceInn;
	$allBaaggePrice=$BaggageFeeInn;
	$allMealsPrice=$MealFeeInn;
   
    $ssrInBookingMaster ='seatPrice="'.$allSeatPrice.'",mealPrice="'.$allMealsPrice.'",extraBaggagePrice="'.$allBaaggePrice.'" '; 
	$where='id="'.$bookinglastId.'" ';
	updatelisting('flightBookingMaster',$ssrInBookingMaster,$where); 
  
  
    
//-------------------Booking Entry End-------------------------  
  
  
  
 
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

if($guestname=='')
{
	$guestname='ChaloFly Services';
}
if($email=='')
{
	$email='chaloflyservices@gmail.com';
}
if($phone=='')
{
	$phone='919099882787';
}

if($companyName=='')
{
	$companyName='Chalofly';
}

if($gstNo=='')
{
	$gstNo='29AAMCC3099C1ZF';
}

if($address=='')
{
	$address='3, 305, Tilak Raj Complex, Panchvati First Lane, Opp. Surya Rath, Ambavadi, Ahmedabad, Gujarat, 380006';
}



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





//-------------Adult-----------------
 
for ($adult = 0; $adult <= $adultmain; $adult++) { 
 
 if($_REQUEST['adtPassEx'.$adult]==''){
 $adtPassEx='1970-01-01';
 } else {
 $adtPassEx=date('Y-m-d',strtotime($_REQUEST['adtPassEx'.$adult]));
 }
 
 
$namevalue ='BookingId="'.$bookinglastId.'",bookingNumber="'.$bookinglastId.'",title="'.trim($_POST['titleAdt'.$adult]).'",firstName="'.trim($_POST['firstNameAdt'.$adult]).'",lastName="'.trim($_POST['lastNameAdt'.$adult]).'",dob="'.date('Y-m-d',strtotime($_POST['dobAdt'.$adult])).'",nationality="'.trim($_POST['nationalityAdt'.$adult]).'",passportNumber="'.trim($_POST['passportNumberAdt'.$adult]).'",passportExpiry="'.$adtPassEx.'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="adult",sector="'.trim($_POST['asector'.$adult]).'",baggage="'.trim($_POST['abaggage'.$adult]).'",meal="'.trim($_POST['ameal'.$adult]).'",seatAdultCode="'.trim($_POST['seatAdultCode'.$adult]).'",seatAdultPrice="'.trim($_POST['seatAdultPrice'.$adult]).'" ';
 
addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue); 




}


//-------------Child-----------------


for ($child = 0; $child <= $childmain; $child++) { 

 if($_REQUEST['adtPassEx'.$child]==''){
 $adtPassEx='1970-01-01';
 } else {
 $adtPassEx=date('Y-m-d',strtotime($_REQUEST['adtPassEx'.$child]));
 }


$namevalue ='BookingId="'.$bookinglastId.'",bookingNumber="'.$bookinglastId.'",title="'.trim($_POST['titleChd'.$child]).'",firstName="'.trim($_POST['firstNameChd'.$child]).'",lastName="'.trim($_POST['lastNameChd'.$child]).'",dob="'.date('Y-m-d',strtotime($_POST['dobChd'.$child])).'",nationality="'.trim($_POST['nationalityChd'.$child]).'",passportNumber="'.trim($_POST['passportNumberChd'.$child]).'",passportExpiry="'.$adtPassEx.'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="child",sector="'.trim($_POST['csector'.$child]).'",baggage="'.trim($_POST['cbaggage'.$child]).'",meal="'.trim($_POST['cmeal'.$child]).'",seatAdultCode="'.trim($_POST['seatChildCode'.$child]).'",seatAdultPrice="'.trim($_POST['seatChildPrice'.$child]).'"   ';
addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue); 

 
}




//-------------Infant-----------------



for($infant = 0; $infant <= $infantmain; $infant++) { 


 if($_REQUEST['adtPassEx'.$infant]==''){
 $adtPassEx='1970-01-01';
 } else {
 $adtPassEx=date('Y-m-d',strtotime($_REQUEST['adtPassEx'.$infant]));
 }
 




$namevalue ='BookingId="'.$bookinglastId.'",bookingNumber="'.$bookinglastId.'",title="'.trim($_POST['titleInf'.$infant]).'",firstName="'.trim($_POST['firstNameInf'.$infant]).'",lastName="'.trim($_POST['lastNameInf'.$infant]).'",dob="'.date('Y-m-d',strtotime($_POST['dobInf'.$infant])).'",nationality="'.trim($_POST['nationalityInf'.$infant]).'",passportNumber="'.trim($_POST['passportNumberInf'.$infant]).'",passportExpiry="'.$adtPassEx.'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="infant"';
addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue); 

}









$insuranceAmount=0;
   if($_REQUEST['addInsurance']==1){
   $insurance=addslashes(trim($_REQUEST['insurance']));
   $insuranceAmount=addslashes(trim($_REQUEST['insuranceAmount']));
   $insuranceDetails=addslashes(trim($_REQUEST['insuranceDetails']));
   }
   $donateAmount=0;
   if($_REQUEST['donate']==1){
	$donateDetails=addslashes(trim($_REQUEST['donateDetails']));
	$donateAmount=addslashes(trim($_REQUEST['donateAmount']));
	}
  
  $finalclientcost=($_REQUEST['finalclientcost']+$insuranceAmount+$donateAmount);
  

$bl=GetPageRecord('*','flightBookingMaster','id="'.$bookinglastId.'" '); 
$actCost=mysqli_fetch_array($bl);
  
$admarkup=($actCost['clientTotalFare']-$actCost['agentTotalFare']);
$agmarkup=($actCost['agentTotalFare']-$actCost['totalFare']);


$inv=GetPageRecord('*','flightBookingMaster',' 1 order by invoiceId desc'); 
$lastInv=mysqli_fetch_array($inv); 
$invoiceId=($lastInv['invoiceId']+1);



	

/*   echo "<br>Adult";
   print_r($adultmain);
   
  echo "<br>**********<br>";*/
  
  /********* Farebreak down ****************/
   $fare_quote_result=$_SESSION['fare_quote_result']; 
  
   $FareBreakdownOnward = $fare_quote_result['Response']['Results']['FareBreakdown']; 
   foreach($FareBreakdownOnward as $fbseOnward)
	{
		$PassengerType=$fbseOnward['PassengerType'];
		if($PassengerType == '1')
		{
		   $PassengerCount=$fbseOnward['PassengerCount'];
		   $currencyadlt =  $fbseOnward['Currency'];
		   
		   $BaseFareadlts = $fbseOnward['BaseFare']; 
		   $BaseFareadlt= $BaseFareadlts / $PassengerCount;
		   
		   $Taxadlts = $fbseOnward['Tax']; 
		   $Taxadlt= $Taxadlts / $PassengerCount;
			
		   $YQTaxadlt = $fbseOnward['YQTax']; 
		   
		   $AdditionalTxnFeeOfrdadlt = $fbseOnward['AdditionalTxnFeeOfrd']; 
		   $AdditionalTxnFeeOfrdadlt= $AdditionalTxnFeeOfrdadlt / $PassengerCount;
		   
		   
		   $AdditionalTxnFeePubadlt = $fbseOnward['AdditionalTxnFeePub']; 
		   $AdditionalTxnFeePubadlt= $AdditionalTxnFeePubadlt / $PassengerCount;
		   
		   
		   $PGChargeadlt = $fbseOnward['PGCharge']; 
		   $AirTransFeeadlt = "0"; 
			
		} 
		if($PassengerType == '2')
		{
		   $PassengerCountchld=$fbseOnward['PassengerCount'];
		   $currencychld =  $fbseOnward['Currency'];
		   
		   $BaseFarechlds = $fbseOnward['BaseFare']; 
		   $BaseFarechld= $BaseFarechlds / $PassengerCountchld;
		   $Taxchlds = $fbseOnward['Tax']; 
		   $Taxchld = $Taxchlds / $PassengerCountchld;
		   
		   $YQTaxchld = $fbseOnward['YQTax']; 
		   $AdditionalTxnFeeOfrdchld = $fbseOnward['AdditionalTxnFeeOfrd']; 
		   
			$AdditionalTxnFeePubchld = $fbseOnward['AdditionalTxnFeePub']; 
		   $AdditionalTxnFeePubchld= $AdditionalTxnFeePubchld / $PassengerCountchld;
		   
		   $PGChargechld = $fbseOnward['PGCharge']; 
		   $AirTransFeechld = "0";
		} 
		if($PassengerType == '3')
		{
		   $PassengerCountinfnt=$fbseOnward['PassengerCount'];
		   $currencyinfnt =  $fbseOnward['Currency'];
		   
		   $BaseFareinfnts = $fbseOnward['BaseFare']; 
		   $BaseFareinfnt = $BaseFareinfnts / $PassengerCountinfnt;
		   $Taxinfnts = $fbseOnward['Tax']; 
		   $Taxinfnt = $Taxinfnts / $PassengerCountinfnt;
		   
		   $YQTaxinfnt = $fbseOnward['YQTax']; 
		   $AdditionalTxnFeeOfrdinfnt = $fbseOnward['AdditionalTxnFeeOfrd']; 
		   
		   $AdditionalTxnFeePubinfnt = $fbseOnward['AdditionalTxnFeePub']; 
		   $AdditionalTxnFeePubinfnt= $AdditionalTxnFeePubinfnt / $PassengerCountinfnt;
		   
		   $PGChargeinfnt = $fbseOnward['PGCharge']; 
		   $AirTransFeeinfnt = "0";
		} 
	} 

	
 	for($adult=1; $adult<=$adultmain; $adult++){
	
	$adultArrForTbo=array();
/*		if($_POST['passportExpiryAdt'.$adult]!=''){
			$adtPassEx = changedDateFormat($_POST['passportExpiryAdt'.$adult]);
		}else{ 
			$adtPassEx = '1970-01-01';
			$adtPassjson = '';
		}*/
		
		$adultArrForTbo['Title']=trim($_POST['titleAdt'.$adult]);
		$adultArrForTbo['FirstName']=trim($_POST['firstNameAdt'.$adult]);
		$adultArrForTbo['LastName']=trim($_POST['lastNameAdt'.$adult]);
		$adultArrForTbo['PaxType']='1';
		$adultArrForTbo['DateOfBirth']= "2000-12-06T00:00:00";
		$adultArrForTbo['Gender']="1";
/*		$adultArrForTbo['PassportNo']='';
		$adultArrForTbo['PassportExpiry']='';
		$adultArrForTbo['PassportIssueDate']='';*/

		if($_SESSION['isdomestic']=='No')
		{
			$adultArrForTbo['PassportNo']=trim($_POST['passportNumberAdt'.$adult]);
			$adultArrForTbo['PassportExpiry']=trim($_POST['passportExpiryAdt'.$adult])."T00:00:00";
		}		
		
		$adultArrForTbo['GSTCompanyAddress']=$address;
		$adultArrForTbo['GSTCompanyContactNumber']=$phone;
		$adultArrForTbo['GSTCompanyName']=$companyName;
		$adultArrForTbo['GSTNumber']=$gstNo;
		$adultArrForTbo['GSTCompanyEmail']=$email;		
		
		$adultArrForTbo['AddressLine1']="NEW DELHI";
		$adultArrForTbo['AddressLine2']='';
		$adultArrForTbo['City']="NEW DELHI";
		$adultArrForTbo['CountryCode']="IN";
		$adultArrForTbo['CountryName']="India";
		$adultArrForTbo['Nationality']='';
		$adultArrForTbo['ContactNo']=$phone;
		$adultArrForTbo['Email']=$email;
		if($adult==1)
		{
			$adultArrForTbo['IsLeadPax']="true";
		}
		else
		{
			$adultArrForTbo['IsLeadPax']="false";
		}
			
		
		$fareArr=array();
		
				
		$fareArr['BaseFare']=$BaseFareadlt;
		$fareArr['Tax']=$Taxadlt;
		$fareArr['TransactionFee']=0;
		$fareArr['YQTax']=$YQTaxadlt;
		$fareArr['AdditionalTxnFeeOfrd']=$AdditionalTxnFeeOfrdadlt;
		$fareArr['AdditionalTxnFeePub']=$AdditionalTxnFeePubadlt;
		$fareArr['AirTransFee']=$AirTransFeeadlt;
		
		$adultArrForTbo['Fare'][]=$fareArr;
		
		 ########################### MEAL ########################## 
		  $MealDynamic= array();
		 $ameal=trim($_POST['ameal'.$adult]);
		 if($ameal!="")
		 {
		 	 $mealval= explode(' ,', $ameal); 
		 	 $adtmlWayType=""; 	
			 $adtmlCode="";
			 $adtmlDescription="";
			 $adtmlAirlineDescription="";
			 $adtmlQuantity="";
			 $adtmlPrice="";
			 $adtmlCurrency="";
			 $adtmlOrigin="";
			 $adtmlDestination="";
			
			foreach($mealpref as $mlref){ //print_r($mlref);
    		     if($mlref['Code'] == $mealval['0']){
					$adtmlAirlineCode= $mlref['AirlineCode'];
    		        $adtmlFlightNumber= $mlref['FlightNumber'];
    		        $adtmlWayType= $mlref['WayType'];
    		        $adtmlCode= $mlref['Code'];
    		        $adtmlDescription= $mlref['Description'];
    		        $adtmlAirlineDescription= $mlref['AirlineDescription'];
    		        $adtmlQuantity= $mlref['Quantity'];
    		        $adtmlCurrency= $mlref['Currency'];
    		        $adtmlPrice= $mlref['Price'];
    		        $adtmlOrigin= $mlref['Origin'];
    		        $adtmlDestination= $mlref['Destination'];
    		     }
    		 }
			 
			 
			 if($adtmlWayType!="")
			 {
				  $MealDynamic['AirlineCode'] = $adtmlAirlineCode;
				  $MealDynamic['FlightNumber'] = $adtmlFlightNumber;
				  $MealDynamic['WayType'] = $adtmlWayType;
				  $MealDynamic['Code'] = $adtmlCode;
				  $MealDynamic['Description'] = $adtmlDescription;
				  $MealDynamic['AirlineDescription'] = $adtmlAirlineDescription;
				  $MealDynamic['Quantity'] = $adtmlQuantity;
				  $MealDynamic['Price'] = $adtmlPrice;
				  $MealDynamic['Currency'] = $adtmlCurrency;
				  $MealDynamic['Origin'] = $adtmlOrigin;
				  $MealDynamic['Destination'] = $adtmlDestination;
				  $adultArrForTbo['MealDynamic'][]=$MealDynamic;
			  }
			 
			 
		 }
		 
		 ########################### MEAL End ########################## 
		 

	     ########################### Baggage ########################## 
    		 $Baggage= array();
			$baggval=trim($_POST['abaggage'.$adult]);
    		
			 if($baggval!=""){
    		 $baggval= explode(' ,', $baggval);
    		 $baggvals= explode('KG', $baggval['0']);
			 
			 $adtbgWayType="";
			 $adtbgCode="";
			 $adtbgDescription="";
			 $adtbgWeight="";
			 $adtbgWeight="";
			 $adtbgCurrency="";
			 $adtbgPrice="";
			 $adtbgOrigin="";
			 $adtbgOrigin="";
			 $adtbgDestination="";
			 
    		 
    		 foreach($baggagepref as $bgref){ //print_r($mlref);
    		     if(trim($bgref['Weight']) == trim($baggvals['0'])){
    		         
    		               $adtbgAirlineCode= $bgref['AirlineCode'];
    		               $adtbgFlightNumber= $bgref['FlightNumber'];
    		               $adtbgWayType= $bgref['WayType'];
    		               $adtbgCode= $bgref['Code'];
    		               $adtbgDescription= $bgref['Description'];
    		               $adtbgWeight= $bgref['Weight'];
    		               $adtbgCurrency= $bgref['Currency'];
    		               $adtbgPrice= $bgref['Price'];
    		               $adtbgOrigin= $bgref['Origin'];
    		               $adtbgDestination= $bgref['Destination'];
    		     }
    		 }
	 		
				 if($adtbgWayType!="")
				 {
					  $Baggage['AirlineCode'] = $adtbgAirlineCode;
					  $Baggage['FlightNumber'] = $adtbgFlightNumber;
					  $Baggage['WayType'] = $adtbgWayType;
					  $Baggage['Code'] = $adtbgCode;
					  $Baggage['Description'] = $adtbgDescription;
					  $Baggage['Weight'] = $adtbgWeight;
					  $Baggage['Currency'] = $adtbgCurrency;
					  $Baggage['Price'] = $adtbgPrice;
					  $Baggage['Origin'] = $adtbgOrigin;
					  $Baggage['Destination'] = $adtbgDestination;
					  $adultArrForTbo['Baggage'][]=$Baggage;   
				   }
    		 }
	    ########################### Baggage ##########################   		 


	    ########################### SEAT ########################## 

    		  $setvals= trim($_POST['seatAdultCode'.$adult]);
    		  $SeatDynamic= array();
    		 if($setvals!=""){

				   $adtstAirlineCode= "";
				   $adtstFlightNumber= "";
				   $adtstCraftType= "";
				   $adtstOrigin= "";
				   $adtstDestination= "";
				   $adtstAvailablityType= "";
				   $adtstDescription= "";
				   $adtstCode= "";
				   $adtstRowNo= "";
				   $adtstSeatNo= "";
				   $adtstSeatType= "";
				   $adtstSeatWayType= "";
				   $adtstCompartment= "";
				   $adtstDeck= "";
				   $adtstCurrency= "";
				   $adtstPrice= "";
    		 
    		 
    		// print_r($seatval); exit;
			//echo trim($setvals);
			//echo "<br>***";
			
    		 foreach($seatref as $seatrefs){ 
    		     foreach($seatrefs['Seats'] as $stref){ 
				 
				 // echo trim($stref['Code']);
				 // echo "<br>";
				  
    		         
    		         if(trim($stref['Code']) == trim($setvals)){
    		                
    		               $adtstAirlineCode= $stref['AirlineCode'];
    		               $adtstFlightNumber= $stref['FlightNumber'];
    		               $adtstCraftType= $stref['CraftType'];
    		               $adtstOrigin= $stref['Origin'];
    		               $adtstDestination= $stref['Destination'];
    		               $adtstAvailablityType= $stref['AvailablityType'];
    		               $adtstDescription= $stref['Description'];
    		               $adtstCode= $stref['Code'];
    		               $adtstRowNo= $stref['RowNo'];
    		               $adtstSeatNo= $stref['SeatNo'];
    		               $adtstSeatType= $stref['SeatType'];
    		               $adtstSeatWayType= $stref['SeatWayType'];
    		               $adtstCompartment= $stref['Compartment'];
    		               $adtstDeck= $stref['Deck'];
    		               $adtstCurrency= $stref['Currency'];
    		               $adtstPrice= $stref['Price'];
    		        }
    		     }
    		 }
	 	
				 if($adtstAvailablityType!="")
				 {
					
					  $SeatDynamic['AirlineCode'] = $adtstAirlineCode;
					  $SeatDynamic['FlightNumber'] = $adtstFlightNumber;
					  $SeatDynamic['CraftType'] = $adtstCraftType;
					  $SeatDynamic['Origin'] = $adtstOrigin;
					  $SeatDynamic['Destination'] = $adtstDestination;
					  $SeatDynamic['AvailablityType'] = $adtstAvailablityType;
					  $SeatDynamic['Description'] = $adtstDescription;
					  $SeatDynamic['Code'] = $adtstCode;
					  $SeatDynamic['RowNo'] = $adtstRowNo;
					  $SeatDynamic['SeatNo'] = $adtstSeatNo;
					  $SeatDynamic['SeatType'] = $adtstSeatType;
					  $SeatDynamic['SeatWayType'] = $adtstSeatWayType;
					  $SeatDynamic['Compartment'] = $adtstCompartment;
					  $SeatDynamic['Deck'] = $adtstDeck;
					  $SeatDynamic['Currency'] = $adtstCurrency;
					  $SeatDynamic['Price'] = $adtstPrice;
					  
					  $adultArrForTbo['SeatDynamic'][]=$SeatDynamic;  
				  } 
	    	      
    		 }
    		 
	    ########################### SEAT ########################## 

		$adultArrForTbo['Nationality']='IN';
	    $passengerDetailArr[]=$adultArrForTbo;
 
	}

		
	for($child=1; $child<=$childmain; $child++){
	
	$childArrForTbo=array();
 
		
		$childArrForTbo['Title']=trim($_POST['titleChd'.$child]);
		$childArrForTbo['FirstName']=trim($_POST['firstNameChd'.$child]);
		$childArrForTbo['LastName']=trim($_POST['lastNameChd'.$child]);
		$childArrForTbo['PaxType']='2';
		$childArrForTbo['DateOfBirth']= "2015-12-06T00:00:00";
		$childArrForTbo['Gender']="1";

		if($_SESSION['isdomestic']=='No')
		{
			$childArrForTbo['PassportNo']=trim($_POST['passportNumberChd'.$child]);
			$childArrForTbo['PassportExpiry']=trim($_POST['passportExpiryChd'.$child])."T00:00:00";
		}
		
		$childArrForTbo['GSTCompanyAddress']=$address;
		$childArrForTbo['GSTCompanyContactNumber']=$phone;
		$childArrForTbo['GSTCompanyName']=$companyName;
		$childArrForTbo['GSTNumber']=$gstNo;
		$childArrForTbo['GSTCompanyEmail']=$email;		

		$childArrForTbo['AddressLine1']="NEW DELHI";
		$childArrForTbo['AddressLine2']='';
		$childArrForTbo['City']="NEW DELHI";
		$childArrForTbo['CountryCode']="IN";
		$childArrForTbo['CountryName']="India";
		$childArrForTbo['Nationality']='';
		$childArrForTbo['ContactNo']=$phone;
		$childArrForTbo['Email']=$email;
		$childArrForTbo['IsLeadPax']="false";
/*		if($child==1)
		{
			$childArrForTbo['IsLeadPax']="true";
		}
		else
		{
			$childArrForTbo['IsLeadPax']="false";
		}*/
			
		
		$fareArr=array();
		
		$fareArr['BaseFare']=$BaseFarechld;
		$fareArr['Tax']=$Taxchld;
		$fareArr['TransactionFee']=0;
		$fareArr['YQTax']=$YQTaxchld;
		$fareArr['AdditionalTxnFeeOfrd']=$AdditionalTxnFeeOfrdchld;
		$fareArr['AdditionalTxnFeePub']=$AdditionalTxnFeePubchld;
		$fareArr['AirTransFee']=$AirTransFeechld;		
		$childArrForTbo['Fare'][]=$fareArr;

		 ########################### MEAL ########################## 
		 $MealDynamic= array();
		 $ameal=trim($_POST['cmeal'.$child]);
		 if($ameal!="")
		 {
		 	 $mealval= explode(' ,', $ameal); 
		 	 $adtmlWayType=""; 	
			 $adtmlCode="";
			 $adtmlDescription="";
			 $adtmlAirlineDescription="";
			 $adtmlQuantity="";
			 $adtmlPrice="";
			 $adtmlCurrency="";
			 $adtmlOrigin="";
			 $adtmlDestination="";
			
			foreach($mealpref as $mlref){ //print_r($mlref);
    		     if($mlref['Code'] == $mealval['0']){
    		               $adtmlAirlineCode= $mlref['AirlineCode'];
    		               $adtmlFlightNumber= $mlref['FlightNumber'];
    		               $adtmlWayType= $mlref['WayType'];
    		               $adtmlCode= $mlref['Code'];
    		               $adtmlDescription= $mlref['Description'];
    		               $adtmlAirlineDescription= $mlref['AirlineDescription'];
    		               $adtmlQuantity= $mlref['Quantity'];
    		               $adtmlCurrency= $mlref['Currency'];
    		               $adtmlPrice= $mlref['Price'];
    		               $adtmlOrigin= $mlref['Origin'];
    		               $adtmlDestination= $mlref['Destination'];
    		     }
    		 }
			 
			 
			 if($adtmlWayType!="")
			 {
				 
				  $MealDynamic['AirlineCode'] = $adtmlAirlineCode;
				  $MealDynamic['FlightNumber'] = $adtmlFlightNumber;
				  $MealDynamic['WayType'] = $adtmlWayType;
				  $MealDynamic['Code'] = $adtmlCode;
				  $MealDynamic['Description'] = $adtmlDescription;
				  $MealDynamic['AirlineDescription'] = $adtmlAirlineDescription;
				  $MealDynamic['Quantity'] = $adtmlQuantity;
				  $MealDynamic['Price'] = $adtmlPrice;
				  $MealDynamic['Currency'] = $adtmlCurrency;
				  $MealDynamic['Origin'] = $adtmlOrigin;
				  $MealDynamic['Destination'] = $adtmlDestination;
				 
				  $childArrForTbo['MealDynamic'][]=$MealDynamic;
			  }
			 
			 
		 }
		 
		 ########################### MEAL End ########################## 
		 

	     ########################### Baggage ########################## 
    		$Baggage= array();
			$baggval=trim($_POST['cbaggage'.$child]);
    		
			 if($baggval!=""){
    		 $baggval= explode(' ,', $baggval);
    		 $baggvals= explode('KG', $baggval['0']);
			 
			 $adtbgWayType="";
			 $adtbgCode="";
			 $adtbgDescription="";
			 $adtbgWeight="";
			 $adtbgWeight="";
			 $adtbgCurrency="";
			 $adtbgPrice="";
			 $adtbgOrigin="";
			 $adtbgOrigin="";
			 $adtbgDestination="";
			 
    		 
    		 foreach($baggagepref as $bgref){ //print_r($mlref);
    		     if(trim($bgref['Weight']) == trim($baggvals['0'])){
    		         
    		               $adtbgAirlineCode= $bgref['AirlineCode'];
    		               $adtbgFlightNumber= $bgref['FlightNumber'];
    		               $adtbgWayType= $bgref['WayType'];
    		               $adtbgCode= $bgref['Code'];
    		               $adtbgDescription= $bgref['Description'];
    		               $adtbgWeight= $bgref['Weight'];
    		               $adtbgCurrency= $bgref['Currency'];
    		               $adtbgPrice= $bgref['Price'];
    		               $adtbgOrigin= $bgref['Origin'];
    		               $adtbgDestination= $bgref['Destination'];
    		     }
    		 }
	 		
				 if($adtbgWayType!="")
				 {	
					 
					  $Baggage['AirlineCode'] = $adtbgAirlineCode;
					  $Baggage['FlightNumber'] = $adtbgFlightNumber;
					  $Baggage['WayType'] = $adtbgWayType;
					  $Baggage['Code'] = $adtbgCode;
					  $Baggage['Description'] = $adtbgDescription;
					  $Baggage['Weight'] = $adtbgWeight;
					  $Baggage['Currency'] = $adtbgCurrency;
					  $Baggage['Price'] = $adtbgPrice;
					  $Baggage['Origin'] = $adtbgOrigin;
					  $Baggage['Destination'] = $adtbgDestination;
					  
					  $childArrForTbo['Baggage'][]=$Baggage;   
				   }	   

    		 }
	    ########################### Baggage ##########################   		 


	    ########################### SEAT ########################## 

    		  $setvals= trim($_POST['seatChildCode'.$child]);
    		  $SeatDynamic= array();
    		 if($setvals!=""){

				   $adtstAirlineCode= "";
				   $adtstFlightNumber= "";
				   $adtstCraftType= "";
				   $adtstOrigin= "";
				   $adtstDestination= "";
				   $adtstAvailablityType= "";
				   $adtstDescription= "";
				   $adtstCode= "";
				   $adtstRowNo= "";
				   $adtstSeatNo= "";
				   $adtstSeatType= "";
				   $adtstSeatWayType= "";
				   $adtstCompartment= "";
				   $adtstDeck= "";
				   $adtstCurrency= "";
				   $adtstPrice= "";
    		 
    		 
    		// print_r($seatval); exit;
			//echo trim($setvals);
			//echo "<br>***";
			
    		 foreach($seatref as $seatrefs){ 
    		     foreach($seatrefs['Seats'] as $stref){ 
				 
				 // echo trim($stref['Code']);
				 // echo "<br>";
				  
    		         
    		         if(trim($stref['Code']) == trim($setvals)){
    		                
    		               $adtstAirlineCode= $stref['AirlineCode'];
    		               $adtstFlightNumber= $stref['FlightNumber'];
    		               $adtstCraftType= $stref['CraftType'];
    		               $adtstOrigin= $stref['Origin'];
    		               $adtstDestination= $stref['Destination'];
    		               $adtstAvailablityType= $stref['AvailablityType'];
    		               $adtstDescription= $stref['Description'];
    		               $adtstCode= $stref['Code'];
    		               $adtstRowNo= $stref['RowNo'];
    		               $adtstSeatNo= $stref['SeatNo'];
    		               $adtstSeatType= $stref['SeatType'];
    		               $adtstSeatWayType= $stref['SeatWayType'];
    		               $adtstCompartment= $stref['Compartment'];
    		               $adtstDeck= $stref['Deck'];
    		               $adtstCurrency= $stref['Currency'];
    		               $adtstPrice= $stref['Price'];
    		        }
    		     }
    		 }
	 	
				 if($adtstAvailablityType!="")
				 {
					
					  $SeatDynamic['AirlineCode'] = $adtstAirlineCode;
					  $SeatDynamic['FlightNumber'] = $adtstFlightNumber;
					  $SeatDynamic['CraftType'] = $adtstCraftType;
					  $SeatDynamic['Origin'] = $adtstOrigin;
					  $SeatDynamic['Destination'] = $adtstDestination;
					  $SeatDynamic['AvailablityType'] = $adtstAvailablityType;
					  $SeatDynamic['Description'] = $adtstDescription;
					  $SeatDynamic['Code'] = $adtstCode;
					  $SeatDynamic['RowNo'] = $adtstRowNo;
					  $SeatDynamic['SeatNo'] = $adtstSeatNo;
					  $SeatDynamic['SeatType'] = $adtstSeatType;
					  $SeatDynamic['SeatWayType'] = $adtstSeatWayType;
					  $SeatDynamic['Compartment'] = $adtstCompartment;
					  $SeatDynamic['Deck'] = $adtstDeck;
					  $SeatDynamic['Currency'] = $adtstCurrency;
					  $SeatDynamic['Price'] = $adtstPrice;
					  
					  $childArrForTbo['SeatDynamic'][]=$SeatDynamic;  
				  } 
	    	      
    		 }
    		 
	    ########################### SEAT ########################## 


		
		
 
		$childArrForTbo['Nationality']='IN';
		


	   
		$passengerDetailArr[]=$childArrForTbo;
		
	}
	
	
		 
	for($infant=1; $infant<=$infantmain; $infant++){
	
	$infantArrForTbo=array();
	
/*		if($_POST['passportExpiryInf'.$infant]!=''){
			$infPassEx = changedDateFormat($_POST['passportExpiryInf'.$infant]);
		}else{ 
			$infPassEx = '1970-01-01';
			$infPassjson = '';
		}*/


		
		$infantArrForTbo['Title']='Mstr';
		$infantArrForTbo['FirstName']=trim($_POST['firstNameInf'.$infant]);
		$infantArrForTbo['LastName']=trim($_POST['lastNameInf'.$infant]);
		
		$infantArrForTbo['PaxType']='3';
		
		$DateOfBirth = date("Y-m-d", strtotime(trim($_POST['dobInf'.$infant])));
		$DateOfBirth= $DateOfBirth.'T00:00:00';
		
		
		$infantArrForTbo['DateOfBirth']= $DateOfBirth;
		$infantArrForTbo['Gender']="1";
/*		$adultArrForTbo['PassportNo']='';
		$adultArrForTbo['PassportExpiry']='';
		$adultArrForTbo['PassportIssueDate']='';*/
		
		if($_SESSION['isdomestic']=='No')
		{
			$infantArrForTbo['PassportNo']=trim($_POST['passportNumberInf'.$infant]);
			$infantArrForTbo['PassportExpiry']=trim($_POST['passportExpiryInf'.$infant])."T00:00:00";
		}			

		$infantArrForTbo['GSTCompanyAddress']=$address;
		$infantArrForTbo['GSTCompanyContactNumber']=$phone;
		$infantArrForTbo['GSTCompanyName']=$companyName;
		$infantArrForTbo['GSTNumber']=$gstNo;
		$infantArrForTbo['GSTCompanyEmail']=$email;		
		
		
		$infantArrForTbo['AddressLine1']="NEW DELHI";
		$infantArrForTbo['AddressLine2']='';
		$infantArrForTbo['City']="NEW DELHI";
		$infantArrForTbo['CountryCode']="IN";
		$infantArrForTbo['CountryName']="India";
		$infantArrForTbo['Nationality']='';
		$infantArrForTbo['ContactNo']=$phone;
		$infantArrForTbo['Email']=$email;
		$infantArrForTbo['IsLeadPax']="false";
/*		if($infant==1)
		{
			$infantArrForTbo['IsLeadPax']="true";
		}
		else
		{
			$childArrForTbo['IsLeadPax']="false";
		}*/
			
		
		$fareArr=array();
		
		$fareArr['BaseFare']=$BaseFareinfnt;
		$fareArr['Tax']=$Taxinfnt;
		$fareArr['TransactionFee']=0;
		$fareArr['YQTax']=$YQTaxinfnt;
		$fareArr['AdditionalTxnFeeOfrd']=$AdditionalTxnFeeOfrdinfnt;
		$fareArr['AdditionalTxnFeePub']=$AdditionalTxnFeePubinfnt;
		$fareArr['AirTransFee']=$AirTransFeeinfnt;
		$infantArrForTbo['Fare'][]=$fareArr;
		$infantArrForTbo['Nationality']='IN';
		$passengerDetailArr[]=$infantArrForTbo;
	}
 
 

if($res['IsLCC']==1)
 {

	$arrayToRequest = array( 
						"EndUserIp" => $_SESSION['EndUserIp'],
						"TokenId" => $_SESSION['tbotokenId'],
						"TraceId" => $res['TID'],
						"ResultIndex" =>$_SESSION['ResultIndex'],
						"Passengers" => $passengerDetailArr,
						"IsPriceChangeAccepted" => false
					);
}
else
{
	$arrayToRequest = array( 
		"EndUserIp" => $_SESSION['EndUserIp'],
		"TokenId" => $_SESSION['tbotokenId'],
		"TraceId" => $res['TID'],
		"ResultIndex" =>$_SESSION['ResultIndex'],
		"Passengers" => $passengerDetailArr
	);

}					

 



$errorStatus=0;
$ErrorMessage='';
$PNR='';
$BookingId='';
$IsPriceChanged='';
$IsTimeChanged='';
$bookingResultJson='';
$Status=0;

$BookingId='';
//-------------Make Offline------------
 if($onewayflightoffline==0){


  
if($res['IsLCC']==1)
 {
      $IsLCC=1;
 	  include_once dirname(__FILE__).'/FLYTBOAPI/FlightTicketLCC3.php';  //ticket request
	  $bookingResultJson= json_encode($ticket_result_LCC);
	 if($ticket_result_LCC['Response']['Error']['ErrorCode']>0){
	 	$ErrorMessage=$ticket_result_LCC['Response']['Error']['ErrorMessage'];
	 }else{
	 	$PNR=$ticket_result_LCC['Response']['Response']['PNR'];
		$BookingId=$ticket_result_LCC['Response']['Response']['BookingId'];
		$IsPriceChanged=$ticket_result_LCC['Response']['Response']['IsPriceChanged'];
		$IsTimeChanged=$ticket_result_LCC['Response']['Response']['IsTimeChanged'];
		$Status=$ticket_result_LCC['Response']['Response']['Status'];
		$pnrResponse1=$PNR;
	 }
 }else{
	include dirname(__FILE__).'/FLYTBOAPI/FlightBook3.php';  //book request
	$IsLCC=0;

	if($book_result['Response']['Error']['ErrorCode']>0){
	 	$ErrorMessage=$book_result['Response']['Error']['ErrorMessage'];
	 }else{
	 	$PNR=$book_result['Response']['Response']['PNR'];
		$BookingId=$book_result['Response']['Response']['BookingId'];
		$IsPriceChanged=$book_result['Response']['Response']['IsPriceChanged'];
		$IsTimeChanged=$book_result['Response']['Response']['IsTimeChanged'];
		$Status=$book_result['Response']['Response']['Status'];
		$pnrResponse1=$PNR;
	 }
 }

  if($Status==1)
  {
  	$Status=2;
  }
  
  if(trim($BookingId)!='' && trim($PNR)!=''){
  $Status=2;
  }
  
   if(trim($ErrorMessage)!=''){
  $Status=1;
  }
  

    $namevalue2 ='bookingNumber="'.$BookingId.'",pnrNo="'.$PNR.'",IsLCC="'.$IsLCC.'",ErrorMessage="'.$ErrorMessage.'",status="'.$Status.'",tboBookingId="'.$BookingId.'"'; 
	$where='id="'.$bookinglastId.'" and tripType="1"';
	updatelisting('flightBookingMaster',$namevalue2,$where); 
 

	// update ticket number for adult 
		$k=0;

	 	for($adult=1; $adult<=$adultmain; $adult++){
		  
			$firstName=trim($_POST['firstNameAdt'.$adult]);
						
				if($IsLCC==1)
				{	
					$firstNameAPI=$ticket_result_LCC['Response']['Response']['FlightItinerary']['Passenger'][$k]['FirstName'];
					$ticketNo=$ticket_result_LCC['Response']['Response']['FlightItinerary']['Passenger'][$k]['Ticket']['TicketNumber'];
					$TicketId=$ticket_result_LCC['Response']['Response']['FlightItinerary']['Passenger'][$k]['Ticket']['TicketId'];
					
					 $namevalue ='ticketNo="'.$ticketNo.'"'; 
		
				 $where='BookingId="'.$bookinglastId.'" and firstName="'.$firstName.'" and paxType="adult" ';

				 updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
					 $k++;
					
				}	
				
				if($IsLCC==0)
				{	
					$firstNameAPI=$book_result['Response']['Response']['FlightItinerary']['Passenger'][$k]['FirstName'];
					$BookingId=$book_result['Response']['Response']['BookingId'];				
					$namevalue ='tboBookingId="'.$BookingId.'"'; 
					$where='BookingId="'.$bookinglastId.'" and firstName="'.$firstName.'" and paxType="adult" ';
					updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
					 $k++;	
				}					
				
					 
		 
		}



	// update ticket number for child 
		$k=0;

	 	for($child=1; $child<=$childmain; $child++){
		  
			$firstName=trim($_POST['firstNameChd'.$child]);
						
				if($IsLCC==1)
				{	
					$firstNameAPI=$ticket_result_LCC['Response']['Response']['FlightItinerary']['Passenger'][$k]['FirstName'];
					$ticketNo=$ticket_result_LCC['Response']['Response']['FlightItinerary']['Passenger'][$k]['Ticket']['TicketNumber'];
					$TicketId=$ticket_result_LCC['Response']['Response']['FlightItinerary']['Passenger'][$k]['Ticket']['TicketId'];
					
					 $namevalue ='ticketNo="'.$ticketNo.'"'; 
		
				 $where='BookingId="'.$bookinglastId.'" and firstName="'.$firstName.'" and paxType="child" ';

				 updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
					 $k++;
					
				}	
				
				if($IsLCC==0)
				{	
					$firstNameAPI=$book_result['Response']['Response']['FlightItinerary']['Passenger'][$k]['FirstName'];
					$BookingId=$book_result['Response']['Response']['BookingId'];				
					$namevalue ='tboBookingId="'.$BookingId.'"'; 
					$where='BookingId="'.$bookinglastId.'" and firstName="'.$firstName.'" and paxType="child" ';
					updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
					 $k++;	
				}					
					 
		 
		}


	// update ticket number for infant 
		$k=0;

	 	for($infant=1; $infant<=$infantmain; $infant++){
		  
			$firstName=trim($_POST['firstNameInf'.$infant]);
						
				if($IsLCC==1)
				{	
					$firstNameAPI=$ticket_result_LCC['Response']['Response']['FlightItinerary']['Passenger'][$k]['FirstName'];
					$ticketNo=$ticket_result_LCC['Response']['Response']['FlightItinerary']['Passenger'][$k]['Ticket']['TicketNumber'];
					$TicketId=$ticket_result_LCC['Response']['Response']['FlightItinerary']['Passenger'][$k]['Ticket']['TicketId'];
					
					 $namevalue ='ticketNo="'.$ticketNo.'"'; 
		
				 $where='BookingId="'.$bookinglastId.'" and firstName="'.$firstName.'" and paxType="infant" ';

				 updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
					 $k++;
					
				}	


				if($IsLCC==0)
				{	
					$firstNameAPI=$book_result['Response']['Response']['FlightItinerary']['Passenger'][$k]['FirstName'];
					$BookingId=$book_result['Response']['Response']['BookingId'];				
					$namevalue ='tboBookingId="'.$BookingId.'"'; 
					$where='BookingId="'.$bookinglastId.'" and firstName="'.$firstName.'" and paxType="infant" ';
					updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
					$k++;	
				}
		}
}
 //----------------------Booking Prosess-------------------------
	$bookingNumber=$BookingId;
		 
		 
        if($bookingNumber==''){
		$bookingNumber=$randbookingid;
		}
		

	echo '======';
		
	if(trim($bookingNumber)!=''){ }
		
		
		
		 
		
		
		
		
}

deleteRecord('wig_flight_json_bkp','agentId="'.$_SESSION['agentUserid'].'"');
if($bookingpro!=1){ ?>
<script>
alert('Something Went Wrong. Please Try Again.');
window.parent.location.href = "<?php echo $fullurl; ?>"; 
</script>

<?php 
	exit();
}
?>
<script> 
 window.parent.location.href = "<?php echo $fullurl; ?>flight-bookings"; 
</script>