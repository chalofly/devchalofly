<div id="header">
   <div class="headerbar">
      <i class="fa fa-bars mobilemainmenu" aria-hidden="true" onclick="$('.mobilemainmenuboxss').toggle();"></i>
      <div class="mobilemainmenuboxss">
         <?php if($_SESSION['mobileapppage']==1){ ?>
         <a href="<?php echo $fullurl; ?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
         <?php } ?>
         <a href="<?php echo $fullurl; ?>flightpage.php"  ><i class="fa fa-plane" aria-hidden="true"></i> Flights</a>
         <!-- <a href="<?php echo $fullurl; ?>hotels"  ><i class="fa fa-building" aria-hidden="true"></i> Hotels</a>  -->
         <a href="<?php echo $fullurl; ?>holidays"><i class="fa fa-suitcase" aria-hidden="true"></i> Holidays</a>
         <!-- <a href="<?php echo $fullurl; ?>visa"><span><i class="fa fa-cc-visa" aria-hidden="true"></i></span>Visa</a> -->
         <a href="<?php echo $fullurl; ?>about-us"><i class="fa fa-file-text-o" aria-hidden="true"></i> About</a>
         <a href="<?php echo $fullurl; ?>terms-conditions"><i class="fa fa-file-text" aria-hidden="true"></i> Terms & conditions</a>
         <a href="<?php echo $fullurl; ?>privacy-policy"><i class="fa fa-file-text" aria-hidden="true"></i> Privacy Policy</a> 
         <a href="<?php echo $fullurl; ?>contact-us"><i class="fa fa-phone-square" aria-hidden="true"></i> Contact</a> 
      </div>
      <script>
         $(document).mouseup(function(e) 
         {
         var container = $(".mobilemainmenuboxss");

         // if the target of the click isn't the container nor a descendant of the container

         if (!container.is(e.target) && container.has(e.target).length === 0) 
         {
         container.hide();
         }
         });
      </script>
      <?php if($LoginUserDetails['userType']=='distributor'){ ?>
      <div id="logo"><a href="<?php echo $fullurl; ?>agent"><img src="<?php echo $fullurl; ?>images/logo.png"></a></div>
      <?php }else { ?>
      <div id="logo"><a href="<?php echo $fullurl; ?>"><img src="<?php echo $fullurl; ?>images/logo.png"></a></div>
      <?php } ?>
	  
		<?php 
         if($_SESSION['agentUserid']!='' && $LoginUserDetails['userType']!='distributor'){
		?>
      <div id="menu">
         <a href="<?php echo $fullurl; ?>" class="<?php if(isset($selectedpage) && $selectedpage=="flights"){ ?>active <?php } ?>"><img src="<?php echo $fullurl; ?>images/flighticon.png"> Flights </a>
         <a href="<?php echo $fullurl; ?>holidays" class="<?php if(isset($selectedpage) && $selectedpage=="holidays"){ ?>active <?php } ?>"><img src="<?php echo $fullurl; ?>images/holidayicon.png"> Holidays</a>
      </div>
      <?php } ?>
      <div class="supportmenu"><strong>Call Us:</strong> <?php echo stripslashes($getlogo['phone']); ?></div>
      <?php if($_SESSION['agentUserid']!=''){ ?>
      <div id="rightmenu">
         <div class="dropdown">
            <?php  if($LoginUserDetails['userType']=='agent' || $LoginUserDetails['userType']=='client' || $LoginUserDetails['userType']=='distributor'){ ?>
            <button class="btn btn-secondary dropdown-toggle mainbutton" style="display:block !important;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span style="float:left;"><i class="fa fa-user" aria-hidden="true"></i>
            </span><?php echo ($LoginUserDetails['userType']=='distributor')?"Profile":"Account"; ?>
            </button> 
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
               <?php  if($LoginUserDetails['userType']=='agent'){ ?>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>balance-sheet" style="background-color: #00000080 !important; color: #fff;"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Balance: &#8377;<?php echo round($totalwalletBalance); ?></a>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>my-profile"><i class="fa fa-id-card-o" aria-hidden="true"></i> Agent Id: <?php echo ($LoginUserDetails['agentId']); ?></a>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>dashboard"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a>
               <?php } ?>
               <?php if($LoginUserDetails['userType']!='distributor'){ ?>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>flight-bookings"><i class="fa fa-list" aria-hidden="true"></i> Bookings</a>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>flight-bookings-invoice"><i class="fa fa-file" aria-hidden="true"></i> Invoices</a>
               <?php } ?>
               <?php if($LoginUserDetails['userType']=='agent'){ ?>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>balance-sheet"><i class="fa fa-money" aria-hidden="true"></i> Balance Sheet</a>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>topup-recharge"><i class="fa fa-retweet" aria-hidden="true"></i> Topup Recharge</a>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>topup-request"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Top Up Request</a>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>my-customer"><i class="fa fa-users" aria-hidden="true"></i> Customers</a>
               <?php } ?>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>my-profile"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a>
               <?php if($LoginUserDetails['userType']!='distributor'){ ?>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>settings"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>
               <?php } ?>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
            </div>
            <?php } else {  ?><a href="<?php echo $fullurl; ?>login"><button class="btn btn-secondary mainbutton agenbtnbar" style="display: block !important; background: #00a1e5; color: #fff; padding-left: 15px; padding-right: 20px; border:1px solid #00a1e5 !important;" type="button"  >
            <img src="<?php echo $fullurl; ?>images/agenticon.png">  Agent Login
            </button></a>
            <!--
               <div class="usericonbar"><a href=""><img src="<?php echo $fullurl; ?>images/usericon.png"></a></div>
               
               -->
            <button class="btn btn-secondary mainbutton dropdown-toggle agenbtnbar" style="display:block !important;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
            <span style="float:left;"><img src="<?php echo $fullurl; ?>images/signupicon.png">
            </span>Login / Signup
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
               <a class="dropdown-item" style=" border-bottom:0px;padding-bottom: 0px;">
                  <strong>Hey Traveller</strong>
                  <div style="font-size:11px; color:#313131;">Get deals & Manage your trips</div>
               </a>
               <a  onclick="$('#clientloginbox').show();loadclientloginbox(1);" style="border-bottom:0px;">
               <button class="btn btn-secondary mainbutton" style="display: block !important; background-color:  var(--blue); border:0px !important; color: #fff; padding-left: 20px; padding-right: 20px;  width: 100%; padding: 5px; margin-bottom: 10px; border-radius: 8px;" type="button">
               Login / Signup
               </button></a>
               <a class="dropdown-item"  onclick="$('#clientloginbox').show();loadclientloginbox(1);" ><i class="fa fa-suitcase" aria-hidden="true"></i> My Bookings</a>
               <a class="dropdown-item" href="<?php echo $fullur; ?>offers"><i class="fa fa-certificate" aria-hidden="true"></i> Offers</a>
            </div>
            <?php } ?>
            <!-- <form method="Post" id="formidscurrency" action="" style="position: absolute;right: 316px; top: 10px; ">
               <select name="currency" id="currency" class="currencyfield"  style="right: 60px !important; border: 1px solid #ddd; padding: 11px 10px; border-radius: 10px; background-color: #f7f7f7; font-weight: 800; outline: 0px;" onchange="$('#formidscurrency').submit();">
               
               <?php   
                  $rs=GetPageRecord('*','currencyExchangeMaster',' 1 and name!="" order by name asc'); 
                  
                  while($rest=mysqli_fetch_array($rs)){  
                  
                  ?> 
               
               <option value="<?php echo $rest['name']; ?>" <?php if($_SESSION['currency']==$rest['name']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>
               
               <?php }  ?>
               
               </select>
               
               </form>-->
         </div>
      </div>
      <?php } ?>
   </div>
</div>
<style>
   .headerbar{max-width:1370px; margin:auto;}
</style>