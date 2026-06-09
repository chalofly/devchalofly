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



if (isset($_REQUEST['tripType']) && $_REQUEST['tripType'] != '') {

   $tripType = $_REQUEST['tripType'];
}



$fixedDeparture = 0;

if (isset($_REQUEST['fixedDeparture']) && $_REQUEST['fixedDeparture'] != '') {

   $fixedDeparture = $_REQUEST['fixedDeparture'];
}



$PC = 'EC';

if (isset($_REQUEST['PC']) && $_REQUEST['PC'] != '') {

   $PC = $_REQUEST['PC'];
}



$travellers = '1 Pax, Economy';

if (isset($_REQUEST['travellers']) && $_REQUEST['travellers'] != '') {

   $travellers = $_REQUEST['travellers'];
} 



$fromcitydesti = 'DEL - NEW DELHI';

if (isset($_REQUEST['fromcitydesti']) && $_REQUEST['fromcitydesti'] != '') {

   $fromcitydesti = $_REQUEST['fromcitydesti'];
}



$fromDestinationFlight = 'DEL-India';

if (isset($_REQUEST['fromDestinationFlight']) && $_REQUEST['fromDestinationFlight'] != '') {

   $fromDestinationFlight = $_REQUEST['fromDestinationFlight'];
}



$tocitydesti = 'BOM - MUMBAI';

if (isset($_REQUEST['tocitydesti']) && $_REQUEST['tocitydesti'] != '') {

   $tocitydesti = $_REQUEST['tocitydesti'];
}



$toDestinationFlight = 'BOM-India';

if (isset($_REQUEST['toDestinationFlight']) && $_REQUEST['toDestinationFlight'] != '') {

   $toDestinationFlight = $_REQUEST['toDestinationFlight'];
}





$journeyDateOne = date('d-m-Y');

if (isset($_REQUEST['journeyDateOne']) && $_REQUEST['journeyDateOne'] != '') {

   $journeyDateOne = $_REQUEST['journeyDateOne'];
}







$journeyDateRound = date('d-m-Y', strtotime('+1 days'));

if (isset($_REQUEST['journeyDateRound']) && $_REQUEST['journeyDateRound'] != '') {

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
   

   <link rel="stylesheet" href="css/fightpage_style.css">

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

               <div class="hero-section">
    <div class="hero-overlay"></div>

    <div class="container hero-content">

        <div class="row align-items-center">

            <div class="col-lg-6">
                <h1 style="font-size:55px;color:#fff;font-weight:800;line-height:1.2;">
                    Holiday Means Travel,<br>
                    Travel Means <span style="color:#ffb100;">ChaloFly</span>
                </h1>

                <p style="color:#fff;font-size:18px;margin-top:20px;">
                    Book flights, hotels and holiday packages at best prices.
                </p>
            </div>

            <div class="col-lg-6">
                <img src="images/plane.png" class="img-fluid">
            </div>

        </div>

        <div class="main-search-box">

            <div class="search-tabs">
                <button class="active">One Way</button>
                <button>Round Trip</button>
                <button>Multi City</button>
            </div>

            <form method="GET" action="<?php echo $fullurl; ?>flight-search">

                <div class="flight-row">

                    <div class="flight-field">
                        <label>FROM</label>
                        <input type="text"
                               name="fromcitydesti"
                               value="DEL - New Delhi">
                    </div>

                    <div class="flight-field">
                        <label>TO</label>
                        <input type="text"
                               name="tocitydesti"
                               value="CCU - Kolkata">
                    </div>

                    <div class="flight-field">
                        <label>DEPARTURE</label>
                        <input type="text"
                               id="dt1"
                               name="journeyDateOne"
                               value="<?php echo date('d M Y'); ?>">
                    </div>

                    <div class="flight-field">
                        <label>TRAVELLERS</label>
                        <input type="text"
                               value="1 Pax, Economy"
                               readonly>
                    </div>

                    <div class="flight-field">
                        <button class="search-btn">
                            Search Flights
                        </button>
                    </div>

                </div>

            </form>

        </div>

    </div>
</div>
<div class="offer-section">
    <div class="container">

        <h2 class="section-title">
            Exclusive Booking Deals
        </h2>

        <div class="row">

            <div class="col-lg-4 mb-4">
                <div class="offer-card">
                    <img src="images/ayodhya.jpg">

                    <div class="offer-card-content">
                        <h4>Fly to Ayodhya</h4>

                        <p>
                            Journey to the land of Shri Ram with ChaloFly.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="offer-card">
                    <img src="images/goa.jpg">

                    <div class="offer-card-content">
                        <h4>Goa Special</h4>

                        <p>
                            Beach holidays with best prices and luxury stays.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="offer-card">
                    <img src="images/kashi.jpg">

                    <div class="offer-card-content">
                        <h4>Kashi Tour</h4>

                        <p>
                            Temple treasures and spiritual journeys.
                        </p>
                    </div>
                </div>
            </div>

        </div>

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