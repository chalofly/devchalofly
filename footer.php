

<footer class="flightfooter modernFooter">

    <div class="container">

	<div class="row" style="text-align:left;">



<div class="col-lg-8 footernav">

 <div class="row">

 



 

<div class="col-lg-3">

<div style="margin-bottom: 10px; font-weight: 700; font-size: 12px; padding: 10px 0px 0px; text-transform: uppercase;">Bookings</div>



 <a href="<?php echo $fullurl; ?>flights"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Flights</a>

 <a href="<?php echo $fullurl; ?>domestic-holidays"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Holidays</a>

 <?php if(!empty($_SESSION['websiteUserId']) && $_SESSION['websiteUserId']==''){ ?>

 <a href="#"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> My Profile</a>

 <a href="#"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> My Bookings</a> 

 <?php } else { ?>

 

  <a href="my-profile"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> My Profile</a>

 <a href="flight-bookings"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> My Bookings</a>

 

 <?php } ?>



</div>



<div class="col-lg-4">

<div style="margin-bottom: 10px; font-weight: 700; font-size: 12px; padding: 10px 0px 0px; text-transform: uppercase;">Site Map</div>

	

  <a href="<?php echo $fullurl; ?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Home</a>

                           <a href="<?php echo $fullurl; ?>about-us"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> About</a>

              <a href="<?php echo $fullurl; ?>terms-conditions"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Terms & conditions</a>

			  <a href="<?php echo $fullurl; ?>refund-cancellation-policy"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Refund & Cancellation Policy</a>

              <a href="<?php echo $fullurl; ?>privacy-policy"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Privacy Policy</a>

              <a href="<?php echo $fullurl; ?>blog"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Blog</a>

              <a href="<?php echo $fullurl; ?>contact-us"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Contact</a>

</div>

 <div class="col-lg-4" style="    border-right: 1px solid #dddddd1f;">

<div style="margin-bottom: 10px; font-weight: 700; font-size: 12px; padding: 10px 0px 0px; text-transform: uppercase;">Contact Us</div>

<strong>Address: </strong><?php echo $websitesetting['contactAddress']; ?><br />



<strong>Call Us: </strong><?php echo $websitesetting['contactPhone']; ?><br />



<strong>Email: </strong><?php echo $websitesetting['contactEmail']; ?><br/><br />



</div>

</div>

</div>



<div class="col-lg-4 footernav">

 <div class="row">

 



 

<div class="col-lg-12">

<div style="margin-bottom: 10px; font-weight: 700; font-size: 12px; padding: 10px 0px 0px; text-transform: uppercase;">PAYMENT MODE</div>

 <img src="<?php echo $fullurl; ?>images/paymentoptionfooter.png" style="height: 80px;" />



<div style="margin-bottom: 10px; font-weight: 700; font-size: 12px; padding: 10px 0px 0px; text-transform: uppercase; margin-top:10px;">FOLLOW US ON</div>

<div class="footericonsouter">



<?php if($websitesetting['facebookURL']!='https://www.facebook.com/people/Chalofly/61574284234080/'){ ?>

 <a href="<?php echo $websitesetting['facebookURL']; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>  

 <?php } ?>

 <?php if($websitesetting['twitterURL']!=''){ ?>

 <a href="<?php echo $websitesetting['twitterURL']; ?>" target="_blank"><img src="images/xo.png" /></a>  

 <?php } ?>

 

  <?php if($websitesetting['instagramURL']!=''){ ?>

 <a href="<?php echo $websitesetting['instagramURL']; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>  

 <?php } ?>

    <?php if($websitesetting['linkedin']!=''){ ?>

 <a href="<?php echo $websitesetting['linkedin']; ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>  

 <?php } ?>

 

 

     <?php if($websitesetting['youtubeURL']!=''){ ?>

 <a href="<?php echo $websitesetting['youtubeURL']; ?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>  

 <?php } ?>

</div>

</div>


</div>

</div>



</div>



<div class="copyrighttext">

 

        <p><?php echo $footerversion; ?></p>

 

    </div>

</div>

	 

    

</footer>





<div style="position:fixed; left:0px; top:0px; width:100%; height:100%; z-index:99999; background-color:#000000c9; text-align:center; padding-top:10%; display:none;" id="clientloginbox">

<table width="200" border="0" cellpadding="0" cellspacing="0" style="margin:auto; position:relative;" class="clientlogintable">

  <tr>

  

    <td colspan="2" class="firstchildlogin"><div style="box-shadow: 0px 0px 10px #000000a1; background-color: #FFFFFF; border-radius: 10px; max-width: 450px; width: 350px; height: 430px; top: 10px; display: inline-block; margin-right: -60px; overflow: hidden; margin: auto; position: absolute; z-index: -1;"><img src="images/b2cloginbg.jpeg" style="width:100%; min-height:100%;" />

	<div style="width: 100%; height: 100%; background-color: #00000096; position: absolute; left: 0px; top: 0px; padding:30px; color:#FFFFFF;  ">

	<div style="margin-top: 40px; font-size: 20px; font-weight: 600; text-align: left;">Sign up/Login now to</div>

	<table width="72%" border="0" cellpadding="10" cellspacing="0" style="color: #FFFFFF; font-size: 16px; text-align: left; font-weight: 600;">

  <tr>

    <td colspan="3" style=" padding:15px; border-bottom:1px solid #ffffff5e; padding-left:0px;">

<i class="fa fa-plane" aria-hidden="true" style="  margin-right: 10px; color: #f6e900;"></i> Best Flight Price </td>

    </tr>

	

	 <tr>

    <td colspan="3" style="padding:15px; border-bottom:1px solid #ffffff5e; padding-left:0px;"><i class="fa fa-hospital-o" aria-hidden="true" style="  margin-right: 10px; color: #f6e900;"></i> Best Deal on Hotel </td>

    </tr>

	

	 <tr>

    <td colspan="3" style="padding:15px; border-bottom:0px solid #fff; padding-left:0px;"><i class="fa fa-life-ring" aria-hidden="true" style="  margin-right: 10px; color: #f6e900;"></i> 24 x 7 Support

</td>

    </tr>

</table>



	</div>



</div></td>







    <td>

<div class="lastchildlogin">



<i class="fa fa-times" aria-hidden="true" style="position:absolute; right:10px; top:10px; font-size:22px; color:#333333; cursor:pointer;" onclick="$('#clientloginbox').hide();"></i>





<div id="loadclientloginbox">

		

			</div>

			

			<script>

			function loadclientloginbox(t){

			$('#loadclientloginbox').html('<div style="text-align:center;"><img src="images/loadinggif.gif" width="32" /></div>'); 

			$('#loadclientloginbox').load('loadclientloginbox.php?t='+t+''); 

			} 

			</script>



</div></td>

  </tr>

</table>











</div>

<!--

<a href="https://wa.me/+919912786688?text=Chalofly! Great to chat with you!" target="_blank"><img src="<?php echo $fullurl; ?>images/whatsappicon.png" style="position:fixed; right:20px; bottom:20px; width:56px; z-index:999999;"></a> --->