<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$page='hotels';
$agentid=$_SESSION['agentUserid']; 
$_SESSION['hotelTraceId']=$_REQUEST['hotelTraceId'];
if($_REQUEST['ResultIndex']!="")
{


 $body2 = '{
 "ResultIndex": '.($_REQUEST['ResultIndex']).',
  "HotelCode": "'.($_REQUEST['HotelCode']).'",
  "EndUserIp": "'.$_SERVER['SERVER_ADDR'].'",
  "TokenId": "'.$_SESSION['hotelTokenId'].'",
  "TraceId": "'.$_SESSION['hotelTraceId'].'"
}';


//echo "<br>";

$ch2 = curl_init();
$url2 = 'https://api.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/GetHotelInfo/';

$headers2 = array(
'Content-Type: application/json',
'Content-Length: '.strlen($body2),    
'Accept: application/json'
);

 curl_setopt($ch2 , CURLOPT_URL, $url2);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_POSTFIELDS, $body2);
curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers2);

$information2 = curl_getinfo($ch2);
$result2 = curl_exec($ch2);
$hotelInfoArr = json_decode($result2,true); 	
//echo "<pre>";
//print_r($hotelInfoArr);

$hotelResultInfo=$hotelInfoArr['HotelInfoResult']['HotelDetails'];
$_SESSION['hotelResultInfo']=$hotelResultInfo;
/*echo "<pre>";
print_r($hotelResultInfo);

echo "<br>***********************************<br>";*/


//-------------Room Data-----------------


$body3 = '{
 "ResultIndex": '.($_REQUEST['ResultIndex']).',
  "HotelCode": "'.($_REQUEST['HotelCode']).'",
  "EndUserIp": "'.$_SERVER['SERVER_ADDR'].'",
  "TokenId": "'.$_SESSION['hotelTokenId'].'",
  "TraceId": "'.$_SESSION['hotelTraceId'].'"
}';

$ch3 = curl_init();
$url3 = 'https://api.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/GetHotelRoom/';

$headers3 = array(
'Content-Type: application/json',
'Content-Length: '.strlen($body3),    
'Accept: application/json',
'UserName: goin',
'APIPassword:goin@12345'
);

 curl_setopt($ch3 , CURLOPT_URL, $url3);
curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch3, CURLOPT_POSTFIELDS, $body3);
curl_setopt($ch3, CURLOPT_HTTPHEADER, $headers3);

$information3 = curl_getinfo($ch3);
 $result3 = curl_exec($ch3);
$roomDataArr = json_decode($result3,true); 

//echo "<br><br>";

$_SESSION['roomData']=$roomDataArr['GetHotelRoomResult']['HotelRoomsDetails'];

/*echo "<pre>";
print_r($roomDataArr);*/


}


//die;

$a=GetPageRecord('*','hotelMaster',' id="'.decode($_REQUEST['hotelSearchId']).'"'); 
$rest=mysqli_fetch_array($a);


$numberOfNights=$_REQUEST['nights'];
$adultCount=$_REQUEST['ad'];
$childCount=$_REQUEST['cd'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title><?php echo stripslashes($hotelResultInfo['HotelName']); ?> - Hotel - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
<?php include "headerinc.php"; ?>

<link rel="stylesheet" href="dist/css/lightbox.min.css">
<style>
.custom-control{cursor:pointer;}
.arranddep .custom-control-label{  text-align: center; color: #fff; border-radius: 60px; padding-left: 0px !important; padding: 0px; color:#666666;padding: 0px; width: 100%; height: 100%; border-radius: 0px; margin:0px; padding: 5px !important;}
.arranddep .custom-control-input:checked ~ .custom-control-label { background: #e8e8e8; text-align: center; color: #666666; border-radius: 60px; padding-left: 0px !important; padding: 0px; width: 100%; height: 100%; border-radius: 0px; margin:0px; padding: 5px !important;}

.arranddep .custom-checkbox input[type=checkbox]:not(:checked)+label:before{display:none !important;} 

.arranddep .custom-checkbox input[type=checkbox]:checked+label:before{display:none !important;} 

.arranddep .custom-checkbox input[type=checkbox]:checked+label:after{display:none !important;} 
.colorboxxx .custom-control-label{background-color:#000; width:30px; height:30px; float:left; margin-right:4px; display:block; border:2px solid #fff;}
.colorboxxx .custom-control-input:checked ~ .custom-control-label { border:2px dashed #fff;}
.colorboxxx .custom-checkbox input[type=checkbox]:not(:checked)+label:before{display:none !important;} 
.colorboxxx .custom-control{float:left;}
.colorboxxx .custom-checkbox input[type=checkbox]:checked+label:before{display:none !important;} 

.colorboxxx .custom-checkbox input[type=checkbox]:checked+label:after{display:none !important;} .flightlisting table tr td{display: table-cell !important;}
.custom-control-input{display:none;}
.arranddep table tr td{padding:0px !important;}
</style>
<style>
.hotelsearchicon{ font-size: 12px !important; right: inherit !important; top: inherit !important; position: inherit !important; color: #b3b3b3 !important; margin-right: 5px !important; }
.searchboxouter .textfield {  padding-top: 10px; }

.searchboxouter .redbuttonsearch {  padding: 20px 20px 20px 30px; outline: 0px; border: 0px; border-top-right-radius: 6px; border-bottom-right-radius: 6px; height: 94px; border-bottom-left-radius: 70px; border-top-left-radius: 70px; }
.roomguestblockdiv { float: left; width: auto; padding-left: 0px; padding-right: 2px; font-size: 12px; }
.roomguestblockdiv .form-control{font-size: 13px !important;     -webkit-appearance: listbox !important;}
.roomguestblockdiv label {   font-size: 10px; margin-left: 0px; margin-top: 0px; margin-bottom: 2px; text-transform: uppercase; }
.roomguestblockdiv .addroombtn{margin-top: 20px; cursor: pointer; background-color: #e52b30; padding: 10px 11px; color: #fff; border-radius: 2px; font-size: 12px; margin-left: 2px; border-radius: 40px;}

#basicDropdownClick{box-shadow: 2px 2px 10px #00000045 !important;}
#basicDropdownClickstar{box-shadow: 2px 2px 10px #00000045 !important;max-width: 190px; width: 460px; padding: 10px; left: 0px; display: none;}
#basicDropdownClickstar label { width: 100%; display: block; padding-bottom: 3px; font-size: 13px; padding-top: 5px; padding-left: 4px; }
#basicDropdownClickstar label:hover{background-color:#ececec;}

.searchboxouter .textfield { padding: 5px 20px;   }
.searchboxouter .redbuttonsearch{height:59px;}
.searchboxouter{box-shadow: 0px 0px 0px #00000070;}
.searchboxouter .textfield { font-size: 14px;   font-weight: 500;  }
.htdtl_amtouter .amboxht { float: left; margin: 0px 20px 20px 0px; text-align: center; width: auto; background-color: #e1fff6; padding: 5px 10px; border-radius: 5px; width: 23%;}
body{background-color:#f3f7fa !important;}
.hotels_amenities{margin-bottom:2px; color:#000; font-weight:600;}
.roomtbl tr td{border:1px  solid #ddd !important; background-color:#fff !important;}
.secondrttable tr td{border:1px solid #ddd !important;}
.cancelltioncharge tr td {padding:5px; font-size:12px;}
@media(max-width:576px){
  .secondrttable tr td{width: 50% !important;display: inline-block;}
}

</style>
</head>

<body id="hotelview">

<?php include "header.php"; ?>

 
 



 
 <section class="hotelgallery phonehotelgallery">
        <div class="container phonehoteldetailcontainer">
		<div class="hoteldetail">
                <div class="hoteldetailone">
                    <div class="topheading">
                     
                            <h1> <?php echo stripslashes($hotelResultInfo['HotelName']); ?> <span class="starcatht" style="font-size:18px; color:#FF9900;"><?php for($i=1; $i<=$hotelResultInfo['StarRating']; $i++){ ?>
						 <i class="fa fa-star" aria-hidden="true"></i>
						   <?php } ?></h1>
                        
                         
                    </div>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;
                           <?php echo $hotelResultInfo['Address']; ?>
                            </p>
                     
                </div>
                <div class="hoteldetailtwo">
                    <div class="roompricing">
                        <div style="margin-top: 20px;">
                            <h3><strong id="toppriceht">0</strong></h3>
                            <p>Best Price</p>
                        </div>
                        <a href="#pricelist"><button type="button">Select Room</button></a>
                    </div>
                </div>
            </div>
		
		
		
		<div class="row hoteldetailrow">
                <div class="col-lg-5">
                    <div class="roomoneimg borderleft">
                        <img src="<?php if($hotelResultInfo['Images'][0]!=''){  echo $hotelimg=$hotelResultInfo['Images'][0];  } else { echo 'images/NoImageFound.png'; } ?>"    onerror="imgError(this);" >
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="roomtwoimg">
                       
	
	<img src="<?php if($hotelResultInfo['Images'][1]!=''){  echo $hotelimg=$hotelResultInfo['Images'][1];  } else { echo 'images/NoImageFound.png'; } ?>"  onerror="imgError(this);"  > 
	<img src="<?php if($hotelResultInfo['Images'][2]!=''){  echo $hotelimg=$hotelResultInfo['Images'][2];  } else { echo 'images/NoImageFound.png'; } ?>"   onerror="imgError(this);"  > 

	
 
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="roomoneimg borderright">
                
	
	<img     src="<?php if($hotelResultInfo['Images'][3]!=''){  echo $hotelimg=$hotelResultInfo['Images'][3];  } else { echo 'images/NoImageFound.png'; } ?>" onerror="imgError(this);"  > 

	
 
  
                        <div class="camerabox">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                            <p>View All</p>
                        </div>

                    </div>
                </div>
            </div>
			 
			<div class="card descriptioncard">
                <div class="card-body">
                    <div class="description">
                        <h1>Stay <span>Details</span></h1>
                        <p>
                            <?php echo nl2br(stripslashes($hotelResultInfo['Description'])); ?></p>
                    </div>
                    <div class="stayamentites">
                        <h1 style="margin-top:30px; margin-bottom:30px;">Stay <span>Amentities</span></h1>
                        <table>
                            <tbody><tr>
                             
                                <td><i class="fa fa-bed" aria-hidden="true"></i><br><span>Rest</span></td>
                                <td><i class="fa fa-bath" aria-hidden="true"></i><br> <span>Bathroom</span></td>
                               <td><i class="fa fa-cutlery" aria-hidden="true"></i><br><span>Restaurant</span></td>
                                <td><i class="fa fa-wifi" aria-hidden="true"></i><br><span>Wifi</span></td>
        
                                <td><i class="fa fa-beer" aria-hidden="true"></i><br><span>Tea Maker</span></td>
                                <td><i class="fa fa-car" aria-hidden="true"></i><br><span>Parking</span></td>
                                </tr>
                        </tbody></table>
                    </div>
                </div>
            </div>
			
			
			<div class="roomtable" id="pricelist">
                <table class="firstrtable">
                    <tbody><tr>
                        <td>Room</td>
                        <td>Options</td>
                        <td>Guest &amp; Rooms</td>
                        <td>Price</td>
                    </tr>
                </tbody></table>
                <table class="secondrttable" width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#ddd" style="margin-bottom:10px;">
  <tr>
    <td width="40%" align="left" bgcolor="#F8F8F8" class="mobilehide" style="padding:10px;"><strong>Room Type</strong></td>
    <td width="33%" align="left" bgcolor="#F8F8F8"  class="mobilehide" style="padding:10px;"><strong>Benefits</strong></td>
    <td width="18%" align="left" bgcolor="#F8F8F8"  class="mobilehide" style="padding:10px;"><strong> Price</strong></td>
  </tr>
 
 
 <?php 
			//echo $HotelSearchArr = json_decode(($_REQUEST['HotelSearchDetails'])); 
			 
	 	//echo '<pre>';
			//print_r($roomDataArr);
			
			 $n=1;
			$roomCount = 1;
			
			if(count($roomDataArr['GetHotelRoomResult']['HotelRoomsDetails'])>0)
			{
			
			foreach($roomDataArr['GetHotelRoomResult']['HotelRoomsDetails'] as $roomValArr)
			{


			$baseFare=0;
			$adultCost=0;
			$childCost=0;
			if($adultCount>0){
			$adultCost=($hotelPrice['adultCost']*$adultCount);
			}
			if($childCount>0){
			$childCost=($hotelPrice['childCost']*$childCount);
			}  
			    $baseFare=((($adultCost+$childCost)*trim($_REQUEST['empcount']))*$numberOfNights); 
			$hotelCost=calculatehotelcost(encode($agentid),stripslashes($rest['name']),$baseFare,'0');
			
			if($count==1){
			$minprice=$hotelCost[2];
			}
			
			if($hotelCost[2]>$maxprice){
			$maxprice=$hotelCost[2];
			}
			
			

		?>
  <tr>
    <td width="40%" align="left" valign="top" style="padding:10px;"><h4 style="font-weight:700; font-size:24px; margin-bottom:10px; color:#000;"><?php echo stripslashes($roomValArr['RoomTypeName']); ?></h4>
	  
	
	
	<div style="margin-bottom:5px; color:#CC3300;"></strong> <a onClick="$('.rows<?php echo $n; ?>').toggle();"><strong>View Cancellation Policy</strong></a></div>
	<?php if($roomValArr['CancellationPolicies']){ ?>
	
	<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style="display:none; font-weight:500;" class="cancelltioncharge rows<?php echo $n; ?>">
  <tr>
    <td><strong>From Date</strong></td>
    <td><strong>To Date</strong></td>
    <td><strong>Charge</strong></td>
  </tr>
  <?php
  $charge='Non-Refundable';
  $check=0;
   foreach($roomValArr['CancellationPolicies'] as $roomValArracharge)	{ ?>
  <tr>
    <td><?php echo  date('d/m/Y - h:i A',strtotime($roomValArracharge['FromDate'])); ?></td>
    <td><?php echo  date('d/m/Y - h:i A',strtotime($roomValArracharge['ToDate'])); ?></td>
    <td><?php echo  $roomValArracharge['Charge'];
	if($roomValArracharge['Charge']<1 && $check==0){
	$charge='Refundable';
	$check=1;
	$till=date('j M Y',strtotime($roomValArracharge['ToDate']));
	} 
	
	 ?><?php if($roomValArracharge['ChargeType']==2){ echo '%'; } else { echo ' INR'; } ?></td>
  </tr>
  <?php } ?>
</table>
<?php } 
/*
			echo '<pre>';
print_r($roomValArr);*/

?>	</td>
    <td width="33%" align="left" valign="top" style="padding:10px;"><div class="borders d-grid">
					 <?php if($n==1){ ?><div><span class="rmRatePlan__rec appendRight3">RECOMMENDED</span></div><?php } ?>
					 <?php if($charge=='Refundable'){ $comroomname='Room With Free Cancellation'; } else {  $comroomname='Room With'; }  ?> 
					 
					 <div style="margin-bottom:10px; font-size:18px; font-weight:800; " id="incroomname<?php echo $n; ?>"></div>
					 											 
			<?php $a=1; foreach($roomValArr['Amenities'] as $roomValArramini)	{
			
			$string = preg_replace('/\.$/', '', $roomValArramini); //Remove dot at end if exists
$array = explode(',', $string); //split string into array seperated by ', '
foreach($array as $value) //loop over values
{ 

if(trim($value)!=''){
			 ?> 								
																
 <p class="hotels_amenities" style="margin-bottom: 5px;"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> <?php echo $roomval=rtrim(trim($value),",");   if($roomval=='Breakfast' || $roomval=='Breakfast and Dinner' || $roomval=='Dinner'){ $comroomname.=' '.$roomval; } ?></p>
 <?php $a++; } } }  ?>
 <?php if($a==1){ ?>
 
  <p class="hotels_amenities" style="margin-bottom: 5px;"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Room Only</p>
 <?php } ?>
 <?php if($charge=='Refundable'){ ?>
 <p class="hotels_amenities" style="margin-bottom: 5px; color:#00a19c; font-weight:500;">
 <i class="fa fa-check" aria-hidden="true"></i> Free Cancellation till <?php echo $till; ?>
 </p>
 <?php } else { ?>
  <p class="hotels_amenities" style="margin-bottom: 5px; color:#CC3300; font-weight:500;">
 <i class="fa fa-times" aria-hidden="true"></i> <?php echo $charge; ?>
 </p>
 <?php } ?>
 
			<script>
			$('#incroomname<?php echo $n; ?>').text('<?php  if($comroomname=='Room With'){ echo str_replace('With','Only',$comroomname); } else { echo $comroomname; } ?>');
			</script>																												 
		    </div></td>
    <td width="18%" align="left" valign="top" style="padding:10px;">
	
	<div style="color:#666666;">Total Price</div>
	<div style="font-size:24px; color:#000000; font-weight:700; margin-bottom:5px;"><?php  
	
	$hotelCostdisplay=calculatehotelcost(encode($agentid),stripslashes($hotelResultInfo['HotelName']),$roomValArr['Price']['PublishedPrice'],'0');
	echo convertfromtocurrencywithcurr('INR',$_SESSION['currency'],$hotelCostdisplay[2]);  
	 round($roomValArr['Price']['PublishedPrice']);  	if($n==1)
			{
			?>
			<script> 
			$('#toppriceht').html('<?php echo convertfromtocurrencywithcurr('INR',$_SESSION['currency'],$hotelCostdisplay[2]);   ?>');
			</script>
			<?php } ?>
	 </div>
		<form name="roomfrom" method="get" action="hotel-review?i=<?php echo $roomValArr['RoomIndex']; ?>" >
	<button type="submit" class="btn btn-danger" style=" font-weight:700px; padding:5px 20px;"   >

                                    <span class="ladda-label" style="color: #fff;">Book Now</span>
                                    <span class="ladda-spinner"></span></button>

									
									<input type="hidden" name="RoomIndex" id="RoomIndex" value="<?php echo $roomValArr['RoomIndex']; ?>" >
									<input type="hidden" name="RoomTypeCode" id="RoomTypeCode" value="<?php echo $roomValArr['RoomTypeCode']; ?>" >
									<input type="hidden" name="RoomTypeName" id="RoomTypeName" value="<?php echo $roomValArr['RoomTypeName']; ?>" >
									<input type="hidden" name="RatePlanCode" id="RatePlanCode" value="<?php echo $roomValArr['RatePlanCode']; ?>" >
									
									<input type="hidden" name="BedTypeCode" id="BedTypeCode" value="" >
									<input type="hidden" name="SmokingPreference" id="SmokingPreference" value="<?php echo $roomValArr['SmokingPreference']; ?>" >
									<input type="hidden" name="Supplements" id="Supplements" value="" >
									
									<input type="hidden" name="ResultIndex" id="ResultIndex" value="<?php echo  $_REQUEST['ResultIndex']; ?>" >
									<input type="hidden" name="HotelCode" id="HotelCode" value="<?php echo $_REQUEST['HotelCode']; ?>" >
									<input type="hidden" name="HotelName" id="HotelName" value="<?php echo $hotelResultInfo['HotelName']; ?>" >
									<input type="hidden" name="NoOfRooms" id="NoOfRooms" value="<?php echo $_REQUEST['empcount']; ?>" >
									<input type="hidden" name="ClientReferenceNo" id="ClientReferenceNo" value="" >
									<input type="hidden" name="IsVoucherBooking" id="IsVoucherBooking" value="" >
									
									<input type="hidden" name="roomArrayIndex" id="roomArrayIndex" value="<?php echo ($n-1); ?>" >
									<input type="hidden" name="hotelimg" id="hotelimg" value="<?php echo $hotelimg; ?>" >
									<input type="hidden" name="hotelnights" id="hotelnights" value="<?php echo $numberOfNights; ?>" >
								</form>									
													<?php  if($LoginUserDetails['userType']=='agent' || $LoginUserDetails['userType']=='client'){} else  {  ?>					
									<div style="margin-top:10px; font-size:11px;">To get more offers or less price<br><a onClick="$('#clientloginbox').show();loadclientloginbox(1);" style="cursor:pointer;"><strong>LOGIN NOW</strong></a></div>
									<?php } ?>
									
									<?php if($n==1){ ?>
									<script>
									// $('#toppriceht').html('&#8377;<?php  echo $hotelCost[2];   ?>');
									</script>
									<?php } ?>	</td>
  </tr>
  
  	<?php $n++; } }  ?>	
</table>
                 
                
            </div>
		
		
		</div>
		
		</section>


<div class="top_bg_ofr_sb" style="display:none;" >
<div class="container"  style="padding:0px 60px;"> 
<div class="searchtabs">
<a <?php if($_REQUEST['tripType']==1){ ?>class="active"<?php } ?>  id="tb1" onClick="selecttb(1);">One-Way</a>
<a <?php if($_REQUEST['tripType']==2){ ?>class="active"<?php } ?> id="tb2" onClick="selecttb(2);">Round-Trip</a></div>

<div class="searchboxouter">
 <form  method="GET" id="formids" action="<?php echo $fullurl; ?>flight-search" >
                <input type="hidden" name="tripType" id="tripType" value="<?php echo $tripType; ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="20%" align="left" valign="top">  
	<div style="height:0px; font-size:0px; position:relative; width: 100%; text-align: left;" id="searchcitylistsfromCity"></div>
	  <input type="text" onClick="$('#pickupCitySearchfromCity').select();" class="textfield" requered="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity','fromDestinationFlight','searchcitylistsfromCity');" id="pickupCitySearchfromCity" name="fromcitydesti" value="<?php echo $fromcitydesti; ?>" autocomplete="off">
	  <input name="fromDestinationFlight" id="fromDestinationFlight" type="hidden" value="<?php echo $fromDestinationFlight; ?>" autocomplete="nope">
	  <div class="swapbtn" onClick="swapdata();"><i class="fa fa-exchange" aria-hidden="true"></i></div>
     </td> 
    <td width="20%" align="left" valign="top" >
	<div style="height:0px; font-size:0px; position:relative; width: 100%; text-align: left;" id="searchcitylistsfromCity2"></div>
	<input type="text" onClick="$('#pickupCitySearchfromCity2').select();" class="textfield" requered="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity2','fromDestinationFlight2','searchcitylistsfromCity2');" id="pickupCitySearchfromCity2" name="tocitydesti" value="<?php echo $tocitydesti; ?>" autocomplete="off" >
	<input name="toDestinationFlight" id="fromDestinationFlight2" type="hidden" value="<?php echo $toDestinationFlight; ?>" autocomplete="nope">
	</td>
    <td width="12%" align="left" valign="top"><input type="text" id="dt1" name="journeyDateOne" class="textfield"  value="<?php echo trim($journeyDateOne); ?>" autocomplete="off"  ><i class="fa fa-calendar" aria-hidden="true"></i></td>
    <td width="12%" align="left" valign="top"  onclick="selecttb(2);"><input type="text" id="dt2" name="journeyDateRound" class="textfield"  value="<?php echo trim($journeyDateRound); ?>" autocomplete="off" <?php if($tripType==1){ ?>disabled  style="color:#fafafa;" <?php } ?> <?php if($_REQUEST['tripType']==1){ ?>disabled="disabled"<?php } ?>  ><i class="fa fa-calendar" aria-hidden="true"></i></td>
    <td width="24%" align="left" valign="top">
	
	<input type="text" id="travellersshow"  name="travellersshow"  class="textfield"  value="<?php echo trim($travellers); ?>" autocomplete="off" readonly="readonly" onClick="$('#basicDropdownClick').show();"  >
							
							
							  <script>
  $('#basicDropdownClick').click(function(event){
  event.stopPropagation();
});
  </script>
 
 <div id="basicDropdownClick" class="dropdown-menu dropdown-unfold col-11 m-0" aria-labelledby="basicDropdownClickInvoker" style="max-width: 300px; width: 250px;">
                   
					  
					  <div class=" "  style="margin-bottom: 10px;">
					  
					  
					  
                        <div class="js-quantity mx-3 row align-items-center justify-content-between">
						   <div class=" "  style="margin-bottom: 10px; width:100%; position:relative;">
					  <strong>Travellers</strong> <i class="fa fa-times" aria-hidden="true" style="position: absolute; right: 0px; cursor: pointer; top: 4px; font-size: 16px; color: #000;" onClick="$('#basicDropdownClick').hide();"></i>
					  </div>
						
						 <span class="d-block font-size-16 text-secondary font-weight-medium">Adults (12y +)</span>
                          <div class="d-flex">
                            <select id="ADT" name="ADT" class="form-control" onChange="selectpaxs();">
                              <option value="1" <?php echo ($ADT == 1 ? 'selected':''); ?>>1</option>
                              <option value="2" <?php echo ($ADT == 2 ? 'selected':''); ?>>2</option>
                              <option value="3" <?php echo ($ADT == 3 ? 'selected':''); ?>>3</option>
                              <option value="4" <?php echo ($ADT == 4 ? 'selected':''); ?>>4</option>
                              <option value="5" <?php echo ($ADT == 5 ? 'selected':''); ?>>5</option>
                              <option value="6" <?php echo ($ADT == 6 ? 'selected':''); ?>>6</option>
                              <option value="7" <?php echo ($ADT == 7 ? 'selected':''); ?>>7</option>
                              <option value="8" <?php echo ($ADT == 8 ? 'selected':''); ?>>8</option>
                              <option value="9" <?php echo ($ADT == 9 ? 'selected':''); ?>>9</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class=""  style="margin-bottom: 10px;">
                        <div class="js-quantity mx-3 row align-items-center justify-content-between"> <span class="d-block font-size-16 text-secondary font-weight-medium">Children (2y - 12y )</span>
                          <div class="d-flex">
                            <select id="CHD" name="CHD" class="form-control" onChange="selectpaxs();">
                              <option value="0" <?php echo ($CHD == 0 ? 'selected':''); ?>>0</option>
                              <option value="1" <?php echo ($CHD == 1 ? 'selected':''); ?>>1</option>
                              <option value="2" <?php echo ($CHD == 2 ? 'selected':''); ?>>2</option>
                              <option value="3" <?php echo ($CHD == 3 ? 'selected':''); ?>>3</option>
                              <option value="4" <?php echo ($CHD == 4 ? 'selected':''); ?>>4</option>
                              <option value="5" <?php echo ($CHD == 5 ? 'selected':''); ?>>5</option>
                              <option value="6" <?php echo ($CHD == 6 ? 'selected':''); ?>>6</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="" style="margin-bottom: 10px;">
                        <div class="js-quantity mx-3 row align-items-center justify-content-between"> <span class="d-block font-size-16 text-secondary font-weight-medium">Infants (below 2y)</span>
                          <div class="d-flex">
                            <select id="INF" name="INF" class="form-control" onChange="selectpaxs();">
                              <option value="0" <?php echo ($INF == 0 ? 'selected':''); ?>>0</option>
                              <option value="1" <?php echo ($INF == 1 ? 'selected':''); ?>>1</option>
                              <option value="2" <?php echo ($INF == 2 ? 'selected':''); ?>>2</option>
                              <option value="3" <?php echo ($INF == 3 ? 'selected':''); ?>>3</option>
                              <option value="4" <?php echo ($INF == 4 ? 'selected':''); ?>>4</option>
                              <option value="5" <?php echo ($INF == 5 ? 'selected':''); ?>>5</option>
                              <option value="6" <?php echo ($INF == 6 ? 'selected':''); ?>>6</option>
                            </select>
                          </div>
                        </div>
                      </div>
					  
					  
					  
					  <div class="" style="margin-bottom: 10px;">
                        <div class="js-quantity mx-3 row align-items-center justify-content-between"> <span class="d-block font-size-16 text-secondary font-weight-medium">Preffered Class</span>
                          <div class="d-flex">
                            <select id="PC" name="PC" class="form-control" onChange="selectpaxs();" > 
                              <option value="EC" <?php if($PC=='EC'){ echo 'selected'; }?>>Economy Class</option>
                              <option value="BU" <?php if($PC=='BU'){ echo 'selected'; }?>>Business Class</option>
                            </select>
                          </div>
                        </div>
                      </div>
					  <script>
							function selectpaxs(){
							var ADT = Number($('#ADT').val());
							var CHD = Number($('#CHD').val());
							var INF = Number($('#INF').val());
							var PC = $('#PC').val();
							
							if(PC=='EC'){
							fPC='Economy';
							}
							if(PC=='BU'){
							fPC='Business';
							}
							if(PC==''){
							fPC='All Class';
							}
							
							$('#travellersshow').val(Number(ADT+CHD+INF)+' Pax, '+fPC); 
							}
							</script>
					  
                       
                       <script>
					   selectpaxs();
					   </script>
                    </div>
	
	</td>
     
    <td width="12%" align="left" valign="top"><input type="submit" name="Submit" value="SEARCH" class="redbuttonsearch"></td>
  </tr>
</table>

<input type="hidden" name="action" value="flightpostaction" >
<input type="hidden" name="changesearch" id="changesearch" value="0" >
</form>

</div>

</div>
</div>

 
 

 

 
 
 
  
<iframe style="display:none;" src="<?php echo $pagesearch; ?>"></iframe>








<?php include "footer.php"; ?>


 
 <script src="dist/js/lightbox-plus-jquery.min.js"></script>

 
</body>
</html>
