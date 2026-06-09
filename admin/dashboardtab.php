<div class="boxtabs">
<a href="#" onclick="loaddasboard('dashboard.php',1);" <?php if($_REQUEST['type']==1){ ?>class="active"<?php } ?>>CRM Dashboard</a>
 
<?php if(strpos($LoginUserDetails["permissionView"], 'Query') !== false) { ?>
<?php if($_SESSION['userid']==1){ ?>
<a href="#" onclick="loaddasboard('org_dashboard.php',2);" <?php if($_REQUEST['type']==2){ ?>class="active"<?php } ?>>Organisation Dashboard</a>
<?php } ?>
	<a href="#" onclick="loaddasboard('flight_dashboard.php',3);" <?php if($_REQUEST['type']==3){ ?>class="active"<?php } ?>>Flight Dashboard B2B</a>
<?php
if($LoginUserDetails["userType"]==0){
?>	
	<a href="#" onclick="loaddasboard('flight_dashboardb2c.php',4);" <?php if($_REQUEST['type']==4){ ?>class="active"<?php } ?>>Flight Dashboard B2C</a>
<?php } ?>
	<!---
	<a href="#" onclick="loaddasboard('hotel_dashboard.php',4);" <?php //if($_REQUEST['type']==4){ ?>class="active"<?php //} ?>>Hotel Dashboard</a>
	-->
	
<?php } ?>  

</div>