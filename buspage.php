<?php  
   include "inc.php";  
   include "config/logincheck.php";  
   $page='flights';
   $selectedpage='flights';
   
   deleteRecord('flightSearchLog','DATE(addDate)<"'.date('Y-m-d').'"');  
   
   $_SESSION['pgc']='2';
   
   $tripType=1;
   
   if($_REQUEST['tripType']!=''){
   $tripType=$_REQUEST['tripType']; 
   }
   
   $fixedDeparture=0; 
   if($_REQUEST['fixedDeparture']!=''){ 
   $fixedDeparture=$_REQUEST['fixedDeparture']; 
   }
   
   $PC='EC'; 
   if($_REQUEST['PC']!=''){ 
   $PC=$_REQUEST['PC']; 
   } 
   
   $travellers='1 Pax, Economy'; 
   if($_REQUEST['travellers']!=''){ 
   $travellers=$_REQUEST['travellers']; 
   } 
   
   $fromcitydesti='DEL - NEW DELHI'; 
   if($_REQUEST['fromcitydesti']!=''){ 
   $fromcitydesti=$_REQUEST['fromcitydesti']; 
   } 
   
   $fromDestinationFlight='DEL-India'; 
   if($_REQUEST['fromDestinationFlight']!=''){ 
   $fromDestinationFlight=$_REQUEST['fromDestinationFlight']; 
   } 
   
   $tocitydesti='BOM - MUMBAI'; 
   if($_REQUEST['tocitydesti']!=''){ 
   $tocitydesti=$_REQUEST['tocitydesti']; 
   }
    
   $toDestinationFlight='BOM-India'; 
   if($_REQUEST['toDestinationFlight']!=''){ 
   $toDestinationFlight=$_REQUEST['toDestinationFlight']; 
   }
    
   
   $journeyDateOne=date('d-m-Y');
   if($_REQUEST['journeyDateOne']!=''){ 
   $journeyDateOne=$_REQUEST['journeyDateOne']; 
   }
   
     
   
   $journeyDateRound=date('d-m-Y', strtotime('+1 days')); 
   if($_REQUEST['journeyDateRound']!=''){ 
   $journeyDateRound=$_REQUEST['journeyDateRound']; 
   }

    function cleanstring($string) {
      $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
      return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
   }
   
   $cc = GetPageRecord('*', 'cmsPages', ' pageType="Services" and url="flights" and status=1');
   $cms = mysqli_fetch_array($cc);
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <title><?php echo $cms['tabTitle']; ?></title>
      <meta name="title" content="<?php echo stripslashes($cms['metaTitle']); ?>">
      <meta name="keywords" content="<?php echo stripslashes($cms['metaKeyword']); ?>">
      <meta name="description" content="<?php echo stripslashes($cms['metaDesctiption']); ?>">
      <meta name="keywords" content="<?php echo stripslashes($cms['seoTag1']); ?>">
      <meta name="keywords" content="<?php echo stripslashes($cms['seoTag2']); ?>">
      <meta name="keywords" content="<?php echo stripslashes($cms['seoTag3']); ?>">
      <meta name="robots" content="<?php echo $cms['robotTag']; ?>">
      <meta property="og:site_name" content="<?php echo $cms['ogsiteName']; ?>"/>
      <meta property="og:type" content="<?php echo $cms['ogType']; ?>"/>
      <meta property="og:title" content="<?php echo $cms['ogmetaTitle']; ?>"/>
      <meta property="og:description" content="<?php echo $cms['ogmetaDescription']; ?>"/>
      <meta property="og:image" content="<?php echo $cms['ogImage']; ?>"/>
      <meta property="og:url" content="<?php echo $cms['ogURL']; ?>"/>
      <meta name="twitter:title" content="<?php echo $cms['twitterMetaTitle']; ?>"/>
      <meta name="twitter:description" content="<?php echo $cms['twitterMetaDescription']; ?>"/>
      <meta property="twitter:image" content="<?php echo $cms['twitterImage']; ?>"/>
      <meta property="twitter:site" content="<?php echo $cms['twitterSite']; ?>"/>
      <meta property="twitter:creator" content="<?php echo $cms['twitterCreator']; ?>"/>
      <?php include "headerinc.php"; ?>
      <style>
         .selectreturnflightcl{display:none;}
         @media (max-width: 575.98px) {
         .flightsearchwihite .lable{margin-left: 6px !important; top: 20px !important; padding: 9px 4px !important;}
         .searchboxouter .textfield{border-radius: 5px !important;padding: 30px 10px !important;font-size: 14px !important;padding-bottom: 14px !important;margin-top: 10px !important;border: 1px solid #ddd !important;}
         #pickupCitySearchfromCity2{margin-left: 0px !important;}
         .flightsearchwihite .searchboxouter .tableborder table tr td{width: 50% !important;}
         .swapbtn{top: 25px !important; font-size: 14px !important;width: 34px !important;height: 34px !important;}
         .tablebordersearch{padding-left: 4px !important;}
         .fa-calendar:before{ top: 18px !important; right: -7px !important;font-size: 16px !important;}
         .offerheading h3 {font-size: 17px; margin-left: 12px !important; }
         .holidestibox .card-body{background-color: transparent !important;top: 0px;}
         .flightsearchwihite{top: 256px !important;}
         .holidestibox{margin-bottom: 10px !important;}
         .holidestibox a{color: #000 !important;}
         .holidestibox p{color: #000 !important;font-weight: 600 !important;}
         .holidestibox .card{border: 1px solid #ddd;}
         .fa-calendar:before {top: 0px !important;right: 4px !important;font-size: 12px !important;}
         .holidestibox p{margin-top: 5px !important;text-align: left !important;}
         .holipricing{justify-content: left !important;}
         .pricelistflight tr{grid-template-columns: 33% 33% 33% !important;}
         .tablebordersearch{border: 1px solid #ddd !important;padding-bottom: 3px !important;}
         .tableborder table{position: relative;top: -4px !important;}
         .flightsearchwihite .searchboxouter .tableborder table tr td:last-child{padding-right: 12px !important;}
         .mobileshowonly ul {margin-bottom: 0px !important;margin-top: 50px;padding-left: 0px !important;}
         .mobileshowonly ul li { display: inline-block; list-style: none; margin: 0px 5px; border: 1px solid #fff; background-color: #fff; border-radius: 5px; padding: 16px 10px; width: 90px; height: 70px; }
         .mobileshowonly ul li a { font-size: 12px !important; font-weight: 700 !important; display: grid; text-align: center; color: #333333; }
         .mobileshowonly ul li a i {font-size: 28px;}
         .mobileshowonly{display: unset !important;}
         .top_bg_ofr_sb2other{border-radius: 0px !important;}
         .mobileshowonly{text-align: center !important;}
         .domheading{top: 160px !important;font-size: 18px !important;}
         .top_bg_ofr_sb2other{margin-top: -208px !important;}
         }
         .holidaytravel h3{text-align: center; color: #000; font-size: 36px; font-weight: 700; margin: 0; padding: 10px 0;}
         [type="radio"]:checked,
         [type="radio"]:not(:checked) {
         position: absolute;
         left: -9999px;
         }
         [type="radio"]:checked + label,
         [type="radio"]:not(:checked) + label
         {
         position: relative;
         padding-left: 28px;
         cursor: pointer;
         line-height: 20px;
         display: inline-block;
         color: #666;
         }
         [type="radio"]:checked + label:before,
         [type="radio"]:not(:checked) + label:before {
         content: '';
         position: absolute;
         left: 0;
         top: 0;
         width: 22px;
         height: 22px;
         border: 2px solid #a1a1a1;
         border-radius: 100%;
         background: #fff;
         }
         [type="radio"]:checked + label:after,
         [type="radio"]:not(:checked) + label:after {
         content: '';
         width: 12px;
         height: 12px;
         background: #00a1e5;
         position: absolute;
         top: 5px;
         left: 5px;
         border-radius: 100%;
         -webkit-transition: all 0.2s ease;
         transition: all 0.2s ease;
         }
         [type="radio"]:not(:checked) + label:after {
         opacity: 0;
         -webkit-transform: scale(0);
         transform: scale(0);
         }
         [type="radio"]:checked + label:after {
         opacity: 1;
         -webkit-transform: scale(1);
         transform: scale(1);
         }
         .flightsearchwihite .searchboxouter .redbuttonsearch {
         background-color: #ff9e31 !important;
         }
         .selectspcial{font-size: 18px; font-weight: 600; color: #000;}
         #flightsearchrow1{border-top:1px solid #ddd;}
         #flightsearchrow2{border-top:1px solid #ddd;}
         #flightsearchrow3{border-top:1px solid #ddd;}
         #flightsearchrow4{border-top:1px solid #ddd;}
         #flightsearchrow5{border-top:1px solid #ddd;}
         .fa-times-circle{padding: 30px; font-size: 25px; color: #d00000;}
         .top_bg_ofr_sb2other{height: auto !important; margin-bottom: 0 !important;}
         .flightsearchwihite { background-color: #fff; padding: 17px; border-radius: 20px; box-shadow: 0px 10px 18px #29426917 !important; padding-bottom: 48px; margin-bottom: -180px; position: inherit; top: 0; }
         .domheadinght{text-align: center; font-size: 26px; font-weight: 600; color: #FFFFFF; width: 100%; padding-top: 410px;}
         .textcontent{padding-top: 210px;}
		 .homeflightsearchouterbox{background: url(images/busbanner.png) no-repeat 0 0;}
      </style>
      <?php echo $cms['headerScript']; ?>
   </head>
   <body>
      <?php include "header.php"; ?>
      <!-- flight -->
      <div class="container mobileshowonly" style="display: none !important;">
         <ul>
            <li><a href="https://bookwithkk.travbizz.website/flights"><i class="fa fa-plane" aria-hidden="true"></i> Flight</a></li>
            <li><a href="https://bookwithkk.travbizz.website/hotels"><i class="fa fa-building" aria-hidden="true"></i> Hotels</a></li>
            <li><a href="https://bookwithkk.travbizz.website/holidays"><i class="fa fa-suitcase" aria-hidden="true"></i> Holidays</a></li>
         </ul>
      </div>
      <div class="top_bg_ofr_sb top_bg_ofr_sb2other homeflightsearchouterbox">
         <div class="flighttopmenuwithback">
            <table border="0" cellpadding="2" cellspacing="0">
               <tbody>
                  <tr>
                     <td><i class="fa fa-arrow-left" aria-hidden="true" onClick="$('.homeflightsearchouterbox').hide();$('body').css('overflow','auto');"></i></td>
                     <td><i class="fa fa-plane" aria-hidden="true"></i></td>
                     <td style="padding-left:10px;">Flights</td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="container mobilecontainer">
            <h1 class="domheading domheadinght"></h1>
            <!-- <h1 style="text-align:center;">Book flights and explore the world with us.</h1> -->
            <div class="row">
               <div class="col-lg-12 col-12">
                  <div class="flightsearchwihite">
                     <div class="holidaytravel">
                        <h3>Holiday Means Travel, Travel Means Chalofly</h3>
                     </div>
                     
                     <script>
                        $(document).mouseup(function(e) 
                        {
                            var container = $("#fromflightdestination"); 
                            if (!container.is(e.target) && container.has(e.target).length === 0) 
                            {
                                $('#searchcitylistsfromCity').hide();
                            } else { 
                            
                            $('#searchcitylistsfromCity2').hide();
                            }
                            
                             var container = $("#toflightdestination"); 
                            if (!container.is(e.target) && container.has(e.target).length === 0) 
                            {
                                $('#searchcitylistsfromCity2').hide();
                            } else { 
                            
                            $('#searchcitylistsfromCity').hide();
                            }
                        });
                        
                        
                         
                     </script>
                     <div class="searchboxouter flightsearchhomebox">
                        <form  method="GET" id="formids" action="<?php echo $fullurl; ?>flight-search" >
                           <input type="hidden" name="tripType" id="tripType" value="1">
                           <div class="tableborder tablebordersearch">
                              <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class="flightsearchtable">
                                 <tbody>
                                    <tr>
                                       <td width="30%" align="left" valign="top" id="fromflightdestination">
                                          <label>
                                             <div class="lable" id="fromlabel3">From</div>
                                             <div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity"></div>
                                             <input type="text" onClick="$('#pickupCitySearchfromCity').select();" class="textfield firstfld" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity','fromDestinationFlight','searchcitylistsfromCity');"  id="pickupCitySearchfromCity" name="fromcitydesti" value="DEL - New Delhi" autocomplete="off">
                                             <div class="sublinesearch fromairport_fromDestinationFlight"><?php echo $fromairport; ?></div>
                                             <input name="fromDestinationFlight" id="fromDestinationFlight" type="hidden" value="DEL-India" autocomplete="nope">
                                          </label>
                                          <div class="swapbtn" onClick="swapdata();"><i class="fa fa-exchange" aria-hidden="true"></i></div>
                                       </td>
                                       <td width="30%" align="left" valign="top" id="toflightdestination"  style="padding-left: 20px;">
                                          <label>
                                             <div class="lable tolabel" id="twolabel" style=" padding-left: 5px !important;">To</div>
                                             <div class="errorSection" style="display:none;" id="flightdublicate"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> From &amp; To airports cannot be the same</div>
                                             <div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity2"></div>
                                             <input type="text" onClick="$('#pickupCitySearchfromCity2').select();" class="textfield" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity2','fromDestinationFlight2','searchcitylistsfromCity2');" id="pickupCitySearchfromCity2" name="tocitydesti" value="CCU - Kolkata" autocomplete="off">
                                             <div class="sublinesearch toairport_fromDestinationFlight2"><?php echo $toairport; ?></div>
                                             <input name="toDestinationFlight" id="fromDestinationFlight2" type="hidden" value="CCU-India" autocomplete="nope">
                                          </label>
                                       </td>
                                       <td width="22%" align="left" valign="top">
                                          <label>
                                             <div class="lable" id="departurelabel">Departure</div>
                                             <input type="text" id="dt1" name="journeyDateOne" class="textfield"  value="<?php echo trim($journeyDateOne); ?>" autocomplete="off" style="min-width: 140px;"  ><i class="fa fa-calendar" aria-hidden="true"></i>
                                          </label>
                                          <script>
                                             function getWeekday(dateFormat){
                                               // split date in non-digit chaarcters
                                               let [d, m, y] = dateFormat.split(/\D/);
                                             
                                               //put them in Date method
                                               const date = new Date(y, m - 1, d)
                                               //and return weekday in long format
                                               const weekday = date.toLocaleString("default", { weekday: "long" })
                                               
                                               return weekday
                                             }
                                             
                                             function formatDate(date) {
                                               var d = new Date(date),
                                                   month = '' + (d.getMonth() + 1),
                                                   day = '' + d.getDate(),
                                                   year = d.getFullYear();
                                             
                                               if (month.length < 2) 
                                                   month = '0' + month;
                                               if (day.length < 2) 
                                                   day = '0' + day;
                                             
                                               return [year, month, day].join('-');
                                             }
                                             
                                             setInterval(function () { 
                                             var dt = $('#dt1').val(); 
                                             var dtt = $('#dt2').val();  
                                             
                                             $('.flightdeparturedate').text(getWeekday(dt));
                                             $('.flightreturndate').text(getWeekday(dtt));  
                                             
                                             
                                             }, 100);
                                          </script>		
                                       </td>
                                       <td width="18%" align="left" valign="top" onClick="selecttb(2);" class="selectreturnflightcl">
                                          <label>
                                             <div class="lable" id="returnlable">Return</div>
                                             <input type="text" id="dt2" name="journeyDateRound" class="textfield"  value="<?php echo trim($journeyDateRound); ?>" autocomplete="off" <?php if($tripType==1){ ?>disabled  style="color:#000;" <?php } ?> disabled="disabled"  ><i class="fa fa-calendar" aria-hidden="true"></i>   
                                          </label>
                                       </td>
                                       
                                       <style>
                                          #flightsearchrow1{ display:none;}
                                          #flightsearchrow2{ display:none;}
                                          #flightsearchrow3{ display:none;}
                                          #flightsearchrow4{ display:none;}
                                       </style>
                                       <td width="18%">
                                          <div class="flightsearchbtn">
                                             <input type="button" name="Submit" value="Search Bus" class="redbuttonsearch" onClick="findflight(1);">
                                             <script>
                                                function addflightrow(){
                                                var showflightrow = Number($('#showflightrow').val());
                                                
                                                if(showflightrow==1){
                                                $('#flightsearchrow1').show();
                                                $('#flightsearchrow1 .fa-times-circle').show();
                                                } 
												
                                                if(showflightrow==2){
                                                $('#flightsearchrow2').show();
                                                $('#flightsearchrow2 .fa-times-circle').show();
                                                $('#flightsearchrow1 .fa-times-circle').hide();
                                                }  
                                                if(showflightrow==3){
                                                $('#flightsearchrow3').show();
                                                $('#flightsearchrow3 .fa-times-circle').show();
                                                $('#flightsearchrow1 .fa-times-circle').hide();
                                                $('#flightsearchrow2 .fa-times-circle').hide();
                                                }
												
                                                if(showflightrow==4){
                                                $('#flightsearchrow4').show();
                                                $('#flightsearchrow4 .fa-times-circle').show();
                                                $('#flightsearchrow1 .fa-times-circle').hide();
                                                $('#flightsearchrow2 .fa-times-circle').hide();
                                                $('#flightsearchrow3 .fa-times-circle').hide();
                                                }
                                                
                                                $('#showflightrow').val(Number(showflightrow+1));
                                                
                                                if(showflightrow==4){
                                                $('#addflightrowbtn').hide();
                                                }
                                                }
                                             </script>
                                             <input name="showflightrow" id="showflightrow" type="hidden" value="1">
                                          </div>
                                       </td>
                                    </tr>
									
<tr id="flightsearchrow1">
	<td width="20%" align="left" valign="top" id="fromflightdestination">
		<label>
        <div class="lable" id="fromlabel">From</div>
        <div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity_2"></div>
        <input type="text"  class="textfield firstfld" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity_2','fromDestinationFlight_2','searchcitylistsfromCity_2');" id="pickupCitySearchfromCity_2" name="fromcitydesti2" value="" autocomplete="off">
        <div class="sublinesearch fromairport_fromDestinationFlight_2" style="padding-left: 0px;"></div>
        <input name="fromDestinationFlight2" id="fromDestinationFlight_2" type="hidden" value="" autocomplete="nope">
        </label>
        <div class="swapbtn" onClick="swapdata();"><i class="fa fa-exchange" aria-hidden="true"></i></div>
	</td>

	<td width="20%" align="left" valign="top" id="toflightdestination"  style="padding-left: 20px;">
		<label>
			<div class="lable tolabel" id="twolabel" style="padding-left: 5px !important;    margin-left: 0px !important;">To</div>
            <div class="errorSection" style="display:none;" id="flightdublicate"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> From &amp; To airports cannot be the same</div>
            <div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left;display:none;" id="searchcitylistsfromCity2_22"></div>
            <input type="text" class="textfield" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity2_22','fromDestinationFlight22','searchcitylistsfromCity2_22');" id="pickupCitySearchfromCity2_22" name="tocitydesti2" value="" autocomplete="off">
            <div class="sublinesearch toairport_fromDestinationFlight22"  style="padding-left: 0px;"></div>
            <input name="toDestinationFlight2" id="fromDestinationFlight22" type="hidden" value="" autocomplete="nope">
		</label>
	</td>
	
    <td width="18%" align="left" valign="top">
		<label>
			<div class="lable" id="departurelabel" style="margin-left: 0px !important;    padding-left: 4px !important;">Departure</div>
            <input type="text" id="departure2" name="journeyDate2" class="textfield datepicker"  value="" autocomplete="off"><i class="fa fa-calendar" aria-hidden="true"></i>
		</label>
	</td>
	<td width="18%" align="left" valign="top"><i class="fa fa-times-circle" aria-hidden="true" onClick="$('#flightsearchrow1').hide(); $('#departure2').val(''); $('#fromDestinationFlight22').val('');$('#addflightrowbtn').show();" ></i></td>
	<td width="18%" align="left" valign="top">	</td>
</tr>
									
<tr id="flightsearchrow2">
	<td width="20%" align="left" valign="top" id="fromflightdestination">
    <label>
		<div class="lable" id="fromlabel">From</div>
        <div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity_3"></div>
        <input type="text" class="textfield firstfld" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity_3','fromDestinationFlight_3','searchcitylistsfromCity_3');"  id="pickupCitySearchfromCity_3" name="fromcitydesti3" value="" autocomplete="off" >
        <div class="sublinesearch fromairport_fromDestinationFlight_3" style="padding-left: 0px;"></div>
        <input name="fromDestinationFlight3" id="fromDestinationFlight_3" type="hidden" value="" autocomplete="nope">
        </label>
        <div class="swapbtn" onClick="swapdata();"><i class="fa fa-exchange" aria-hidden="true"></i></div>
	</td>

	<td width="20%" align="left" valign="top" id="toflightdestination"  style="padding-left: 20px;">
		<label>
			<div class="lable tolabel" id="twolabel" style=" padding-left: 5px !important; margin-left: 0px !important;">To</div>
			<div class="errorSection" style="display:none;" id="flightdublicate"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> From &amp; To airports cannot be the same</div>
			<div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity2_33"></div>
			<input type="text" class="textfield" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity2_33','fromDestinationFlight33','searchcitylistsfromCity2_33');" id="pickupCitySearchfromCity2_33" name="tocitydesti3" value="" autocomplete="off">
			<div class="sublinesearch toairport_fromDestinationFlight33" style="padding-left: 0px;"></div>
			<input name="toDestinationFlight3" id="fromDestinationFlight33" type="hidden" value="" autocomplete="nope">
		</label>
	</td>
                                    
	<td width="18%" align="left" valign="top">
		<label>
			<div class="lable" id="departurelabel" style="    margin-left: 0px !important; padding-left: 4px !important;">Departure</div>
			<input type="text" id="departure3" name="journeyDate3" class="textfield datepicker"  value="" autocomplete="off"><i class="fa fa-calendar" aria-hidden="true"></i>
		</label>
                                          <script>
                                             function getWeekday(dateFormat){
                                               // split date in non-digit chaarcters
                                               let [d, m, y] = dateFormat.split(/\D/);
                                             
                                               //put them in Date method
                                               const date = new Date(y, m - 1, d)
                                               //and return weekday in long format
                                               const weekday = date.toLocaleString("default", { weekday: "long" })
                                               
                                               return weekday
                                             }
                                             
                                             function formatDate(date) {
                                               var d = new Date(date),
                                                   month = '' + (d.getMonth() + 1),
                                                   day = '' + d.getDate(),
                                                   year = d.getFullYear();
                                             
                                               if (month.length < 2) 
                                                   month = '0' + month;
                                               if (day.length < 2) 
                                                   day = '0' + day;
                                             
                                               return [year, month, day].join('-');
                                             }
                                             
                                             setInterval(function () { 
                                             var dt = $('#dt1').val(); 
                                             var dtt = $('#dt2').val();  
                                             
                                             $('.flightdeparturedate').text(getWeekday(dt));
                                             $('.flightreturndate').text(getWeekday(dtt));  
                                             
                                             
                                             }, 100);
                                          </script>		
	</td>
	<td width="18%" align="left" valign="top"><i class="fa fa-times-circle" aria-hidden="true" onClick="$('#flightsearchrow2').hide();$('#departure3').val(''); $('#fromDestinationFlight33').val('');$('#addflightrowbtn').show();" ></i></td>
	<td width="18%" align="left" valign="top">	</td>
</tr>

<tr id="flightsearchrow3">
	<td width="20%" align="left" valign="top" id="fromflightdestination">
		<label>
		<div class="lable" id="fromlabel">From</div>
		<div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity_4"></div>
		<input type="text"  class="textfield firstfld" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity_4','fromDestinationFlight_4','searchcitylistsfromCity_4');"  id="pickupCitySearchfromCity_4" name="fromcitydesti4" value="" autocomplete="off" >
		<div class="sublinesearch fromairport_fromDestinationFlight_4" style="padding-left: 0px;"></div>
		<input name="fromDestinationFlight4" id="fromDestinationFlight_4" type="hidden" value="" autocomplete="nope">
		</label>
		<div class="swapbtn" onClick="swapdata();"><i class="fa fa-exchange" aria-hidden="true"></i></div>
	</td>

	<td width="20%" align="left" valign="top" id="toflightdestination"  style="padding-left: 20px;">
		<label>
			<div class="lable tolabel" id="twolabel" style=" padding-left: 5px !important;    margin-left: 0px !important;">To</div>
			<div class="errorSection" style="display:none;" id="flightdublicate"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> From &amp; To airports cannot be the same</div>
			<div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity2_44"></div>
			<input type="text" class="textfield" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity2_44','fromDestinationFlight44','searchcitylistsfromCity2_44');" id="pickupCitySearchfromCity2_44" name="tocitydesti4" value="" autocomplete="off">
			<div class="sublinesearch toairport_fromDestinationFlight44"  style="padding-left: 0px;"></div>
			<input name="toDestinationFlight4" id="fromDestinationFlight44" type="hidden" value="" autocomplete="nope">
		</label>
	</td>

<td width="18%" align="left" valign="top">
		<label>
			<div class="lable" id="departurelabel" style="    margin-left: 0px !important;    padding-left: 4px !important;">Departure</div>
			<input type="text" id="departure4" name="journeyDate4" class="textfield datepicker"  value="" autocomplete="off"><i class="fa fa-calendar" aria-hidden="true"></i>
		</label>
	</td>
	
	<td width="18%" align="left" valign="top" ><i class="fa fa-times-circle" aria-hidden="true" onClick="$('#flightsearchrow3').hide();$('#departure4').val(''); $('#fromDestinationFlight44').val('');$('#addflightrowbtn').show();" ></i></td>
	
	<td width="18%" align="left" valign="top">	</td>
</tr>
                                   
<tr id="flightsearchrow4">
	<td width="20%" align="left" valign="top" id="fromflightdestination">
		<label>
			<div class="lable" id="fromlabel">From</div>
			<div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity_5"></div>
			<input type="text"  class="textfield firstfld" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity_5','fromDestinationFlight_5','searchcitylistsfromCity_5');"  id="pickupCitySearchfromCity_5" name="fromcitydesti5" value="" autocomplete="off" >
			<div class="sublinesearch fromairport_fromDestinationFlight_5" style="padding-left: 0px;"></div>
			<input name="fromDestinationFlight5" id="fromDestinationFlight_5" type="hidden" value="" autocomplete="nope">
		</label>
		<div class="swapbtn" onClick="swapdata();"><i class="fa fa-exchange" aria-hidden="true"></i></div>
	</td>
	<td width="20%" align="left" valign="top" id="toflightdestination"  style="padding-left: 20px;">
		<label>
			<div class="lable tolabel" id="twolabel" style=" padding-left: 5px !important;    margin-left: 0px !important;">To</div>
			<div class="errorSection" style="display:none;" id="flightdublicate"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> From &amp; To airports cannot be the same</div>
			<div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity2_55"></div>
			<input type="text" class="textfield" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity2_55','fromDestinationFlight55','searchcitylistsfromCity2_55');" id="pickupCitySearchfromCity2_55" name="tocitydesti5" value="" autocomplete="off">
			<div class="sublinesearch toairport_fromDestinationFlight55"  style="padding-left: 0px;"></div>
			<input name="toDestinationFlight5" id="fromDestinationFlight55" type="hidden" value="" autocomplete="nope">
		</label>
	</td>

	<td width="18%" align="left" valign="top">
		<label>
			<div class="lable" id="departurelabel" style="margin-left: 0px !important;    padding-left: 4px !important;">Departure</div>
			<input type="text" id="departure5" name="journeyDate5" class="textfield datepicker"  value="" autocomplete="off"><i class="fa fa-calendar" aria-hidden="true"></i>
		</label>
	</td>
	
	<td width="18%" align="left" valign="top"><i class="fa fa-times-circle" aria-hidden="true" onClick="$('#flightsearchrow4').hide();$('#departure5').val(''); $('#fromDestinationFlight55').val('');$('#addflightrowbtn').show();" ></i></td>
	<td width="18%" align="left" valign="top">	</td>
</tr>
                                 </tbody>
                              </table>
                           </div>                           
                           <input type="hidden" name="action" value="flightpostaction">
                           <input type="hidden" name="changesearch" id="changesearch" value="0">
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>      
      <div class="textcontent">
         <div class="container">
           
<style>
  .offerheadingflight{overflow: hidden; clear: both; padding: 20px;}
  .offerheading p{font-size: 22px; margin: 20px 0px; font-weight: 500;}
  .offersection h2{font-size: 17px; margin: 5px 0px;}
  .offersection p { color: var(--darkgray); font-size: 14px;}
  .offersectiondeal h2{font-size: 17px; margin: 5px 0px; color: #fff; text-align: center;}
  .offersectiondeal p { color: var(--darkgray); font-size: 14px; color: #fff; text-align: center;}
  .offerheadingflight .offerlaftside{float: left;}
  .offerheadingflight .offerrightside{float: left;}
  .offerheadingflight .middleofferside{float: right;}
  .offerheadingflight .offerrightside ul{list-style: none; margin: 0; padding: 0;}
  
  .offerheadingflight h2{font-size: 21px; margin: 0; padding-right: 30px;}
  .offerheadingflight .offerrightside ul li{float: left; }
  .offerheadingflight .offerrightside  ul li a{padding: 10px 15px;font-weight: 700; font-size: 16px; color: #4d4d4d;}
  .offerheadingflight .offerrightside ul li a:hover{background: #00a1e5;  color: #fff; border-radius: 30px;}
  .offerheadingflight .offerrightside ul li .active{background: #00a1e5;  color: #fff; border-radius: 30px;}
  .offerheadingflight .middleofferside ul{list-style: none; margin: 0; padding: 0;}
  .offerheadingflight .middleofferside ul li a{padding: 10px 15px;font-weight: 700; font-size: 16px; color: #00a1e5;}
  .offerheadingflight .middleofferside ul li a:hover{color: #4d4d4d;}
  .offerbardeals{padding: 10px 0px;box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px !important; border-radius: 5px;}
  .offersectiondeal{margin: 0 5px; background: #00a1e5; padding: 10px; border-radius: 4px; height: 300px;}
 .owl-carousel{padding: 0 35px;}
  

  .owl-nav .owl-prev {
    position: absolute;
    top: 50%;
    left: 5px;
    right: -1.5em;
    margin-top: -1.65em;
}
  .owl-nav .owl-next {
    position: absolute;
    top: 50%;
    right: 5px;
    margin-top: -1.65em;
}
.owl-nav button {
    background-color: #00a1e5 !important;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
}
.owl-nav button {
    width: 28px !important;
    height: 28px !important;
    border-radius: 50%;
}
.owl-nav span {
    font-size: 30px !important;
    color: #fff !important;
    position: relative;
    top: -11px !important;
}
.blugbg{border: solid 1px #00a1e5; background: #95d5f0; padding: 20px; border-radius: 10px; margin: 30px 0;}
.essent{font-size: 18px; color: #57646a; font-weight: 700;}

.playstore{background: #002f7c; border-radius: 10px; border: solid 1px #002f7c; padding: 30px 40px;    position: relative;}
</style>
<link rel="stylesheet" href="css/owl.theme.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
   


<div class="row offerrow">
<div class="col-12 col-lg-12">
<div class="offerbardeals">
        <div class="offerheadingflight">

          <div class="offerlaftside"> <h2>Offers For You</h2></div>
<div class="offerrightside">
  <ul>
  <li><a href="" class="active">All Offers</a></li>
  <li><a href="">Flights </a></li>
  <li><a href="">Buses </a></li>
  <li><a href="">Group Booking </a></li>
  <li><a href="">Holidays </a></li>
  <li><a href="">Bank Offers</a></li>
    
  </ul>
</div>
<div class="middleofferside">
  <ul>
  <li><a href="">View All Offers <i class="fa fa-long-arrow-right" aria-hidden="true"></i>  </a></li>
    
  </ul></div>
        </div>

       
        <div class="owl-carousel owl-theme">
        <?php

        $a = GetPageRecord('*', 'sys_specialDeal', ' dealType="flight"  and addBy=1 and status=1 order by id desc');

        while ($spdeals = mysqli_fetch_array($a)) {

        ?>
<div class="item">
          <div class="col-lg-12">

            <div class="offersectiondeal">

              <a onClick="loadpop('Deal Details',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewdetails&id=<?php echo encode($spdeals['id']); ?>" style="cursor:pointer;">

                <div class="offerimg mobileofferimg">

                  <img src="<?php echo $imgurl; ?><?php echo $spdeals['image']; ?>" alt="<?php echo stripslashes($spdeals['title']); ?>">

                </div>

              </a>



              <h2 class="mt-2"><?php echo stripslashes($spdeals['title']); ?></h2>

              <p class="mt-2"><?php echo substr(nl2br(stripslashes($spdeals['description'])), 0, 40); ?>...</p>



            </div>

          </div>
</div>

        <?php } ?>

        </div>
</div>
</div>
</div>
	  
	  

	  
	  
<style>
  .touersoffer{padding: 0 20px 20px;box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px !important; border-radius: 5px; margin: 30px 0;}
  .offerheading h3{margin: 0; padding: 30px 0 20px;}
  .phoneholibox{padding: 20px; box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px !important; border-radius: 5px; margin-bottom: 15px;}
  .bgimg{background:url(images/train.png) no-repeat 0 5px;}
  .bgimg a{font-size: 21px; color: #000; text-decoration: none; font-weight: 700; padding: 0 0 10px 30px;}
  .bgimg p{padding: 72px 0 10px 30px; font-weight: 600; font-size: 16px;}
   .offerheading p {font-size: 20px; margin: 0; padding-bottom: 10px; font-weight: 600;}
.offerbardealsfeaturedes {box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px !important; border-radius: 5px; padding: 20px 20px 0; margin: 30px 0 0;}
.offerheadingflight1{padding: 0 20px 30px;}
.offerbardealsfeaturedes h3{padding: 15px 0 20px;}
  .offerrightside2{float: left;}
  .offerrightside2 ul{list-style: none; margin: 0; padding: 0;}  
  .offerrightside2 ul li{float: left; }
  .offerrightside2  ul li a{padding: 0px 15px 15px;font-weight: 700; font-size: 16px; color: #4d4d4d;}
  .offerrightside2 ul li a:hover{color: #00a1e5; border-bottom: solid 2px #00a1e5;}
  .offerrightside2 ul li .active{color: #00a1e5; border-bottom: solid 2px #00a1e5;}
  .boxordercity{border: solid 1px #000; border-radius: 5px; margin-bottom: 30px;}
  .boxordercity a{display: block; padding: 20px;}
  .citynewdelhi{font-size: 18px; color: #000; font-weight: 700; padding-bottom: 15px;}
  .stratprice{font-size: 16px; color: #000; font-weight: 500;}
</style>
  <div class="offerrow">
<div class="row">
  <div class="col-12 col-lg-12">
<div class="touersoffer">
        <div class="offerheading">

          <h3>Popular Buses Routes</h3>

        </div>

        <div class="row">



         

                <div class="col-lg-4 col-12">
                  <div class="phoneholibox">
                      <div class="bgimg">
                        <a href="">New Delhi Buses</a>
						<p>Mumbai, Hyderabad, Goa, Chennai</p>
                      </div>
                  </div>
                </div>
				<div class="col-lg-4 col-12">
                  <div class="phoneholibox">
                      <div class="bgimg">
                        <a href="">New Delhi Buses</a>
						<p>Mumbai, Hyderabad, Goa, Chennai</p>
                      </div>
                  </div>
                </div>
				<div class="col-lg-4 col-12">
                  <div class="phoneholibox">
                      <div class="bgimg">
                        <a href="">New Delhi Buses</a>
						<p>Mumbai, Hyderabad, Goa, Chennai</p>
                      </div>
                  </div>
                </div>
				<div class="col-lg-4 col-12">
                  <div class="phoneholibox">
                      <div class="bgimg">
                        <a href="">New Delhi Buses</a>
						<p>Mumbai, Hyderabad, Goa, Chennai</p>
                      </div>
                  </div>
                </div>
				<div class="col-lg-4 col-12">
                  <div class="phoneholibox">
                      <div class="bgimg">
                        <a href="">New Delhi Buses</a>
						<p>Mumbai, Hyderabad, Goa, Chennai</p>
                      </div>
                  </div>
                </div>
				<div class="col-lg-4 col-12">
                  <div class="phoneholibox">
                      <div class="bgimg">
                        <a href="">New Delhi Buses</a>
						<p>Mumbai, Hyderabad, Goa, Chennai</p>
                      </div>
                  </div>
                </div>
				<div class="col-lg-4 col-12">
                  <div class="phoneholibox">
                      <div class="bgimg">
                        <a href="">New Delhi Buses</a>
						<p>Mumbai, Hyderabad, Goa, Chennai</p>
                      </div>
                  </div>
                </div>
				<div class="col-lg-4 col-12">
                  <div class="phoneholibox">
                      <div class="bgimg">
                        <a href="">New Delhi Buses</a>
						<p>Mumbai, Hyderabad, Goa, Chennai</p>
                      </div>
                  </div>
                </div>
				<div class="col-lg-4 col-12">
                  <div class="phoneholibox">
                      <div class="bgimg">
                        <a href="">New Delhi Buses</a>
						<p>Mumbai, Hyderabad, Goa, Chennai</p>
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
<div class="row">
<div class="col-lg-6 col-12">
  <div class="playdisgd"><img src="images/playstoremobile.png"></div>
<div class="downlaod">
  <h4>Download Chalofly App Now!</h4>
<h5>Get More Offer & More Discounts</h5>
<div><a href=""><img src="images/googleplay.png"></a> <a href=""><img src="images/macleplay.png"></a></div></div>

</div>
<div class="col-lg-6 col-12">
<div class="imagerights"><img src="images/rightlogoapp.png"></div>

</div>
<div></div>
</div>
<style>.playdisgd{width: 18%; float: left;}
.playdisgd{text-align: center; padding-top: 25px;}
  .downlaod{width: 82%; float: left;}
  .downlaod h4{font-size: 30px; color: #fff; font-weight: 700; margin: 0 0 10px;}
  .downlaod h5{font-size: 24px; color: #fff; font-weight: 700; margin: 0 0 30px;}
  .imagerights{position: absolute;
    right: 70px;
}
.imagerights img{width: 257px;}




.populartext{margin: 0 !important; padding: 0 !important; font-size: 30px !important;}
.busdestination{position:relative; margin-bottom: 25px;}
.destinationimg{position:relative;}
.destinationimg img{border-radius: 5px;}
.packagedestination{position: absolute; bottom: 0; left: 0;  right: 0; text-align: center; background-color: rgb(31 31 31 / 76%); border-radius: 0 0 5px 5px;}
.packagedestination a{color: #fff; font-size:21px; text-decoration: none; font-weight:700; padding: 10px; display:block;}
</style>
  </div>
</div>
</div>



<div class="offerrow">
<div class="row">
  <div class="col-12 col-lg-12">
    <div class="offerbardealsfeaturedes">        
      <div class="offerheading">

          <h3 class="populartext">Popular Destinations</h3>

        </div>
        <div class="row" style="padding-left: 3px;padding-right: 3px;">

        <div class="offerheadingflight1">

         
<div class="offerrightside2">
  
</div>
        </div>

<div class="col-12 col-lg-3">
<div class="busdestination">
<div class="destinationimg"><img src="images/image1.jpg" class="img-fluid"></div>
<div class="packagedestination"><a href="">GOA</a></div>
</div>

</div>
<div class="col-12 col-lg-3">
<div class="busdestination">
<div class="destinationimg"><img src="images/image2.jpg" class="img-fluid"></div>
<div class="packagedestination"><a href="">OOTY</a></div>
</div>

</div>
<div class="col-12 col-lg-3">
<div class="busdestination">
<div class="destinationimg"><img src="images/image1.jpg" class="img-fluid"></div>
<div class="packagedestination"><a href="">BALI</a></div>
</div>

</div>
<div class="col-12 col-lg-3">
<div class="busdestination">
<div class="destinationimg"><img src="images/image2.jpg" class="img-fluid"></div>
<div class="packagedestination"><a href="">ANDAMAN</a></div>
</div>

</div>
<div class="col-12 col-lg-3">
<div class="busdestination">
<div class="destinationimg"><img src="images/image1.jpg" class="img-fluid"></div>
<div class="packagedestination"><a href="">UTTARAKHANDA</a></div>
</div>

</div>
<div class="col-12 col-lg-3">
<div class="busdestination">
<div class="destinationimg"><img src="images/image2.jpg" class="img-fluid"></div>
<div class="packagedestination"><a href="">HIMACHAL PRADESH</a></div>
</div>

</div>
<div class="col-12 col-lg-3">
<div class="busdestination">
<div class="destinationimg"><img src="images/image1.jpg" class="img-fluid"></div>
<div class="packagedestination"><a href="">KERALA</a></div>
</div>

</div>
<div class="col-12 col-lg-3">
<div class="busdestination">
<div class="destinationimg"><img src="images/image2.jpg" class="img-fluid"></div>
<div class="packagedestination"><a href="">LADAKH</a></div>
</div>

</div>






















        </div>
      </div>
  </div>
</div>
</div>


	  
	  <!--<div class="row offerrow mt-5">

        <div class="offerheading">

          <h3 style="display:none;"><?php echo stripslashes($clientwebsitesection['sectionName']); ?></h3>

        </div>

        <?php

        $cc = GetPageRecord('*', 'cmsPages', ' pageType="Services"  and url="flights" and status=1');

        while ($cms = mysqli_fetch_array($cc)) {

        ?>

          <div class="col-lg-12">

            <div class="offersection">

              
              <?php echo stripslashes($cms['description']); ?> 

            </div>

          </div>

        <?php } ?>


      </div>-->
	  
      
	   <!-- ---------Flight Content section-------------->

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
     <script>
      $('.owl-carousel').owlCarousel({
         loop: true,
         margin: 10,
         nav: true,
         responsive: {
            0: {
               items: 1
            },
            600: {
               items: 3
            },
            1400: {
               items: 4
            }
         }
      })
   </script>
         </div>
      </div>
      <style>
         .flightfooter{padding-bottom:10px;}
      </style>
      <script>
         function getflightSearchCIty(citysearchfield,cityresultfield,listsearch){
         
         var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
         
         var citysearchfield = citysearchfield;
         
         
         
         if(citysearchfieldval!=''){  
         
         $('#'+listsearch).show();
         
         $('#'+listsearch).load('searchflightcitylists.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
         
         }
         
         }
         
         
         
         
         
         function swapdata(){
         
         var pickupCitySearchfromCity = $('#pickupCitySearchfromCity').val();
         
         var pickupCitySearchfromCity2 = $('#pickupCitySearchfromCity2').val();
         
         
         
         var fromDestinationFlight = $('#fromDestinationFlight').val();
         
         var fromDestinationFlight2 = $('#fromDestinationFlight2').val();
         
         
         
         $('#pickupCitySearchfromCity').val(pickupCitySearchfromCity2);
         
         $('#pickupCitySearchfromCity2').val(pickupCitySearchfromCity);
         
         
         
         $('#fromDestinationFlight2').val(fromDestinationFlight);
         
         $('#fromDestinationFlight').val(fromDestinationFlight2);
         
         
         
         }
         
         
         
         $(".swapbtn").click(function(){
         
          $(this).toggleClass("down")  ; 
         
         });
         
         
         
         
         
         
         
         
         
         
         
          
         
         $(document).ready(function () {
         
          $( function() {
             $( ".datepicker" ).datepicker({ dateFormat: "dd-mm-yy",
         
                 minDate: 0,});
           } );
         
         
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
         
         
         $(document).ready(function () {
         
             $("#dt1").datepicker({
         
                 dateFormat: "dd-mm-yy",
         
                 minDate: 0,
         
                 onSelect: function () {
         
                     var dt2 = $('#dt2');
         
                     var startDate = $(this).datepicker('getDate');
         
                     //add 30 days to selected date
         
                     startDate.setDate(startDate.getDate() + 365);
         
                     var minDate = $(this).datepicker('getDate');
         
                     var dt2Date = dt2.datepicker('getDate');
         
                     //difference in days. 86400 seconds in day, 1000 ms in second
         
                     var dateDiff = (dt2Date - minDate)/(86400 * 1000);
         
         
         
                     //dt2 not set or dt1 date is greater than dt2 date
         
                     if (dt2Date == null || dateDiff < 0) {
         
                             dt2.datepicker('setDate', minDate);
         
                     }
         
                     //dt1 date is 30 days under dt2 date
         
                     else if (dateDiff > 365){
         
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
         
          
         
          
         
          
         
         function changeselectsearchtype(){
         
         var selectsearchtype = Number($('#selectsearchtype').val());
         
         if(selectsearchtype<4){
         
         selecttb(selectsearchtype);
         
         }
         
         
         
         if(selectsearchtype==4){ 
         
         $( "#groupenquiryid" ).trigger( "click" );
         
         }
         
         $('#selectsearchtype').val(1);
         
         }
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         function selecttb(id){
         
         $('#returndiv').show();
         
         $('#searchbuttonflight').show();
         
         $('#submitbuttonflight').hide();
         
         $('#notediv').hide(); 

         if(id==1){
         $('#addflightrowbtn').hide();
         $('#tb1').removeClass('active');
         $('#tb2').removeClass('active');
         $('#tb3').removeClass('active');
         $('#tb4').removeClass('active');
         $('#tb1').addClass('active');
         
         $('#tripType').val('1');
         
         $('#dt2').attr('disabled','true');
         
         $('#dt3').attr('disabled','true');
         
         $('#dt2').css('color','#fafafa');
         
         $('#fixedDeparture').val('0');
         
         $('.selectreturnflightcl').hide();
         
         $('.swapbtn').show();
         }
         
         
         if(id==3){
         $('#tb1').removeClass('active');
         $('#tb2').removeClass('active');
         $('#tb3').addClass('active');
         $('#addflightrowbtn').show();
         $('.swapbtn').hide();
         $('.selectreturnflightcl').hide(); 
         $('#dt2').attr('disabled','true');
          $('#tripType').val('3');
         }
         
         if(id==2){
         $('#addflightrowbtn').hide();
         
         $('.selectreturnflightcl').show();
         
         $('#tb1').removeClass('active');
         
         $('#tb3').removeClass('active');
         
         $('#tb4').removeClass('active');
         
         $('#tb2').addClass('active');
         
         $('#tripType').val('2');
         
         $('#dt2').removeAttr('disabled');
         
         $('#dt3').removeAttr('disabled');
         
         $('#dt2').css('color','#333333');
         
         $('#fixedDeparture').val('0');
         $('.swapbtn').show();
         
         } 
         
         
         
         
         if(id==4){
         
         $('#returndiv').hide();
         
         $('#tb1').removeClass('active');
         
         $('#tb2').removeClass('active');
         
         $('#tb3').removeClass('active');
         
         $('#tb4').addClass('active');
         
         $('#formids').attr('target','actoinfrm');
         
         $('#formids').attr('action','actionpage.php');
         
         $('#tripType').val('4');
         
         $('#notediv').show();
         
         
         
         $('#searchbuttonflight').hide();
         
         $('#submitbuttonflight').show();
         
         }
         
         
         
         
         
         }
         
         
         
         
         
         
         function findflight(id){
         
         var pickupCitySearchfromCity = $('#pickupCitySearchfromCity').val();
         
         var pickupCitySearchfromCity2 = $('#pickupCitySearchfromCity2').val();
         
         
         
         if(pickupCitySearchfromCity==pickupCitySearchfromCity2){
         
         $('#flightdublicate').show();
         
         } else {
         
         $('#flightdublicate').hide();
         
         
         
         
         
         if(id==1){
         
         $('#formids').submit();
         
         }
         
         
         
         }
         
         }
         
         
         
         
         
         function checkdublicatedestination(){
         
         setTimeout(function() { 
         
         findflight(0);
         
          }, 500);
         
         }
         
             $('.testimonials').slick({
               dots: true,
               slidesToShow: 3,
               slidesToScroll: 1,
               touchMove: false,
               responsive: [{
                   breakpoint: 1024,
                   settings: {
                     slidesToShow: 3,
                     slidesToScroll: 3,
                     infinite: true,
                     dots: true
                   }
                 },
                 {
                   breakpoint: 600,
                   settings: {
                     slidesToShow: 2,
                     slidesToScroll: 2
                   }
                 },
                 {
                   breakpoint: 480,
                   settings: {
                     slidesToShow: 1,
                     slidesToScroll: 1
                   }
                 }
                 // You can unslick at a given breakpoint now by adding:
                 // settings: "unslick"
                 // instead of a settings object
               ]
         
             });
         
      </script>
      <?php echo $cms['footerScript']; ?>
      <?php include "footer.php"; ?>
      <?php include "footerinc.php"; ?>
   </body>
</html>