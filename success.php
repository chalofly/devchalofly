<?php
session_start();
include "config/database.php";
include "config/function.php";
include "config/setting.php";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
if($_POST["code"]=="PAYMENT_SUCCESS" && $_POST["merchantId"]=="CHALOFLYONLINE"){
$merchantId=$_POST["merchantId"];
$transactionId=$_POST["transactionId"];
$providerReferenceId=$_POST["providerReferenceId"];
$amount=$_POST["amount"];

$namevalue='status="success",net_amount_debit="'.$amount.'",referenceId="'.$providerReferenceId.'"';
$where='id="'.decode($transactionId).'"';
updatelisting('onlineRechargeRequest',$namevalue,$where);

$chk=GetPageRecord('*','onlineRechargeRequest',$where);
$chkData=mysqli_fetch_array($chk);


$onR=GetPageRecord('*','sys_balanceSheet','token="'.$chkData["token"].'"');
if(mysqli_num_rows($onR)==0){

$namevalue ='agentId="'.$chkData['agentId'].'",amount="'.$amount.'",paymentType="Credit",paymentMethod="Online",transactionId="'.$providerReferenceId.'",token="'.$chkData["token"].'",remarks="Online Recharge",addedBy="'.$chkData['agentId'].'",addDate="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_balanceSheet',$namevalue); 

}
?>
<script>
//parent.allBookingSubmit(); 
//parent.window.opener.bookingFormSubmit();

    function closeWindow() { 
        let new_window =
            open(location, '_self');
       
        new_window.close();
      
        return false;
    }
setTimeout(function() { 
closeWindow();
}, 2000);
</script>
Wait Please...
<?php
exit();
}else{
$namevalue='status="failed",referenceId="'.$providerReferenceId.'"';
$where='id="'.$transactionId.'"';
updatelisting('onlineRechargeRequest',$namevalue,$where);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Paymemt Information</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body style="font-family:Arial, Helvetica, sans-serif; float:14px; ">
<div class="container" style="text-align:center;">
  <h2>Payment Failure</h2>            
  <table border="1" cellpadding="10" cellspacing="0" bordercolor="#000000" class="table" style="font-size:14px;">
    <tbody>
      <tr>
        <td align="left" bgcolor="#F0F0F0"><strong>Status</strong></td>
        <td align="left" bgcolor="#F0F0F0"><strong>Falied</strong></td>
      </tr>
      <tr>
        <td align="left"><strong>Transaction Id</strong></td>
        <td align="left"><?php echo $transactionId; ?></td>
      </tr>
	  <tr>
        <td align="left"><strong>Payable Amount</strong></td>
        <td align="left"><?php echo $amount; ?></td>
      </tr>
      <tr>
        <td align="left"><strong>Reference Id</strong></td>
        <td align="left"><?php echo $providerReferenceId; ?></td>
      </tr>
    </tbody>
  </table>    
</div>
 
<script type="text/javascript">

    function closeWindow() { 
        let new_window =
            open(location, '_self');
       
        new_window.close();
      
        return false;
    }
 
setTimeout(function() { 
 closeWindow();
}, 3000);
</script>
</body>
</html>

<?php
exit();
}

?>