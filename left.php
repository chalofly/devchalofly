<div id="leftsidemenu">

<div class="inlist">

<?php if($LoginUserDetails['userType']=='agent' or $LoginUserDetails['userType']=='distributor'){ ?>
<div class="companyinfobox">

<a href="<?php echo $fullurl; ?>my-profile" style="color:#000000;">

<div class="companyname"><?php echo stripslashes($LoginUserDetails['company']); ?></div>

<strong>ID:</strong> <?php echo ($LoginUserDetails['agentId']); ?>

<a class="dropdown-item" href="<?php echo $fullurl; ?>balance-sheet" style="color: #000;"><strong><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Wallet: &#8377;<?php echo round($totalwalletBalance); ?></strong></a>

</a>

</div>

<?php } ?>

<div class="sidemenuleft"> 
<?php if($LoginUserDetails['userType']=='distributor'){ ?> 
<a <?php if($selectleft=='agent'){ ?>class="active"<?php } ?> href="<?php echo $fullurl; ?>agent"><span><i class="fa fa-list" aria-hidden="true"></i></span>Agent</a>
<a <?php if($selectleft=='bookings'){ ?>class="active"<?php } ?> href="<?php echo $fullurl; ?>flight-bookings"><span><i class="fa fa-list" aria-hidden="true"></i></span> Bookings</a>
<?php } ?>
<?php if($LoginUserDetails['userType']!='distributor'){ ?>
<a <?php if($selectleft=='bookings'){ ?>class="active"<?php } ?> href="<?php echo $fullurl; ?>flight-bookings"><span><i class="fa fa-list" aria-hidden="true"></i></span> Bookings</a>

<a <?php if($selectleft=='invoice'){ ?>class="active"<?php } ?> href="<?php echo $fullurl; ?>flight-bookings-invoice"><span><i class="fa fa-file" aria-hidden="true"></i></span> Invoices</a>
<?php } ?>
	<?php if($LoginUserDetails['userType']=='agent' or $LoginUserDetails['userType']=='distributor'){ ?>
<a <?php if($selectleft=='balancesheet'){ ?>class="active"<?php } ?> href="<?php echo $fullurl; ?>balance-sheet" ><span><i class="fa fa-money" aria-hidden="true"></i></span> Balance Sheet</a>

<a <?php if($selectleft=='topup-recharge'){ ?>class="active"<?php } ?> href="<?php echo $fullurl; ?>topup-recharge" ><span><i class="fa fa-retweet" aria-hidden="true"></i></span> Topup Recharge</a>

<a <?php if($selectleft=='topup-request'){ ?>class="active"<?php } ?> href="<?php echo $fullurl; ?>topup-request" ><span><i class="fa fa-cloud-upload" aria-hidden="true"></i></span> Top Up Request</a>

<?php if($LoginUserDetails['userType']!='distributor') { ?>
<a <?php if($selectleft=='group-request'){ ?>class="active"<?php } ?> href="<?php echo $fullurl; ?>group-request" ><span><i class="fa fa-cloud-upload" aria-hidden="true"></i></span> Flight Group Request</a>



 

<a <?php if($selectleft=='mycustomers'){ ?>class="active"<?php } ?> href="<?php echo $fullurl; ?>my-customer"><span><i class="fa fa-users" aria-hidden="true"></i></span> Customers</a>
<?php } ?>
<!--<a href="#"><span><i class="fa fa-plane" aria-hidden="true"></i></span> Flight Series Fare</a> -->
<?php } ?>
<?php if($LoginUserDetails['userType']!='distributor'){ ?>
<a <?php if($selectleft=='settings'){ ?>class="active"<?php } ?> href="<?php echo $fullurl; ?>settings"><span><i class="fa fa-cog" aria-hidden="true"></i></span> Settings</a> 
<?php } ?>
</div>





	<?php if($LoginUserDetails['userType']=='agent'){ ?>

<div id="leftcontactbox">

<img src="images/flightlefticon.png">

<!--
<div class="head">Sales Manager</div>
-->

<?php echo $acountmanager['name']; ?> <?php echo $acountmanager['lastName']; ?><br>

<?php echo $acountmanager['phone']; ?><br>

<?php echo $acountmanager['email']; ?>



</div>
<?php } ?>


</div> 

</div>