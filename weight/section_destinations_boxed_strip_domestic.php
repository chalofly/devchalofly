<div class="offerrow">

   <div class="row">

      <div class="col-12 col-lg-12">

         <div class="offerbardealsfeaturedes famosudesti">

            <div class="offerlaftside">

               <h2><?php echo stripslashes($clientwebsitesection['sectionName']); ?></h2>

            </div>

            <div class="row" style="padding-left: 3px;padding-right: 3px;">

               <div class="offerheadingflight1">

                  <div class="offerrightside2">

                     <div class="tab-wrapper">

                        <ul class="tabs">

                           <?php

                              $active="active";

                              $popDest=GetPageRecord('destinationId','popularDestinations','status="1" group by destinationId order by id desc ');

                              while($popDestData=mysqli_fetch_array($popDest)){

                              	

                              $rs=GetPageRecord('*','websiteDestination',' id="'.$popDestData["destinationId"].'"  order by name asc'); 

                              $rsData=mysqli_fetch_array($rs);

                              ?>

                           <li class="tab-link <?php echo $active; ?>" data-tab="<?php echo $popDestData["destinationId"]; ?>"><?php echo $rsData["name"]; ?></li>

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

                  <div id="tab-<?php echo $popDestData1["destinationId"]; ?>" class="tab-content <?php echo $active; ?>">

                     <table style="width:100%;">

						<tr>

<?php

$popDest2=GetPageRecord('*','popularDestinations','status="1" and destinationId="'.$popDestData1["destinationId"].'"');

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

                                          <td class="stratprice" colspan="2">Starting </td>

                                          <td class="stratprice" align="right">Price ₹ <?php echo $popDestData2["startingPrice"]; ?></td>

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