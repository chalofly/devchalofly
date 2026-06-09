<style>

   .offerbardealsfeature {

   box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px ;

   border-radius: 5px;

   padding: 20px;

   margin-top: 30px;

   }

   .easybox{background: #e1eaff; border: solid 1px #689cff;border-radius: 5px; padding: 20px;} 

   .easybox2{background: #c3e2ff; border: solid 1px #5ea5e8;border-radius: 5px; padding: 20px;} 

   .easybox3{background: #fff6d9; border: solid 1px #f1da95;border-radius: 5px; padding: 20px;} 

   .easybox4{background: #d6e3ff; border: solid 1px #a3c0ff;border-radius: 5px; padding: 20px;}

   .playstore{background: #002f7c; border-radius: 10px; border: solid 1px #002f7c; padding: 30px 40px; margin-top: 30px;}

   .domesticair{font-size: 36px; color: #fc7700; font-weight: 700; margin: 0 0 10px; text-align: center;}

   .domesticair span{color: #fff;}

   .airlond{color: #10be00;}

   .busdestination{position:relative; margin-bottom: 25px;}

   .destinationimg{position:relative;}

   .destinationimg img{border-radius: 5px;}

   .packagedestination{position: absolute; bottom: 0; left: 0;  right: 0; text-align: center; background-color: rgb(31 31 31 / 76%); border-radius: 0 0 5px 5px;}

   .packagedestination a{color: #fff; font-size:21px; text-decoration: none; font-weight:700; padding: 10px; display:block;}

   .populartext{margin: 0 !important; padding: 0 0 20px !important; font-size: 30px !important;}

</style>

<div class="row" style="padding-left: 3px !important;padding-right: 3px !important;">

   <div class="col-lg-12">

      <div class="offerbardealsfeature">

         <div class="offerheading">

            <p style="    margin: 0px; font-weight: 700"><?php echo stripslashes($clientwebsitesection['sectionName']); ?></p>

         </div>

         <div class="col-lg-12">

            <div class="card" style="border: 0px !important;">

               <div class="card-body">

                  <div class="row">

                     <div class="col-lg-3">

                        <div class="easybox">

                           <table width="100%" border="0" cellpadding="0" cellspacing="0">

                              <tbody>

                                 <tr>

                                    <td colspan="2"><img src="images/hand1.png" width="64">

                                    </td>

                                    <td width="90%" style="padding-left:5px;">

                                       <div style="font-size:18px; font-weight:700;">Easy Booking</div>

                                       <!--<div style="font-size:11px; font-weight:600; color:#666666;">10000+ Happy Customers</div>-->

                                    </td>

                                 </tr>

                              </tbody>

                           </table>

                        </div>

                     </div>

                     <div class="col-lg-3">

                        <div class="easybox2">

                           <table width="100%" border="0" cellpadding="0" cellspacing="0">

                              <tbody>

                                 <tr>

                                    <td colspan="2"><img src="images/hand2.png" width="64">

                                    </td>

                                    <td width="90%" style="padding-left:5px;">

                                       <div style="font-size:18px; font-weight:700;">Lowest Price </div>

                                       <!-- <div style="font-size:11px; font-weight:600; color:#666666;">Safe holidays with assured stays, clean cabs &amp; 24x7 support</div>-->

                                    </td>

                                 </tr>

                              </tbody>

                           </table>

                        </div>

                     </div>

                     <div class="col-lg-3">

                        <div class="easybox3">

                           <table width="100%" border="0" cellpadding="0" cellspacing="0">

                              <tbody>

                                 <tr>

                                    <td colspan="2"><img src="images/hand3.png" width="64">

                                    </td>

                                    <td width="90%" style="padding-left:5px;">

                                       <div style="font-size:18px; font-weight:700;">Best Deal </div>

                                       <!-- <div style="font-size:11px; font-weight:600; color:#666666;">Cancel or reschedule your holiday to suit your needs.</div>-->

                                    </td>

                                 </tr>

                              </tbody>

                           </table>

                        </div>

                     </div>

                     <div class="col-lg-3">

                        <div class="easybox4">

                           <table width="100%" border="0" cellpadding="0" cellspacing="0">

                              <tbody>

                                 <tr>

                                    <td colspan="2"><img src="images/hand4.png" width="64">

                                    </td>

                                    <td width="90%" style="padding-left:5px;">

                                       <div style="font-size:18px; font-weight:700;">Support</div>

                                       <!--<div style="font-size:11px; font-weight:600; color:#666666;">Best deals and offers in the industry</div>-->

                                    </td>

                                 </tr>

                              </tbody>

                           </table>

                        </div>

                     </div>

                  </div>

               </div>

            </div>

         </div>

      </div>

   </div>

</div>

<div class="row">

   <div class="col-lg-12">

      <div class="playstore">

         <div class="domesticair">

            Popular <span>Domestic</span><span class="airlond"> Airlines </span>

         </div>

      </div>

      <div></div>

   </div>

</div>





<div class="offerrow">

   <div class="row">

      <div class="col-12 col-lg-12">

         <div class="offerbardealsfeaturedes">

            <div class="offerlaftside">

               <h2>Domestic Airlines<?php //echo stripslashes($clientwebsitesection['sectionName']); ?></h2>

            </div>

            <div class="row" style="padding-left: 3px;padding-right: 3px;">

               <div class="offerheadingflight1">

                  <div class="offerrightside2">

                     <div class="tab-wrapper">

                        <ul class="tabs">

                           <?php

                              $active="active";

                              $popDest=GetPageRecord('destinationId','popularDestinations','status="1" and type="0" group by destinationId order by id desc ');

                              while($popDestData=mysqli_fetch_array($popDest)){

                              $rs=GetPageRecord('*','websiteDestination',' id="'.$popDestData["destinationId"].'" order by name asc'); 

                              $rsData=mysqli_fetch_array($rs);

                              ?>

                           <li class="tab-link <?php echo $active; ?>" data-tab="Domestic_<?php echo $popDestData["destinationId"]; ?>"><?php echo $rsData["name"]; ?></li>

                           <?php $active=""; } ?>

                        </ul>

                     </div>

                  </div>

               </div>

               <div class="content-wrapper">

<?php

$journeyDate = date('d-m-Y', strtotime("+1 day"));

$active="active";

$popDest1=GetPageRecord('*','popularDestinations','status="1" and type="0" group by destinationId order by id desc ');

while($popDestData1=mysqli_fetch_array($popDest1)){

?>

                  <div id="tab-Domestic_<?php echo $popDestData1["destinationId"]; ?>" class="tab-content <?php echo $active; ?>">

                     <table style="width:100%;">

						<tr>

<?php

$popDest2=GetPageRecord('*','popularDestinations','status="1" and type="0" and destinationId="'.$popDestData1["destinationId"].'"');

while($popDestData2=mysqli_fetch_array($popDest2)){	

	

$fromSector=GetPageRecord('*','flightDestinationMaster','airportCode="'.$popDestData2["fromSector"].'"');

$fromSectorData=mysqli_fetch_array($fromSector);

$toSector=GetPageRecord('*','flightDestinationMaster','airportCode="'.$popDestData2["toSector"].'"');

$toSectorData=mysqli_fetch_array($toSector);

?>

                        

                           <td style="padding:5px">

                              <div class="boxordercity">

                                 <a target="_blank" href="<?php echo $fullurl; ?>flight-search?tripType=1&fromcitydesti=<?php echo $popDestData2["fromSector"]; ?>-<?php echo $fromSectorData["city"]; ?>&fromDestinationFlight=<?php echo $popDestData2["fromSector"]; ?>-<?php echo $fromSectorData["country"]; ?>&tocitydesti=<?php echo $popDestData2["toSector"]; ?>-<?php echo $toSectorData["city"]; ?>&toDestinationFlight=<?php echo $popDestData2["toSector"]; ?>-<?php echo $toSectorData["country"]; ?>&journeyDateOne=<?php echo $journeyDate; ?>&travellersshow=1+Pax%2C+Economy&ADT=1&CHD=0&INF=0&showflightrow=1&fromcitydesti2=&fromDestinationFlight2=&tocitydesti2=&toDestinationFlight2=&journeyDate2=&fromcitydesti3=&fromDestinationFlight3=&tocitydesti3=&toDestinationFlight3=&journeyDate3=&fromcitydesti4=&fromDestinationFlight4=&tocitydesti4=&toDestinationFlight4=&journeyDate4=&fromcitydesti5=&fromDestinationFlight5=&tocitydesti5=&toDestinationFlight5=&journeyDate5=&psting=&action=flightpostaction&changesearch=0">

                                    <table cellpadding="">

                                       <tr>

                                          <td width="40%" class="citynewdelhi"><?php echo $popDestData2["fromSector"]; ?></td>

                                          <td width="20%" align="center" class="citynewdelhi"><i class="fa fa-long-arrow-right"></i></td>

                                          <td width="40%" align="right" class="citynewdelhi"><?php echo $popDestData2["toSector"]; ?></td>

                                       </tr>

                                       <tr>

                                          <td class="stratprice" >Starting </td>

                                          <td class="stratprice" colspan="2" align="right">&nbsp;&nbsp;Price <span class="box-price">₹ <?php echo $popDestData2["startingPrice"]; ?></span></td>

                                       </tr>

                                    </table>

                                 </a>

                              </div>

                           </td>

                        

<?php } ?></tr>

                     </table>

                  </div>

				 <?php $active=""; } ?>

				  

				 </div>

               <!--  <?php

                  $dm = GetPageRecord('*', 'websiteDestination', 'name in (SELECT destinations FROM sys_packageBuilder WHERE showwebsite=1  and showinPopular=1 )  order by rand() limit 6');

                  while ($destinationMaster = mysqli_fetch_array($dm)) {

                  ?>

                  <div class="col-lg-3" style="margin-bottom:10px;">

                  

                    <div class="card" style="border-radius: 20px !important; overflow: hidden; box-shadow: 0px 10px 18px #29426917 !important;margin-top: 0px;border: 0px;">

                  

                      <a href="holidays-search?holidaysdestination=<?php echo stripslashes($destinationMaster["name"]); ?>&Submit=SEARCH&action=flightpostaction&changesearch=0">

                  

                        <div class="mobedit1" style="border-radius: 20px; height:200px; object-fit: cover; margin-right:10px; overflow:hidden;border-radius: 5px;margin-right: 10px; margin-top: 0px !important; margin: 5px;"><img src="<?php echo $packagephotourl; ?><?php echo stripslashes($destinationMaster['photo']); ?>" style="width:100%; height:100%; border-radius: 20px !important;"></div>

                  

                        <table width="100%" border="0" cellpadding="0" cellspacing="0"> 

                          <tbody> 

                  

                            <tr> 

                  

                              <td width="90%" style="font-size: 13px;padding-left: 10px; font-weight: 700;color:#000 !important; text-align:center; padding:0px 0px 5px;"><?php echo stripslashes($destinationMaster["name"]); ?></td>

                            </tr>

                          </tbody>

                        </table>

                  

                      </a>

                  

                    </div>

                  

                  </div>

                  

                  <?php } ?> -->

            </div>

         </div>

      </div>

   </div>

</div>

<script>

   $('.tab-link').click( function() {

   	

   	var tabID = $(this).attr('data-tab');

   	

   	$(this).addClass('active').siblings().removeClass('active');

   	

   	$('#tab-'+tabID).addClass('active').siblings().removeClass('active');

   });

</script>







<div class="offerrow ">

   <div class="row">

      <div class="col-12 col-lg-12">

         <div class="offerbardealsfeaturedes">

            <div class="offerheading">

               <h3 class="populartext">Popular Destinations</h3>

            </div>

            <div class="row popularrowfix" style="padding-left: 3px;padding-right: 3px;">

<div class="owl-carousel owl-theme popular-destination-carousel">

<?php

$dm = GetPageRecord(
    '*',
    'websiteDestination',
    'name in (
        SELECT destinations 
        FROM sys_packageBuilder 
        WHERE showwebsite=1 and showinPopular=1
    ) order by id desc'
);

while ($destinationMaster = mysqli_fetch_array($dm)) {

?>

    <div class="item">

        <div class="busdestination">

            <div class="destinationimg">

                <img src="<?php echo $packagephotourl . stripslashes($destinationMaster['photo']); ?>"
                     style="width:100%; height:250px; object-fit:cover;" />

            </div>

            <div class="packagedestination">

                <a href="<?php echo $fullurl; ?>holidays-search?holidaysdestination=<?php echo stripslashes($destinationMaster["name"]); ?>&Submit=SEARCH&action=flightpostaction&changesearch=0">

                    <?php echo stripslashes($destinationMaster["name"]); ?>

                </a>

            </div>

        </div>

    </div>

<?php } ?>

</div>

            </div>

         </div>

      </div>

   </div>

</div>

</div>

</div>