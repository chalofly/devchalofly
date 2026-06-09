<?php 
   include "inc.php"; 
   include "config/logincheck.php"; 
   $page='holidays';
   $selectedpage='holidays';
    
   function cleanstring($string) {
      $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   
      return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
   }
   
   function isMobile() {
       return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
   }
   
   
   		 $where='';
   		 if($_REQUEST['holidaysdestination']!=0){
   		 $where=' and destination="'.$_REQUEST['holidaysdestination'].'" ';
   		 
   		 }
		 
		 
$cc = GetPageRecord('*', 'cmsPages', ' pageType="Services"  and url="package" and status=1');
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
      <link rel="stylesheet" type="text/css" href="slick/slick.css">
      <link rel="stylesheet" type="text/css" href="slick/slick-theme.css">
      <script src="slick/slick.js" type="text/javascript" charset="utf-8"></script>
      <style>
         .holicontainer, .travelcontainer, .lastcon { padding: 0px 60px; }
         @media (max-width: 575.98px) {
         .holidaybanner{height: 180px !important;}
         .holidabancontainer{top: 70px !important;}
         .holidaysearch table{width: 85% !important;margin: auto !important;}
         .holidaysearch .textfield{font-size: 13px !important;}
         .holidaysearch .redbuttonsearch{font-size: 13px !important;}
         .lastcon{margin-top: 0px !important;}
         .holidestibox .fa-calendar:before{top: 0px !important;right: 5px !important;font-size: 13px !important;}
         }

         .flightdetailrightfilter{background-color: #fff; padding: 10px 10px; border: 1px solid #d2d2d2; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;}


      </style>
	  
	  <?php echo $cms['headerScript']; ?>
   </head>
   <body class="greybluebg">
      <?php include "header.php"; ?>

      <section style="    margin-top: 120px;">
         <div class="container">
            <div class="row">
               <div class="col-lg-3">
                  <div class="flightdetailrightfilter">
                     <div class="filtertopcontent">
                        <h2>Filters</h2>
                        <p>Showing 31 Flights</p>
                     </div>
                      <div class="departurecontent">
                        <a href="#">12AM-06AM</a>
                      </div>

                  </div>
               </div>
            </div>
         </div>
      </section>
  
	  
     
	  <?php echo $cms['bodyScript']; ?>
	    <?php echo $cms['footerScript']; ?>
      <?php include "footer.php"; ?>
	  
	  
   </body>
   
</html>