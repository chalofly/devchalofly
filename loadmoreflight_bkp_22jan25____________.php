<?php
   include "inc.php";
   $flightpricelastid=0;
   $ns=1;
   $farecolor='';
   ?>
<div class="boxcontentnew">
   <ul>
      <?php
		$RowId=$_REQUEST["RowId"];
		$checked="checked='checked'";
		
         $b=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and uniqueSessionId="'.$_SESSION['uniqueSessionId'].'" and FLIGHT_NO="'.$_REQUEST['FLIGHT_NO'].'" and DEP_TIME="'.$_REQUEST['DEP_TIME'].'" and FLIGHT_CODE="'.$_REQUEST['FLIGHT_CODE'].'" order by AMT asc');

         while($flightprice=mysqli_fetch_array($b)){

         $str_arr = explode (",", $flightprice['agfare']);
         $basefares = explode ("=", $str_arr[2]);
         $bagg=explode (",", $flightprice['FLIGHT_INFO']);
         $iB=$bagg[1];
         $cB=$bagg[0];
		 $segmentsDataArr=(array) unserialize(stripslashes($flightprice['PARAM_DATA']));

$fareAmount=0;
$totalfare=0;
$totalfare=$basefares[1]+$flightprice['agentFixedMakup'];  
$fareAmount=convertfromtocurrencywithcurr('INR',$_SESSION['currency'],$totalfare);

$totaltdsdisplay=0;
$totaltdsdisplay=0;
$sellingfare=0;
$sellingfare=($flightprice['netFareBeforecomm']+$totaltdsdisplay);
?>
      <li>
         <div class="boxnewa" style="margin-bottom:10px;border-radius:5px;">
            <div class="crpcon" style="background-color:<?php echo getfaretypedisplaycolor(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC'])); ?>; color:#FFFFFF;">
               <input type="radio" name="fareType" onclick="updateRate<?php echo $RowId; ?>(<?php echo $RowId; ?>,<?php echo encode($flightprice['id']); ?>);" <?php echo $checked; ?> />
			   <?php if(getfaretypedisplayname(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC']))!=''){ echo getfaretypedisplayname(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC'])); }else{ echo $flightprice['PCC']; } ?>
            </div>
            <div class="situated">
			   <?php if($LoginUserDetails['userType']=='agent'){ ?>
			   <div class="insideb"> 
                  <p>Publish Fare <span><?php echo $fareAmount; ?></span></p>
               </div>
			   <div class="insideb"> 
                  <p>Offer Fare <span><?php echo round($totalfare-$sellingfare); ?></span></p>
               </div>
			   <?php }else{ ?>
			   <div class="insideb"> 
                  <p>Price <span><?php echo $fareAmount; ?></span></p>
               </div>
			   <?php } ?>
			   
            </div>
            <div class="cancellationbt">
               <ul>
		<?php
			if($segmentsDataArr["FareInclusions"]!=""){
		?>
                  <li><i class="fa fa-check"></i> <?php echo $segmentsDataArr["FareInclusions"][0]; ?></li>
                  <li><i class="fa fa-check"></i> <?php echo $segmentsDataArr["FareInclusions"][1]; ?></li>
                  <li><i class="fa fa-check"></i> <?php echo $segmentsDataArr["FareInclusions"][2]; ?></li>
                  <li><i class="fa fa-check"></i> <?php echo $segmentsDataArr["FareInclusions"][3]; ?></li>
                  <li><i class="fa fa-check"></i> <?php echo $segmentsDataArr["FareInclusions"][4]; ?> </li>
                  <li><i class="fa fa-check"></i> <?php echo $segmentsDataArr["FareInclusions"][5]; ?></li>
		 <?php }else{ ?>
<li><i class="fa fa-check"></i> Cabin Baggage - <?php if($flightprice["apiType"]=="FS"){echo $iB; }else{ echo $segmentsDataArr['Segments'][0][0]['Baggage'];} ?></li>
<li><i class="fa fa-check"></i> Check-In Baggage - <?php if($flightprice["apiType"]=="FS"){echo $cB; }else{echo $segmentsDataArr['Segments'][0][0]['CabinBaggage'];} ?></li>
<li><i class="fa fa-check"></i> Cancellation fees - Applicable</li>
<li><i class="fa fa-check"></i> Reissue fees - Applicable</li>
<li><i class="fa fa-check"></i> Seat - <?php if($segmentsDataArr["Fare"]["TotalSeatCharges"]==0){echo "Free";}else{echo "Chargeable";} ?> </li>
<li><i class="fa fa-check"></i> Meal - <?php if($segmentsDataArr["Fare"]["TotalMealCharges"]==0){echo "Free";}else{echo "Chargeable";} ?></li>
		 <?php } ?>
               </ul>
            </div>
         </div>
      </li>
      <?php $checked=''; } ?>
   </ul>
</div>

<script>
function updateRate<?php echo $RowId; ?>(RowId,PId){
	var link = document.getElementById("bookNowprice"+RowId);
	link.setAttribute('href', "<?php echo $fullurl; ?>flight-review-book?i="+PId);
}
</script>