<?php



include "inc.php";

include "config/logincheck.php";

$page = 'flights';

$selectedpage = 'flights';

deleteRecord('flightSearchLog', 'DATE(addDate)<"' . date('Y-m-d') . '"');



$a12 = GetPageRecord('*', 'homeBanner', 'type=1 and status=1');

$websitesetting2 = mysqli_fetch_array($a12);



$_SESSION['pgc'] = '2';



$tripType = 1;



if ($_REQUEST['tripType'] != '') {

   $tripType = $_REQUEST['tripType'];
}



$fixedDeparture = 0;

if ($_REQUEST['fixedDeparture'] != '') {

   $fixedDeparture = $_REQUEST['fixedDeparture'];
}



$PC = 'EC';

if ($_REQUEST['PC'] != '') {

   $PC = $_REQUEST['PC'];
}



$travellers = '1 Pax, Economy';

if ($_REQUEST['travellers'] != '') {

   $travellers = $_REQUEST['travellers'];
}



$fromcitydesti = 'DEL - NEW DELHI';

if ($_REQUEST['fromcitydesti'] != '') {

   $fromcitydesti = $_REQUEST['fromcitydesti'];
}



$fromDestinationFlight = 'DEL-India';

if ($_REQUEST['fromDestinationFlight'] != '') {

   $fromDestinationFlight = $_REQUEST['fromDestinationFlight'];
}



$tocitydesti = 'BOM - MUMBAI';

if ($_REQUEST['tocitydesti'] != '') {

   $tocitydesti = $_REQUEST['tocitydesti'];
}



$toDestinationFlight = 'BOM-India';

if ($_REQUEST['toDestinationFlight'] != '') {

   $toDestinationFlight = $_REQUEST['toDestinationFlight'];
}





$journeyDateOne = date('d-m-Y');

if ($_REQUEST['journeyDateOne'] != '') {

   $journeyDateOne = $_REQUEST['journeyDateOne'];
}







$journeyDateRound = date('d-m-Y', strtotime('+1 days'));

if ($_REQUEST['journeyDateRound'] != '') {

   $journeyDateRound = $_REQUEST['journeyDateRound'];
}



function cleanstring($string)
{

   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

}



?>

<!DOCTYPE html>

<html lang="en">

<head>

   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

   <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />

   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">



   <?php

   $cc = GetPageRecord('*', 'cmsPages', ' pageType="Flight" and status=1 order by id desc limit 1');

   $cms = mysqli_fetch_array($cc);

   ?>



   <title><?php echo $cms['metaTitle']; ?></title>

   <meta name="title" content="<?php echo stripslashes($cms['metaTitle']); ?>">

   <meta name="keywords" content="<?php echo stripslashes($cms['metaKeyword']); ?>">

   <meta name="description" content="<?php echo stripslashes($cms['metaDesctiption']); ?>">

   <meta name="keywords" content="<?php echo stripslashes($cms['seoTag1']); ?>">

   <meta name="keywords" content="<?php echo stripslashes($cms['seoTag2']); ?>">

   <meta name="keywords" content="<?php echo stripslashes($cms['seoTag3']); ?>">

   <meta name="robots" content="<?php echo $cms['robotTag']; ?>">

   <meta property="og:site_name" content="<?php echo $cms['ogsiteName']; ?>" />

   <meta property="og:type" content="<?php echo $cms['ogType']; ?>" />

   <meta property="og:title" content="<?php echo $cms['ogmetaTitle']; ?>" />

   <meta property="og:description" content="<?php echo $cms['ogmetaDescription']; ?>" />

   <meta property="og:image" content="<?php echo $cms['ogImage']; ?>" />

   <meta property="og:url" content="<?php echo $cms['ogURL']; ?>" />

   <meta name="twitter:title" content="<?php echo $cms['twitterMetaTitle']; ?>" />

   <meta name="twitter:description" content="<?php echo $cms['twitterMetaDescription']; ?>" />

   <meta property="twitter:image" content="<?php echo $cms['twitterImage']; ?>" />

   <meta property="twitter:site" content="<?php echo $cms['twitterSite']; ?>" />

   <meta property="twitter:creator" content="<?php echo $cms['twitterCreator']; ?>" />

   <?php include "headerinc.php"; ?>

   <style>
      .selectreturnflightcl {
         display: none;
      }

      .flightsearchwihite .textfield::placeholder {
         color: #000;
      }

      @media (max-width: 575.98px) {

         .flightsearchwihite .lable {
            margin-left: 6px !important;
            top: 20px !important;
            padding: 9px 4px !important;
         }

         .searchboxouter .textfield {
            border-radius: 5px !important;
            padding: 30px 10px !important;
            font-size: 14px !important;
            padding-bottom: 14px !important;
            margin-top: 10px !important;
            border: 1px solid #ddd !important;
         }

         #pickupCitySearchfromCity2 {
            margin-left: 0px !important;
         }

         .flightsearchwihite .searchboxouter .tableborder table tr td {
            width: 50% !important;
         }

         .swapbtn {
            top: 25px !important;
            font-size: 14px !important;
            width: 34px !important;
            height: 34px !important;
         }

         .tablebordersearch {
            padding-left: 4px !important;
         }

         .fa-calendar:before {
            top: 18px !important;
            right: -7px !important;
            font-size: 16px !important;
         }

         .offerheading h3 {
            font-size: 17px;
            margin-left: 12px !important;
         }

         .holidestibox .card-body {
            background-color: transparent !important;
            top: 0px;
         }

         .flightsearchwihite {
            top: 256px !important;
         }

         .holidestibox {
            margin-bottom: 10px !important;
         }

         .holidestibox a {
            color: #000 !important;
         }

         .holidestibox p {
            color: #000 !important;
            font-weight: 600 !important;
         }

         .holidestibox .card {
            border: 1px solid #ddd;
         }

         .fa-calendar:before {
            top: 0px !important;
            right: 4px !important;
            font-size: 12px !important;
         }

         .holidestibox p {
            margin-top: 5px !important;
            text-align: left !important;
         }

         .holipricing {
            justify-content: left !important;
         }

         .pricelistflight tr {
            grid-template-columns: 33% 33% 33% !important;
         }

         .tablebordersearch {
            border: 1px solid #ddd !important;
            padding-bottom: 3px !important;
         }

         .tableborder table {
            position: relative;
            top: -4px !important;
         }

         .flightsearchwihite .searchboxouter .tableborder table tr td:last-child {
            padding-right: 12px;
         }

         .mobileshowonly ul {
            margin-bottom: 0px !important;
            margin-top: 50px;
            padding-left: 0px !important;
         }

         .mobileshowonly ul li {
            display: inline-block;
            list-style: none;
            margin: 0px 5px;
            border: 1px solid #fff;
            background-color: #fff;
            border-radius: 5px;
            padding: 16px 10px;
            width: 90px;
            height: 70px;
         }

         .mobileshowonly ul li a {
            font-size: 12px !important;
            font-weight: 700 !important;
            display: grid;
            text-align: center;
            color: #333333;
         }

         .mobileshowonly ul li a i {
            font-size: 28px;
         }

         .mobileshowonly {
            display: unset !important;
         }

         .top_bg_ofr_sb2other {
            border-radius: 0px !important;
         }

         .mobileshowonly {
            text-align: center !important;
         }

         .domheading {
            top: 160px !important;
            font-size: 18px !important;
         }

         .top_bg_ofr_sb2other {
            margin-top: -208px !important;
         }

      }

      .holidaytravel h3 {
         text-align: center;
         color: #000;
         font-size: 36px;
         font-weight: 700;
         margin: 0;
         padding: 10px 0;
      }

      [type="radio"]:checked,

      [type="radio"]:not(:checked) {

         position: absolute;

         left: -9999px;

      }

      [type="radio"]:checked+label,

      [type="radio"]:not(:checked)+label {

         position: relative;

         padding-left: 28px;

         cursor: pointer;

         line-height: 20px;

         display: inline-block;

         color: #666;

      }

      [type="radio"]:checked+label:before,

      [type="radio"]:not(:checked)+label:before {

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

      [type="radio"]:checked+label:after,

      [type="radio"]:not(:checked)+label:after {

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

      [type="radio"]:not(:checked)+label:after {

         opacity: 0;

         -webkit-transform: scale(0);

         transform: scale(0);

      }

      [type="radio"]:checked+label:after {

         opacity: 1;

         -webkit-transform: scale(1);

         transform: scale(1);

      }

      .flightsearchwihite .searchboxouter .redbuttonsearch {

         background-color: #ff9e31 !important;

      }

      .selectspcial {
         font-size: 18px;
         font-weight: 600;
         color: #000;
      }

      #flightsearchrow1 {
         border-top: 1px solid #ddd;
      }

      #flightsearchrow2 {
         border-top: 1px solid #ddd;
      }

      #flightsearchrow3 {
         border-top: 1px solid #ddd;
      }

      #flightsearchrow4 {
         border-top: 1px solid #ddd;
      }

      #flightsearchrow5 {
         border-top: 1px solid #ddd;
      }

      .fa-times-circle {
         padding: 30px;
         font-size: 25px;
         color: #d00000;
      }

      /*

         .top_bg_ofr_sb2other{height: auto !important; margin-bottom: 0 !important;}

         */



      .flightsearchwihite {
         background-color: #fff;
         padding: 17px;
         border-radius: 20px;
         box-shadow: 0px 10px 18px #29426917 !important;
         padding-bottom: 48px;
         margin-bottom: -180px;
         position: inherit;
         top: 0;
      }

      .domheadinght {
         text-align: center;
         font-size: 26px;
         font-weight: 600;
         color: #FFFFFF;
         width: 100%;
         padding-top: 200px;
      }

      .textcontent {
         padding-top: 100px;
      }



      .top_bg_ofr_sb2other {

         width: 100%;

         background: url(https://chalofly.com/admin/package_image/<?php echo $websitesetting2["photo"]; ?>) no-repeat;

         padding: 10px 0px 10px;

         color: #fff;

         height: 380px;

         background-color: transparent;

         background-repeat: no-repeat;

         background-size: cover;

         padding-top: 20px;

         margin-bottom: 210px;

         margin-top: 0;

         background-position: center;

      }





      @media (max-width: 575.98px) {



         .top_bg_ofr_sb2other .col-10 {
            width: 100% !important;
         }

         .offerheadingflight {
            display: none !important;
         }

         .top_bg_ofr_sb2other {
            margin-bottom: 430px !important;
         }

         .flightsearchwihite {
            padding: 20px !important;
         }

         .flightsearchwihite .searchboxouter .redbuttonsearch {
            height: 63px !important;
         }

         .flightsearchwihite .flightsearchbtn {
            margin-top: 5px !important;
         }

         .flightsearchwihite {
            border: 1px solid #ff9e31;
         }

         .tabgroup table tr {
            display: grid;
            grid-template-columns: 50% 50%;
         }

         .offerimg {
            height: 160px;
            border-radius: 15px;
         }

         .offersection h2 {
            font-size: 14px !important;
            margin: 5px 0px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 35px;
         }

         .offersection p {
            font-size: 14px !important;
            margin: 5px 0px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
         }

         .top_bg_ofr_sb2other {
            margin-top: -200px !important;
            margin-bottom: 410px !important;
         }

         .phoneholibox .card {
            border-radius: 14px !important;
         }

         .touersoffer {
            padding: 0px 10px !important;
         }

         .offerheading h3 {
            padding-top: 10px !important;
         }

         .testibg {
            border-radius: 0px !important;
         }

         .testibg {
            padding: 20px 42px 23px;
            border-radius: 0px;
            margin-top: 38px;
         }

         .testibg .heading {
            margin-bottom: 5px !important;
         }

         .offerbardealsfeaturedes {
            margin-top: 5px !important;
            margin-bottom: 10px !important;
         }

         .offerlaftside h2 {
            margin-bottom: 0px !important;
         }

         .offerheading p {
            font-size: 16px !important;
         }

         .offerbardealsfeature {
            padding: 15px 20px !important;
            margin-bottom: 20px !important;
         }

         .offerbardealsfeature .col-lg-3 {
            margin-bottom: 10px !important;
         }

         .playstore {
            margin-bottom: 12px !important;
            height: auto !important;
         }

         .domesticair {
            font-size: 22px !important;
         }

         .reslble label div {
            font-size: 10px !important;
         }

         .flightsearchwihite {
            padding: 10px !important;
         }

         .populartext {
            font-size: 20px !important;
         }

         .offerbardealsfeaturedes .row {
            padding-left: 3px;
            padding-right: 3px;
            display: flex !important;
            overflow: auto !important;
         }

         .holidaytravel h3{font-size: 14px !important;}

         [type="radio"]:checked+label:before, [type="radio"]:not(:checked)+label:before{    width: 17px !important;height: 17px !important;}
         [type="radio"]:checked+label:after, [type="radio"]:not(:checked)+label:after{top: 3px !important; left: 3px !important;width: 11px !important;height: 11px !important;}
.reswebchk{display: none !important;}
.labelheding1{display: none !important;}
.listlastflight{text-align: left !important;}
.resclss{text-align: left !important; align-items: left !important; display: block !important; margin: 12px 0px !important;}
.flightsearchwihite{position: relative !important; position: relative !important; top: 0px !important; height: 119% !important;}
.fullwidthinphone{width: 100% !important;}
.flightsearchwihite .flightsearchbtn{padding-left: 0px !important; padding-right: 0px !important;}
.reslble{margin-right: 5px !important;}
.listlastflight div:first-child{margin-right: 3px !important;}
.flightsearchwihite .searchboxouter .redbuttonsearch{max-width: 100% !important; width: 95% !important;}
#addflightrowbtn{max-width: 48% !important; position: relative !important; top: -78px !important; right: 9px !important; margin-left: auto !important;}
#flightsearchrow1 td:nth-child(4){display: none !important;}
.fa-times-circle{display: none !important;}
.flightsearchwihite{height: auto !important; position:  relative !important; top: 0px !important;}
.top_bg_ofr_sb2other{margin-bottom: 320px !important;}
.essent{font-size: 14px !important; font-weight: 500 !important;     color: #191e21 !important; }
.essent img{width: 22px !important;}
.essent span{color: #000000; font-weight: 700; margin-left: 10px;}
.populartext{font-size: 18px !important; text-align: center; margin-top: 0px !important; padding-top: 0px !important; margin-bottom: 10px !important;}
.flightsearchwihite .lable{background-color: transparent !important;}
#departurelabel{margin-left: 10px !important;}
.offerheading h3{font-size: 18px !important;  padding-bottom: 25px !important;}
.offerbardealsfeaturedes .col-12{width: 50% !important; padding: 0px 5px !important;}
.destinationimg img{width: 100% !important; height: 220px !important; object-fit: cover !important;}
.packagedestination a{color: #fff; font-size: 16px !important; text-decoration: none !important; font-weight: 500 !important; padding: 10px !important; display: block !important; letter-spacing: 1px !important;}
.popularrowfix{padding-left: 3px; padding-right: 3px; display: flex !important ; flex-wrap: nowrap !important;}
.citynewdelhi{text-align: center !important;}
.touersoffer{padding-top: 10px !important;}
.offersection p{font-size: 12px !important;font-weight: 500 !important;}

      }
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

            <div class="col-lg-1 col-1">

            </div>

            <div class="col-lg-10 col-10">

               <div class="flightsearchwihite">

                  <div class="holidaytravel">

                     <h3>Holiday Means Travel, Travel Means Chalofly</h3>

                  </div>

                  <div class="searchtabs">

                     <a class="active" id="tb1" onClick="selecttb(1);"><input type="radio" id="test1" name="radio-group" checked>

                        <label for="test1">One Way</label></a>

                     <a id="tb2" onClick="selecttb(2);">

                        <input type="radio" id="test2" name="radio-group">

                        <label for="test2">Round Trip</label></a>

                     <a id="tb3" onClick="selecttb(3);"><input type="radio" id="test3" name="radio-group">

                        <label for="test3">Multicity</label></a>

                     <!--<a class="active" id="tb1" onClick="selecttb(1);"><input type="radio"> One Way</a>

                           <a id="tb2" onClick="selecttb(2);"><input type="radio">  Round Trip</a>

                           <a id="tb3" onClick="selecttb(3);"><input type="radio"> Multicity</a>-->

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

                     <form method="GET" id="formids" action="<?php echo $fullurl; ?>flight-search">

                        <input type="hidden" name="tripType" id="tripType" value="1">

                        <div class="tableborder tablebordersearch">

                           <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class="flightsearchtable">

                              <tbody>

                                 <tr>

                                    <td width="20%" align="left" valign="top" id="fromflightdestination">

                                       <label>

                                          <div class="lable" id="fromlabel3">From</div>

                                          <div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity"></div>

                                          <input type="text" onClick="$('#pickupCitySearchfromCity').select();" class="textfield firstfld" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity','fromDestinationFlight','searchcitylistsfromCity');" id="pickupCitySearchfromCity" name="fromcitydesti" value="DEL - New Delhi" autocomplete="off">

                                          <div class="sublinesearch fromairport_fromDestinationFlight"><?php echo $fromairport; ?></div>

                                          <input name="fromDestinationFlight" id="fromDestinationFlight" type="hidden" value="DEL-India" autocomplete="nope">

                                       </label>

                                       <div class="swapbtn" onClick="swapdata();"><i class="fa fa-exchange" aria-hidden="true"></i></div>

                                    </td>

                                    <td width="20%" align="left" valign="top" id="toflightdestination" style="padding-left: 20px;">

                                       <label>

                                          <div class="lable tolabel" id="twolabel" style=" padding-left: 5px !important;">To</div>

                                          <div class="errorSection" style="display:none;" id="flightdublicate"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> From &amp; To airports cannot be the same</div>

                                          <div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity2"></div>

                                          <input type="text" onClick="$('#pickupCitySearchfromCity2').select();" class="textfield" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity2','fromDestinationFlight2','searchcitylistsfromCity2');" id="pickupCitySearchfromCity2" name="tocitydesti" value="CCU - Kolkata" autocomplete="off">

                                          <div class="sublinesearch toairport_fromDestinationFlight2"><?php echo $toairport; ?></div>

                                          <input name="toDestinationFlight" id="fromDestinationFlight2" type="hidden" value="CCU-India" autocomplete="nope">

                                       </label>

                                    </td>

                                    <td width="18%" align="left" valign="top">

                                       <label>

                                          <div class="lable" id="departurelabel">Departure</div>

                                          <input type="text" id="dt1" name="journeyDateOne" class="textfield" value="<?php echo trim($journeyDateOne); ?>" autocomplete="off" style="min-width: 140px;"><i class="fa fa-calendar" aria-hidden="true"></i>

                                       </label>

                                       <script>
                                          function getWeekday(dateFormat) {

                                             // split date in non-digit chaarcters

                                             let [d, m, y] = dateFormat.split(/\D/);



                                             //put them in Date method

                                             const date = new Date(y, m - 1, d)

                                             //and return weekday in long format

                                             const weekday = date.toLocaleString("default", {
                                                weekday: "long"
                                             })



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



                                          setInterval(function() {

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

                                          <input type="text" id="dt2" name="journeyDateRound" class="textfield" value="<?php echo trim($journeyDateRound); ?>" autocomplete="off" <?php if ($tripType == 1) { ?>disabled style="color:#000;" <?php } ?> disabled="disabled"><i class="fa fa-calendar" aria-hidden="true"></i>

                                       </label>

                                    </td>

                                    <td class="fullwidthinphone" width="18%" align="left" valign="top">

                                       <div class="lable" id="returnlable">Travellers & Class</div>

                                       <input type="text" id="travellersshow" name="travellersshow" class="textfield" value="<?php echo trim($travellers); ?>" autocomplete="off" readonly="readonly" onClick="$('#mobileflightsearchpax').show();" style="opacity: 0; display:none;">

                                       <input type="text" id="travellersshowdisplay" placeholder="1 Pax, Economy" class="textfield" value="<?php echo trim($toairportpax); ?>" autocomplete="off" readonly="readonly" onClick="$('#mobileflightsearchpax').show();">

                                       <div class="sublinesearch travellersshowclass"><?php echo $toairportclass; ?></div>

                                       <script>
                                          $('#basicDropdownClick').click(function(event) {

                                             event.stopPropagation();

                                          });



                                          function countadultchild(id, selectdiv) {

                                             var remainingpax = 0;

                                             var maxadultchild = 10;

                                             var toadult = 1;

                                             var tochild = 0;



                                             if (selectdiv == 'adt') {

                                                toadult = Number(id);

                                             } else {

                                                toadult = Number($('#ADT').val());

                                             }



                                             if (selectdiv == 'chd') {

                                                tochild = Number(id);

                                             } else {

                                                tochild = Number($('#CHD').val());

                                             }



                                             maxadultchild = Number(maxadultchild - toadult);



                                             maxadultchild = Number(maxadultchild - tochild);



                                             if (maxadultchild > 0) {

                                                selectadultad(id, selectdiv);

                                             } else {

                                                alert('You can not select more then 9 (Adult + Child)');

                                             }











                                          }







                                          function selectadultad(id, selectdiv) {







                                             $('.' + selectdiv + ' .paxbx').removeClass('active');











                                             if (selectdiv == 'adt') {



                                                $('#ADT').val(id);



                                                $('#adt' + id).addClass('active');



                                                selectpaxs();



                                             }







                                             if (selectdiv == 'chd') {



                                                $('#chd' + id).addClass('active');



                                                $('#CHD').val(id);



                                                selectpaxs();



                                             }















                                             if (selectdiv == 'inft') {



                                                $('#inft' + id).addClass('active');



                                                $('#INF').val(id);



                                                selectpaxs();



                                             }







                                          }
                                       </script>

                                       <div id="mobileflightsearchpax" class="dropdown-menu dropdown-unfold col-11 m-0 fullwidth" aria-labelledby="basicDropdownClickInvoker" style="width: 370px; right: 0px;">

                                          <div class=" " style="margin-bottom: 10px;">

                                             <div class="js-quantity mx-1 row align-items-center justify-content-between">

                                                <div class="phnonetraveltext" style="margin-bottom: 10px; width:100%; position:relative;">

                                                   <strong>Travellers</strong> <i class="fa donebtn1" aria-hidden="true" style="position: absolute; right: 10px; cursor: pointer; top: 4px; font-size: 16px; color: #000;" onClick="$('#mobileflightsearchpax').hide();">Done</i>

                                                </div>

                                                <span class="font-weight-medium" style="argin-bottom: 0px;">Adults</span>

                                                <div class="d-flex phonecalendar">

                                                   <div class="boxselectpax adt">

                                                      <div class="paxbx active" id="adt1" onClick="countadultchild('1','adt');">1</div>

                                                      <div class="paxbx" id="adt2" onClick="countadultchild('2','adt');">2</div>

                                                      <div class="paxbx" id="adt3" onClick="countadultchild('3','adt');">3</div>

                                                      <div class="paxbx" id="adt4" onClick="countadultchild('4','adt');">4</div>

                                                      <div class="paxbx" id="adt5" onClick="countadultchild('5','adt');">5</div>

                                                      <div class="paxbx" id="adt6" onClick="countadultchild('6','adt');">6</div>

                                                      <div class="paxbx" id="adt7" onClick="countadultchild('7','adt');">7</div>

                                                      <div class="paxbx" id="adt8" onClick="countadultchild('8','adt');">8</div>

                                                      <div class="paxbx" id="adt9" onClick="countadultchild('9','adt');">9</div>

                                                   </div>

                                                </div>

                                                <div class="d-flex phonecalendar" style="display:none !important;">

                                                   <select id="ADT" name="ADT" class="form-control" onChange="selectpaxs();">

                                                      <option value="1" <?php echo ($ADT == 1 ? 'selected' : ''); ?>>1</option>

                                                      <option value="2" <?php echo ($ADT == 2 ? 'selected' : ''); ?>>2</option>

                                                      <option value="3" <?php echo ($ADT == 3 ? 'selected' : ''); ?>>3</option>

                                                      <option value="4" <?php echo ($ADT == 4 ? 'selected' : ''); ?>>4</option>

                                                      <option value="5" <?php echo ($ADT == 5 ? 'selected' : ''); ?>>5</option>

                                                      <option value="6" <?php echo ($ADT == 6 ? 'selected' : ''); ?>>6</option>

                                                      <option value="7" <?php echo ($ADT == 7 ? 'selected' : ''); ?>>7</option>

                                                      <option value="8" <?php echo ($ADT == 8 ? 'selected' : ''); ?>>8</option>

                                                      <option value="9" <?php echo ($ADT == 9 ? 'selected' : ''); ?>>9</option>

                                                   </select>

                                                </div>

                                             </div>

                                          </div>

                                          <div class="" style="margin-bottom: 10px;">

                                             <div class="js-quantity mx-1 row align-items-center justify-content-between">

                                                <span class="d-block font-size-16 text-secondary font-weight-medium">Children (2 - 12 Years )</span>

                                                <div class="d-flex phonecalendar">

                                                   <div class="boxselectpax chd">

                                                      <div class="paxbx active" id="chd0" onClick="countadultchild('0','chd');">0</div>

                                                      <div class="paxbx" id="chd1" onClick="countadultchild('1','chd');">1</div>

                                                      <div class="paxbx" id="chd2" onClick="countadultchild('2','chd');">2</div>

                                                      <div class="paxbx" id="chd3" onClick="countadultchild('3','chd');">3</div>

                                                      <div class="paxbx" id="chd4" onClick="countadultchild('4','chd');">4</div>

                                                      <div class="paxbx" id="chd5" onClick="countadultchild('5','chd');">5</div>

                                                      <div class="paxbx" id="chd6" onClick="countadultchild('6','chd');">6</div>

                                                      <div class="paxbx" id="chd7" onClick="countadultchild('7','chd');">7</div>

                                                      <div class="paxbx" id="chd8" onClick="countadultchild('8','chd');">8</div>

                                                   </div>

                                                </div>

                                                <div class="d-flex phonecalendar" style="display:none !important;">

                                                   <select id="CHD" name="CHD" class="form-control" onChange="selectpaxs();">

                                                      <option value="0" <?php echo ($CHD == 0 ? 'selected' : ''); ?>>0</option>

                                                      <option value="1" <?php echo ($CHD == 1 ? 'selected' : ''); ?>>1</option>

                                                      <option value="2" <?php echo ($CHD == 2 ? 'selected' : ''); ?>>2</option>

                                                      <option value="3" <?php echo ($CHD == 3 ? 'selected' : ''); ?>>3</option>

                                                      <option value="4" <?php echo ($CHD == 4 ? 'selected' : ''); ?>>4</option>

                                                      <option value="5" <?php echo ($CHD == 5 ? 'selected' : ''); ?>>5</option>

                                                      <option value="6" <?php echo ($CHD == 6 ? 'selected' : ''); ?>>6</option>

                                                      <option value="7" <?php echo ($CHD == 7 ? 'selected' : ''); ?>>7</option>

                                                      <option value="8" <?php echo ($CHD == 8 ? 'selected' : ''); ?>>8</option>

                                                   </select>

                                                </div>

                                             </div>

                                          </div>

                                          <div class="" style="margin-bottom: 10px;">

                                             <div class="js-quantity mx-1 row align-items-center justify-content-between">

                                                <span class="d-block font-size-16 text-secondary font-weight-medium">Infants 0-23 Months</span>

                                                <div class="d-flex phonecalendar">

                                                   <div class="boxselectpax inft">

                                                      <div class="paxbx active" id="inft0" onClick="selectadultad('0','inft');">0</div>

                                                      <div class="paxbx" id="inft1" onClick="selectadultad('1','inft');">1</div>

                                                      <div class="paxbx" id="inft2" onClick="selectadultad('2','inft');">2</div>

                                                      <div class="paxbx" id="inft3" onClick="selectadultad('3','inft');">3</div>

                                                      <div class="paxbx" id="inft4" onClick="selectadultad('4','inft');">4</div>

                                                      <div class="paxbx" id="inft5" onClick="selectadultad('5','inft');">5</div>

                                                      <div class="paxbx" id="inft6" onClick="selectadultad('6','inft');">6</div>

                                                   </div>

                                                </div>

                                                <div class="d-flex calendar" style="display:none !important;">

                                                   <select id="INF" name="INF" class="form-control" onChange="selectpaxs();">

                                                      <option value="0" <?php echo ($INF == 0 ? 'selected' : ''); ?>>0</option>

                                                      <option value="1" <?php echo ($INF == 1 ? 'selected' : ''); ?>>1</option>

                                                      <option value="2" <?php echo ($INF == 2 ? 'selected' : ''); ?>>2</option>

                                                      <option value="3" <?php echo ($INF == 3 ? 'selected' : ''); ?>>3</option>

                                                      <option value="4" <?php echo ($INF == 4 ? 'selected' : ''); ?>>4</option>

                                                      <option value="5" <?php echo ($INF == 5 ? 'selected' : ''); ?>>5</option>

                                                      <option value="6" <?php echo ($INF == 6 ? 'selected' : ''); ?>>6</option>

                                                   </select>

                                                </div>

                                             </div>

                                          </div>
										  
										  <div class="" style="margin-bottom: 10px;">

                                          <div class="js-quantity mx-1 row align-items-center justify-content-between">

                                             <span class="d-block font-size-16 text-secondary font-weight-medium">Preffered Class</span>

                                             <div class="d-flex">

                                                <select id="PC" name="PC" class="form-control economybutton" onChange="selectpaxs();" >

                                                   <option value="ECONOMY">ECONOMY</option>

                                                   <option value="PREMIUM_ECONOMY">PREMIUM ECONOMY</option>

                                                   <option value="BUSINESS">BUSINESS</option>

                                                   <option value="FIRST">FIRST</option>

                                                </select>

                                             </div>

                                          </div>

                                       </div>


                                          <!-- <div class="" style="margin-bottom: 10px;">

                                                <div class="js-quantity mx-1 row align-items-center justify-content-between">

                                                   <span class="d-block font-size-16 text-secondary font-weight-medium">Preffered Class</span>

                                                   <div class="d-flex">

                                                      <select id="PC" name="PC" class="form-control economybutton" onChange="selectpaxs();" >

                                                         <option value="ECONOMY" <?php if ($PC == 'ECONOMY') {
                                                                                    echo 'selected';
                                                                                 } ?>>Economy</option>

                                                         <option value="PREMIUM_ECONOMY" <?php if ($PC == 'PREMIUM_ECONOMY') {
                                                                                             echo 'selected';
                                                                                          } ?>>Premium Economy</option>

                                                         <option value="BUSINESS" <?php if ($PC == 'BUSINESS') {
                                                                                       echo 'selected';
                                                                                    } ?>>Business</option>

                                                         <option value="FIRST" <?php if ($PC == 'FIRST') {
                                                                                    echo 'selected';
                                                                                 } ?>>First</option>

                                                      </select>

                                                   </div>

                                                </div>

                                             </div>-->

                                          <script>
                                             function selectpaxs() {

                                                var ADT = Number($('#ADT').val());

                                                var CHD = Number($('#CHD').val());

                                                var INF = Number($('#INF').val());

                                                var PC = $('#PC').val();

                                                $('#travellersshow').val(Number(ADT + CHD + INF) + ' Pax, ' + PC);

                                                $('#travellersshowdisplay').val(Number(ADT + CHD + INF) + ' Pax');

                                                $('.travellersshowclass').text(PC);

                                             }
                                          </script>

                                       </div>

                                    </td>

                                    <style>
                                       #flightsearchrow1 {
                                          display: none;
                                       }

                                       #flightsearchrow2 {
                                          display: none;
                                       }

                                       #flightsearchrow3 {
                                          display: none;
                                       }

                                       #flightsearchrow4 {
                                          display: none;
                                       }
                                    </style>

                                    <td width="18%">

                                       <div class="flightsearchbtn">

                                          <input type="button" name="Submit" value="Search Flights" class="redbuttonsearch" onClick="findflight(1);">

                                          <script>
                                             function addflightrow() {

                                                var showflightrow = Number($('#showflightrow').val());



                                                if (showflightrow == 1) {

                                                   $('#flightsearchrow1').show();

                                                   $('#flightsearchrow1 .fa-times-circle').show();

                                                }



                                                if (showflightrow == 2) {

                                                   $('#flightsearchrow2').show();

                                                   $('#flightsearchrow2 .fa-times-circle').show();

                                                   $('#flightsearchrow1 .fa-times-circle').hide();

                                                }

                                                if (showflightrow == 3) {

                                                   $('#flightsearchrow3').show();

                                                   $('#flightsearchrow3 .fa-times-circle').show();

                                                   $('#flightsearchrow1 .fa-times-circle').hide();

                                                   $('#flightsearchrow2 .fa-times-circle').hide();

                                                }



                                                if (showflightrow == 4) {

                                                   $('#flightsearchrow4').show();

                                                   $('#flightsearchrow4 .fa-times-circle').show();

                                                   $('#flightsearchrow1 .fa-times-circle').hide();

                                                   $('#flightsearchrow2 .fa-times-circle').hide();

                                                   $('#flightsearchrow3 .fa-times-circle').hide();

                                                }



                                                $('#showflightrow').val(Number(showflightrow + 1));



                                                if (showflightrow == 4) {

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

                                          <input type="text" class="textfield firstfld" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity_2','fromDestinationFlight_2','searchcitylistsfromCity_2');" id="pickupCitySearchfromCity_2" name="fromcitydesti2" value="" autocomplete="off">

                                          <div class="sublinesearch fromairport_fromDestinationFlight_2" style="padding-left: 0px;"></div>

                                          <input name="fromDestinationFlight2" id="fromDestinationFlight_2" type="hidden" value="" autocomplete="nope">

                                       </label>

                                       <div class="swapbtn" onClick="swapdata();"><i class="fa fa-exchange" aria-hidden="true"></i></div>

                                    </td>



                                    <td width="20%" align="left" valign="top" id="toflightdestination" style="padding-left: 20px;">

                                       <label>

                                          <div class="lable tolabel" id="twolabel" style="padding-left: 5px !important;    margin-left: 0px !important;">To</div>

                                          <div class="errorSection" style="display:none;" id="flightdublicate"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> From &amp; To airports cannot be the same</div>

                                          <div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left;display:none;" id="searchcitylistsfromCity2_22"></div>

                                          <input type="text" class="textfield" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity2_22','fromDestinationFlight22','searchcitylistsfromCity2_22');" id="pickupCitySearchfromCity2_22" name="tocitydesti2" value="" autocomplete="off">

                                          <div class="sublinesearch toairport_fromDestinationFlight22" style="padding-left: 0px;"></div>

                                          <input name="toDestinationFlight2" id="fromDestinationFlight22" type="hidden" value="" autocomplete="nope">

                                       </label>

                                    </td>



                                    <td width="18%" align="left" valign="top">

                                       <label>

                                          <div class="lable" id="departurelabel" style="margin-left: 0px !important;    padding-left: 4px !important;">Departure</div>

                                          <input type="text" id="departure2" name="journeyDate2" class="textfield datepicker" value="" autocomplete="off"><i class="fa fa-calendar" aria-hidden="true"></i>

                                       </label>

                                    </td>

                                    <td width="18%" align="left" valign="top"><i class="fa fa-times-circle" aria-hidden="true" onClick="$('#flightsearchrow1').hide(); $('#departure2').val(''); $('#fromDestinationFlight22').val('');$('#addflightrowbtn').show();"></i></td>

                                    <td width="18%" align="left" valign="top"> </td>

                                 </tr>



                                 <tr id="flightsearchrow2">

                                    <td width="20%" align="left" valign="top" id="fromflightdestination">

                                       <label>

                                          <div class="lable" id="fromlabel">From</div>

                                          <div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity_3"></div>

                                          <input type="text" class="textfield firstfld" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity_3','fromDestinationFlight_3','searchcitylistsfromCity_3');" id="pickupCitySearchfromCity_3" name="fromcitydesti3" value="" autocomplete="off">

                                          <div class="sublinesearch fromairport_fromDestinationFlight_3" style="padding-left: 0px;"></div>

                                          <input name="fromDestinationFlight3" id="fromDestinationFlight_3" type="hidden" value="" autocomplete="nope">

                                       </label>

                                       <div class="swapbtn" onClick="swapdata();"><i class="fa fa-exchange" aria-hidden="true"></i></div>

                                    </td>



                                    <td width="20%" align="left" valign="top" id="toflightdestination" style="padding-left: 20px;">

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

                                          <input type="text" id="departure3" name="journeyDate3" class="textfield datepicker" value="" autocomplete="off"><i class="fa fa-calendar" aria-hidden="true"></i>

                                       </label>

                                       <script>
                                          function getWeekday(dateFormat) {

                                             // split date in non-digit chaarcters

                                             let [d, m, y] = dateFormat.split(/\D/);



                                             //put them in Date method

                                             const date = new Date(y, m - 1, d)

                                             //and return weekday in long format

                                             const weekday = date.toLocaleString("default", {
                                                weekday: "long"
                                             })



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



                                          setInterval(function() {

                                             var dt = $('#dt1').val();

                                             var dtt = $('#dt2').val();



                                             $('.flightdeparturedate').text(getWeekday(dt));

                                             $('.flightreturndate').text(getWeekday(dtt));





                                          }, 100);
                                       </script>

                                    </td>

                                    <td width="18%" align="left" valign="top"><i class="fa fa-times-circle" aria-hidden="true" onClick="$('#flightsearchrow2').hide();$('#departure3').val(''); $('#fromDestinationFlight33').val('');$('#addflightrowbtn').show();"></i></td>

                                    <td width="18%" align="left" valign="top"> </td>

                                 </tr>



                                 <tr id="flightsearchrow3">

                                    <td width="20%" align="left" valign="top" id="fromflightdestination">

                                       <label>

                                          <div class="lable" id="fromlabel">From</div>

                                          <div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity_4"></div>

                                          <input type="text" class="textfield firstfld" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity_4','fromDestinationFlight_4','searchcitylistsfromCity_4');" id="pickupCitySearchfromCity_4" name="fromcitydesti4" value="" autocomplete="off">

                                          <div class="sublinesearch fromairport_fromDestinationFlight_4" style="padding-left: 0px;"></div>

                                          <input name="fromDestinationFlight4" id="fromDestinationFlight_4" type="hidden" value="" autocomplete="nope">

                                       </label>

                                       <div class="swapbtn" onClick="swapdata();"><i class="fa fa-exchange" aria-hidden="true"></i></div>

                                    </td>



                                    <td width="20%" align="left" valign="top" id="toflightdestination" style="padding-left: 20px;">

                                       <label>

                                          <div class="lable tolabel" id="twolabel" style=" padding-left: 5px !important;    margin-left: 0px !important;">To</div>

                                          <div class="errorSection" style="display:none;" id="flightdublicate"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> From &amp; To airports cannot be the same</div>

                                          <div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity2_44"></div>

                                          <input type="text" class="textfield" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity2_44','fromDestinationFlight44','searchcitylistsfromCity2_44');" id="pickupCitySearchfromCity2_44" name="tocitydesti4" value="" autocomplete="off">

                                          <div class="sublinesearch toairport_fromDestinationFlight44" style="padding-left: 0px;"></div>

                                          <input name="toDestinationFlight4" id="fromDestinationFlight44" type="hidden" value="" autocomplete="nope">

                                       </label>

                                    </td>



                                    <td width="18%" align="left" valign="top">

                                       <label>

                                          <div class="lable" id="departurelabel" style="    margin-left: 0px !important;    padding-left: 4px !important;">Departure</div>

                                          <input type="text" id="departure4" name="journeyDate4" class="textfield datepicker" value="" autocomplete="off"><i class="fa fa-calendar" aria-hidden="true"></i>

                                       </label>

                                    </td>



                                    <td width="18%" align="left" valign="top"><i class="fa fa-times-circle" aria-hidden="true" onClick="$('#flightsearchrow3').hide();$('#departure4').val(''); $('#fromDestinationFlight44').val('');$('#addflightrowbtn').show();"></i></td>



                                    <td width="18%" align="left" valign="top"> </td>

                                 </tr>



                                 <tr id="flightsearchrow4">

                                    <td width="20%" align="left" valign="top" id="fromflightdestination">

                                       <label>

                                          <div class="lable" id="fromlabel">From</div>

                                          <div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity_5"></div>

                                          <input type="text" class="textfield firstfld" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity_5','fromDestinationFlight_5','searchcitylistsfromCity_5');" id="pickupCitySearchfromCity_5" name="fromcitydesti5" value="" autocomplete="off">

                                          <div class="sublinesearch fromairport_fromDestinationFlight_5" style="padding-left: 0px;"></div>

                                          <input name="fromDestinationFlight5" id="fromDestinationFlight_5" type="hidden" value="" autocomplete="nope">

                                       </label>

                                       <div class="swapbtn" onClick="swapdata();"><i class="fa fa-exchange" aria-hidden="true"></i></div>

                                    </td>

                                    <td width="20%" align="left" valign="top" id="toflightdestination" style="padding-left: 20px;">

                                       <label>

                                          <div class="lable tolabel" id="twolabel" style=" padding-left: 5px !important;    margin-left: 0px !important;">To</div>

                                          <div class="errorSection" style="display:none;" id="flightdublicate"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> From &amp; To airports cannot be the same</div>

                                          <div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity2_55"></div>

                                          <input type="text" class="textfield" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity2_55','fromDestinationFlight55','searchcitylistsfromCity2_55');" id="pickupCitySearchfromCity2_55" name="tocitydesti5" value="" autocomplete="off">

                                          <div class="sublinesearch toairport_fromDestinationFlight55" style="padding-left: 0px;"></div>

                                          <input name="toDestinationFlight5" id="fromDestinationFlight55" type="hidden" value="" autocomplete="nope">

                                       </label>

                                    </td>



                                    <td width="18%" align="left" valign="top">

                                       <label>

                                          <div class="lable" id="departurelabel" style="margin-left: 0px !important;    padding-left: 4px !important;">Departure</div>

                                          <input type="text" id="departure5" name="journeyDate5" class="textfield datepicker" value="" autocomplete="off"><i class="fa fa-calendar" aria-hidden="true"></i>

                                       </label>

                                    </td>



                                    <td width="18%" align="left" valign="top"><i class="fa fa-times-circle" aria-hidden="true" onClick="$('#flightsearchrow4').hide();$('#departure5').val(''); $('#fromDestinationFlight55').val('');$('#addflightrowbtn').show();"></i></td>

                                    <td width="18%" align="left" valign="top"> </td>

                                 </tr>

                              </tbody>

                           </table>

                        </div>

                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mobdme2">

                           <tbody>

                              <tr>

                                 <td style="border-right: 0 !important;">

                                    <div style=" margin-bottom:10px; text-align:right; display:none;" id="addflightrowbtn"><input type="button" name="button" value="+ Add City" class="redbuttonsearch" onClick="addflightrow();" style="margin-top: 0px; border: 1px solid #24bf24 !important; background-color: #fff !important; box-shadow: 0px 0px 0px; color: #24bf24; padding: 10px; font-size: 15px; width: 100px; border-radius: 5px; "></div>

                                    <div style="text-align:center;" class="listlastflight">

                                       <div class="resclss" style="border-radius: 10px;display: flex ; align-items: center;text-align: center; border-radius:8px;">

                                          <div>

                                             <label class="labelheding1">

                                                <div style="padding:10px 10px 10px 2px !important; border-right: 0 !important; font-size:18px; color:#000; font-weight: 800;">Select a Special Fares</div>

                                             </label>

                                          </div>





                                          <div class="reslble">

                                             <label>

                                                <div style="padding:10px 25px;line-height: 13px; border: solid 1px #ccc; border-radius: 4px; font-size:16px; color: #aaa;">

                                                   <input type="radio" name="psting" id="alltest1" value="" checked>

                                                   <label class="secondlbl" for="alltest1">All</label>

                                                </div>
                                             </label>

                                             <label>

                                                <div style="padding:10px 25px;line-height: 13px; border: solid 1px #ccc; border-radius: 4px; font-size:16px; color: #aaa;">

                                                   <input name="psting" type="radio" id="alltest2" value="Regular">

                                                   <label class="secondlbl" for="alltest2">Regular</label>

                                                </div>
                                             </label>

                                             <label>

                                                <div style="padding:10px 25px;line-height: 13px; border: solid 1px #ccc; border-radius: 4px; font-size:16px; color: #aaa;">

                                                   <input type="radio" name="psting" id="alltest3" value="Student">

                                                   <label class="secondlbl" for="alltest3">Student</label>

                                                </div>
                                             </label>

                                             <label>

                                                <div style="padding:10px 25px;line-height: 13px; border: solid 1px #ccc; border-radius: 4px; font-size:16px; color: #aaa;">

                                                   <input type="radio" name="psting" id="alltest4" value="Senior citizen">

                                                   <label class="secondlbl" for="alltest4">Senior Citizen</label>
                                                </div>
                                             </label>

                                          </div>

                                       </div>

                                    </div>

                                    <!-- secondrighttable -->

                                    <table class="reswebchk" border="0" align="right" cellpadding="0" cellspacing="0">

                                       <tbody>

                                          <tr>

                                             <td style="border-right: 0px solid #ddd !important;">

                                                <a href="<?php echo $fullurl; ?>web-check-in" target="_blank" style="padding: 9px 15px; display: block; color: #00a1e5; font-size: 18px; font-weight: 800; border-radius: 5px; background: #e5f7ff; border: solid 1px #00a1e5;"><img src="images/webplan.png"> Web Check-In</a>

                                             </td>

                                          </tr>

                                       </tbody>

                                    </table>

                                 </td>

                              </tr>

                           </tbody>

                        </table>

                        <input type="hidden" name="action" value="flightpostaction">

                        <input type="hidden" name="changesearch" id="changesearch" value="0">

                     </form>

                  </div>

               </div>

            </div>

         </div>

      </div>

   </div>

   <!-- messagesection -->

   <div class="textcontent">

      <div class="container">

         <?php

         $a = GetPageRecord('id', 'sys_Marquee', 'messageType="flight" and addBy=1 and status=1');

         $Marqueedata = mysqli_fetch_array($a);



         if ($Marqueedata['id'] != '') {



         ?>

            <div class="row messagerow">

               <div class="col-lg-12">

                  <div class="messagesection">

                     <?php

                     $a = GetPageRecord('*', 'sys_Marquee', ' messageType="flight"  and addBy=1 and status=1 order by id desc limit 0,1');

                     while ($marqueedatalist = mysqli_fetch_array($a)) {

                     ?>

                        <marquee direction="left" width="100%"><?php echo stripslashes($marqueedatalist['title']); ?></marquee>

                     <?php } ?>

                  </div>

               </div>

            </div>

         <?php } ?>

         <!-- offersection -->

         <?php

         $clientwebsite = GetPageRecord('*', 'clientWebsiteTheme', ' 1 order by id asc');

         while ($clientwebsitesection = mysqli_fetch_array($clientwebsite)) {

            include 'weight/' . $clientwebsitesection['sectionFile'] . '.php';
         }

         ?>

      </div>

      <?php echo $cms['bodyScript']; ?>

   </div>

   <style>
      .flightfooter {
         padding-bottom: 10px;
      }
   </style>

   <script>
      function getflightSearchCIty(citysearchfield, cityresultfield, listsearch) {



         var citysearchfieldval = encodeURI($('#' + citysearchfield).val());



         var citysearchfield = citysearchfield;







         if (citysearchfieldval != '') {



            $('#' + listsearch).show();



            $('#' + listsearch).load('searchflightcitylists.php?keyword=' + citysearchfieldval + '&searchcitylists=' + listsearch + '&cityresultfield=' + cityresultfield + '&citysearchfield=' + citysearchfield);



         }



      }











      function swapdata() {



         var pickupCitySearchfromCity = $('#pickupCitySearchfromCity').val();



         var pickupCitySearchfromCity2 = $('#pickupCitySearchfromCity2').val();







         var fromDestinationFlight = $('#fromDestinationFlight').val();



         var fromDestinationFlight2 = $('#fromDestinationFlight2').val();







         $('#pickupCitySearchfromCity').val(pickupCitySearchfromCity2);



         $('#pickupCitySearchfromCity2').val(pickupCitySearchfromCity);







         $('#fromDestinationFlight2').val(fromDestinationFlight);



         $('#fromDestinationFlight').val(fromDestinationFlight2);







      }







      $(".swapbtn").click(function() {



         $(this).toggleClass("down");



      });



























      $(document).ready(function() {



         $(function() {

            $(".datepicker").datepicker({
               dateFormat: "dd-mm-yy",



               minDate: 0,
            });

         });





         $("#dt1").datepicker({



            dateFormat: "dd-mm-yy",



            minDate: 0,



            onSelect: function() {



               var dt2 = $('#dt2');



               var startDate = $(this).datepicker('getDate');



               //add 30 days to selected date



               startDate.setDate(startDate.getDate() + 30);



               var minDate = $(this).datepicker('getDate');



               var dt2Date = dt2.datepicker('getDate');



               //difference in days. 86400 seconds in day, 1000 ms in second



               var dateDiff = (dt2Date - minDate) / (86400 * 1000);







               //dt2 not set or dt1 date is greater than dt2 date



               if (dt2Date == null || dateDiff < 0) {



                  dt2.datepicker('setDate', minDate);



               }



               //dt1 date is 30 days under dt2 date
               else if (dateDiff > 30) {



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



            minDate: 0,
            onSelect: function() {



            }



         });







      });





      $(document).ready(function() {



         $("#dt1").datepicker({



            dateFormat: "dd-mm-yy",



            minDate: 0,



            onSelect: function() {



               var dt2 = $('#dt2');



               var startDate = $(this).datepicker('getDate');



               //add 30 days to selected date



               startDate.setDate(startDate.getDate() + 365);



               var minDate = $(this).datepicker('getDate');



               var dt2Date = dt2.datepicker('getDate');



               //difference in days. 86400 seconds in day, 1000 ms in second



               var dateDiff = (dt2Date - minDate) / (86400 * 1000);







               //dt2 not set or dt1 date is greater than dt2 date



               if (dt2Date == null || dateDiff < 0) {



                  dt2.datepicker('setDate', minDate);



               }



               //dt1 date is 30 days under dt2 date
               else if (dateDiff > 365) {



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



            minDate: 0,
            onSelect: function() {



            }



         });







      });















      function changeselectsearchtype() {



         var selectsearchtype = Number($('#selectsearchtype').val());



         if (selectsearchtype < 4) {



            selecttb(selectsearchtype);



         }







         if (selectsearchtype == 4) {



            $("#groupenquiryid").trigger("click");



         }



         $('#selectsearchtype').val(1);



      }

































      function selecttb(id) {



         $('#returndiv').show();



         $('#searchbuttonflight').show();



         $('#submitbuttonflight').hide();



         $('#notediv').hide();



         if (id == 1) {

            $('#addflightrowbtn').hide();

            $('#tb1').removeClass('active');

            $('#tb2').removeClass('active');

            $('#tb3').removeClass('active');

            $('#tb4').removeClass('active');

            $('#tb1').addClass('active');



            $('#tripType').val('1');



            $('#dt2').attr('disabled', 'true');



            $('#dt3').attr('disabled', 'true');



            $('#dt2').css('color', '#fafafa');



            $('#fixedDeparture').val('0');



            $('.selectreturnflightcl').hide();



            $('.swapbtn').show();

         }





         if (id == 3) {

            $('#tb1').removeClass('active');

            $('#tb2').removeClass('active');

            $('#tb3').addClass('active');

            $('#addflightrowbtn').show();

            $('.swapbtn').hide();

            $('.selectreturnflightcl').hide();

            $('#dt2').attr('disabled', 'true');

            $('#tripType').val('3');

         }



         if (id == 2) {

            $('#addflightrowbtn').hide();



            $('.selectreturnflightcl').show();



            $('#tb1').removeClass('active');



            $('#tb3').removeClass('active');



            $('#tb4').removeClass('active');



            $('#tb2').addClass('active');



            $('#tripType').val('2');



            $('#dt2').removeAttr('disabled');



            $('#dt3').removeAttr('disabled');



            $('#dt2').css('color', '#333333');



            $('#fixedDeparture').val('0');

            $('.swapbtn').show();



         }









         if (id == 4) {



            $('#returndiv').hide();



            $('#tb1').removeClass('active');



            $('#tb2').removeClass('active');



            $('#tb3').removeClass('active');



            $('#tb4').addClass('active');



            $('#formids').attr('target', 'actoinfrm');



            $('#formids').attr('action', 'actionpage.php');



            $('#tripType').val('4');



            $('#notediv').show();







            $('#searchbuttonflight').hide();



            $('#submitbuttonflight').show();



         }











      }













      function findflight(id) {



         var pickupCitySearchfromCity = $('#pickupCitySearchfromCity').val();



         var pickupCitySearchfromCity2 = $('#pickupCitySearchfromCity2').val();







         if (pickupCitySearchfromCity == pickupCitySearchfromCity2) {



            $('#flightdublicate').show();



         } else {



            $('#flightdublicate').hide();











            if (id == 1) {



               $('#formids').submit();



            }







         }



      }











      function checkdublicatedestination() {



         setTimeout(function() {



            findflight(0);



         }, 500);



      }



      $('.testimonials').slick({
    dots: true,
    arrows: false,

    slidesToShow: 3,
    slidesToScroll: 1,

    autoplay: true,          // Auto slide
    autoplaySpeed: 2000,     // 2 sec
    infinite: true,
    speed: 800,

    touchMove: true,

    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});
   </script>

   <?php echo $cms['footerScript']; ?>

   <?php include "footer.php"; ?>

   <?php include "footerinc.php"; ?>

</body>

</html>