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
            border-radius: 5px !important; padding: 0px 5px 0 !important;
            box-shadow: none !important;
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

         .holidaytravel h3 {
            font-size: 14px !important;
         }

         [type="radio"]:checked+label:before,
         [type="radio"]:not(:checked)+label:before {
            width: 17px !important;
            height: 17px !important;
         }

         [type="radio"]:checked+label:after,
         [type="radio"]:not(:checked)+label:after {
            top: 3px !important;
            left: 3px !important;
            width: 11px !important;
            height: 11px !important;
         }

         .reswebchk {
            display: none !important;
         }

         .labelheding1 {
            display: none !important;
         }

         .listlastflight {
            text-align: left !important;
         }

         .resclss {
            text-align: left !important;
            align-items: left !important;
            display: block !important;
            margin: 12px 0px !important;
         }

         .flightsearchwihite {
            position: relative !important;
            position: relative !important;
            top: 0px !important;
            height: 119% !important;
         }

         .fullwidthinphone {
            width: 100% !important;
         }

         .flightsearchwihite .flightsearchbtn {
            padding-left: 0px !important;
            padding-right: 0px !important;
         }

         .reslble {
            margin-right: 5px !important;
         }

         .listlastflight div:first-child {
            margin-right: 3px !important;
         }

         .flightsearchwihite .searchboxouter .redbuttonsearch {
            max-width: 100% !important;
            width: 95% !important;
         }

         #addflightrowbtn {
            max-width: 48% !important;
            position: relative !important;
            top: -78px !important;
            right: 9px !important;
            margin-left: auto !important;
         }

         #flightsearchrow1 td:nth-child(4) {
            display: none !important;
         }

         .fa-times-circle {
            display: none !important;
         }

         .flightsearchwihite {
            height: auto !important;
            position: relative !important;
            top: 0px !important;
         }

         .top_bg_ofr_sb2other {
            margin-bottom: 320px !important;
         }

         .essent {
            font-size: 14px !important;
            font-weight: 500 !important;
            color: #191e21 !important;
         }

         .essent img {
            width: 22px !important;
         }

         .essent span {
            color: #000000;
            font-weight: 700;
            margin-left: 10px;
         }

         .populartext {
            font-size: 18px !important;
            text-align: center;
            margin-top: 0px !important;
            padding-top: 0px !important;
            margin-bottom: 10px !important;
         }

         .flightsearchwihite .lable {
            background-color: transparent !important;
         }

         #departurelabel {
            margin-left: 10px !important;
         }

         .offerheading h3 {
            font-size: 18px !important;
            padding-bottom: 25px !important;
         }

         .offerbardealsfeaturedes .col-12 {
            width: 50% !important;
            padding: 0px 5px !important;
         }

         .destinationimg img {
            width: 100% !important;
            height: 220px !important;
            object-fit: cover !important;
         }

         .packagedestination a {
            color: #fff;
            font-size: 16px !important;
            text-decoration: none !important;
            font-weight: 500 !important;
            padding: 10px !important;
            display: block !important;
            letter-spacing: 1px !important;
            background-color: rgb(31 31 31 / 92%) !important;
         }

         .popularrowfix {
            padding-left: 3px;
            padding-right: 3px;
            display: flex !important;
            flex-wrap: nowrap !important;
         }

         .citynewdelhi {
            text-align: center !important;
         }

         .touersoffer {
            padding-top: 10px !important;
         }

         .offersection p {
            font-size: 12px !important;
            font-weight: 500 !important;
         }


         .offerbardeals {
            padding-top: 0px !important;
         }

         .textcontent {
            margin-top: 30px !important;
         }

         .blugbg {
            margin: 20px 0px !important;
         }

         .touersoffer {
            margin-top: 10px !important;
         }

         .phoneholibox .card {
            border-radius: 10px !important;
         }

         .testibg {
            padding: 20px !important;
            height: 340px !important;
         }

         .offerbardealsfeature {
            margin-top: 20px !important;
         }

         .busdestination {
            border-radius: 10px !important;
            overflow: hidden !important;
         }

         .offerbardeals {
            box-shadow: none !important;
         }

         .tabgroup table tr td {
            padding: 0px !important;
            padding-right: 14px !important;
            padding-bottom: 15px !important;
         }

         .offerbardeals {
            width: 103% !important;
         }

         .option-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px !important;
            text-align: center;
            box-shadow: 0 0 2px rgba(0, 0, 0, 0.1);
            width: 45%;
            transition: 0.3s;
         }

         .option-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-4px);
         }

         .option-card svg {
            width: 48px;
            height: 48px;
            margin-bottom: 10px;
         }

         .option-card h6 {
            font-weight: 600;
            margin: 0;
            font-size: 14px !important
         }

         .option-card img {
            width: 38px !important;
            margin-bottom: 6px !important;
         }

         .topcarmenu {
            background-color: rgb(242, 242, 242) !important;
            padding: 15px 0px;
            margin-top: 49px;
         }

         .flightfooter {
            display: none !important;
         }

         .tabgroup table tr {
            display: unset !important;
         }

         #first-tab-group table {
            width: 100% !important;
            overflow: auto !important;
            display: flex !important;
            flex-wrap: nowrap !important;
            white-space: nowrap !important;
         }

         .offersection h2 {
            white-space: normal !important;
            height: 44px !important;
            padding: 10px 5px !important;
            margin: 0px !important;
         }

         .offersection p {
            white-space: normal !important;
            height: 48px !important;
            padding: 10px 5px !important;
            margin: 0px !important;
         }

         #first-tab-group .offersection {
            width: 200px !important;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 15px;
            padding: 6px;
         }

         .mobileofferimg {
            height: 130px !important;
         }

         .touersoffer .row {
            display: flex !important;
            flex-wrap: nowrap !important;
            overflow: auto !important;
         }

         .touersoffer {
            box-shadow: none !important;
            padding-left: 0px !important;
         }

         .offerheading h3 {
            margin-left: 0px !important;
         }

         .offerbardealsfeature {
            box-shadow: none !important;
            padding: 0px !important;
         }

         .offerbardealsfeature .row {
            display: grid !important;
            grid-template-columns: 50% 50% !important;
            padding-right: 11px !important;
         }

         .offerbardealsfeature tr td {
            display: block !important;
            text-align: center !important;
         }

         .offerbardealsfeature .col-lg-3 {
            padding-right: 0px !important;
         }

         .blugbg {
            border: solid 1px #0089c34f !important;
            background: #95d5f057 !important;
         }

         .essent img {
            margin-right: 6px !important;
         }

         .offerbardealsfeature p {
            font-size: 18px !important;
         }

         .mobilemainmenuboxss a{border-bottom: 1px solid #b5daeb !important;}
         .mobilemainmenuboxss{background-color: #ddf4ff !important; transition: left 0.5s ease !important;}


      }
   </style>

   <?php echo $cms['headerScript']; ?>

</head>

<body>

   <?php include "header.php"; ?>

   <div class="container topcarmenu">
      <div class="d-flex justify-content-center gap-3">
         <div class="option-card">
           <a href="flightpage.php"> <img src="images/pl.png" alt="" style="width: 30px;">
            <h6>Flights</h6></a>
         </div>
         <div class="option-card">
          <a href="https://chalofly.com/holidays">   <img src="images/hld3.png" alt="" style="width: 30px;">
            <h6>Holidays</h6></a>
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