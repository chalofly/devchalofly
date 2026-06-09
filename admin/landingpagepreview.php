<?php
include "config/database.php"; 
include "config/function.php"; 
include "config/setting.php"; 
$startDate=date('d-m-Y',strtotime('+2 Days'));
$endDate=date('d-m-Y',strtotime('+4 Days'));
 
$rs=GetPageRecord('*','landingPages','status=1 and pageURL="'.$_REQUEST['id'].'"'); 
$landingpageres=mysqli_fetch_array($rs);

 
$a=GetPageRecord('*','sys_userMaster','id=1'); 
$companydata=mysqli_fetch_array($a);

if($landingpageres['id']==''){
echo 'You dont have permission to access this page!';
exit();
}

$destinationName='';

$data=array($landingpageres["packages"]);

$packages=GetPageRecord('*','sys_packageBuilder','id="'.$data[0].'"'); 
$packagesData=mysqli_fetch_array($packages);
$destinationName=$packagesData["destinations"];


function cleanstring($string) {

   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
      $string = str_replace('----', '-', $string); // Replaces all spaces with hyphens.
   $string = str_replace('---', '-', $string); // Replaces all spaces with hyphens.
   $string = str_replace('--', '-', $string); // Replaces all spaces with hyphens.
   $string = str_replace('-', '-', $string); // Replaces all spaces with hyphens.

   return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $string)); // Removes special chars.
}

?>

<!DOCTYPE html>
<html lang="en">

 
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo !empty($landingpageres['metaTitle']) ? stripslashes($landingpageres['metaTitle']) : "Holiday Packages-Chalofly"; ?></title>
  <meta name="description" content="<?php echo stripslashes($landingpageres['metaDescription']); ?>">
<meta name="keywords" content="<?php echo stripslashes($landingpageres['metaKeyword']); ?>">
<link rel="shortcut icon" href="<?php echo "https://$_SERVER[HTTP_HOST]/"; ?>favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="<?php echo $landingpagedatas; ?>assets/styles/css/slick.css">
  <link rel="stylesheet" href="<?php echo $landingpagedatas; ?>assets/styles/css/slick-theme.css">
  <link rel="stylesheet" href="<?php echo $landingpagedatas; ?>assets/styles/css/jquery.datepicker2.css">
  <link rel="stylesheet" href="<?php echo $landingpagedatas; ?>assets/styles/css/animate.css">

  <link rel="stylesheet" href="<?php echo $landingpagedatas; ?>assets/styles/style.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> 

  <style>
.bannerheadingouter{ width:100%; text-align:left; overflow:hidden; position:absolute; left:0px; top:10%;}
.bannerheadingouter .headingleftin{max-width:1156px; margin:auto;}
.bannerheadingouter .headingleft{width:50%; float:left;}
.bannerheadingouter .headingleft h1{font-size: 30px; color: #fff; background-color: #00000091; padding: 10px 20px; line-height: 50px; width: fit-content; border-radius: 4px; margin-top:80px;}
.bannerheadingouter .headingleft .content{font-size:20px; color: #fff; background-color: #00000091; padding: 10px 20px; line-height: 30px; width: fit-content; border-radius: 4px;}
.bannerheadingouter .headingright{width:50%; float:left;}
.bannerheadingouter .headingright .formbox{width:80%; float:right; padding:20px 30px; background-color:#FFFFFF; border-radius: 10px;}
.bannerheadingouter .headingright .formbox .heading{font-size:22px; font-weight:500; margin-bottom:0px;}
.bannerheadingouter .headingright .formbox .subheading{font-size:16px; font-weight:500; margin-bottom:10px;}
.bannerheadingouter .headingright .formbox .field{margin-bottom:10px;}
.somedia .fa{font-size: 40px; margin-right: 10px; margin-top: 20px;}

@media only screen and (max-width: 800px) {
.headingleft{width:100% !important;}
.headingright{width:100% !important;}
.filterable-tour {   margin-top: 400px; }
.bannerheadingouter .headingright .formbox{width:100%;}
.bannerheadingouter .headingleft h1 { font-size: 30px; color: #fff; background-color: #00000091; padding: 10px 20px; line-height: 50px; width: fit-content; border-radius: 4px; margin-top: 0px; text-align: center; font-size: 15px; width: 100%; line-height: 25px; margin-bottom: -1px;}
.bannerheadingouter .headingleft .content { font-size: 20px; color: #fff; background-color: #00000091; padding: 10px 20px; line-height: 30px; width: fit-content; border-radius: 4px; width: 100%; text-align: center; font-size: 15px; padding: 10px; line-height: 21px; }
.filterable-tour .trending-tour-item{width:100%;}
.bannerheadingouter .headingleft h1{font-size: 14px;padding: 7px 20px;}
.heading h5{font-size: 13px; margin-bottom: 5px;}
.bannerheadingouter .headingright .formbox .subheading{font-size: 13px; margin-bottom: 5px;}
#addeditfrm input{ padding: 5px 10px; font-size: 12px;}
#addeditfrm select{padding: 7px 10px !important;font-size: 12px;}
.form__item--submit input{ height: 35px;}
.bannerheadingouter .headingright .formbox{ padding: 10px 20px;}
.bannerheadingouter{position: inherit;width: 90%; margin: auto; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; margin-top: 10px;}
.slider-banner-3__item > img{ max-height: 220px !important;}
.filterable-tour { margin-top: 30px; }
.contact-infomation{ padding-top: 10px;}
#filterable-posts{ min-height: auto;}
.contact-infomation h5{font-size: 20px;margin-bottom: 10px;}
.contact-infomation__item{ margin-top: 10px; margin-bottom: 10px;}
.contact-infomation__info__address-item img{ height: 20px;}
.contact-infomation__info__address-item span{font-size: 13px;}
.somedia .fa{ margin-top: 15px;font-size: 30px;}
.contact-infomation__info p{ margin-bottom: 10px;}
.contact-infomation__working-time{ margin-top: 20px;}
.copyright-style3 .copyright__area{height:auto;}
.contact-infomation__working-time p{font-size: 15px;}
.filterable-tour__tittle{margin-top: 10px !important; margin-bottom: 10px !important;}
.pstyel{margin-bottom: 20px !important; font-size: 13px;}
.section-tittle p{ font-size: 17px;  margin-bottom: 10px !important;}
.filterable-tour{ margin-top: 10px;}
.section-tittle h2{font-size: 24px;}
}
#sendOtpBtn {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: #fff;
    text-align: center;
    border-radius: 5px;
    padding: 5px;
    margin: 5px;
    float:right;
}
#verifySection {
    background-color: #198754;
    border-color: #198754;
    color: #fff;
    text-align: center;
    border-radius: 5px;
    padding: 5px;
    margin: 5px;
}
  </style>
  
  
<?php echo stripslashes($landingpageres['headerScript']); ?>

</head>
<body>


<header id="header-2">
    <div class="wand-container">
        <div class="header-content2">
            <div class="header-content2__logo">
                <a class="header-content2__logo__sitename" href="<?php echo $landingpage; ?><?php echo stripslashes($landingpageres['pageURL']); ?>"><img src="<?php echo $fullurl; ?>profilepic/<?php echo stripslashes($companydata['invoiceLogo']); ?>" alt="<?php echo stripslashes($companydata['invoiceCompany']); ?>" style="max-height:105px;"></a>
            </div>
            
            <nav class="header-2-nav">
                <ul>
                    <li>
                        <a href="#" >Home </a> 
                    </li>
					<li>
                        <a href="#tourpackagesid"  >Tours Packages </a> 
                    </li>
					<li>
                        <a href="#contactUs" >Contact Us </a> 
                    </li>
                      
                </ul>
            </nav> 

            <a href="tel:<?php echo stripslashes($landingpageres['contactNumber']); ?>" class="header-content2__call">
                <img src="<?php echo $landingpagedatas; ?>assets/images/call.png" alt="call">
                <div class="header-content2__call__phone-number">
                    <p>Call Us Today!</p>
                    <span><?php echo stripslashes($landingpageres['contactNumber']); ?></span>
                </div>
            </a>
            <div class="search-area">
    <div class="search-area__close"></div>
    <form action="#">
        <input class="search-area__input" placeholder="Search..." type="text">
        <button class="search-area__submit" type="submit"><span>Hit Enter to search or Esc key to close</span></button>
    </form>
</div>
            <nav class="header-nav-mobile">
    <ul>
           <li>
                        <a href="#" >HOME </a> 
                    </li>
					<li>
                        <a href="#tourpackagesid"  >Tours Packages </a> 
                    </li>
					<li>
                        <a href="#contactUs" >Contact Us </a> 
                    </li>
                      
    </ul>
</nav> 

            <div class="header-content2__hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div> 
    </div>
</header>
 

<section>
    <div class="slider-banner-3">
        <div class="slider-banner-3__item">
            <img src="<?php echo $fullurl; ?>package_image/<?php echo $landingpageres['banner']; ?>" alt="banner" style="max-height:623px;width: 100%; height: 623px; object-fit: cover;">
			
			<div class="bannerheadingouter">
			<div class="headingleftin">
			<div class="headingleft"><h1><?php echo stripslashes(ucwords($landingpageres['bannerHeading'])); ?></h1><div class="content" style="display:none;"><?php echo stripslashes($landingpageres['bannerSubHeading']); ?></div></div>
			
			
			<div class="headingright">
			<div class="formbox">
			<div class="heading"><h5><?php echo stripslashes($landingpageres['enquiryHeading']); ?></h5></div>
			<div class="subheading"><?php echo stripslashes($landingpageres['enquirySubHeading']); ?></div>
			
			<form action="<?php echo $fullurl; ?>landingpageaction.php" method="post" enctype="multipart/form-data" name="addeditfrm"   id="addeditfrm">

			<input type="hidden" name="destination" value="<?php echo $destinationName; ?>">
			
			<input value="" name="clientName" id="clientName" type="text" placeholder="Name" maxlength="50" class="field">
			<input value="" name="mobileNumber" id="mobileNumber" type="text" maxlength="13" placeholder="Mobile Number" class="field">
			<input value="" name="clientEmail" id="clientEmail" type="email" placeholder="Email" maxlength="100" class="field">
			
			<table style="width: 100%; margin-bottom:0px;">
			<tr style="border-bottom: none;">
			<td><input value="" name="adult" id="adult" type="number" maxlength="13" placeholder="No. of Adult" class="field"></td>
			<td><input value="" name="child" id="child" type="number" maxlength="13" placeholder="No. of Child" class="field"></td>
			</tr>
			
			<tr style="border-bottom: none;">
			<td><input name="startDate" id="startDatestart" type="text" maxlength="13" value="<?php if($startDate!='1970-01-01' && $startDate!='01-01-1970'){ echo $startDate; } ?>" placeholder="From Date" class="field"></td>
			<td><input name="endDate" id="endDateend" type="text" maxlength="13" value="<?php if($endDate!='1970-01-01' && $endDate!='01-01-1970'){ echo $endDate; } ?>" placeholder="To Date" class="field"></td>
			</tr>
			
			<tr>
                <td colspan="2">
			 <select name="enquiryFor" id="enquiryFor" class="field" style="padding: 12px; width: 100%; border: 1px solid #ddd; border-radius: 3px;">
			 	   <option value="0">Select Package From Below List</option>
			 <?php 

$string = $landingpageres['packages'];
$string = preg_replace('/\.$/', '', $string); //Remove dot at end if exists
$array = explode(',', $string); //split string into array seperated by ', '
foreach($array as $value) //loop over values
{
$rs=GetPageRecord('*','sys_packageBuilder',' id="'.$value.'"  order by id desc');
while($rest=mysqli_fetch_array($rs)){ 

?>
			   <option value="<?php echo stripslashes($rest['name']); ?>" data-id="<?php echo encode($rest['id']);?>"><?php echo stripslashes($rest['name']); ?> (<?php echo $rest['days']; ?> Days - <?php echo ($rest['days']-1); ?> Nights)</option>
			   <?php } } ?>
			   
			 </select>
            </td>
            </tr>
            <tr>
                <td id="otpSection" >
                    <input type="text" name="email_otp"  id="email_otp" class="form-control" placeholder="Enter OTP"  style="display:none;text-align:center;">
                    
                </td>
                <td>
                                 <button type="button" style="display:none;" id="verifySection" class="btn btn-success btn-otp w-100" onclick="verifyEmailOTP()"> Verify OTP </button>
                               <button type="button" class="btn btn-primary btn-otp w-100" id="sendOtpBtn" onclick="sendEmailOTP()"> Send OTP</button>
                </td>
            </tr>
            <tr>
                <td colspan="2">             
                              
                              <div >
                                 <div id="otpSuccess" style="display:none;color:green;font-weight:600;font-size:14px;">
                                       ✓ Email Verified Successfully
                                 </div>
                              </div>

                              <input type="hidden" id="otp_verified"  name="email_verified"  value="0">
                </td>
            </tr>
            </table>                  
			<div class="form__item form__item--submit" style="width: 100%;">
                <input type="submit" value="Submit">
                <input name="action" type="hidden" id="action" value="submitquery">
                <input name="packageId" type="hidden" id="packageId" value="<?php echo stripslashes($rest['id']); ?>">
			</div>
			</form>
			<div style="padding:20px; text-align:center; display:none;" id="thanksmsg">
			<div style="text-align:center; font-size:30px;">Thank You</div>
			<div style="text-align:center; font-size:18px;">Your enquiry has been submitted successfully.</div>
			</div>
			</div>
			</div>
			</div>
			
			
			</div>
             
        </div>
    </div>
      
</section>


<section class="filterable-tour" id="tourpackagesid">
    <div class="container">
        <div class="filterable-tour__tittle" style=" margin-top: 40px;margin-bottom: 30px; ">
            
            
            
            <div class="section-tittle">
    <h2><?php echo stripslashes(ucwords($landingpageres['mainHeading'])); ?></h2>
    <div class="section-tittle__line-under"></div>
    <p><?php echo stripslashes(ucwords($landingpageres['mainHeading'])); ?></p>
</div>
        </div>
        <p class="pstyel" style="margin-bottom:40px; border-bottom:1px solid #ddd; padding:10px; display:block; text-align:center;"><?php echo stripslashes(ucwords(nl2br($landingpageres['description']))); ?></p>
		
        <div id="filterable-posts" class="row">
		
		
		<?php 

$string = $landingpageres['packages'];
$string = preg_replace('/\.$/', '', $string); //Remove dot at end if exists
$array = explode(',', $string); //split string into array seperated by ', '
foreach($array as $value) //loop over values
{
$rs=GetPageRecord('*','sys_packageBuilder',' id="'.$value.'"  order by id desc');
while($rest=mysqli_fetch_array($rs)){ 
 
?>
            <div class="col-lg-4 col-md-6 col-xl-4 col-sm-6 col-12 greek">
                <a href="<?php echo $fullurlproposal; ?>sharepackage/<?php echo encode($rest['id']); ?>/<?php echo cleanstring(stripslashes($rest['name'])); ?>.html" class="trending-tour-item " target="_blank" style="    margin-bottom: 0px;"> 
                    <img class="trending-tour-item__thumnail" src="<?php echo $fullurl; ?>package_image/<?php echo $rest['coverPhoto']; ?>" alt="<?php echo stripslashes($rest['name']); ?>">
                    <div class="trending-tour-item__info">
                        <h3 class="trending-tour-item__name">
                            <?php echo stripslashes($rest['name']); ?>
                        </h3>
                        <div class="trending-tour-item__group-infor">
                            <div class="trending-tour-item__group-infor--left"> 
                                <div class="trending-tour-item__group-infor__lasting"><?php echo $rest['days']; ?> Days / <?php echo ($rest['days']-1); ?> Nights</div>
                            </div> 
                            <span class="trending-tour-item__group-infor__price" style="top: 50px; color: #000; background-color: #fffbbf; padding: 0px 8px; border-radius: 4px;">&#8377;<?php echo number_format($rest['grossPrice']); ?></span>
            
                        </div>
                    </div>
					
					
                </a><div class="form__item--submit" style="width: 100%;margin-top: -9px;">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr style="    border: 0px;">
    <!--<td width="50%"><a href="<?php echo $fullurlproposal; ?>sharepackage/<?php echo encode($rest['id']); ?>/<?php echo cleanstring(stripslashes($rest['name'])); ?>.html" target="_blank" style="margin-bottom:20px;"><input type="submit" value="Preview" style="padding: 10px;"></a></td>-->
	<td colspan="2"><a  href="<?php echo $fullurlproposal; ?>sharepackage/<?php echo encode($rest['id']); ?>/<?php echo cleanstring(stripslashes($rest['name'])); ?>.html"  style="margin-bottom:20px; cursor:pointer;"><input type="submit" value="Preview" style="padding: 10px; background-color:#ffc60;"></a></td>
	<td colspan="2"><a   style="margin-bottom:20px; cursor:pointer;" onClick="$('#packageId').val('<?php echo encode($rest['id']); ?>');$('#clientName').focus();$('#enquiryFor').val('<?php echo stripslashes($rest['name']); ?> (<?php echo $rest['days']; ?> Days - <?php echo ($rest['days']-1); ?> Nights)');"><input type="submit" value="Enquiry" style="padding: 10px; background-color:#3fced3;"></a></td>
    
  </tr>
</table>

            </div>
            </div>
			
			<?php $totalno++; } } ?>
           
        </div>
    </div>
</section>

<section class="contact-infomation" style=" background-color:#f7f7f7;padding-bottom: 0px;" id="contactUs"> 
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                 <img src="<?php echo $fullurl; ?>images/Untitled design (6).png" style="width:100%;">
            </div>
            <div class="col-lg-7 col-md-6">
                <div class="contact-infomation__item contact-infomation__item--padding">
                    <div class=" contact-infomation__info">
                        <h5>Contact Information</h5> 
                        <div class="contact-infomation__info__address">
                            <div class="contact-infomation__info__address-item">
                                <img src="<?php echo $landingpagedatas; ?>assets/images/addresst.png" alt="contact-addresst" style="height: 25px;">
                                <span><?php echo stripslashes($landingpageres['address']); ?></span>
                            </div>
                            <div class="contact-infomation__info__address-item">
                                <img src="<?php echo $landingpagedatas; ?>assets/images/mail.png" alt="contact-mail" style="height: 25px;">
                                <span><?php echo stripslashes($landingpageres['emailId']); ?></span>
                            </div>
                            <div class="contact-infomation__info__address-item">
                                <img src="<?php echo $landingpagedatas; ?>assets/images/phone.png" alt="contact-phone" style="height: 25px;">
                                <span><?php echo stripslashes($landingpageres['contactNumber']); ?></span>
                            </div>
                        </div><p class="somedia">
 <?php if($landingpageres['facebook']!=''){ ?><a href="<?php echo $landingpageres['facebook']; ?>" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a><?php } ?>
 <?php if($landingpageres['instagram']!=''){ ?><a href="<?php echo $landingpageres['instagram']; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a><?php } ?>
<?php if($landingpageres['twitter']!=''){ ?><a href="<?php echo $landingpageres['twitter']; ?>" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a><?php } ?>
<?php if($landingpageres['youtube']!=''){ ?><a href="<?php echo $landingpageres['youtube']; ?>" target="_blank"><i class="fa fa-youtube-square" aria-hidden="true"></i></a><?php } ?>
<?php if($landingpageres['pinterest']!=''){ ?><a href="<?php echo $landingpageres['pinterest']; ?>" target="_blank"><i class="fa fa-pinterest-square" aria-hidden="true"></i></a><?php } ?>
						
						</p>
                    </div>
                    <div class="contact-infomation__working-time">
                        <h5>Working Hours</h5>
                        <p>We are always here for you 24x7 Support</p>
                        
                    </div>
                </div>
            </div>
        </div>

         
    </div>


</section>

<script src="<?php echo $landingpagedatas; ?>assets/scripts/jquery-3.4.1.js"> </script>
<!--
<script src="<?php echo $landingpagedatas; ?>assets/scripts/countdownsale.js"></script>
-->

<!-- Choose tuor destination index 4 -->

 
<footer>
    <div class="scroll-top">
    <i class="fas fa-angle-up"></i>
</div>
     
    <div class="copyright-style3">
        <div class="container">
            <div class="copyright__area">
                <div class="copyright__license">
                    Copyright <i class="far fa-copyright"></i> <?php echo date('Y'); ?> <?php echo stripslashes($companydata['invoiceCompany']); ?>. All Rights Reserved.
                </div>
                 
            </div>
			 
        </div>
		
		
		
    </div>
	
	
	
</footer>

<script src="<?php echo $landingpagedatas; ?>assets/scripts/jquery-3.4.1.js"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script src="<?php echo $landingpagedatas; ?>assets/scripts/slick.min.js"></script>
<script src="<?php echo $landingpagedatas; ?>assets/scripts/isotope.pkgd.min.js"></script> 
<script src="<?php echo $landingpagedatas; ?>assets/scripts/app.js"></script>
	<script>
  

$(document).ready(function(){
    $('#enquiryFor').on("change",function(){
         var selectedOption = $(this).find(':selected');
         $('#packageId').val(selectedOption.data('id'));
    })
    
  $("#startDatestart").datepicker({
        numberOfMonths: 2,
        dateFormat: 'dd-mm-yy',
        minDate: 0,
        onSelect: function (selectedDate) {

            let date = $(this).datepicker('getDate');

            if (date) {
                $("#endDateend").datepicker("option", "minDate", date);
            }
        }
    });

    $("#endDateend").datepicker({
        numberOfMonths: 2,
        dateFormat: 'dd-mm-yy',
        minDate: 0,
        onSelect: function (selectedDate) {

            let date = $(this).datepicker('getDate');

            if (date) {
                $("#startDatestart").datepicker("option", "maxDate", date);
            }
        }
    });


    $("#addeditfrm").submit(function (e) {

        let clientName   = $("#clientName").val().trim();
        let mobileNumber = $("#mobileNumber").val().trim();
        let clientEmail  = $("#clientEmail").val().trim();
        let adult        = $("#adult").val().trim();
        let child        = $("#child").val().trim();
        let enquiryFor   = $("#enquiryFor").val();
        let startDate    = $("#startDatestart").val();
        let endDate      = $("#endDateend").val();
        let otpVerified = document.getElementById("otp_verified").value;
        // Name
        if (clientName == "") {
            alert("Please enter your name");
            $("#clientName").focus();
            e.preventDefault();
            return false;
        }

        // Mobile
        let mobilePattern = /^[0-9]{10,13}$/;

        if (mobileNumber == "") {
            alert("Please enter mobile number");
            $("#mobileNumber").focus();
            e.preventDefault();
            return false;
        }

        if (!mobilePattern.test(mobileNumber)) {
            alert("Please enter valid mobile number");
            $("#mobileNumber").focus();
            e.preventDefault();
            return false;
        }

        // Email
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (clientEmail == "") {
            alert("Please enter email");
            $("#clientEmail").focus();
            e.preventDefault();
            return false;
        }

        if (!emailPattern.test(clientEmail)) {
            alert("Please enter valid email");
            $("#clientEmail").focus();
            e.preventDefault();
            return false;
        }

        // Adult
        if (adult == "" || adult <= 0) {
            alert("Please enter number of adults");
            $("#adult").focus();
            e.preventDefault();
            return false;
        }

        // Package
        if (enquiryFor == "0") {
            alert("Please select package");
            $("#enquiryFor").focus();
            e.preventDefault();
            return false;
        }

        // Dates
        if (startDate == "") {
            alert("Please select start date");
            $("#startDatestart").focus();
            e.preventDefault();
            return false;
        }

        if (endDate == "") {
            alert("Please select end date");
            $("#endDateend").focus();
            e.preventDefault();
            return false;
        }

        if (endDate < startDate) {
            alert("End date should be greater than start date");
            $("#endDateend").focus();
            e.preventDefault();
            return false;
        }
        if(otpVerified != "1"){

            alert("Please verify OTP first");
            e.preventDefault();
            return false;
        }

    });

 
});

//   $( function() {
//     $( "#startDatestart" ).datepicker({ 
// 	  dateFormat: 'dd-mm-yy' 
//       });
	  
// 	  $( "#endDateend" ).datepicker({ 
// 	  dateFormat: 'dd-mm-yy' 
//       });
//   } );
 function sendEmailOTP(){

    let email =
    document.getElementById("clientEmail")
    .value.trim();

    let emailPattern =
    /^[^\s@]+@[^\s@]+\.[^\s@]+$/;



    if(!emailPattern.test(email)){

        alert("Enter valid email");

        return;
    }



    // Button loading state
    document.getElementById(
        "sendOtpBtn"
    ).innerHTML = "Sending...";



    fetch("<?php echo "https://$_SERVER[HTTP_HOST]/"; ?>send-otp.php", {

        method: "POST",

        headers: {
            "Content-Type":
            "application/x-www-form-urlencoded"
        },

        body:
        "email="+encodeURIComponent(email)

    })

    .then(res => res.json())

    .then(data => {

        document.getElementById(
            "sendOtpBtn"
        ).innerHTML = "Resend OTP";



        if(data.status){

            // Show OTP fields
            document.getElementById(
                "otpSection"
            ).style.display = "block";



            document.getElementById(
                "verifySection"
            ).style.display = "block";

            document.getElementById(
                "email_otp"
            ).style.display = "block";

            alert("OTP sent to your email");

        } else {

            alert(data.message);
        }

    });

}



function verifyEmailOTP(){

    let otp =
    document.getElementById(
        "email_otp"
    ).value.trim();



    let email =
    document.getElementById(
        "clientEmail"
    ).value.trim();



    if(otp.length != 6){

        alert("Enter valid OTP");

        return;
    }



    fetch("<?php echo "https://$_SERVER[HTTP_HOST]/"; ?>verify-otp.php", {

        method: "POST",

        headers: {
            "Content-Type":
            "application/x-www-form-urlencoded"
        },

        body:
        "otp="+encodeURIComponent(otp)+
        "&email="+encodeURIComponent(email)

    })

    .then(res => res.json())

    .then(data => {

        if(data.status){

            document.getElementById(
                "otp_verified"
            ).value = "1";



            document.getElementById(
                "otpSuccess"
            ).style.display = "block";



            // Disable fields after verification
            document.getElementById(
                "clientEmail"
            ).readOnly = true;



            document.getElementById(
                "email_otp"
            ).readOnly = true;

            document.getElementById(
                  "submitBtn"
               ).disabled = false;

            alert("Email verified");

        } else {

            alert(data.message);
        }

    });

}
</script>



<?php echo stripslashes($landingpageres['footerScript']); ?>

<iframe style="display:none;" id="actoinfrm" name="actoinfrm"></iframe>
</body>

<style>
.float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#25d366;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  font-size:30px;
	box-shadow: 2px 2px 3px #999;
  z-index:100;
}

.my-float{
	margin-top:16px;
}
</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send?phone=919900084614&text=Hello!!" class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>


 
</html>