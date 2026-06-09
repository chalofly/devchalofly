<?php  

   if($_REQUEST['preview']==1){
   //include_once("inc.php");
  // include_once("config/logincheck.php");
   }
  
	include_once("inc.php");
	include_once("config/logincheck.php");
   
	if($_REQUEST['tabid']==''){
	$_REQUEST['tabid']=1;
	}
      
	$a=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and id="'.$_REQUEST['id'].'" ');
	$res=mysqli_fetch_array($a);
   
	$bagg=explode (",", $res['FLIGHT_INFO']);
   
    $iB=$bagg[1];
   
    $cB=$bagg[0];
   
   ?>
<style>
   .detailscontent<?php echo $res['id']; ?> { padding: 10px; border: 1px solid #ddd; display: none; }
   .detailsboxtabs<?php echo $res['id']; ?> { width: 100%; border-bottom: 1px solid #ddd; overflow: hidden; padding-left: 0px; }
   .detailsboxtabs<?php echo $res['id']; ?> a { padding: 5px 10px; margin-right: 5px; float: left; color: #000; padding: 10px 20px; border-radius: 12px !important; border-bottom-left-radius: 0px !important; border-bottom-right-radius: 0px !important; font-weight: 600; }
   .detailsboxtabs<?php echo $res['id']; ?> .active { background-color: var(--blue); color: #fff; }
  
   @media(max-width: 576px){
     .detailsboxtabs<?php echo $res['id']; ?> a {padding: 8px !important; font-size: 12px !important;    border-top-left-radius: 5px !important;border-top-right-radius: 5px !important;}
   }
</style>
<div class="detailsboxtabs<?php echo $res['id']; ?>" style="position:relative;">
   <?php if($res['tripType']==1 || $res['tripType']==2){ ?>
   <a <?php if($_REQUEST['tabid']==1){ ?> class="active"<?php } ?> id="fltb1<?php echo $res['id']; ?>"  onClick="flightdetailstab<?php echo $res['id']; ?>('1<?php echo $res['id']; ?>');">Flight Details</a>
   <?php if($_REQUEST['preview']!=1){ ?><a <?php if($_REQUEST['']==2){ ?> class="active"<?php } ?> id="fltb2<?php echo $res['id']; ?>" onClick="flightdetailstab<?php echo $res['id']; ?>('2<?php echo $res['id']; ?>');" style="display:none;">Fare Details</a><?php } ?>
   <a <?php if($_REQUEST['']==3){ ?> class="active"<?php } ?> id="fltb3<?php echo $res['id']; ?>" onClick="flightdetailstab<?php echo $res['id']; ?>('3<?php echo $res['id']; ?>');">Baggage Info</a>
   <a  <?php if($_REQUEST['']==4){ ?> class="active"<?php } ?> id="fltb4<?php echo $res['id']; ?>" onClick="flightdetailstab<?php echo $res['id']; ?>('4<?php echo $res['id']; ?>');">Fare Rules</a>
   <?php }else{ ?>  
   <a  <?php if($_REQUEST['']==4){ ?> class="active"<?php } ?> id="fltb4<?php echo $res['id']; ?>" onClick="flightdetailstab<?php echo $res['id']; ?>('4<?php echo $res['id']; ?>');">Fare Rules</a>
   <?php } ?>
</div>
<div class="detailscontent<?php echo $res['id']; ?>" id="tabid1<?php echo $res['id']; ?>">
   <div class="row">
      <div class="col-12">
         <?php
            $j=0; 
            if($res['apiType']=='kafila'){
            foreach(unserialize(stripslashes($res['CON_DETAILS'])) as $layoverFlight){
            if($layoverFlight->FLIGHT_NAME!=''){
            $yesdata=1;
            ?>
         <div class="row multiflightbox">
            <div class="col-3">
               <table border="0" cellpadding="0" cellspacing="0">
                  <tr>
                     <td colspan="2"><img src="<?php echo $imgurl.getflightlogo(stripslashes($res['FLIGHT_NAME'])); ?>" width="32" height="32"></td>
                     <td>
                        <div class="flightname"><?php echo $layoverFlight->FLIGHT_NAME; ?> </div>
                        <div class="flightnumber"><?php echo $layoverFlight->FLIGHT_CODE; ?> <?php echo $layoverFlight->FLIGHT_NO; ?></div>
                     </td>
                  </tr>
               </table>
            </div>
            <div class="col-9">
               <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                     <td width="33%" align="center">
                        <div class="coltime">
                           <?php echo $layoverFlight->DEP_TIME; ?>
                        </div>
                        <div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($layoverFlight->DEP_DATE)); ?></div>
                        <div class="graysmalltext">
                           <?php
                              $rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$layoverFlight->ORG_CODE.'"');
                              
                              $rscodearr=mysqli_fetch_array($rs); ?>
                           (<?php echo strip($layoverFlight->ORG_CODE); ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($rscodearr['airportDescription']); ?>
                        </div>
                     </td>
                     <td width="33%" align="center">
                        <div class="nostops"><?php echo $layoverFlight->DURATION; ?></div>
                        <div style="margin-top:2px;">
                           <span class="green"><?php if($res['refundyes']=='1'){ echo '<span class="refundablespan">Refundable</span>'; } else { echo '<span class="nonrefundablespan">Non Refundable</span>'; } ?></span>
                        </div>
                     </td>
                     <td width="33%" align="center">
                        <div class="coltime">
                           <?php echo $layoverFlight->ARRV_TIME; ?>
                        </div>
                        <div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($layoverFlight->ARRV_DATE)); ?></div>
                        <div class="graysmalltext">
                           <?php
                              $rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$layoverFlight->DES_CODE.'"');
                              
                              $rscodearr=mysqli_fetch_array($rs); ?>
                           (<?php echo strip($layoverFlight->DES_CODE); ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($rscodearr['airportDescription']); ?>
                        </div>
                     </td>
                  </tr>
               </table>
            </div>
            <?php if($layoverFlight->LAYOVER_INFO!=''){ ?>
            <div style="text-align: center; color: #0b0b0b; padding: 5px; background-color: #e4f8ff; font-weight: 600; border-radius: 24px; margin-top:20px;"><?php echo $layoverFlight->LAYOVER_INFO; ?></div>
            <?php } ?>
         </div>
         <?php  $j++; } } ?>
         <?php
            if($yesdata!=1){
            $yesdata=1;
            ?>
         <div class="row multiflightbox">
            <div class="col-3">
               <table border="0" cellpadding="0" cellspacing="0">
                  <tr>
                     <td colspan="2"><img src="<?php echo $imgurl.getflightlogo(stripslashes($res['FLIGHT_NAME'])); ?>" width="32" height="32"></td>
                     <td>
                        <div class="flightname"><?php echo stripslashes($res['FLIGHT_NAME']); ?> </div>
                        <div class="flightnumber"><?php echo stripslashes($res['FLIGHT_CODE']); ?>-<?php echo stripslashes($res['FLIGHT_NO']); ?></div>
                     </td>
                  </tr>
               </table>
            </div>
            <div class="col-9">
               <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                     <td width="33%" align="center">
                        <div class="coltime">
                           <?php echo stripslashes($res['DEP_TIME']); ?>
                        </div>
                        <div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($res['DEP_DATE'])); ?></div>
                        <div class="graysmalltext">
                           <div class="graysmalltext">
                              <?php
                                 $rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$res['ORG_CODE'].'"');
                                 
                                 $rscodearr=mysqli_fetch_array($rs); ?>
                              (<?php echo strip($res['ORG_CODE']); ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($rscodearr['airportDescription']); ?>
                           </div>
                        </div>
                     </td>
                     <td width="33%" align="center">
                        <div class="nostops"><?php echo $res['DUR']; ?></div>
                        <div style="margin-top:2px;">
                           <span class="green"><?php if($res['refundyes']=='1'){ echo '<span class="refundablespan">Refundable</span>'; } else { echo '<span class="nonrefundablespan">Non Refundable</span>'; } ?></span>
                        </div>
                     </td>
                     <td width="33%" align="center">
                        <div class="coltime">
                           <?php echo stripslashes($res['ARRV_TIME']); ?>
                        </div>
                        <div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($res['ARRV_DATE'])); ?></div>
                        <div class="graysmalltext">
                           <?php
                              $rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$res['ORG_CODE'].'"');
                              
                              $rscodearr=mysqli_fetch_array($rs); ?>
                           (<?php echo strip($res['ORG_CODE']); ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($rscodearr['airportDescription']); ?>
                        </div>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
         <?php }  $j++;  
            }
            
            if($res['apiType']=='tripjack'){
			
			$arr = unserialize(stripslashes($res['PARAM_DATA']));			
				
            $j=0;
            foreach((array) unserialize(stripslashes($res['CON_DETAILS'])) as $layoverFlight){
            if($layoverFlight->FLIGHT_NAME!=''){
            ?>
         <div class="row multiflightbox">
            <div class="col-3">
               <table border="0" cellpadding="0" cellspacing="0">
                  <tr>
                     <td colspan="2"><img src="<?php echo $imgurl.getflightlogo(stripslashes($res['FLIGHT_NAME'])); ?>" width="32" height="32"></td>
                     <td>
                        <div class="flightname"><?php echo $layoverFlight->FLIGHT_NAME; ?> </div>
                        <div class="flightnumber"><?php echo $layoverFlight->FLIGHT_CODE; ?> <?php echo $layoverFlight->FLIGHT_NO; ?></div>
                     </td>
                  </tr>
               </table>
            </div>
            <div class="col-9">
               <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                     <td width="33%" align="center">
                        <div class="coltime">
                           <?php echo $layoverFlight->DEP_TIME; ?>
                        </div>
                        <div class="graysmalltext">
                           <?php echo $layoverFlight->ORG_NAME; ?>
                        </div>
                     </td>
                     <td width="33%" align="center">
                        <div class="nostops"><?php echo $layoverFlight->DURATION; ?></div>
                     </td>
                     <td width="33%" align="center">
                        <div class="coltime">
                           <?php echo $layoverFlight->ARRV_TIME; ?>
                        </div>
                        <div class="graysmalltext">
                           <?php echo $layoverFlight->DES_NAME; ?>
                        </div>
                     </td>
                  </tr>
               </table>
            </div>
            <?php if($layoverFlight->LAYOVER_INFO!=''){ ?>
            <div style="text-align: center; color: #0b0b0b; padding: 5px; background-color: #e4f8ff; font-weight: 600; border-radius:12px; margin:15px 0px; "><?php echo $layoverFlight->LAYOVER_INFO; ?></div>
            <?php } ?>
         </div>
         <?php  $j++; } } ?>
         <?php if($j==0){
            $dd=unserialize(stripslashes($res['searchJson']));
             ?>
         <?php 
            $f=1;
            
            foreach((array) $dd['sI'] as $layoverFlight){ 
            
            $duration='';
            
            ?>
         <?php if($_SESSION['isRoundTripInt']==1 && $f==1){ ?>
         <div style="padding: 5px 10px; background-color: #f1f1f1; font-weight: 700; margin-bottom: 10px;">Departure Flight</div>
         <?php } 
            $f++;
            
            ?>
         <div class="row multiflightbox">
            <div class="col-4">
               <table border="0" cellpadding="0" cellspacing="0">
                  <tr>
                     <td colspan="2"><img src="<?php echo $imgurl.getflightlogo($layoverFlight['fD']['aI']['name']); ?>"  height="32"></td>
                     <td>
                        <div class="flightname"><?php echo stripslashes($layoverFlight['fD']['aI']['name']); ?></div>
                        <div class="flightnumber"><?php echo stripslashes($layoverFlight['fD']['aI']['code']); ?>-<?php echo stripslashes($layoverFlight['fD']['fN']); ?></div>
                     </td>
                  </tr>
               </table>
            </div>
            <div class="col-8">
               <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                     <td width="33%" align="center">
                        <div class="coltime"><?php echo date('H:i',strtotime($layoverFlight['dt'])); ?></div>
                        <div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($layoverFlight['dt'])); ?></div>
                        <div class="graysmalltext">
                           <?php
                              $rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$layoverFlight['da']['code'].'"');
                              
                              $rscodedep=mysqli_fetch_array($rs); ?>
                           (<?php echo $layoverFlight['da']['code']; ?>) <?php echo strip($rscodedep['city']); ?><br /><?php echo strip($rscodedep['airportDescription']); ?>
                        </div>
                     </td>
                     <td width="33%" align="center">
                        <div class="nostops"><?php 
                           echo $hours = intdiv($layoverFlight['duration'], 60).'H :'. ($layoverFlight['duration'] % 60).' M';
                           
                           
                           
                           $duration=(strtotime($layoverFlight['at'])-strtotime($layoverFlight['dt']))/60;   makeFlightTime($duration); ?>  
                        </div>
                        <div style="margin-top:2px;">
                           <span class="green"><?php if($res['refundyes']=='1'){ echo '<span class="refundablespan">Refundable</span>'; } else { echo '<span class="nonrefundablespan">Non Refundable</span>'; } ?></span>
                        </div>
                     </td>
                     <td width="33%" align="center">
                        <div class="coltime">
                           <?php echo date('H:i',strtotime($layoverFlight['at'])); ?>
                        </div>
                        <div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($layoverFlight['at'])); ?></div>
                        <div class="graysmalltext">
                           <?php
                              $rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$layoverFlight['aa']['code'].'"');
                              
                              $rscodearr=mysqli_fetch_array($rs); ?>
                           (<?php echo $layoverFlight['aa']['code']; ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($rscodearr['airportDescription']); ?>
                        </div>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
         <?php if($layoverFlight['cT']>0){ ?>
         <div style="text-align: center; color: #0b0b0b; padding: 5px; background-color: #e4f8ff; font-weight: 600; margin:15px 0px;   ">Layover time: <?php echo sprintf("%d:%02d",   floor($layoverFlight['AccumulatedDuration']/60), $layoverFlight['AccumulatedDuration']%60);  ?> hours99999</div>
         <?php } ?>
         <?php
            if($_SESSION['isRoundTripInt']==1 && trim($res['DES_NAME'])==trim($layoverFlight['aa']['city'])){ ?>
         <div style="padding: 5px 10px; background-color: #f1f1f1; font-weight: 700; margin-bottom: 10px; margin-top:10px;">Return Flight</div>
         <?php }  ?>
         <?php } ?>
         <?php } } 
		 
		 
		 
		 
            if($res['apiType']=='tbo'){
            $d=1;
            $segmentsDataArr=(array) unserialize(stripslashes($res['PARAM_DATA']));		
            $numberOfStop=count($segmentsDataArr['Segments'][0]);
            if($numberOfStop>0){
            		foreach($segmentsDataArr['Segments'][0] as $segmentsDataArrValue){
			?>
         <div class="row multiflightbox">
            <?php if($d>1){?>
            <div style="text-align: center; color: #0b0b0b; padding: 5px; background-color: #e4f8ff; font-weight: 600; border-radius: 24px; margin-top:20px;"><?php 
               $lastdep=date('Y-m-d H:i:s',strtotime($segmentsDataArrValue['Origin']['DepTime']));
               
               $datetime1 = new DateTime($lastdep);
               $datetime2 = new DateTime($lastarr);
               $interval = $datetime1->diff($datetime2);
               $elapsed = $interval->format(' %h:%i hours');
               echo 'Layover time: '.$elapsed;
               
               ?></div>
            <?php } ?>
            <div class="col-3">
               <table border="0" cellpadding="0" cellspacing="0">
                  <tr>
                     <td colspan="2"><img src="<?php echo $imgurl.getflightlogo(stripslashes( $segmentsDataArrValue['Airline']['AirlineName'])); ?>" width="32" height="32"></td>
                     <td>
                        <div class="flightname"><?php echo $segmentsDataArrValue['Airline']['AirlineName']; ?> </div>
                        <div class="flightnumber"><?php echo $segmentsDataArrValue['Airline']['AirlineCode']; ?> <?php echo $segmentsDataArrValue['Airline']['FlightNumber']; ?></div>
                     </td>
                  </tr>
               </table>
            </div>
            <div class="col-9">
               <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                     <td width="33%" align="center">
                        <div class="coltime">
                           <?php echo date('H:i A',strtotime($segmentsDataArrValue['Origin']['DepTime'])); ?>
                        </div>
                        <div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($segmentsDataArrValue['Origin']['DepTime']));  ?></div>
                        <div class="graysmalltext"> 
                           <?php
                              $rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$segmentsDataArrValue['Origin']['Airport']['CityCode'].'"'); 
                              $rscodearr=mysqli_fetch_array($rs); ?>
                           (<?php echo $segmentsDataArrValue['Origin']['Airport']['CityCode']; ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($segmentsDataArrValue['Origin']['Airport']['AirportName']); ?>
                        </div>
                     </td>
                     <td width="33%" align="center">
                        <div class="nostops" style="font-size:15px; font-weight:800;"><?php echo sprintf("%d:%02d",   floor($segmentsDataArrValue['Duration']/60), $segmentsDataArrValue['Duration']%60);  ?></div>
                        <div style="margin-top:2px;">
                        </div>
                     </td>
                     <td width="33%" align="center">
                        <div class="coltime">
                           <?php echo date('H:i A',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); ?>
                        </div>
                        <div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); $lastarr=date('Y-m-d H:i:s',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); ?></div>
                        <div class="graysmalltext">
                           <?php
                              $rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$segmentsDataArrValue['Destination']['Airport']['CityCode'].'"'); 
                              $rscodearr=mysqli_fetch_array($rs); ?>
                           (<?php echo $segmentsDataArrValue['Destination']['Airport']['CityCode']; ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($segmentsDataArrValue['Destination']['Airport']['AirportName']); ?>
                        </div>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
         <?php
            $j++; 	$d++; }	
            	
            }
/*
            $ss=1;
            $numberOfStop=count($segmentsDataArr['Segments'][1]);
            if($numberOfStop>0){
            $Rhh=1;
            	foreach($segmentsDataArr['Segments'][1] as $segmentsDataArrValue)
            	{
            	if($Rhh==1){
            	?>
         <div style="padding: 5px 10px; background-color: #f1f1f1; font-weight: 700; margin-bottom: 10px; margin-top:10px;">Return Flight</div>
         <?php
            }
            ?>
         <div class="row multiflightbox">
            <?php if($ss>1){?>
            <div style="text-align: center; color: #0b0b0b; padding: 5px; background-color: #e4f8ff; font-weight: 600; border-radius: 24px; margin-top:20px;"><?php 
               $lastdep=date('Y-m-d H:i:s',strtotime($segmentsDataArrValue['Origin']['DepTime']));
               
               $datetime1 = new DateTime($lastdep);
               $datetime2 = new DateTime($lastarr);
               $interval = $datetime1->diff($datetime2);
               $elapsed = $interval->format(' %h:%i hours');
               echo 'Layover time: '.$elapsed;
               
               ?></div>
            <?php } ?>
            <div class="col-3">
               <table border="0" cellpadding="0" cellspacing="0">
                  <tr>
                     <td colspan="2"><img src="<?php echo $imgurl.getflightlogo(stripslashes( $segmentsDataArrValue['Airline']['AirlineName'])); ?>" width="32" height="32"></td>
                     <td>
                        <div class="flightname"><?php echo $segmentsDataArrValue['Airline']['AirlineName']; ?> </div>
                        <div class="flightnumber"><?php echo $segmentsDataArrValue['Airline']['AirlineCode']; ?> <?php echo $segmentsDataArrValue['Airline']['FlightNumber']; ?></div>
                     </td>
                  </tr>
               </table>
            </div>
            <div class="col-9">
               <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                     <td width="33%" align="center">
                        <div class="coltime">
                           <?php echo date('H:i A',strtotime($segmentsDataArrValue['Origin']['DepTime'])); ?>
                        </div>
                        <div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($segmentsDataArrValue['Origin']['DepTime']));  ?></div>
                        <div class="graysmalltext"> 
                           <?php
                              $rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$segmentsDataArrValue['Origin']['Airport']['CityCode'].'"'); 
                              $rscodearr=mysqli_fetch_array($rs); ?>
                           (<?php echo $segmentsDataArrValue['Origin']['Airport']['CityCode']; ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($segmentsDataArrValue['Origin']['Airport']['AirportName']); ?>
                        </div>
                     </td>
                     <td width="33%" align="center">
                        <div class="nostops" style="font-size:15px; font-weight:800;"><?php echo sprintf("%d:%02d",   floor($segmentsDataArrValue['Duration']/60), $segmentsDataArrValue['Duration']%60);  ?></div>
                        <div style="margin-top:2px;">
                        </div>
                     </td>
                     <td width="33%" align="center">
                        <div class="coltime">
                           <?php echo date('H:i A',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); ?>
                        </div>
                        <div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); $lastarr=date('Y-m-d H:i:s',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); ?></div>
                        <div class="graysmalltext">
                           <?php
                              $rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$segmentsDataArrValue['Destination']['Airport']['CityCode'].'"'); 
                              $rscodearr=mysqli_fetch_array($rs); ?>
                           (<?php echo $segmentsDataArrValue['Destination']['Airport']['CityCode']; ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($segmentsDataArrValue['Destination']['Airport']['AirportName']); ?>
                        </div>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
         <?php
            $j++; 	$d++; $ss++; $Rhh++; }
            }
			*/
            
            }
            ?>
      </div>
   </div>
</div>
<div class="detailscontent<?php echo $res['id']; ?>"  id="tabid3<?php echo $res['id']; ?>">
   <div class="row">
      <div class="col-12">
         <table width="100%" border="0" cellpadding="0" cellspacing="0" class="baggageclass">
            <tr>
               <td width="33%" align="left" bgcolor="#f5f5f5"><strong>Airline</strong></td>
               <td width="33%" align="left" bgcolor="#f5f5f5"><strong>Check-in Baggage</strong></td>
               <td width="33%" align="left" bgcolor="#f5f5f5"><strong>Cabin Baggage</strong></td>
            </tr>
            <tr>
               <td width="33%" align="left">
                  <table border="0" cellpadding="0" cellspacing="0">
                     <tr>
                        <td colspan="2"><img src="<?php echo $imgurl.getflightlogo(stripslashes($res['FLIGHT_NAME'])); ?>"  height="32"></td>
                        <td>
                           <div class="flightname"><?php echo stripslashes($res['FLIGHT_NAME']); ?></div>
                           <div class="flightnumber"><?php echo stripslashes($res['FLIGHT_CODE']); ?>-<?php echo stripslashes($res['FLIGHT_NO']); ?></div>
                        </td>
                     </tr>
                  </table>
               </td>
               <td width="33%" align="left"><?php 		$segmentsDataArr=(array) unserialize(stripslashes($res['PARAM_DATA'])); echo $segmentsDataArr['Segments'][0][0]['Baggage']; ?></td>
               <td width="33%" align="left"><?php echo $segmentsDataArr['Segments'][0][0]['CabinBaggage']; ?></td>
            </tr>
            <tr>
               <td colspan="3" align="left">
                  <div  style="padding:10px; background-color:#F5F5F5;">
                     Baggage information mentioned above is obtained from airline's reservation system, <?php echo stripslashes($getcompanybasicinfo['companyName']); ?> does not guarantee the accuracy of this information.<br />
                     The baggage allowance may vary according to stop-overs, connecting flights. changes in airline rules. etc. 
                  </div>
               </td>
            </tr>
         </table>
      </div>
   </div>
</div>
<div class="detailscontent<?php echo $res['id']; ?>"  id="tabid2<?php echo $res['id']; ?>">
   <div class="row">
      <div class="col-6">
         <div style="margin-bottom:10px; font-size:16px;"><strong>Fare Breakup</strong></div>
         <table width="100%" border="0" cellpadding="0" cellspacing="0" class="baggageclass">
            <tr>
               <td width="33%" align="left">Base Fare</td>
               <td width="33%" align="left">&#8377;<?php $str_arr = explode (",", $res['agfare']);  
                  $basefare = explode ("=", $str_arr[0]);
                  
                  echo $basefare[1];
                  
                    ?></td>
            </tr>
            <tr>
               <td align="left">Surcharges & Taxes</td>
               <td align="left">&#8377;<?php 
                  $basefare = explode ("=", $str_arr[1]);
                  
                  echo $basefare[1];
                  
                    ?></td>
            </tr>
            <tr>
               <td align="left" bgcolor="#F7F7F7"><strong>Total Fare</strong></td>
               <td align="left" bgcolor="#F7F7F7"><strong>&#8377;<?php 
                  $basefare = explode ("=", $str_arr[2]);
                  
                  echo $basefare[1];
                  
                    ?></strong></td>
            </tr>
            <tr>
               <td align="left">Commission (-)</td>
               <td align="left">&#8377;<?php echo $res['acom']; ?></td>
            </tr>
            <tr>
               <td align="left">GST</td>
               <td align="left">&#8377;<?php echo $totalgst=round($res['acom']*18/100); ?></td>
            </tr>
            <tr>
               <td align="left">TDS</td>
               <td align="left">&#8377;<?php echo $totaltds=round($res['acom']*5/100); ?></td>
            </tr>
            <tr>
               <td align="left" bgcolor="#FFF9EA"><strong>Net Price</strong></td>
               <td align="left" bgcolor="#FFF9EA"><strong>&#8377;<?php 
                  $basefare = explode ("=", $str_arr[2]);
                  echo (($basefare[1]+$totalcommissiongstdisplay+$totalgst+$totaltds)-$res['acom']);
                  ?></strong></td>
            </tr>
         </table>
      </div>
   </div>
</div>
<div class="detailscontent<?php echo $res['id']; ?>"  id="tabid4<?php echo $res['id']; ?>">
   <?php
      if($res['apiType']=='kafila'){ 
      
       
      
      $flight_name=stripslashes($res['FLIGHT_NAME']);
      
      $flight_pcc=explode("~",stripslashes($res['PCC'])); 
      
      $pcc_query=GetPageRecord('*','fareTypeMaster','flightName="'.$flight_name.'" and fareTypeName="'.$flight_pcc[1].'"');
      
      $pcc_row=mysqli_fetch_array($pcc_query);
      
       echo $pcc_row['cancellationPolicy'];
      
       
      
       if($pcc_row['cancellationPolicy']==''){
      
       $arr = unserialize(stripslashes($res['PARAM_DATA']));
      
      
      
       
      
      
      
           $jsonPost = '{
      
         "NAME":"FARE_CHECK",
      
         "STR":[
      
            {
      
               "FLIGHT":{
      
                  "UID":"'.$res['UID'].'",
      
                  "ID":"'.$res['ResultIndex'].'",
      
                  "TID":"'.$res['TID'].'"
      
               },
      
               "PARAM":'.json_encode($arr[0]).',
      
               "GSTINFO":{
      
                  "hasGST":"false"
      
               }
      
            }
      
         ],
      
         "TYPE":"AIR"
      
      }';	
      
      
      
      	$ch = curl_init();
      
      	curl_setopt($ch, CURLOPT_URL,$SeatAvailUrl);
      
      	curl_setopt($ch, CURLINFO_HEADER_OUT, true);
      
      	curl_setopt($ch, CURLOPT_POST,1);
      
      	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
      
      	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      
      	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      	
      
      			curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
      
      		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
      
      		curl_setopt($ch, CURLOPT_TIMEOUT, 300); 
      
      		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
      
      	
      
      	$response = curl_exec($ch); 
      
      	curl_close($ch);
      
      	
      
      	
      
      	$data = json_decode($response);	
      
      	 
      
      	
      
      	echo $data->FARE_RULE[0]->FARE_RULE;
      
      	}
      
      	
      
      }	
      
      
      
      
      
      if($res['apiType']=='tbo'){ 
      
      $ResultIndex=$res['ResultIndex'];
      
      include 'FLYTBOAPI/FareRulesOB.php'; 
      
      $_SESSION['ob-farerule-result']= $fare_rule_result;
      
      
      
      $frule_res= $fare_rule_result;; 
      
      $fare_Origin= $frule_res['Response']['FareRules']['0']['Origin'];
      
      $fare_Destination= $frule_res['Response']['FareRules']['0']['Destination'];
      
      $FareRuleDetail= $frule_res['Response']['FareRules']['0']['FareRuleDetail'];
      
      ?>
   <style>
      #fareruledetails table{border:1px solid #ddd !important; width:100% !important;}
      #fareruledetails table tr td{border:1px solid #ddd !important; background-color:#FFFFFF; padding:10px !important; font-size:12px !important;}
      #fareruledetails table th{padding:10px; background-color:#F4F4F4 !important;}
   </style>
   <div class="fareruledivbox">
      <div id="fareruledetails" style="color:#000000;">
         <?php
            $segmentsDataArr=(array) unserialize(stripslashes($res['PARAM_DATA'])); 
            if($segmentsDataArr['AirlineRemark']!=''){
            ?>
         <div style="margin-bottom:10px; color:#CC3300; color:#CC3300; font-size:13px;"><strong>Airline Remark: <?php echo $segmentsDataArr['AirlineRemark']; ?></strong></div>
         <?php } ?>
         <?php echo str_replace('-------------------------------------------------','<br>',$FareRuleDetail); ?>
      </div>
   </div>
   <?php
      }
      
      
      
      if($res['apiType']=='tripjack'){
      
      	include 'tripjackAPI/APIConstants.php';
      
      	include 'tripjackAPI/RestApiCaller.php';
      
      	
      
      	$ResultIndex=$res['ResultIndex'];
      
      	$sourceKey=$res['ORG_CODE']."-".$res['DES_CODE'];
      
      	include_once 'tripjackAPI/fareRule.php';
      
      	
      
      	// $dd=unserialize(stripslashes($res['searchJson']));
      
      	// print_r($dd);
      
      	 
      
      	// print_r($fareRuleResult);
      
         if(count($fareRuleResult['fareRule'])>0)
      
         {
      
         
      
         $fareRuleResultArr=$fareRuleResult['fareRule'][$sourceKey]['fr'];
      
         
      
        // print_r($fareRuleResultArr);
      
      ?>
   <style>
      .detailscontent<?php echo $res['id']; ?> table { caption-side: bottom; border-collapse: collapse; font-family: arial; font-size: 13px; }
   </style>
   <div style="font-size:18px; font-weight:600; margin-bottom:5px;">Cancellation Fee</div>
   <div style="margin-bottom:2px; font-size:15px; font-weight:600; color:#CC0000;">&#8377; <?php echo str_replace('	','',str_replace('__nls__','',$fareRuleResultArr['CANCELLATION']['DEFAULT']['amount'])); ?> +  &#8377;<?php echo $fareRuleResultArr['CANCELLATION']['DEFAULT']['additionalFee']; ?></div>
   <div style="margin-bottom:20px;"><?php echo  strip_tags(str_replace('	','',str_replace('__nls__','',$fareRuleResultArr['CANCELLATION']['DEFAULT']['policyInfo']))); ?></div>
   <div style="font-size:18px; font-weight:600; margin-bottom:5px;">Date Change Fee</div>
   <div style="margin-bottom:2px; font-size:15px; font-weight:600; color:#CC0000;">&#8377; <?php echo str_replace('	','',str_replace('__nls__','',$fareRuleResultArr['DATECHANGE']['DEFAULT']['amount'])); ?> +  &#8377;<?php echo $fareRuleResultArr['DATECHANGE']['DEFAULT']['additionalFee']; ?></div>
   <div style="margin-bottom:20px;"><?php echo  strip_tags(str_replace('	','',str_replace('__nls__','',$fareRuleResultArr['DATECHANGE']['DEFAULT']['policyInfo']))); ?></div>
   <div style="font-size:18px; font-weight:600; margin-bottom:5px;">No Show</div>
   <div style="margin-bottom:20px;"><?php echo  strip_tags(str_replace('	','',str_replace('__nls__','',$fareRuleResultArr['NO_SHOW']['DEFAULT']['policyInfo']))); ?></div>
   <div style="font-size:18px; font-weight:600; margin-bottom:5px;">Seat Chargeable</div>
   <div style="margin-bottom:20px;"><?php echo  strip_tags(str_replace('	','',str_replace('__nls__','',$fareRuleResultArr['SEAT_CHARGEABLE']['DEFAULT']['policyInfo']))); ?></div>
   <?php } else { echo "No Data Found"; } ?>
   <?php
      }
       
      ?>
</div>
<script>
   function flightdetailstab<?php echo $res['id']; ?>(id){
   $('.detailsboxtabs<?php echo $res['id']; ?> a').removeClass('active');
   $('.detailscontent<?php echo $res['id']; ?>').hide();
   $('#tabid'+id).show(); 
   $('#fltb'+id).addClass('active');
   }
   <?php if($res['tripType']==3){ ?>
   flightdetailstab<?php echo $res['id']; ?>(4<?php echo $res['id']; ?>);
   <?php }else{ ?>
   flightdetailstab<?php echo $res['id']; ?>(1<?php echo $res['id']; ?>);
   <?php } ?>
</script>