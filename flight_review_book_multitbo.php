<?php  
   include "inc.php";  
   include "config/logincheck.php";  
   include 'FLYTBOAPI/APIConstants.php';
   include 'FLYTBOAPI/RestApiCaller.php';
   
   $selectedpage='flights';
   
   $_SESSION['agentprice']=$_REQUEST['hgaid'];
   $randval=rand('000000','999999');
   $_SESSION['randval']=$randval;
   
   // checkLCC
   $isLCCchk=0;
   $a=GetPageRecord('*','wig_flight_json_bkp',' id="'.decode($_REQUEST['i']).'" and agentId="'.$_SESSION['agentUserid'].'"');
   $res=mysqli_fetch_array($a);
   
   $ResultIndex=$res['ResultIndex'];
   $_SESSION['ResultIndex']=$ResultIndex;

   include_once dirname(__FILE__).'/FLYTBOAPI/FlightFarequote.php';

   $bookingServiceType='flight';
   $_SESSION['serviceId']=encode($res['id']);
   
   if($res['id']=="" || $res['id']<1){
   echo "Something went wrong...<br>Please back to search page.";
   exit();
   }
   
   $ResultIndex=$res['ResultIndex'];
   $_SESSION['ResultIndex']=$ResultIndex;
   
   $totalcommission=0;
   $totalcommission = $res['acom'];
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <title>Flight Booking Review - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
      <?php include "headerinc.php"; ?>
      <style>
         @media(max-width:576px){
         .flightreview .container{overflow: auto !important;white-space: nowrap !important;}
         }
      </style>
   </head>
   <body>
      <?php include "header.php"; ?>
      <div class="top_bg_ofr_sb2 flightreview">
         <div class="container">
            <table border="0" align="left" cellpadding="0" cellspacing="0">
               <tr>
                  <td >
                     <table border="0" cellpadding="0" cellspacing="0" class="flightreviewbox active" id="strp1"  >
                        <tr>
                           <td colspan="2">
                              <div class="iconfa"><i class="fa fa-plane" aria-hidden="true"></i></div>
                           </td>
                           <td>
                              <div class="steptext">FIRST STEP</div>
                              Flight Itinerary
                           </td>
                        </tr>
                     </table>
                  </td>
                  <td class="showonlyaftercheck">
                     <div class="midline"></div>
                  </td>
                  <td class="showonlyaftercheck">
                     <table border="0" cellpadding="0" cellspacing="0" class="flightreviewbox" id="strp2" >
                        <tr>
                           <td colspan="2">
                              <div class="iconfa"><i class="fa fa-user" aria-hidden="true"></i></div>
                           </td>
                           <td>
                              <div class="steptext">SECOND STEP</div>
                              Passenger Details
                           </td>
                        </tr>
                     </table>
                  </td>
                  <td  class="showonlyaftercheck">
                     <div class="midline"></div>
                  </td>
                  <td class="showonlyaftercheck">
                     <table border="0" cellpadding="0" cellspacing="0" class="flightreviewbox" id="strp4">
                        <tr>
                           <td colspan="2">
                              <div class="iconfa"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></div>
                           </td>
                           <td>
                              <div class="steptext">FINISH STEP</div>
                              Payments
                           </td>
                        </tr>
                     </table>
                  </td>
               </tr>
            </table>
         </div>
      </div>
      <div class="container" style="margin-top:20px; margin-bottom:20px;">
         <form id="flightbookingsubmit" method="post" action="flight-booking-action-multicity" target="bookingframe">
            <div class="row" id="bookingdatainfo">
               <div class="col-9" style="min-height:500px;">
                  <input name="coid" id="coid" type="hidden" value="0" >
                  <div class="row">
                     <div class="col-12" style="position:relative; margin-bottom:20px;">
                        <h2>Flight Details </h2>
                        <div class="card cardresult" style="width:100%;" >
                           <div class="card-header">Itinerary Info</div>
                           <div class="card-body" id="loadonewaytrip">
                              <?php
                                 $segments=GetPageRecord('*','wig_flight_json_bkp','ResultIndex="'.$res['ResultIndex'].'" ORDER BY id ASC');
                                 while($segmentsData=mysqli_fetch_array($segments)){
                                 ?>
                              <div class="bookdetail">
                                 <div class="bookimg">
                                    <div class="bkimg"> <img src="<?php echo $imgurl.getflightlogo(stripslashes($segmentsData['FLIGHT_NAME'])); ?>" alt=""> </div>
                                    <h6><?php echo stripslashes($segmentsData['FLIGHT_NAME']); ?> <br>
                                       <span><?php echo stripslashes($segmentsData['FLIGHT_CODE']); ?> <?php echo stripslashes($segmentsData['FLIGHT_NO']); ?></span>
                                    </h6>
                                 </div>
                                 <div class="bookboxprice">
                                    <h6><?php echo stripslashes($segmentsData['DEP_TIME']); ?></h6>
                                    <p class="destination"><?php echo stripslashes($segmentsData['ORG_CODE']); ?></p>
                                 </div>
                                 <div class="nonstop">
                                    <h4><?php echo $segmentsData['DUR']; ?></h4>
                                    <div class="nonstopborder"><i class="fa fa-plane" aria-hidden="true"></i> </div>
                                 </div>
                                 <div class="bookboxprice">
                                    <h6><?php echo stripslashes($segmentsData['ARRV_TIME']); ?>
                                       <?php 
                                          $now = strtotime(date('Y-m-d',strtotime($segmentsData['ARRV_DATE']))); // or your date as well
                                          $your_date = strtotime(date('Y-m-d',strtotime($segmentsData['DEP_DATE'])));
                                          $datediff = $now - $your_date;
                                          $plusdays=round($datediff / (60 * 60 * 24));
                                          if($plusdays>0){
                                          ?>
                                       <span style="color:#CC3300; font-size:11px; display: block;">+<?php echo $plusdays; ?> Day(s)</span>
                                       <?php } ?>
                                    </h6>
                                    <p class="destination"><?php echo stripslashes($segmentsData['DES_CODE']); ?></p>
                                 </div>
                              </div>
                              <div class="bookmsg">
                                 <?php if(stripslashes(getfaretypedetails(stripslashes($segmentsData['FLIGHT_NAME']),stripslashes($segmentsData['PCC'])))!=''){?>
                                 <p><?php echo stripslashes(getfaretypedetails(stripslashes($segmentsData['FLIGHT_NAME']),stripslashes($segmentsData['PCC']))); ?></p>
                                 <?php } ?>
                              </div>
                              <div class="refundtable">
                                 <table>
                                    <tbody>
                                       <tr>
                                          <td><i class="fa fa-credit-card-alt" aria-hidden="true"></i> <span class="green">
                                             <?php if($segmentsData['refundyes']=='1'){ echo '<span class="refundablespan">Refundable</span>'; } else { echo '<span class="nonrefundablespan">Non Refundable</span>'; } ?>
                                             </span>&nbsp;&nbsp;&nbsp;
                                          </td>
                                          <td><i class="fa fa-user-circle-o" aria-hidden="true"></i> <span class="red"> <?php echo stripslashes($segmentsData['SEAT']); ?> Seat Left </span> </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <?php
                                 }
                                 ?>
                           </div>
                        </div>
                        
                     </div>
                     <div class="col-12" style="position:relative;display:none;"  id="steptwopassengerdetails">
                        <h2>
                           Passenger Details
                           <script>
                              function clearfield(){
                              $('#steptwopassengerdetails input').val('');
                              $('#steptwopassengerdetails select').val('');
                              }
                           </script>
                        </h2>
                        <div class="card cardresult" style="width:100%;">
                           <!-- Input -->
                           <?php //$param_arr = unserialize(stripslashes($res['PARAM_DATA'])); ?>
                           <?php for($adult=1; $adult<=$_SESSION['ADT']; $adult++){ ?>
                           <div class="card-header">Adult <?php echo $adult; ?> (12 + yrs)</div>
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-sm-2 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       Title
                                       </label>
                                       <select class="form-control validate1" name="titleAdt<?php echo $adult; ?>" id="titleAdt<?php echo $adult; ?>">
                                          <option value="">Select</option>
                                          <option value="Mr">Mr.</option>
                                          <option value="Mrs">Mrs</option>
                                          <option value="Ms">Ms.</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       First Name
                                       </label>
                                       <input type="text" class="form-control validate1" name="firstNameAdt<?php echo $adult; ?>" id="firstNameAdt<?php echo $adult; ?>" placeholder="" aria-label="" required
                                          data-msg="Please enter your first name."
                                          data-error-class="u-has-error"
                                          data-success-class="u-has-success" autocomplete="nope">
                                    </div>
                                 </div>
                                 <!-- End Input -->
                                 <!-- Input -->
                                 <div class="col-sm-3 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       Last name
                                       </label>
                                       <input type="text" class="form-control validate1" name="lastNameAdt<?php echo $adult; ?>" id="lastNameAdt<?php echo $adult; ?>" required
                                          data-msg="Please enter your last name."
                                          data-error-class="u-has-error"
                                          data-success-class="u-has-success" autocomplete="nope">
                                    </div>
                                 </div>
                                 <!-- End Input -->
                                 <div class="w-100"></div>
                                 <!-- Input -->
                                 <!-- End Input -->
                                 <?php if($_SESSION['isdomestic']=='No'){ ?>
                                 <div class="col-sm-3 mb-4"  >
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       DOB
                                       </label>
                                       <div id="datepickerWrapperFromadt<?php echo $adult; ?>" class="u-datepicker input-group">
                                          <div class="input-group-prepend"> <span class="d-flex align-items-center mr-2"> <i class="flaticon-calendar text-primary font-weight-semi-bold"></i> </span> </div>
                                          <input class="font-size-lg-16 form-control <?php if($_SESSION['isRoundTripInt']==1) {  ?>validate1 <?php } ?>border-1 datepickerfield"  id="dobAdt<?php echo $adult; ?>" name="dobAdt<?php echo $adult; ?>" readonly="readonly" value="<?php if($_SESSION['isRoundTripInt']!=1) {  ?>01-01-1988<?php } ?>">
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Input -->
                                 <div class="col-sm-4 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       Passport Provided Country
                                       </label>
                                       <select class="form-control validate1 js-select selectpicker dropdown-select" id="nationalityAdt<?php echo $adult; ?>" name="nationalityAdt<?php echo $adult; ?>" data-msg="Please select country." data-error-class="u-has-error" data-success-class="u-has-success"
                                          data-live-search="true"
                                          data-style="form-control validate1 font-size-16 border-width-2 border-gray font-weight-normal">
                                          <option value="">Select country</option>
                                          <?php
                                             $countryInfo=GetPageRecord('*','countryMaster','1 and status="1" order by name');
                                             while($countryInfoData=mysqli_fetch_array($countryInfo)){
                                              ?>
                                          <option value="<?php echo $countryInfoData["sortname"]; ?>"><?php echo $countryInfoData["name"]; ?></option>
                                          <?php
                                             }
                                             ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       Passport Number
                                       </label>
                                       <input type="text" class="form-control validate1" name="passportNumberAdt<?php echo $adult; ?>" id="passportNumberAdt<?php echo $adult;?>" placeholder="" aria-label="" 
                                          data-msg="Please enter passport number"
                                          data-error-class="u-has-error"
                                          data-success-class="u-has-success" autocomplete="nope" required>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       Passport Expiry
                                       </label>
                                       <input type="text" class="form-control validate1 datepickerfieldexpiry" name="passportExpiryAdt<?php echo $adult; ?>" id="passportExpiryAdt<?php echo $adult;?>" placeholder="" aria-label="" 
                                          data-msg="Please enter expiry Date"
                                          data-error-class="u-has-error"
                                          data-success-class="u-has-success" autocomplete="nope" required>
                                    </div>
                                 </div>
                                 <!-- End Input -->
                                 <?php } ?>
                              </div>
                           </div>
                           <input name="totaladult" type="hidden" value="<?php echo $adult; ?>">
                           <!---- SSR Detail ---->
                           <input type="hidden" id="seatAdultPrice<?php echo $adult; ?>" name="seatAdultPrice<?php echo $adult; ?>" value="0" />
                           <input type="hidden" id="seatAdultCode<?php echo $adult; ?>" name="seatAdultCode<?php echo $adult; ?>" value="" />
                           <!--- End SSR details --->
                           <?php }
                              $totaladultcount=$adult;
                               ?>
                           <?php
                              for($child=1; $child<=$_SESSION['CHD']; $child++){
                              ?>
                           <div class="card-header">Child <?php echo $child; ?> (2 + yrs)</div>
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-sm-2 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       Title
                                       </label>
                                       <select class="form-control validate1" name="titleChd<?php echo $child; ?>" id="titleChd<?php echo $child; ?>">
                                          <option value="">Select</option>
                                          <option value="Mr">Mr</option>
                                          <option value="Mrs">Mrs</option>
                                          <option value="Ms">Ms</option>
                                          <option value="Mstr">Mstr</option>
                                          <option value="Miss">Miss</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       First Name
                                       </label>
                                       <input type="text" class="form-control validate1" name="firstNameChd<?php echo $child; ?>" id="firstNameChd<?php echo $child; ?>" placeholder="" aria-label="" required
                                          data-msg="Please enter your first name."
                                          data-error-class="u-has-error"
                                          data-success-class="u-has-success" autocomplete="nope">
                                    </div>
                                 </div>
                                 <!-- End Input -->
                                 <!-- Input -->
                                 <div class="col-sm-3 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       Last name
                                       </label>
                                       <input type="text" class="form-control validate1" name="lastNameChd<?php echo $child; ?>" id="lastNameChd<?php echo $child; ?>" required
                                          data-msg="Please enter your last name."
                                          data-error-class="u-has-error"
                                          data-success-class="u-has-success" autocomplete="nope">
                                    </div>
                                 </div>
                                 <div class="col-sm-3 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       DOB
                                       </label>
                                       <input class="form-control validate1 datepickerfieldchild"  id="dobChd<?php echo $child; ?>" name="dobChd<?php echo $child; ?>" readonly="readonly">				 
                                    </div>
                                 </div>
                                 <?php if($_SESSION['isdomestic']=='No'){ ?>
                                 <!-- Input -->
                                 <div class="col-sm-4 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       Passport Provided Country
                                       </label>
                                       <select class="form-control js-select selectpicker dropdown-select" id="nationalityChd<?php echo $child; ?>" name="nationalityChd<?php echo $child; ?>"  data-msg="Please select country." data-error-class="u-has-error" data-success-class="u-has-success"
                                          data-live-search="true"
                                          data-style="form-control font-size-16 border-width-2 border-gray font-weight-normal">
                                          <option value="">Select country</option>
                                          <?php
                                             $countryInfo=GetPageRecord('*','countryMaster','1 and status="1" order by name');
                                             while($countryInfoData=mysqli_fetch_array($countryInfo)){
                                              ?>
                                          <option value="<?php echo $countryInfoData["sortname"]; ?>"><?php echo $countryInfoData["name"]; ?></option>
                                          <?php
                                             }
                                             ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       Passport Number
                                       </label>
                                       <input type="text" class="form-control datepickerfieldexpiry" name="passportNumberChd<?php echo $child; ?>" id="passportNumberChd<?php echo $child;?>" placeholder="" aria-label="" 
                                          data-msg="Please enter passport number"
                                          data-error-class="u-has-error"
                                          data-success-class="u-has-success" autocomplete="nope" required>
                                    </div>
                                 </div>
                                 <!-- End Input -->
                                 <div class="col-sm-4 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       Passport Expiry
                                       </label>
                                       <input type="text" class="form-control" name="passportExpiryChd<?php echo $child; ?>" id="passportExpiryChd<?php echo $child;?>" placeholder="" aria-label="" 
                                          data-msg="Please enter expiry Date"
                                          data-error-class="u-has-error"
                                          data-success-class="u-has-success" autocomplete="nope" required>
                                    </div>
                                 </div>
                                 <?php } ?>
                              </div>
                           </div>
                           <input name="totalchild" type="hidden" value="<?php echo $child; ?>">
                           <!---- SSR Detail ---->
                           <input type="hidden" id="seatChildPrice<?php echo $child; ?>" name="seatChildPrice<?php echo $child; ?>" value="0" />
                           <input type="hidden" id="seatChildCode<?php echo $child; ?>" name="seatChildCode<?php echo $child; ?>" value="" />
                           <!--- End SSR details --->	
                           <?php }
                              $totalchildcount=$child;
                               ?>
                           <?php
                              for($infant=1; $infant<=$_SESSION['INF']; $infant++){
                              ?>
                           <div class="card-header">Infant <?php echo $infant; ?> (0 - 2 yrs)</div>
                           <div class="card-body">
                              <div class="row"  >
                                 <div class="col-sm-2 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       Title
                                       </label>
                                       <select class="form-control validate1" name="titleInf<?php echo $infant; ?>" id="titleInf<?php echo $infant; ?>">
                                          <option value="">Select</option>
                                          <option value="Mr">Mr</option>
                                          <option value="Mrs">Mrs</option>
                                          <option value="Ms">Ms</option>
                                          <option value="Mstr">Mstr</option>
                                          <option value="Miss">Miss</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       First Name
                                       </label>
                                       <input type="text" class="form-control" name="firstNameInf<?php echo $infant; ?>" id="firstNameInf<?php echo $infant; ?>" required
                                          data-msg="Please enter your first name."
                                          data-error-class="u-has-error"
                                          data-success-class="u-has-success" autocomplete="nope">
                                    </div>
                                 </div>
                                 <!-- End Input -->
                                 <!-- Input -->
                                 <div class="col-sm-3 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       Last name
                                       </label>
                                       <input type="text" class="form-control" name="lastNameInf<?php echo $infant; ?>" id="lastNameInf<?php echo $infant; ?>" required
                                          data-msg="Please enter your last name."
                                          data-error-class="u-has-error"
                                          data-success-class="u-has-success" autocomplete="nope">
                                    </div>
                                 </div>
                                 <div class="col-sm-3 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       DOB
                                       </label>
                                       <input class="form-control validate1 datepickerfieldinfant"  id="dobInf<?php echo $infant; ?>" name="dobInf<?php echo $infant; ?>" readonly="readonly">
                                    </div>
                                 </div>
                                 <!-- End Input -->
                                 <?php if($_SESSION['isdomestic']=='No'){ ?>
                                 <!-- Input -->
                                 <div class="col-sm-4 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       Passwort Provided Country
                                       </label>
                                       <select class="form-control js-select selectpicker dropdown-select" id="passportNumberInf<?php echo $infant; ?>" name="passportNumberInf<?php echo $infant; ?>"  data-msg="Please select country." data-error-class="u-has-error" data-success-class="u-has-success"
                                          data-live-search="true"
                                          data-style="form-control font-size-16 border-width-2 border-gray font-weight-normal">
                                          <option value="">Select country</option>
                                          <?php
                                             $countryInfo=GetPageRecord('*','countryMaster','1 and status="1" order by name');
                                             while($countryInfoData=mysqli_fetch_array($countryInfo)){
                                              ?>
                                          <option value="<?php echo $countryInfoData["sortname"]; ?>"><?php echo $countryInfoData["name"]; ?></option>
                                          <?php
                                             }
                                             ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       Passport Number
                                       </label>
                                       <input type="text" class="form-control" name="passportNumberInf<?php echo $infant; ?>" id="passportNumberInf<?php echo $infant;?>" placeholder="" aria-label="" 
                                          data-msg="Please enter passport number"
                                          data-error-class="u-has-error"
                                          data-success-class="u-has-success" autocomplete="nope" required>
                                    </div>
                                 </div>
                                 <!-- End Input -->
                                 <div class="col-sm-4 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       Passport Expiry
                                       </label>
                                       <input type="text" class="form-control datepickerfieldexpiry" name="passportExpiryInf<?php echo $infant; ?>" id="passportExpiryInf<?php echo $infant;?>" placeholder="" aria-label="" 
                                          data-msg="Please enter expiry Date"
                                          data-error-class="u-has-error"
                                          data-success-class="u-has-success" autocomplete="nope" required>
                                    </div>
                                 </div>
                                 <?php } ?>
                              </div>
                           </div>
                           <input name="totalinfant" type="hidden" value="<?php echo $infant; ?>">
                           <?php }  
                              $totalinfantcount=$infant;
                               ?>
                           <?php
                              if($isLCCchk==0)
                              {
                               ?>
                           <div style="text-align: left; padding: 10px 20px; border-top: 1px solid #ddd;display:none;">
                              <input name="onholdFlight" type="checkbox" value="1"  > On Hold Flight
                           </div>
                           <?php } ?>	
                        </div>
                        <div class="card cardresult" style="width:100%; margin-top:20px;" id="contactdetailid">
                           <div class="card-header">Contact Details</div>
                           <div class="card-body">
                              <div class="row">
                                 <!-- Input -->
                                 <?php 
                                    $a=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['agentUserid'].'" and (userType="client" or userType="agent")  ');   
                                    $websiteLoginuser=mysqli_fetch_array($a);
                                    
                                    ?>
                                 <div class="col-sm-6 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       Email
                                       </label>
                                       <input type="email" class="form-control validate1" name="email" id="email" placeholder="" aria-label="" required
                                          data-msg="Please enter a valid email address."
                                          data-error-class="u-has-error"
                                          data-success-class="u-has-success" autocomplete="nope"  value="<?php echo $websiteLoginuser['email']; ?>">
                                    </div>
                                 </div>
                                 <!-- End Input -->
                                 <!-- Input -->
                                 <div class="col-sm-6 mb-4">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       Phone
                                       </label>
                                       <input type="number" class="form-control validate1" name="phone" id="userphone" placeholder="" aria-label="" required
                                          data-msg="Please enter a valid phone number."
                                          data-error-class="u-has-error"
                                          data-success-class="u-has-success" autocomplete="nope"  value="<?php echo $websiteLoginuser['phone']; ?>">
                                    </div>
                                 </div>
                                 <!-- End Input -->
                                 <!-- Input -->
                                 <!-- End Input -->
                              </div>
                              <div class="row" style="position:relative;">
                                 <label style="padding-left: 37px; width: 100%; margin-bottom: 30px;"><input name="gst" type="checkbox" value="1" onClick="ifgst();" class="checkbox_check" style="width: 16px; height: 16px; position: absolute; left: 14px; top: 3px;"> I have a GST number (Optional)</label>
                                 <div class="col-sm-4 mb-4 showgst">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       Company Name
                                       </label>
                                       <input type="text" class="form-control" name="companyName" placeholder=""  autocomplete="nope">
                                    </div>
                                 </div>
                                 <div class="col-sm-4 mb-4 showgst">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       GST No
                                       </label>
                                       <input type="test" class="form-control" name="gstNo" placeholder=""  autocomplete="nope">
                                    </div>
                                 </div>
                                 <div class="col-sm-4 mb-4 showgst">
                                    <div class="js-form-message">
                                       <label class="form-label">
                                       Email
                                       </label>
                                       <input type="test" class="form-control" name="gstEmail" placeholder=""  autocomplete="nope">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="card-footer text-muted hidefooter">
                              <button type="button" class="btn btn-danger btn-sm" style="float:right;" onClick="checkInputs();">Proceed To Pay</button>
                           </div>
                           <div class="card-footer text-muted" id="showfooterpay" style="display:none;">
                              <button type="button" class="btn btn-danger btn-sm float-left" onClick="$('#steponeflightdetails').hide();$('#steptwopassengerdetails').show();$('.flightreviewbox').removeClass('active');$('#strp2').addClass('active');$('.hidefooter').show();$('#showfooterpay').hide();"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back</button>
                              <?php
                                 if($isLCCchk==0)
                                 {
                                  ?>
                              <div style="text-align:center;display:none;">
                                 <input name="onholdFlight" type="checkbox" value="1"  > On Hold Flight
                              </div>
                              <?php } ?>
                              <button type="button" class="btn btn-danger btn-sm" style="float:right;" onClick="checkInputs();$('#steponeflightdetails').hide();$('#steptwopassengerdetails').hide();$('#stepfourpayments').show();$('.flightreviewbox').removeClass('active');$('#strp4').addClass('active');$('.hidefooter').show();$('#showfooterpay').hide();">Proceed To Pay</button>
                           </div>
                        </div>
                     </div>
                     <?php $str_arr = explode (",", $res['agfare']);   
                        $basefare = explode ("=", $str_arr[2]); 
                          ?>
                     <div class="col-12" style="position:relative; margin-top:20px; display:none;"  id="stepfourpayments">
                        <h2>Payments</h2>
                        <div class="card cardresult" style="width:100%;">
                           <div class="card-header">
                              Payment
                           </div>
                           <div class="row">
                              <?php if($LoginUserDetails['userType']=='agent'){ ?>
                              <div class="col-4">
                                 <div style="padding: 40px 0px; text-align: center;  font-size: 30px; border-bottom-left-radius: 5px; <?php if($totalwalletBalance>=$basefare[1]){?>border-right: 2px solid #41e0d2; background-color: #e4f8ff; color:#02C4B0;<?php } else { ?>border-right: 2px solid #e04159; background-color: #ffe4e4;color:#c4021e;<?php } ?>">
                                    <div style="font-weight:600; ">₹<?php echo round($totalwalletBalance); ?></div>
                                    <div style="font-size:14px; color:#000000; "><strong>Your Wallet Balance</strong></div>
                                 </div>
                              </div>
                              <?php } ?>
                              <div class="<?php if($LoginUserDetails['userType']=='agent'){ ?>col-8<?php }  else { ?>col-12<?php } ?>">
                                 <div class="card-body">
                                    <?php  //if($totalwalletBalance>=($basefare[1]+$totalfareret)){?>
                                    <?php 
                                       if($ifoffile==0){ 
                                       
                                        $totalwalletBalanceParent;
                                       
                                       } ?>
                                    <div style="padding-top:10px; padding-bottom:10px; font-size:14px;"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; By placing this order, you agree to our Terms Of Use and Privacy Policy</div>
                                    <input name="termsofuse" type="checkbox" value="1" checked disabled="disabled"> I accept <a href="<?php echo $fullurl; ?>terms-conditions" target="_blank" style="text-decoration:underline;">terms & conditions</a>
                                    <input name="flightbooking" id="flightbooking" type="hidden" value="1">
                                    <input name="bookingMethod" id="bookingMethod" type="hidden" value="0">
                                    <div style=" font-size:14px; margin-bottom:10px; margin-top:15px;"> 
                                       <?php if($totalwalletBalance>=($basefare[1]+$totalfareret)){ ?>
                                       <?php if($LoginUserDetails['userType']=='agent'){ ?>
                                       <button type="button" id="paynowbtnmain" class="btn btn-danger" onClick="payandbooknow();" id="paynowbutton" >Pay Now ₹<?php  echo ($basefare[1]+$totalfareret); ?></button>
                                       <?php } ?>
                                       <?php }  ?>
                                       <a href="javascript:void(0);" onClick="payonlinenow();" id="payonlinebtn"><button type="button" class="btn btn-danger payonlinebtnmain" >Pay Online ₹<?php  echo ($basefare[1]+$totalfareret); ?></button></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-3">
                  <div class="card">
                     <div class="card-header">
                        Fare Summary
                     </div>
                     <div class="card-body">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:14px; color:#000000;">
                           <tr>
                              <td align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Base fare</td>
                              <td width="50%" align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<?php  
                                 $str_arr = explode (",", $res['agfare']);  
                                 $basefare = explode ("=", $str_arr[0]);
                                 echo $BaseFare= ($basefare[1]+$basefareret); 
                                  
                                  
                                  
                                 //echo $BaseFare;
                                   ?></td>
                           </tr>
                           <tr>
                              <td align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Taxes and fees</td>
                              <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<?php 
                                 $Tax = explode ("=", $str_arr[1]); 
                                 echo $Tax = $Tax[1];
                                 
                                 ?></td>
                           </tr>
                           <tr style="display:none;" id="discountAmtDiv">
                              <td align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Discount Amount</td>
                              <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">- ₹<span id="discountAmt"></span></td>
                           </tr>
                           <tr  style="display:none;">
                              <td align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;"><strong>Total Fare </strong></td>
                              <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<span id="totalpayAmt" style=" font-weight:600;"><?php 
                                 $basefare = explode ("=", $str_arr[2]);
                                 echo ($basefare[1]+$totalfareret);
                                 ?></span></td>
                           </tr>
                           <?php  if($LoginUserDetails['userType']=='agent'){ ?>  
                           <tr>
                              <td align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Commission (-)</td>
                              <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<?php echo $totalcommission; ?></td>
                           </tr>
                           <tr   >
                              <td align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">GST</td>
                              <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<?php echo $totalcommissiongstdisplay=round($totalcommission*18/100); ?></td>
                           </tr>
                           <tr   >
                              <td align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">TDS</td>
                              <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<?php echo $totaltdsdisplay=round($totalcommission*5/100); ?></td>
                           </tr>
                           <?php } ?>
                           <tr>
                              <td align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;"><strong>Net Price</strong></td>
                              <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;"><strong>₹<span id="totalamountpaybox"><?php 
                                 $basefare = explode ("=", $str_arr[2]);
                                 if($LoginUserDetails['userType']=='agent'){ 
                                 
                                 echo $finaltotalpay=($basefare[1]+$totalfareret+$totalcommissiondisplay+$totaltdsdisplay+$totalcommissiongstdisplay)-$totalcommission;
                                 } else {
                                 echo $finaltotalpay=($basefare[1]+$totalfareret);
                                 }
                                 
                                 ?></span>
                                 </strong>
                              </td>
                           </tr>
                           <?php if($_SESSION['currency']!='INR'){ ?>
                           <tr>
                              <td align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;"><strong>Net Price <?php echo $_SESSION['currency']; ?></strong></td>
                              <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">
                                 <strong><span id="showothercurrency"></span> <?php echo $_SESSION['currency']; ?>
                                 </strong>
                                 <script> 
                                    setInterval(function() {
                                    var totalamountpaybox = Number($('#totalamountpaybox').text());
                                    $('#showothercurrency').text(Number(convertfromtocurrencywithcurr(totalamountpaybox)).toFixed(2));  
                                    }, 500); 
                                 </script>
                              </td>
                           </tr>
                           <?php } ?>
                        </table>
                        <?php if($LoginUserDetails['userType']=='agent'){ ?>
                        <?php if($totalwalletBalance>=($basefare[1]+$totalfareret)){} else {?>
                        <div style="padding-top:10px; padding-bottom:10px; font-size:14px; color:#CC0000;"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; You don't have sufficient balance.</div>
                        <?php } } ?>
                        <script>
                           function gettotalamountpay(){
                           
                           var totalAmountToPay = Number($('#totalpayAmt').text());
                            <?php  if($LoginUserDetails['userType']=='agent'){ ?> 
                           totalAmountToPay=Number(totalAmountToPay-<?php echo $totalcommission; ?>);
                           <?php }?>
                           totalAmountToPay=Number(totalAmountToPay+<?php echo ($totalcommissiongstdisplay+$totaltdsdisplay); ?>); 
                           //$('#totalamountpaybox').text(totalAmountToPay); 
                           $('#totalAmountToPay').val(totalAmountToPay);
                           //$('#totalamountpaybox').text(totalAmountToPay); 
                           
                           //var baggval = Number($('#baggval').text());
                           //var mealval = Number($('#mealval').text());
                           //var seatvalamtTotal = Number($('.seatvalamtTotal').text()); 
                           //$('#totalAmountToPayForSSR').val(Number(seatvalamtTotal+mealval+baggval));
                           }
                           
                           setInterval(function() {
                            gettotalamountpay()
                           }, 500);
                        </script>
                     </div>
                  </div>
                  <?php
                     $totalFare=round($basefare[1]+$totalfareret);
                     ?>
                  <div class="card d-none">
                     <div class="card-header hd">
                        Select a Discount Coupon 
                     </div>
                     <div class="card-body">
                        <style>
                           .appliedbtn{
                           display:none;
                           }
                        </style>
                        <h5 class="mb-0">
                           <div id="manualcouponapply" class="collapse show" aria-labelledby="basicsHeadingFour">
                              <table width="100%" border="0" cellpadding="0">
                                 <tr>
                                    <td>
                                       <div style="position:relative;"><input type="text" name="couponCodeApply" id="couponCodeApply" placeholder="" style="border: 1px solid #cccaca; padding: 2px; border-radius: 3px;width:95%; border-radius: 4px; border: 1px solid #d5d5d5; background-color: #fff; width: 100%; padding: 10px; color: #000;"><i class="fa fa-times-circle-o appliedbtn" aria-hidden="true" style="position: absolute; right: 10px ; top: 8px ; color: #6a6a6a; font-size: 16px; cursor:pointer;" onClick="removecouponcode();removeapplycop();"></i></div>
                                    </td>
                                    <td><button type="button" class="btn btn-danger btn-sm float-left" onClick="applycouponcode();" ><span class="applybtn">Apply</span><span class="appliedbtn" style="color:#00CC33;">Applied&nbsp;&nbsp;</span></button></td>
                                 </tr>
                              </table>
                              <script>
                                 function applycouponcode(){
                                 	var couponcode = encodeURI($('#couponCodeApply').val());
                                 	//var displayprice = Number($('#finalclientcost_new').val()); 
                                 	if(couponcode!=''){
                                 		$('#discountAmtDiv').show();
                                 		//$('.discountAmtDiv').removeClass('hd'); 
                                 		$('#couponCodeApply').val($('.dottedlinebox').text());
                                 		$('#couponapplied').load('actionpage.php?action=applycopmanual&couponcode='+couponcode+'&bid=<?php echo encode($res["id"]); ?>&displayprice=<?php echo ($totalFare); ?>');
                                 	}
                                 }
                                 
                                 function removecouponcode(){
                                 	$('#discountAmtDiv').hide();
                                 	//$('#discountAmtDiv').addClass('hd'); 
                                 	$('#couponCodeApply').val('');
                                 	$('#discountAmt').text('');
                                 	$('.appliedbtn').hide();
                                 	$('.applybtn').show(); 
                                 	$('#couponCodeApply').val(''); 
                                 }
                              </script>
                           </div>
                        </h5>
                        <div>
                        </div>
                        <script>
                           function applycop(){
                           	var couponid = $('input[name="couponid"]:checked').val();
                           	//var displayprice = Number($('#finalclientcost_new').val()); 
                           	if(couponid>0){
                           		$('#couponapplied').load('actionpage.php?action=applycop&id='+couponid+'&bid=<?php echo encode($res["id"]); ?>&displayprice=<?php echo $totalFare; ?>');  
                           		$('#discountAmtDiv').show();
                           		//$('.discountapplydiv').removeClass('hd'); 
                           		$('#couponCodeApply').val($('.dottedlinebox').text());
                           		$('.appliedbtn').show();
                           		$('.applybtn').hide(); 
                           	}
                           }
                           								
                           function removeapplycop(){
                           	var couponid = $('input[name="couponid"]:checked').val();
                           	//var displayprice = Number($('#finalclientcost_new').val()); 
                           	$('#couponapplied').load('actionpage.php?action=removeapplycop&id='+couponid+'&bid=<?php echo encode($res["id"]); ?>&displayprice=<?php echo $totalFare; ?>'); 
                           	$("input[type=radio][name=couponid]").prop('checked', false);
                           	$('#discountAmtDiv').hide();
                           	//$('.discountapplydiv').addClass('hd');
                           	$('#couponCodeApply').val('');
                           	$('.appliedbtn').hide();
                           	$('.applybtn').show(); 
                           	$('#couponCodeApply').val('');
                           	$('#discountAmt').text('');
                           }
                        </script>
                     </div>
                  </div>
               </div>
               <?php
                  $arq=($totalFare-$wallet30PercBalance);
                  $arq=$arq+202565517+202565517;
                  ?>
               <input name="flightone" type="hidden" value="<?php echo encode($_REQUEST['i']); ?>">
               <input name="flighttwo" type="hidden" value="<?php echo encode($_REQUEST['r']); ?>">
               <input type="hidden" name="arq" id="arq" value="<?php echo $arq; ?>">
               <input name="baseFareInn"  id="baseFareInn" type="hidden" value="<?php echo $BaseFare; ?>" >
               <input name="TaxAndFeeInn" id="TaxAndFeeInn" type="hidden" value="<?php echo $Tax; ?>" >
               <input name="BaggageFeeInn" id="BaggageFeeInn" type="hidden" value="0" >
               <input name="MealFeeInn" id="MealFeeInn" type="hidden" value="0" >
               <input name="SeatFeeInn" id="SeatFeeInn" type="hidden" value="0" >
               <input name="BaggageFeeInn2" id="BaggageFeeInn2" type="hidden" value="0" >
               <input name="MealFeeInn2" id="MealFeeInn2" type="hidden" value="0" >
               <input name="SeatFeeInn2" id="SeatFeeInn2" type="hidden" value="0" > 
               <input name="SeatPriceInn" id="SeatPriceInn" type="hidden" value="0" >
               <input name="SeatPriceInn2" id="SeatPriceInn2" type="hidden" value="0" > 
               <input name="SeatNoInn" id="SeatNoInn" type="hidden" value="" >
               <input name="SeatNoInn2" id="SeatNoInn2" type="hidden" value="" >  
               <input name="totalAmountToPay" id="totalAmountToPay" type="hidden" value="<?php echo ($basefare[1]+$totalfareret); ?>" >
               <input name="totalAmountToPayForSSR" id="totalAmountToPayForSSR" type="hidden" value="<?php echo ($basefare[1]+$totalfareret); ?>" >
         </form>
         </div>
         <div class="row" id="bookingloading" style="display:none;">
            <div class="col-12" style=" text-align:center;">
               <div class="card">
                  <div class="card-body">
                     <div style="text-align:center; font-size:30px; padding:80px 0px;">
                        <div style="text-align:center; "><img src="images/loadinggif.gif" width="40"></div>
                        Wait Please Processing...
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script>
function checkInputs(){
	var e='';
    var flag = 0;
    $('.validate1').each(function() {
		if($(this).val() == ''){
			$('.form-control').removeClass('redborderfiled');
			$(this).addClass('redborderfiled');
			$(this).focus();
              e=1;
			return false;
		}
	});

    if(e==1){
		alert('Please fill mandatory fields');
	}
          
	if(e!=1){
		
		$('.form-control').removeClass('redborderfiled');
        $('#steponeflightdetails').show();
		$('#steptwopassengerdetails').show();
		$('.flightreviewbox').removeClass('active');
		$('#strp3').addClass('active');
		$(window).scrollTop(0);
		$('.hidefooter').hide();
		$('#showfooterpay').show();
		$('#stepfourpayments').hide();
        $('#steponeflightdetails').hide();
		$('#steptwopassengerdetails').show();
		$('#stepfourpayments').show();
		$('#contactdetailid').hide();
		$('.flightreviewbox').removeClass('active');
		$('#strp4').addClass('active');
		$('.hidefooter').show();
		$('#showfooterpay').hide();
	}
}

$(function(){
	$(".datepickerfield").datepicker({
		changeMonth: true,
        changeYear: true,
        yearRange: '-100:+0',
        dateFormat: 'dd-mm-yy',
        maxDate: new Date()
	});
});
         
         
$( function() {
	$( ".datepickerfieldinfant" ).datepicker({
		changeMonth: true,
        changeYear: true,
        yearRange: '-100:+0',
        dateFormat: 'dd-mm-yy',
        maxDate:new Date('<?php echo $journeyDate1; ?>'),
        minDate: new Date('<?php echo $infantDateValidate; ?>')
	});
});
$( function() {
	$( ".datepickerfieldchild" ).datepicker({
		changeMonth: true,
        changeYear: true,
        yearRange: '-100:+0',
        dateFormat: 'dd-mm-yy',
        maxDate:new Date('<?php echo $journeyDate1; ?>'),
        minDate: new Date('<?php echo $childDateValidate; ?>')
	});
}); 
         
$( function() {
	$( ".datepickerfieldexpiry" ).datepicker({
		changeMonth: true,
        changeYear: true,
        yearRange: '-100:+50',
        dateFormat: 'yy-mm-dd',
        minDate: 0
	});
});
      </script>
      <?php include "footer.php"; ?>
      <iframe id="bookingframe" name="bookingframe" style="display:none;"></iframe>
      <script type="text/javascript">
         function allCalCulatedPrice(){
         	var baseFarePrice=parseInt($('#baseFareInn').val());
         	var TaxAndFee=parseInt($('#TaxAndFeeInn').val());
         	
         	var BaggageFeeInn=parseInt($('#BaggageFeeInn').val());
         	var MealFeeInn=parseInt($('#MealFeeInn').val());
         	var SeatPriceInn=parseInt($('#SeatPriceInn').val());
         	
         	var BaggageFeeInn2=parseInt($('#BaggageFeeInn2').val());
         	var MealFeeInn2=parseInt($('#MealFeeInn2').val());
         	var SeatPriceInn2=parseInt($('#SeatPriceInn2').val());
         	
         	var totalPricePay=baseFarePrice+TaxAndFee+BaggageFeeInn+MealFeeInn+BaggageFeeInn2+MealFeeInn2+SeatPriceInn+SeatPriceInn2;
         	
         	console.log('baseFarePrice '+baseFarePrice+ ' TaxAndFee '+TaxAndFee+ 'BaggageFeeInn '+BaggageFeeInn+ ' MealFeeInn '+MealFeeInn+ ' SeatPriceInn '+SeatPriceInn);

         	$('#totalAmountToPay').val(totalPricePay);
         	 $('#coid').val(Number(totalPricePay+<?php echo $randval; ?>));
         	 $('#totalpayAmt').html(totalPricePay);

         }
      </script>	
      
      <script type="text/javascript">
		function payandbooknow(){
         $('#flightbooking').val('1');
         $('#flightbookingsubmit').submit();
         $('#bookingloading').show();
         $('#bookingdatainfo').hide();
         $('.flightreview').hide();
         }

         function allBookingSubmit(){
          $('#bookingMethod').val('0');
          $("#flightbookingsubmit").submit();
         }
         
         
         $('#steponeflightdetails').hide();
         $('#steptwopassengerdetails').show();
         $('.flightreviewbox').removeClass('active');
         $('#strp2').addClass('active');
         $('.hidefooter').show();
         $('#showfooterpay').hide();
         $('#stepfourpayments').hide();
         
		 setInterval(function() {
         var totalpayAmt = Number($('#totalAmountToPay').val());
         $('#paynowbtnmain').text('Pay Now ₹'+totalpayAmt);
         
         if(<?php echo $totalwalletBalance ?><=totalpayAmt){
         $('#paynowbutton').show();
         } else {
         $('#paynowbutton').remove();
         }
         $('#payonlinebtn').attr('onClick','payonlinenow('+totalpayAmt+')');         
         $('.payonlinebtnmain').text('Pay Online ₹'+totalpayAmt);
         }, 500); 
		 
         var childWindow;
         
         function bookingFormSubmit(){
         childWindow.close();
         $('#bookingMethod').val('0');
         $("#flightbookingsubmit").submit();
         }

         function allBookingSubmit(){
         childWindow.close();
         $('#bookingMethod').val('0');
         $("#flightbookingsubmit").submit();
         }
         
         function payonlinenow(){
         $('#flightbooking').val('1');
         $('#bookingMethod').val('0');
         var totalAmountToPay=$('#totalAmountToPay').val();
         var firstNameAdt = encodeURI($('#firstNameAdt1').val());
         var lastNameAdt = encodeURI($('#lastNameAdt1').val());
         var email = encodeURI($('#email').val());
         var userphone = encodeURI($('#userphone').val());
         childWindow = window.open('online-recharge?b=1&bamount='+totalAmountToPay+'&firstNameAdt='+firstNameAdt+'&lastNameAdt='+lastNameAdt+'&email='+email+'&userphone='+userphone+'&z=<?php echo encode($_SESSION['agentUserid']); ?>&type=wallet&bType=<?php echo $_SESSION['serviceId']; ?>', '_blank');
         }
      </script>
      <?php include "footerinc.php"; ?>