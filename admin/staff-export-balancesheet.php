<?php 
   include "inc.php"; 
   include "config/logincheck.php";


    $getUserDetails = getUserDetails($_REQUEST['agentId']);

    header('Content-type: application/excel');
    $filename = $getUserDetails["firstName"].' - Balance-Sheet-'.mt_rand().'.xls';
    header('Content-Disposition: attachment; filename='.$filename);
?>
<table border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" class="table balancesheettable" style=" margin-bottom:0px;">
   <thead>
      <tr style="background-color: #f6f6f6;">
         <th align="left">Date</th>
         <th align="left">Reference No.</th>
         <th align="left">Description</th>
         <th align="center">
			<div align="center">Method</div>
		</th>
        <th align="right">
			<div align="right">Credit</div>
		</th>
        <th align="right">
			<div align="right">Debit</div>
		</th>
        <th align="right">
			<div align="right">Running Balance</div>
		</th>
      </tr>
   </thead>
   <tbody>
<?php
$search='';
if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
	$search.=' and DATE(addDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and DATE(addDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}

if($_REQUEST['keyword']!=''){
	$search.=' and ( transactionId like "%'.decode($_REQUEST['keyword']).'%" )';
}
        								
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1;
           
$targetpage='balance-sheet?view=1&agentCategory='.$_REQUEST['agentCategory'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
         
$rs=GetRecordList('*','sys_balanceSheet',' where 1 '.$search.' and agentId="'.$_REQUEST['agentId'].'" order by id desc','50000',$page,$targetpage); 

$totalentry=$rs[1]; 
$paging=$rs[2];  
		 
$totalCreditAmt=0;
$totalDebitAmt=0;
$balance=0;

while($agentWebsitePages=mysqli_fetch_array($rs[0])){ 

if($agentWebsitePages['amount']>0){
                              
//Opening Balance Debit Amount                              
$openBalDebited=GetPageRecord('SUM(amount)','sys_balanceSheet',' agentId="'.$agentWebsitePages['agentId'].'" and paymentType="Debit" and id<="'.$agentWebsitePages["id"].'" order by id asc'); 
                              
$openBalDebitedData=mysqli_fetch_array($openBalDebited);
$openBalDebitedAmount = $openBalDebitedData["SUM(amount)"];
                              
//Opening Balance Credit Amount
$openBalCredited=GetPageRecord('SUM(amount)','sys_balanceSheet',' agentId="'.$agentWebsitePages['agentId'].'" and paymentType="Credit" and id<="'.$agentWebsitePages["id"].'" order by id asc');
$openBalCreditedData=mysqli_fetch_array($openBalCredited);

$openBalCreditedAmount = $openBalCreditedData["SUM(amount)"];
$balance = round($openBalCreditedAmount-$openBalDebitedAmount);	

$totalDebit+=$openBalDebitedAmount;
$totalCredit+=$openBalCreditedAmount;  
?>

<tr>
	<td align="left" valign="top"><?php echo date('l d M Y h:i A', strtotime($agentWebsitePages['addDate'])); ?></td>
	
	<td align="left" valign="top"><?php echo $agentWebsitePages['transactionId']; ?></td>
	
	<td align="left" valign="top"><?php echo $agentWebsitePages['remarks']; ?></td>
	
	<td align="left" valign="top"><?php echo $agentWebsitePages['paymentMethod']; ?></td>

	<td align="right" valign="top">
		<div align="right">
			<?php if($agentWebsitePages['paymentType']=='Credit'){ 
			$totalCreditAmt+=$agentWebsitePages['amount']; ?>
            <?php echo strip($agentWebsitePages['amount']); ?> INR
            <?php } ?>
		</div>
	</td>
    
	<td align="right" valign="top">
		<div align="right">
			<?php if($agentWebsitePages['paymentType']=='Debit'){ 
			$totalDebitAmt+=$agentWebsitePages['amount']; ?>
            <?php echo strip($agentWebsitePages['amount']); ?> INR
            <?php } ?>
		</div>
	</td>
	
	<td align="right" valign="top">
		<div align="right"><?php echo strip($balance); ?> INR</div>
	</td>
</tr>

<?php } } ?>

<tr>
	<td align="right" valign="top" bgcolor="#EBEBEB">&nbsp;</td>
    
	<td align="right" valign="top" bgcolor="#EBEBEB">&nbsp;</td>
    
	<td align="right" valign="top" bgcolor="#EBEBEB">&nbsp;</td>

	<td align="right" valign="top" bgcolor="#EBEBEB">
		<div align="right"><!--<strong><?php //echo round($totalCreditAmt); ?> INR</strong>--></div>
	</td>
    
	<td align="right" valign="top" bgcolor="#EBEBEB">
		<div align="right"><!--<strong><?php //echo round($totalDebitAmt); ?> INR</strong>--></div>
	</td>
	
	<td align="center" valign="top" bgcolor="#EBEBEB">
		<div align="center"><strong>Total</strong>:</div>
	</td>
    
	<td align="right" valign="top" bgcolor="#EBEBEB">
		<div align="right"><strong><?php echo round($totalwalletBalance); ?> INR</strong></div>
	</td>
</tr>							  
  
   </tbody>
</table>