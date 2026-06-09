<?php 
include "inc.php"; 
//include "config/logincheck.php";  
//$cookie_value=$_SESSION;
//setcookie('flyshopkafila', $cookie_value, time() + (86400 * 30), "/");
//file_put_contents("usersession/".$_SESSION['agentUserid'].".txt",json_encode($_SESSION));


if($_REQUEST['b2brecharge']!=1){
$rscheck=GetPageRecord('*','sys_userMaster','email="'.trim($_REQUEST["email"]).'" and (userType="client" or userType="agent")'); 
if(mysqli_num_rows($rscheck)>0){
 
$userinfo=mysqli_fetch_array($rscheck); 
$_SESSION['agentUserid']=$userinfo['id'];   
$_SESSION['websiteUserId']=$userinfo['id'];   
$_SESSION['parentAgentId']=1;  
$_SESSION['agentUsername']=$userinfo['email'];    
$_SESSION['parentid']=1;  

} else { 

$password=rand ( 10000000 , 99999999 );
 
 $rs=GetPageRecord('commissionType','sys_userMaster','id=3');  
$getWebsiteAgent=mysqli_fetch_array($rs); 

$namevalue ='firstName="Guest",commissionType="'.$getWebsiteAgent['commissionType'].'",userType="client",phone="'.trim($_REQUEST["userphone"]).'",email="'.trim($_REQUEST["email"]).'",parentId=1,dateAdded="'.date('Y-m-d H:i:s').'",addedBy=1,websiteUser=1';  
$lastagentid=addlistinggetlastid('sys_userMaster',$namevalue); 

$namevalue ='submitName="'.$submitName.'",firstName="Guest",lastName="'.$lastName.'",password="'.md5($password).'",status=1,userType="4",phone="'.trim($_REQUEST["userphone"]).'",mobile="'.trim($_REQUEST["userphone"]).'",email="'.trim($_REQUEST["email"]).'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy=1';  
addlistinggetlastid('userMaster',$namevalue);
 
$_SESSION['agentUserid']=$lastagentid;    
$_SESSION['websiteUserId']=$lastagentid;   
$_SESSION['parentAgentId']=1;  
$_SESSION['agentUsername']=trim($_POST['email']);    
$_SESSION['parentid']=1;  

}
 
 }

?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Online Recharge - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>

	<?php include "headerinc.php"; ?>

<style>

#searchform .form-control { font-size: 12px !important; height: 33px; border-radius: 4px !important; }

#searchform .col-xl-3 { padding-left: 5px !important; padding-right: 5px !important; }
html{background-color:#ededed;}
body{background-color: transparent;}
</style>

</head>

<body id="bookingpage">
<?php
if($_REQUEST["b"]=="1" && $_REQUEST["bamount"]>0){
$payment_confirm=1;
?>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> 
<style>
html{background-color:#FFFFFF;}
body{background-color:#FFFFFF !important; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:0px; margin:0px;}
</style>
<div style="padding:30px 15%; ">
<form method="post" id="bookingForm" action="<?php echo $fullurl; ?>frmaction.html" > 
<table width="100%" border="0" cellpadding="10" cellspacing="0" >
  <tr>
    <td colspan="3" align="center" style="font-size:20px; font-weight:600;">Select Payment Mode</td>
    </tr>
  <tr>
    <td colspan="3" align="center"><table width="100%" border="1" cellpadding="10" cellspacing="0" bordercolor="#B7FFEB" style="font-size:13px;">
      <tr style="font-weight:500;">
        <td width="10%" align="left" valign="middle" bgcolor="#E0FEF9">&nbsp;</td>
        <td width="20%" align="center" valign="middle" bgcolor="#E0FEF9">&nbsp;</td>
        <td width="20%" align="left" valign="middle" bgcolor="#E0FEF9">MODE</td>
		<td width="20%" align="left" valign="middle" bgcolor="#E0FEF9">CONVENIENCE FEES</td>
		<td width="20%" align="left" valign="middle" bgcolor="#E0FEF9">PAYABLE AMOUNT</td>
      </tr>
      <tr style=" border-bottom:1px solid #B7FFEB;">
        <td width="10%" align="left" valign="middle"><input name="pg_name" type="radio" value="DC"> </td>
        <td width="20%" align="center" valign="middle"><i class="fa fa-credit-card-alt" aria-hidden="true" style="color:#09b598; font-size:24px;"></i></td>
        <td width="20%" align="left" valign="middle">Debit Card </td>
        <td width="20%" align="left" valign="middle">0.85% </td>
        <td width="20%" align="left" valign="middle"><?php echo round($_REQUEST["bamount"]+($_REQUEST["bamount"]*0.0085)); ?> </td>

      </tr>

      <tr style=" border-bottom:1px solid #B7FFEB;">
        <td width="10%" align="left" valign="middle"><input name="pg_name" type="radio" value="CC"></td>
        <td width="20%" align="center" valign="middle"><i class="fa fa-credit-card-alt" aria-hidden="true" style="color:#09b598; font-size:24px;"></i></td>
        <td width="20%" align="left" valign="middle">Credit Card </td>
        <td width="20%" align="left" valign="middle">1.90% </td>
		<td width="20%" align="left" valign="middle"><?php echo round($_REQUEST["bamount"]+($_REQUEST["bamount"]*0.019)); ?> </td>
      </tr>
	  <tr style=" border-bottom:1px solid #B7FFEB;">
        <td width="10%" align="left" valign="middle"><input name="pg_name" type="radio" value="MW"></td>
        <td width="20%" align="center" valign="middle"><i class="fa fa-credit-card-alt" aria-hidden="true" style="color:#09b598; font-size:24px;"></i></td>
        <td width="20%" align="left" valign="middle">Wallet (ANY WALLET)</td>
        <td width="20%" align="left" valign="middle">1.75% </td>
		<td width="20%" align="left" valign="middle"><?php echo round($_REQUEST["bamount"]+($_REQUEST["bamount"]*0.0175)); ?> </td>
      </tr>
      <tr style=" border-bottom:1px solid #B7FFEB;">
        <td width="10%" align="left" valign="middle"><input name="pg_name" type="radio" value="NB"></td>
        <td width="20%" align="center" valign="middle"><i class="fa fa-university" aria-hidden="true" style="color:#09b598; font-size:24px;"></i></td>
        <td width="20%" align="left" valign="middle">Net Banking </td>
        <td width="20%" align="left" valign="middle">17&#8377; </td>
		<td width="20%" align="left" valign="middle"><?php echo round($_REQUEST["bamount"]+17); ?> </td>
      </tr>
      <tr>
        <td width="10%" align="left" valign="middle"><input name="pg_name" type="radio" value="UPI" checked></td>
        <td width="20%" align="center" valign="middle"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACaklEQVR4nO2Xu49NURTGf94SIRidRzTeCTMejVehGFFIKLRKxRQoKBRcGgohhMZ/IKYyU00hJnGRUFCMR6cYIhKRmAwJgytb1o6TNWefdfYZEZL1JTvnfud+37fOvmeffdcBh8PhcDgcDofD4fh30A10MsZ18W0S/tTI17oyvrvmtc4A+lJfnsycyEXxnVA8Ba0r4yPATCNnLtBfVW9IgvcaQVoXeW9NX6/B+yoyFgPtqnphlp+AL8C8iqA5ohsFZssYr+HTuhTvAB+AJSUZK4GXoknW25OxpCaAfQ18YdxRPs076vmL2Ay8LcmZhAsZFzNe+DXOZ07klPJpPiTHb8BG+S4soTEZD5RvEh6LYBvVeCS6Zcq31fBpXRUflM/DwGHgK/AO2GLV6wK+y9oM21oKi+SXirroew9Mr/BpncXXyMXHu/gKWF2n3qHM5dGvfLeMu6F1Fg+4JudGCnffrHcjYxJvCssv+o6kghM6iyO71m1gIb9Rt57jv8Co3M6lhu610kVeZ4SHuSxnGnBAzh+cyiTWSegzQ7de6SKvO54ncjZIO7IWeDiViRyV4CuG7lhNXSr/aoIfB34Al+X8KhpiQAL2/yGd5RtQfLDQEoXj6QZz+NVKf5SQBRm6yOsuK+2bqMh50WQiO8V8L1MXeZ0ROtiW8rWF7yrRX2oykbNiPmPozomupXythvVaKje2KjeNNiiJ+xKwPVMXX3p2ZNZrK1/ocu9Kkzos70HZmK+aNmuE9npWwRd5br2xQs4TYLkcQ7PaCCsKb2vW+CzbL7LbdGT3yYH29cgfYnehYXQ4HA6Hw+Fw8PfxEyWmf5sEmp4DAAAAAElFTkSuQmCC" style="height:32px;"></td>
        <td width="20%" align="left" valign="middle">UPI (Recommend)</td>
        <td width="20%" align="left" valign="middle">0%</td>
		<td width="20%" align="left" valign="middle"><?php echo round($_REQUEST["bamount"]); ?> </td>
      </tr>
      
    </table></td>
  </tr>
</table>


		<input type="hidden" name="action" value="onlineRecharge">
		<input type="hidden" name="booking_payment_type" value="booking">
		<input name="token" type="hidden" value="<?php echo rand(89898,543132113).strtotime(date('YmdHis')); ?>" />
		<input type="hidden" name="type" value="<?php echo $_REQUEST['type']; ?>">
		<input type="hidden" name="bType" value="<?php echo $_REQUEST['bType']; ?>">
		<input type="hidden" name="amount" value="<?php echo trim($_REQUEST["bamount"]); ?>">
		<input type="hidden" name="firstNameAdt" value="<?php echo trim($_REQUEST["firstNameAdt"]); ?>">
		<input type="hidden" name="lastNameAdt" value="<?php echo trim($_REQUEST["lastNameAdt"]); ?>">
		<input type="hidden" name="email" value="<?php echo trim($_REQUEST["email"]); ?>">
		<input type="hidden" name="userphone" value="<?php echo trim($_REQUEST["userphone"]); ?>">
			<div  style="text-align:center; width:100%;"> 

				 <input type="submit" value="Continue Payment" style="padding:10px 20px; background-color:#09b598; color:#FFFFFF; font-size:14px; font-size:15px; font-weight:600; border:0px; outline:0px;border-radius:5px;">
			</div>
	</form>
</div>
<script>
 //$('#bookingForm').submit();
</script>

<?php
}


 



if($payment_confirm<1){ ?>

<body>
	<h2 style="text-align:center;">Something went wrong, please try again!!</h2>
</body>

<?php
	
	
}
 ?>


</body>
</html>

