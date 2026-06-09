<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$page='hotels';


function gethotelimgna($imgname){
if(strpos($imgname, 'HotelNA.jpg') !== false){
    return 'images/nohotelimage.png';
} else {
return $imgname;
}
}


$agentid=$_SESSION['agentUserid'];

$category='';

if(!empty($_REQUEST['category'])) {
    foreach($_REQUEST['category'] as $check) {
        $category.=$check.','; 
    }
}
$starcategory=$_REQUEST['starcategory'];
 
$travellers='1 Room - 1 Guest';
if($_REQUEST['travellers']!=''){
$travellers=$_REQUEST['travellers'];
}

$starcategory='3, 4 Star';
if($_REQUEST['starcategory']!=''){
$starcategory=$_REQUEST['starcategory'];
}
$checkInDate=date('d-m-Y', strtotime('+1 days'));
if($_REQUEST['checkInDate']!=''){
$checkInDate=$_REQUEST['checkInDate'];
}
  
$checkOutDate=date('d-m-Y', strtotime('+2 days'));
if($_REQUEST['checkOutDate']!=''){
$checkOutDate=$_REQUEST['checkOutDate'];
}
 
$destinationHotel='130443,IN'; 
if($_REQUEST['destinationHotel']!=''){
$destinationHotel=$_REQUEST['destinationHotel'];
}
 
$citydestination='Delhi,India'; 
if($_REQUEST['citydestination']!=''){
$citydestination=$_REQUEST['citydestination'];
}





////////=============Online=======================================






$category='';

if(!empty($_REQUEST['category'])) {
    foreach($_REQUEST['category'] as $check) {
        $category.=$check.','; 
    }
}
 $category=rtrim($category,', '); 

if($_GET['citydestination']!=""){ 

if(strpos(strtoupper($_GET['citydestination']), 'INDIA')){
    $domesticInternational = 'Yes';
}else{
    $domesticInternational = 'No';
}

 


$destExplode = explode(',',$_GET['destinationHotel']);
$city = $destExplode[0]; 
$country = $destExplode[1];

$checkInDateapi =  date('Y-m-d',strtotime($checkInDate));
$_SESSION['checkInDate']=$checkInDateapi;
 
$checkOutDateapi = date('Y-m-d',strtotime($checkOutDate));
$_SESSION['checkOutDate']=$checkOutDateapi;

$norooms='';
$roomJson= '';
$n=1;
$adultTotal=0;
$childTotal=0;
//$adultCount=0;
//$childCount=0;
$childAge='';
for ($x = 1; $x <= $_GET['empcount']; $x++) {

$adultTotal=0;
$childTotal=0;

$childAge='';

$adultJson='';
for ($j = 1; $j <= $_GET['noadults'.$n]; $j++) {
//$adultTotal=$adultTotal+$j;
$adultTotal = $_GET['noadults'.$n];
$adultJson.='{"PaxType":"AD"},';

}


$childJson='';



$cn1=$n;
$cn2=$n;
for ($k = 1; $k <= $_GET['nochilds'.$n]; $k++) {
$ca=10;
$cb=20;
 
if($k==1){ 
	$cage = $_REQUEST['age'.($ca+$cn1)];
	$cn1++;
}else{
	$cage = $_REQUEST['age'.($cb+$cn2)];
	$cn2++;
}

//$childTotal=$childTotal+$k;
$childTotal=$_GET['nochilds'.$n];
$childAge.=$cage.',';
$childJson.='{"PaxType":"CH","Age":"'.$cage.'"},';


}

$adultCount+=$_GET['noadults'.$n];
$childCount+=$_GET['nochilds'.$n];

$norooms.='{
				"numberOfAdults": '.$adultTotal.',
				"numberOfChild": '.$childTotal.',
				"childAge": ['.rtrim($childAge,',').']	
		   },';

$roomJson.= '{
				"Adult": ['.rtrim($adultJson,',').'],
				"Child": ['.rtrim($childJson,',').']
			},';

$n++; 

}

 $hotelBasicJson = '{
	"Destination":"'.$_GET['citydestination'].'",
	"CheckIn":"'.$checkInDateapi.'",
	"CheckOut":"'.$checkOutDateapi.'",
	"TotalRoom":"'.$_GET['empcount'].'",
	"TotalAdult":"'.$adultCount.'",
	"TotalChild":"'.$childCount.'",
	"Domestic":"'.$domesticInternational.'",
	"RoomDetails":['.rtrim($roomJson,',').']
}';

 $jsonPost = '{
    "searchQuery": {
        "checkinDate": "'.$checkInDateapi.'",
        "checkoutDate": "'.$checkOutDateapi.'",
        "roomInfo": ['.rtrim($norooms,',').'],
        "searchCriteria": {
            "city": "'.$city.'",
            "nationality": "'.$country.'",
            "currency": "INR"
        },
        "searchPreferences": {
            "ratings": ['.$category.'],
            "fsc": true
        }
    },
    "sync": falseapi
}';

$_SESSION['hotelBasicJson']= $hotelBasicJson;

$api=GetPageRecord('*','sys_companyMaster',' id=1'); 
$apiData=mysqli_fetch_array($api); 
/*echo '<pre>';
print_r($jsonPost);
echo '</pre>';*/
//$url = stripslashes($apiData['hotelApiKey']); // URL To Hit
$url = $hotelsearchquerylist; // URL To Hit
 
 
 
$result = getHotelApiData($url,$jsonPost,$hotelApiKey);

//print_r($result);
$resultArr = json_decode($result);
$searchId = $resultArr->searchIds{0};

$urlsecond = $hotelsearch; // URL To Hit
$searchPostJosn = '{ "searchId":"'.$searchId.'" }';
$listJson = getHotelApiData($urlsecond,$searchPostJosn,$hotelApiKey);
$hotelData = json_decode($listJson);


//print_r($listJson);

 
}
$datetime1 = date_create($checkInDateapi);
$datetime2 = date_create($checkOutDateapi);
$interval = date_diff($datetime1, $datetime2);
$days = $interval->format('%a');




 $destination = explode(',',$_GET['citydestination']);
		  $citydestination = $destination[0];
		  
		  $values = $hotelData->searchResult->his;
		  foreach($values as $hotelList){
		  
		  $count++;
		
		
		$source=$hotelList->img{0}->tns;
    $contents=file_get_contents( $source );
	
	 $source=$hotelList->img{0}->tns;
	
	}






////////=============Offline=======================================












$norooms='';
$roomJson= '';
$n=1;
$adultTotal=0;
$childTotal=0;


$childAge='';
$childJson='';
for ($x = 1; $x <= $_GET['empcount']; $x++) {

$adultTotal=0;
$childTotal=0;

$childAge='';

 




$cn1=$n;
$cn2=$n;
for ($k = 1; $k <= $_GET['nochilds'.$n]; $k++) {
$ca=10;
$cb=20;
 
if($k==1){ 
	$cage = $_REQUEST['age'.($ca+$cn1)];
	$cn1++;
}else{
	$cage = $_REQUEST['age'.($cb+$cn2)];
	$cn2++;
}

//$childTotal=$childTotal+$k;
$childTotal=$_GET['nochilds'.$n];
$childAge.=$cage.',';
$childJson.='{"PaxType":"CH","Age":"'.$cage.'"},';


}

$adultCount+=$_GET['noadults'.$n];
$childCount+=$_GET['nochilds'.$n];

 

$n++; 

}

 


if($_REQUEST['action']=='flightpostaction'){ 




include "hotelapi/api.php"; 

 
 $n=1;

$strings = explode(' - ',$_REQUEST['daterange']);
 
$rooms='';

$adultJson='';
$childJson='';
$norooms='';
  
for ($x = 1; $x <= $_GET['empcount']; $x++) {

$adultTotal=0;
$childTotal=0;

$childAge='';

 $adultCount=0;
 $childCount=0;


for ($j = 1; $j <= $_GET['noadults'.$n]; $j++) {
//$adultTotal=$adultTotal+$j;
$adultTotal = $_GET['noadults'.$n];
$adultJson.='{"PaxType":"AD"},';

}


$cn1=$n;
$cn2=$n;
for ($k = 1; $k <= $_GET['nochilds'.$n]; $k++) {
$ca=10;
$cb=20;
 
if($k==1){ 
	$cage = $_REQUEST['age'.($ca+$cn1)];
	$cn1++;
}else{
	$cage = $_REQUEST['age'.($cb+$cn2)];
	$cn2++;
}

//$childTotal=$childTotal+$k;
$childTotal=$_GET['nochilds'.$n];
$childAge.=$cage.',';
}



$cn1=$n;
$cn2=$n;
 

$adultCount+=$_GET['noadults'.$n];
$childCount+=$_GET['nochilds'.$n];

$norooms.='{
				"NoOfAdults": '.$adultCount.',
				"NoOfChild": '.$childTotal.',
				"ChildAge": ['.rtrim($childAge,',').']	
		   },';

$roomJson.= '{
				"Adult": ['.rtrim($adultJson,',').'],
				"Child": ['.rtrim($childJson,',').']
			},';
			
			
if($childCount<=0)
{			
	$rooms.='{
		  "NoOfAdults": '.$adultCount.',
		  "NoOfChild": '.$childCount.',
		  "ChildAge": null	
		},';
}
else
{

	$rooms.='{
		  "NoOfAdults": '.$adultCount.',
		  "NoOfChild": '.$childCount.',
		  "ChildAge": ['.rtrim($childAge,',').']	
		},';

}		


$n++; 

}

//echo $rooms;
//echo "<br>***********<br>"; 
 
/*echo $category;
die;*/

$categoryArr=explode(",",$category);
$minCategory=min($categoryArr);
 
$maxCategory=max($categoryArr);
 
//After city add this for tbo mapped data
/*"IsTBOMapped": "true",*/
$body1 = '{
  "CheckInDate": "'.date('d/m/Y',strtotime($checkInDate)).'",
  "NoOfNights": "'.$days.'",
  "CountryCode": "'.$country.'",
  "CityId": "'.$city.'",
  "ResultCount": null,
  "PreferredCurrency": "INR",
  "GuestNationality": "IN",
  "NoOfRooms": "'.($n-1).'",
  "RoomGuests": [
    '.rtrim($rooms,',').'
  ],
  "PreferredHotel": "",
  "MaxRating": "'.$maxCategory.'",
  "MinRating": "'.$minCategory.'",
  "ReviewScore": null,
  "IsNearBySearchAllowed": false,
  "EndUserIp": "'.$_SERVER['SERVER_ADDR'].'",
  "TokenId": "'.$tokenId.'"
}';

// echo $body1;
  
 
 $_SESSION['hotelSearchRequestSES'] =$body1;
 

$ch = curl_init();
$url = 'https://api.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/GetHotelResult/';


$headers = array(
'Content-Type: application/json',
'Content-Length: '.strlen($body1),    
'Accept: application/json',
'UserName: '.APIUSERNAME.'',
'APIPassword:'.APIPASSWORD.''
);

 curl_setopt($ch , CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$information = curl_getinfo($ch);

//echo "<br><br>";
 $result = curl_exec($ch);

$json_arr = json_decode($result,true); 


/*echo "<pre>";


echo "<br>*****************<br>";*/
$_SESSION['hotelTraceId']=$json_arr['HotelSearchResult']['TraceId'];



}

//print_r($json_arr);
?>

<style>

</style>




<div class="col-3 filtersidebar hotelfilter">
<div class="card-header">
    Enter Hotel Name, Location
  </div>
<div class="card-body">
<input type="text" id="search" class="form-control" placeholder="Enter Keyword">
				
<script>
$(document).ready(function(){
 $('#search').keyup(function(){
 
  // Search text
  var text = $(this).val();
 
  // Hide all content class element
  $('.hotelboxx').hide();

  // Search and show
  $('.hotelboxx:contains("'+text+'")').show();
 
 });
});

</script>
 </div>

<div class="card">
<div class="card-header">
    Price Range
  </div>
<div class="card-body">
		<div class=""> 
			<p class="range-value">
			<input type="text" id="amountfilter" readonly style="border: 0px;">
			</p>
		<div id="slider-ranges" class="range-bar"></div> 
		</div>
</div>

<div class="card-header">
    Star Rating
  </div>
<div class="card-body" id="allFilterDiv">
<div class="arranddep">
 <label id="1star" style="display:none;"><input  type="checkbox" value="1star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 1 Star</label>
 <label id="2star"  style="display:none;"><input type="checkbox" value="2star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 2 Star</label>
 <label id="3star" style="display:none;" ><input  type="checkbox" value="3star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 3 Star</label>
 <label id="4star" style="display:none;"><input  type="checkbox" value="4star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 4 Star</label>
 <label id="5star" style="display:none;"><input  type="checkbox" value="5star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 5 Star</label>

</div> 
</div>
 
  <div class="card-header">
    Property Type
  </div>
<div class="card-body"  id="allFilterDiv3">
<div class="arranddep" style="max-height:250px; overflow-y: auto;">
<?php 
							  						    
$rs=GetPageRecord('*','sys_hotelType',' status=1 order by name asc'); 
while($rest=mysqli_fetch_array($rs)){ 

?>
 <label id="hoteltype<?php echo str_replace(' ','-',$rest['name']); ?>" style="display:none;"><input  type="checkbox" value="hoteltype<?php echo str_replace(' ','-',$rest['name']); ?>" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> <?php echo stripslashes($rest['name']); ?></label> 
 <?php } ?>

</div> 
</div>

 
</div>

 

 

 
</div>


<div class="col-9 cardresult">
 


<div id="flightresult" class="listouter">
<div class="sortingouter" style="display:none;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">



                      <tbody><tr>



                        <td width="16%" align="left" style="cursor:pointer;" onClick="getSortedDeparture();"><strong>Sort By: sfsdf</strong> </td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedDeparture();">Departure <i class="fa fa-arrow-down" id="departurefa" aria-hidden="true" style="display: none;"></i>



                          <input name="departurefilterid" type="hidden" id="departurefilterid" value="1"></td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedDuration();">Duration <i class="fa fa-arrow-down" id="durationfa" aria-hidden="true" style="display: none;"></i>



                          <input name="durationfilterid" type="hidden" id="durationfilterid" value="1"></td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedArrival();">Arrival <i class="fa fa-arrow-down" id="arrivalfa" aria-hidden="true" style="display: none;"></i>



                          <input name="arrivalfilterid" type="hidden" id="arrivalfilterid" value="1">



                        </td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedPrice();" id="pricefilter">Price <i class="fa fa-arrow-up" id="pricefa" aria-hidden="true" style="display: inline-block;"></i>



                           <input name="pricefilterid" type="hidden" id="pricefilterid" value="0">



                        </td> 

                      </tr>



                    </tbody></table>
</div>





 <?php $minprice=0; 
  $n=1;
			  foreach($json_arr['HotelSearchResult']['HotelResults'] as $hotelList){ 
				$hoteyes=1;
			  
			  
			  
			  $hotelprice=0;
			  
			  $hotelprice=$hotelList['Price']['PublishedPriceRoundedOff']; 
				if($startingprice==''){
				$startingprice=$hotelList['Price']['PublishedPriceRoundedOff'];
				}
				$endingprice=$hotelList['Price']['PublishedPriceRoundedOff'];
		
		
		$date1 = new DateTime($checkInDate);
			$date2 = new DateTime($checkOutDate); 
			$numberOfNights= $date2->diff($date1)->format("%a");
		
		if($endingprice<$minprice || $minprice==0){
			$minprice=$endingprice;
			}
			
			if($endingprice>$maxprice){
			$maxprice=$endingprice;
			}
		
		$hotelCost=calculatehotelcost(encode($agentid),stripslashes($hotelList['HotelName']),$hotelprice,'0');
		
	
		
		if($hotelnamevar!=$hotelList['HotelName']){
		
			$hotelnamevar=$hotelList['HotelName'];
			  ?>
			  
			  
<script> 
$('#<?php echo $hotelList['StarRating']; ?>star').show();
$('#hoteltype<?php echo str_replace(' ','-','Hotel'); ?>').show();
</script>

<div class="row bookrow hotelbookrow hotelsearchlist hotelboxx"  style="width:100%;"  data-price="<?php echo $hotelprice; ?>" data-category="<?php echo $hotelList['StarRating']; ?>star amt3 amt10 amt14 amt7 amt19 hoteltype<?php echo str_replace(' ','-','Hotel'); ?>">
<div class="col-lg-9"> 
<div class="hotelbooking">
<div class="hotelimg">
<img src="<?php echo gethotelimgna($hotelList['HotelPicture']); ?>" onerror="this.onerror=null;this.src='images/nohotelimage.png';" data-src="<?php echo stripslashes($hotelList['HotelPicture']); ?>">
</div>
<div class="hoteltext">
<h5><?php echo stripslashes($hotelList['HotelName']);  ?> <span style="display:none;"><?php echo strtolower($hotelList['HotelName']); ?></span></h5>
<div class="reviewsection">
<p class="threeblue"><?php if($hotelList['HotelCategory']==''){ echo 'Hotel';} else { echo $hotelList['HotelCategory']; } ?> </p>
<span class="starcatht"> 
<?php $i=1;while($i<=$hotelList['StarRating']) { ?>
<i class="fa fa-star" aria-hidden="true"></i>
<?php $i++; } ?></span> 
</div>
<p class="relocation"><i class="fa fa-map-marker" aria-hidden="true"></i>
<?php echo stripslashes($hotelList['HotelAddress']); ?></p>
<div class="Deluxe">
<p> <?php
$amn=1;
$categories = '';
$cats = explode(",", '24 hour front desk,AC,Bathroom,Breakfast,Breakfast Buffet,Internet Access');
foreach($cats as $cat) { 
if($amn<10){  

$abs=GetPageRecord('amenitiesIcon','sys_hotelAmenities',' name="'.$cat.'"'); 
$resticon=mysqli_fetch_array($abs); 

$cat = trim($cat);?>
<div class="tbl"><?php echo $resticon['amenitiesIcon']; ?> <?php echo $cat; ?></div>

<?php } $amn++; } ?></p> 
</div>
</div> 
</div> 
</div>
<div class="col-lg-3">
<div class="bookbtn">
<h4>&#8377;<?php echo $hotelCost[2]; ?></h4>
<div class="blackbox">  
<h5>Start From</h5>
</div>
<form name="hotelform" id="hotelform<?php echo $count; ?>" method="post"  action="<?php echo $fullurl; ?>hotel-view2" target="_blank"> 
<input type="hidden" name="action" value="hotelapi" /> 
<input type="hidden" name="ResultIndex" value="<?php echo ($hotelList['ResultIndex']); ?>" /> 
<input type="hidden" name="HotelCode" value="<?php echo ($hotelList['HotelCode']); ?>" />  
<input type="hidden" name="HotelSearchDetails" value="<?php echo htmlentities($hotelBasicJson); ?>" />
<input type="hidden" name="hotelSearchId" value="<?php echo encode($rest['id']); ?>" /> 
<input type="hidden" name="checkInDate" value="<?php echo $checkInDate; ?>" /> 
<input type="hidden" name="empcount" value="<?php echo $_REQUEST['empcount']; ?>" /> 
<input type="hidden" name="checkOutDate" value="<?php echo $checkOutDate; ?>" /> 
<input type="hidden" name="nights" value="<?php echo $numberOfNights; ?>" /> 
<input type="hidden" name="ad" value="<?php echo $adultCount; ?>" /> 
<input type="hidden" name="cd" value="<?php echo $childCount; ?>" /> 
<input type="hidden" name="countrynamedesti" value="<?php echo $_REQUEST['citydestination']; ?>" /><input type="hidden" name="hotelTraceId" value="<?php echo $json_arr['HotelSearchResult']['TraceId']; ?>" /> <button type="submit" class="btn btn-danger" style="width:100%;">View Room</button>
</form>
</div>
</div>
</div>







	  <?php $n++; } } ?>














<?php $minprice=0;  
		  	$count = 0;   
			$print=explode(',', $citydestination);  
			$HotelSearchArr = json_decode($hotelBasicJson);  
			
			$date1 = new DateTime($checkInDate);
			$date2 = new DateTime($checkOutDate); 
			$numberOfNights= $date2->diff($date1)->format("%a");
			if($numberOfNights==0){ $numberOfNights=1; }
			 
			$a=GetPageRecord('*','hotelMaster',' agentId in(0,'.$agentid.') and hotelPhoto!="" and cityName="'.trim($print[0]).'" order by id desc'); 
			while($rest=mysqli_fetch_array($a)){
			$count++;
			 
			$rs=GetPageRecord('*','sys_HotelRoomTypeCost',' hotelId="'.$rest['id'].'" and validFrom<="'.date('Y-m-d', strtotime($checkInDate)).'" and validTo>="'.date('Y-m-d', strtotime($checkOutDate)).'" order by adultCost asc');
			$hotelPrice=mysqli_fetch_array($rs); 
		 
			
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
			
			if($hotelCost[2]<$minprice || $minprice==0){
			$minprice=$hotelCost[2];
			}
			
			if($hotelCost[2]>$maxprice){
			$maxprice=$hotelCost[2];
			}
			?> 
			
			
			
			 <script>
<?php 

$categories = '';
$allamt='';
$cats = explode(",", $rest['hotelAmenities']);
foreach($cats as $cat) { 

$abs=GetPageRecord('id','sys_hotelAmenities',' name="'.$cat.'"'); 
$resticon=mysqli_fetch_array($abs); 

$cat = trim($cat);
$allamt.='amt'.$resticon['id'].' '; ?>

$('#amt<?php echo $resticon['id']; ?>').show();
 <?php } ?>
			 
			 $('#<?php echo $rest['category']; ?>star').show();
			 $('#hoteltype<?php echo str_replace(' ','-',$rest['hotelType']); ?>').show();
			 </script>
			<div class="card hotelsearchlist" data-price="<?php echo $hotelCost[2]; ?>" data-category="<?php echo $rest['category']; ?>star <?php echo $allamt; ?> hoteltype<?php echo str_replace(' ','-',$rest['hotelType']); ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10%" align="left" valign="top"><div class="imgboxhotel">
 
	<img src="<?php  echo $imgurl.$rest['hotelPhoto'];  ?>" onerror="this.onerror=null;this.src='images/nohotelimage.png';" data-src="<?php  echo $imgurl.$rest['hotelPhoto'];  ?>" ></div></td>
    <td align="left" valign="top" style="padding-right:20px; border-right:1px solid #f1f1f1;">
<div class="card-body">

 <div class="htname">
 <span style="display:none;"><?php echo strtolower($rest['name']); ?></span>
 <?php echo stripslashes($rest['name']); ?> <span class="starcatht"><?php for($i=1; $i<=$rest['category']; $i++){ ?>
						 <i class="fa fa-star" aria-hidden="true"></i>
						   <?php } ?></span></div>
						   
						   
						   <div class="htaddress"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $rest['address']; ?>, <?php echo $rest['cityName']; ?> </div>
						   
						   <div class="htamnt">
<?php
$amn=1;
$categories = '';
$cats = explode(",", $rest['hotelAmenities']);
foreach($cats as $cat) { 
if($amn<10){  

$abs=GetPageRecord('amenitiesIcon','sys_hotelAmenities',' name="'.$cat.'"'); 
$resticon=mysqli_fetch_array($abs); 

$cat = trim($cat);?>
<div class="tbl"><?php echo $resticon['amenitiesIcon']; ?> <?php echo $cat; ?></div>

<?php } $amn++; } ?>
						   
						   
						   </div>
						   
						   

</div>
</td>
    <td width="20%" align="right" valign="bottom">
	<div class="card-body" style="padding:20px;">
	<div class="htprice">&#8377;<?php  echo $hotelCost[2]; $allprice.=$hotelCost[2].','; ?></div>
	<div class="htpriceperperson">Start From</div>
		<form name="hotelform" id="hotelform<?php echo $count; ?>" method="get"  action="<?php echo $fullurl; ?>hotel-view" target="_blank">
		  <input type="hidden" name="action" value="hotelmanual" />
		  <input type="hidden" name="HotelSearchDetails" value="<?php echo htmlentities($hotelBasicJson); ?>" />
		   <input type="hidden" name="hotelSearchId" value="<?php echo encode($rest['id']); ?>" /> 
		   <input type="hidden" name="checkInDate" value="<?php echo $checkInDate; ?>" /> 
		   <input type="hidden" name="empcount" value="<?php echo $_REQUEST['empcount']; ?>" /> 
		   <input type="hidden" name="checkOutDate" value="<?php echo $checkOutDate; ?>" /> 
		   <input type="hidden" name="nights" value="<?php echo $numberOfNights; ?>" /> 
		   <input type="hidden" name="ad" value="<?php echo $adultCount; ?>" /> 
		   <input type="hidden" name="cd" value="<?php echo $childCount; ?>" /> 
		   <input type="hidden" name="countrynamedesti" value="<?php echo $_REQUEST['citydestination']; ?>" />
	  <button type="submit" class="btn btn-danger" style="width:100%;">View Room</button>
	  </form>
	<div class="cancellationtbht"><i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $rest['cancellationType']; ?></div>
	
	</div>
	</td>
  </tr>
</table>


 



</div>
			<?php $count++; $n++; }	 ?>

  

</div>
 
 
 
 

 
 
 

 

</div>








<div style=" margin:20px 0px 40px; display:none; width:100%; min-height:400px;" id="nohotel"> 
<div style="text-align:center; font-size:30px;">
No Hotel Found
</div>

<div class="sections">
<div class="container" >
<h2 style="text-align:center; font-size:22px;">Book Hotels at Popular Destinations</h2>

<div class="row offerboxes"> 

<?php
$a=GetPageRecord('*','hotelMaster',' status=1 and cityName in (select name from cityMaster) group by cityName order by rand() limit 0,6');
while($spdeals=mysqli_fetch_array($a)){ 

$ab=GetPageRecord('*','cityMaster','name="'.$spdeals['cityName'].'"'); 
$destinationimage=mysqli_fetch_array($ab);

$bb=GetPageRecord('*','hotelDestinationMaster','name like "'.$destinationimage['name'].'%"  order by name asc limit 0,1'); 
$destiname=mysqli_fetch_array($bb);
?>
<div class="col-lg-2 d-flex align-items-stretch" style="cursor:pointer;" >
<a href="hotel-search?Submit=SEARCH&citydestination=<?php echo  ($destiname['name']); ?>,<?php echo  ($destiname['countryName']); ?>&destinationHotel=8543%2C106&checkInDate=<?php echo trim($checkInDate); ?>&checkOutDate=<?php echo trim($checkOutDate); ?>&travellers=1+Room+-+1+Guest&noadults1=1&nochilds1=0&age11=0&age21=0&empcount=1&totalpax=1&starcategory=3%2C+4+Star&category%5B%5D=3&category%5B%5D=4&action=flightpostaction&changesearch=0">
<div class="card" style="overflow: hidden; border-radius: 10px;">
<div class="offerphotobox">
 <img src="<?php echo $imgurl; ?><?php echo $destinationimage['thumbImage']; ?>">
</div>
<div class="card-body" style="text-align:center;">
<?php echo stripslashes($spdeals['cityName']); ?>
</div>
</div>
</a>
</div> 
<?php } ?>

</div>


</div>
</div>


</div>



 
<script>

 

  
function getSearchCityHotel(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchcitylistshotel.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
}
}
 
 

$(document).ready(function () {
    $("#dt1").datepicker({
        dateFormat: "dd-mm-yy",
        minDate: 0,
        onSelect: function () {
            var dt2 = $('#dt2');
            var startDate = $(this).datepicker('getDate');
            //add 30 days to selected date
            startDate.setDate(startDate.getDate() + 30);
            var minDate = $(this).datepicker('getDate');
            var dt2Date = dt2.datepicker('getDate');
            //difference in days. 86400 seconds in day, 1000 ms in second
            var dateDiff = (dt2Date - minDate)/(86400 * 1000);

            //dt2 not set or dt1 date is greater than dt2 date
            if (dt2Date == null || dateDiff < 0) {
                    dt2.datepicker('setDate', minDate);
            }
            //dt1 date is 30 days under dt2 date
            else if (dateDiff > 30){
                    dt2.datepicker('setDate', startDate);
            }
            //sets dt2 maxDate to the last day of 30 days window
            dt2.datepicker('option', 'maxDate', startDate);
            //first day which can be selected in dt2 is selected date in dt1
            dt2.datepicker('option', 'minDate', minDate);
        }
    });
    $('#dt2').datepicker({
        dateFormat: "dd-mm-yy",
        minDate: 0,onSelect: function () { 
        }
    });
	
});
 
 
  
function gettotalpax(){

var totalpax=0;
$('.pax').each(function(i, obj) {
    totalpax=Number(totalpax+Number($(obj).val())); 
}); 
$('#totalpax').val(totalpax);
 
 
var empcount = $('#empcount').val(); 
$('#travellersshow').val(''+empcount+' Room - '+totalpax+' Guest'); 
}




 
function addEmpInfo(){
var empcount = $('#empcount').val();

empcount=Number(empcount)+1;  
$.get("loadchild.php?id="+empcount, function (data) { 
$("#loademployee").append(data); 
}); 

var totalpax = $('#totalpax').val();
$('#empcount').val(empcount); 
$('#travellersshow').val(''+empcount+' Room - '+totalpax+' Guest'); 
}



function removeEmpInfo(id){
$('#empInfoId'+id).remove();
var empcount = $('#empcount').val();
empcount=Number(empcount)-1;  
var totalpax = $('#totalpax').val();
$('#empcount').val(empcount);
$('#travellersshow').val(''+empcount+' Room - '+totalpax+' Guest');
}



function combinecheckbox(){
var combinecheck ='';
var output = jQuery.map($(':checkbox[name=category\\[\\]]:checked'), function (n, i) {
    combinecheck = combinecheck+n.value+',';
}).join(',');

$('#starcategory').val(rtrim(combinecheck)+' Star');
}

function rtrim(str){
    return str.replace(/\s+$/, '');
}


  
gettotalpax();





	$(function() {

					var maxprice = Number($('#maxprice').val()); 

					var minprice = Number($('#minprice').val());

						$( "#slider-ranges" ).slider({
						  range: true,
						  min: minprice,
						  max: maxprice,
						  values: [ minprice, maxprice ],
						  slide: function( event, ui ) {
							$( "#amountfilter" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
							
							showProducts(ui.values[ 0 ], ui.values[ 1 ]);
						  }
						});
						$( "#amountfilter" ).val( "" + $( "#slider-ranges" ).slider( "values", 0 ) +
						  " - " + $( "#slider-ranges" ).slider( "values", 1 ) );
						  
					});

					function showProducts(minPrice, maxPrice) {
					  $(".hotelsearchlist").hide().filter(function() {
						var price = parseInt($(this).data("price"), 10);
						return price >= minPrice && price <= maxPrice;
					  }).show();
					}
					
					
					
					
					
					


var $filterCheckboxes = $('#allFilterDiv input[type="checkbox"]');
$filterCheckboxes.on('change', function() {
  var selectedFilters = {};
  $filterCheckboxes.filter(':checked').each(function() {
    if (!selectedFilters.hasOwnProperty(this.name)) {

      selectedFilters[this.name] = [];

    }
    selectedFilters[this.name].push(this.value);
  });
  // create a collection containing all of the filterable elements

  var $filteredResults = $('.hotelsearchlist');
  // loop over the selected filter name -> (array) values pairs

  $.each(selectedFilters, function(name, filterValues) {
    // filter each .flower element

    $filteredResults = $filteredResults.filter(function() {
      var matched = false,

        currentFilterValues = $(this).data('category').split(' ');
      // loop over each category value in the current .flower's data-category

      $.each(currentFilterValues, function(_, currentFilterValue) {
        // if the current category exists in the selected filters array

        // set matched to true, and stop looping. as we're ORing in each

        // set of filters, we only need to match once
        if ($.inArray(currentFilterValue, filterValues) != -1) {

          matched = true;

          return false;

        }

      });
      // if matched is true the current .flower element is returned

      return matched;
    });

  });
  $('.hotelsearchlist').hide().filter($filteredResults).show();
});











 var $filterCheckboxes2 = $('#allFilterDiv2 input[type="checkbox"]');
$filterCheckboxes2.on('change', function() {
  var selectedFilters2 = {};
  $filterCheckboxes2.filter(':checked').each(function() {
    if (!selectedFilters2.hasOwnProperty(this.name)) {

      selectedFilters2[this.name] = [];

    }
    selectedFilters2[this.name].push(this.value);
  });
  // create a collection containing all of the filterable elements

  var $filteredResults = $('.hotelsearchlist');
  // loop over the selected filter name -> (array) values pairs

  $.each(selectedFilters2, function(name, filterValues) {
    // filter each .flower element

    $filteredResults = $filteredResults.filter(function() {
      var matched = false,

        currentFilterValues = $(this).data('category').split(' ');
      // loop over each category value in the current .flower's data-category

      $.each(currentFilterValues, function(_, currentFilterValue) {
        // if the current category exists in the selected filters array

        // set matched to true, and stop looping. as we're ORing in each

        // set of filters, we only need to match once
        if ($.inArray(currentFilterValue, filterValues) != -1) {

          matched = true;

          return false;

        }

      });
      // if matched is true the current .flower element is returned

      return matched;
    });

  });
  $('.hotelsearchlist').hide().filter($filteredResults).show();
});







 var $filterCheckboxes3 = $('#allFilterDiv3 input[type="checkbox"]');
$filterCheckboxes3.on('change', function() {
  var selectedFilters2 = {};
  $filterCheckboxes3.filter(':checked').each(function() {
    if (!selectedFilters2.hasOwnProperty(this.name)) {

      selectedFilters2[this.name] = [];

    }
    selectedFilters2[this.name].push(this.value);
  });
  // create a collection containing all of the filterable elements

  var $filteredResults = $('.hotelsearchlist');
  // loop over the selected filter name -> (array) values pairs

  $.each(selectedFilters2, function(name, filterValues) {
    // filter each .flower element

    $filteredResults = $filteredResults.filter(function() {
      var matched = false,

        currentFilterValues = $(this).data('category').split(' ');
      // loop over each category value in the current .flower's data-category

      $.each(currentFilterValues, function(_, currentFilterValue) {
        // if the current category exists in the selected filters array

        // set matched to true, and stop looping. as we're ORing in each

        // set of filters, we only need to match once
        if ($.inArray(currentFilterValue, filterValues) != -1) {

          matched = true;

          return false;

        }

      });
      // if matched is true the current .flower element is returned

      return matched;
    });

  });
  $('.hotelsearchlist').hide().filter($filteredResults).show();
});

		
		
		
function getSortedPrice(){

var pricefilterid = $('#pricefilterid').val();
var $wrap = $('#flightresult'); 
$('#pricefa').show();$wrap.find('.hotelsearchlist').sort(function(a, b) 
{if(pricefilterid==1){$('#pricefilterid').val('0'); 
$('#pricefa').removeClass('fa-caret-down');
$('#pricefa').addClass('fa-caret-up');return + a.getAttribute('data-price') - 
+b.getAttribute('data-price'); 
}else{$('#pricefilterid').val('1'); 
$('#pricefa').removeClass('fa-caret-up');
$('#pricefa').addClass('fa-caret-down');return + b.getAttribute('data-price') - 
+a.getAttribute('data-price');
}})
.appendTo($wrap); 
}
 getSortedPrice();	
 getSortedPrice();	
 <?php if($n>1){ ?>
 $('.totalhotel').text('<?php echo $n; ?>');
 <?php }   ?>
 
 
 
</script>


<input name="maxprice" id="maxprice" type="hidden" value="<?php echo $maxprice; ?>">
<input name="minprice" id="minprice" type="hidden" value="<?php echo $minprice; ?>">