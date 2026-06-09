<?php 
include "inc.php";

$_SESSION['agentUserid']=$_REQUEST['ag'];
 

if($_REQUEST['id']!=''){
//$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['id']).'" and agentId="'.$_SESSION['agentUserid'].'"'); 
$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['id']).'" '); 
$rest=mysqli_fetch_array($a); 

if($rest['id']==''){
echo 'Something went wrong. Please try again.';
exit();
}

$b=GetPageRecord('*','sys_userMaster',' id=1  '); 
$adminData=mysqli_fetch_array($b); 


$urs=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($urs); 


$urs=GetPageRecord('*','sys_userMaster',' userType="b2cwebsite" '); 
$gstdata=mysqli_fetch_array($urs); 
} 


?> 

<div style="margin:auto; padding:10px;" id="DivIdToPrint">
<style>
table { font-size:12px; color:#000000; }
</style>
<style>
@media print {
body{padding:0px;}
table tr td { font-family:Arial, Helvetica, sans-serif;  font-size:13px; }
}

@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
</style>
<table width="100%" border="0" cellpadding="5" style="font-size:12px; ">
  <tr>
    <td width="34%" align="left"><img src="<?php echo $profilepic; ?><?php echo $websitesetting['websiteLogo']; ?>" height="55"></td>
    <td width="27%">&nbsp;</td>
    <td width="39%" align="right" valign="middle"><div style="font-size:24px; text-decoration:underline; font-weight:600">Invoice</div></td>
  </tr>
  <tr>
    <td width="34%" valign="top"><table width="100%" border="0" cellpadding="0">
      <tr>
        <td><strong><?php echo strtoupper($adminData['companyName']); ?></strong></td>
      </tr>
     
      <tr>
        <td>Tel: <?php echo stripslashes($websitesetting['contactPhone']); ?> </td>
      </tr>
      <tr>
        <td>Email: <?php echo stripslashes($websitesetting['contactEmail']); ?> </td>
      </tr>
      <tr>
        <td>GSTN: <?php echo stripslashes($gstdata['gstin']); ?></td>
      </tr>
      <tr>
        <td>Address: <?php echo stripslashes($gstdata['address']); ?></td>
      </tr>
    </table></td>
    <td width="27%">&nbsp;</td>
    <td width="39%" align="right" valign="top"><table width="100%" border="0" cellpadding="0">
      <tr>
        <td align="right"><strong>	<?php  if($LoginUserDetails['userType']=='agent'){  ?><?php echo stripslashes($agentData['companyName']); ?><?php } else { ?><?php echo stripslashes($agentData['firstName']); ?> <?php echo stripslashes($agentData['lastName']); ?><?php } ?></strong></td>
      </tr>
      <tr>
        <td align="right"><?php echo stripslashes($agentData['address']); ?></td>
      </tr>
      
      <tr>
        <td align="right">Mobile No: <?php echo stripslashes($agentData['phone']); ?></td>
      </tr>
      <tr>
        <td align="right">Email: <?php echo stripslashes($agentData['email']); ?></td>
      </tr>
	  
	  	<?php  if($LoginUserDetails['userType']=='agent'){  ?>
      <tr>
        <td align="right">GSTIN: <?php echo stripslashes($agentData['gstin']); ?></td>
      </tr>
      <tr>
        <td align="right">Pan No: <?php echo stripslashes($agentData['pan']); ?></td>
      </tr>
	  
	  <?php } ?>
    </table></td>
  </tr> 
  <tr>
    <td colspan="3"><hr /></td>
    </tr> 
  <tr>
    <td colspan="3"><table width="100%" border="0" cellpadding="0" style="border:1px solid #ddd;">
      <tr>
        <td width="39%"><div>Invoice no:</div>
		<div style="font-size:13px; font-weight:600;"><?php echo encode($rest['id']); ?></div>		</td>
        <td width="28%"><div>Booking Date:</div>
		<div style="font-size:13px; font-weight:600;"><?php echo date('d M Y, H:i A', strtotime($rest['bookingDate'])); ?></div></td>
        <td width="18%"><div>PNR:</div>
		  <div style="font-size:13px; font-weight:600;"><?php echo stripslashes($rest['pnrNo']); ?></div>		</td>
        </tr>
    </table></td>
    </tr> 
  <tr>
    <td colspan="3"><table width="100%" border="0" cellpadding="3" cellspacing="0">
      <tr>
        <td colspan="3" style="border-bottom:1px solid #FF6633;">Onward: <span style="font-size:13px; font-weight:600;"><?php echo $rest['source']; ?>-<?php echo $rest['destination']; ?> , <?php echo $rest['flightName']; ?> <?php echo $rest['flightNo']; ?></span></td>
        <td colspan="4" align="right" style="border-bottom:1px solid #FF6633;">Travel Date: <span style="font-size:13px; font-weight:600;"><?php echo date('d M Y', strtotime($rest['journeyDate'])); ?></span></td>
        </tr>
      <tr>
        <td width="31%" align="left" style="border-bottom:1px solid #FF6633;"><strong>Name</strong></td>
        <td width="8%" align="center" style="border-bottom:1px solid #FF6633;"><strong>Type</strong></td>
        <td width="14%" align="center" style="border-bottom:1px solid #FF6633;"><strong>Class</strong></td>
        <td width="13%" align="center" style="border-bottom:1px solid #FF6633;"><strong>Basic</strong></td>
        <td width="8%" align="center" style="border-bottom:1px solid #FF6633;"><strong>YQ</strong></td>
        <td width="13%" align="center" style="border-bottom:1px solid #FF6633;"><strong>Taxes</strong></td>
        <td width="13%" align="center" style="border-bottom:1px solid #FF6633;"><strong>GST</strong></td>
        <td width="13%" align="center" style="border-bottom:1px solid #FF6633;"><strong>Total</strong></td>
      </tr>
	    <?php 
		$rs6=GetPageRecord('*,count(id) as cnt','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" and firstName!="" group by paxType order by paxType asc'); 
		$countPax=mysqli_num_rows($rs6);
		while($paxData=mysqli_fetch_array($rs6)){
    $abasefare=$paxData['baseFare']*$paxData['cnt'];
    $atax=$paxData['tax']*$paxData['cnt'];
    $agst=$paxData['gst']*$paxData['cnt'];
	  ?>
      <tr>
        <td align="left" style="border-bottom:1px solid #ddd;"><?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName']; ?> <?php if($paxData['cnt']>1){ ?>+ <?php echo ($paxData['cnt']-1); } ?></td>
        <td align="center" style="border-bottom:1px solid #ddd;"><?php echo ucfirst($paxData['paxType']); ?></td>
        <td align="center" style="border-bottom:1px solid #ddd;"><?php echo ucfirst($rest['flightClass']); ?></td>
        <td align="center" style="border-bottom:1px solid #ddd;"><?php echo number_format($abasefare); ?></td>
        <td align="center" style="border-bottom:1px solid #ddd;">0</td>
        <td align="center" style="border-bottom:1px solid #ddd;"><?php echo number_format($atax); ?></td>
        <td align="center" style="border-bottom:1px solid #ddd;"><?php echo number_format($agst); ?></td>
        <td align="center" style="border-bottom:1px solid #ddd;"><?php echo number_format($abasefare+$atax+$agst); ?></td>
      </tr>
      <?php 
    }
    ?>
    </table></td>
    </tr> 
	<?php 
		$c=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="flight_GST"'); 
		$balanceSheetData=mysqli_fetch_array($c);
		 
		$ct=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="TDS"'); 
		$balanceSheetDataTDS=mysqli_fetch_array($ct); 
		
		$totalAmt=0;
	  ?>
  <tr>
    <td width="34%">&nbsp;</td>
    <td width="27%">&nbsp;</td>
    <td width="39%" align="right"><table width="100%" border="0" cellpadding="0">
      <tr>
        <td width="81%" align="right">Basic</td>
        <td width="1%" align="center">:</td>
        <td width="18%" align="right"><?php echo number_format($rest['baseFare']); $totalAmt+=$rest['agentBaseFare']; ?> INR</td>
      </tr>
      
      <tr>
        <td align="right">Taxes</td>
        <td align="center">:</td>
        <td align="right"><?php echo number_format($rest['agentTax']); ?> INR</td>
      </tr>
     <?php if($rest['seatPrice']>0){ ?> <tr>
        <td align="right">Seat Charges</td>
        <td align="center">:</td>
        <td align="right"><?php echo number_format($seat=$rest['seatPrice']); ?> INR</td>
      </tr>
	  <?php } ?>
       <?php if($rest['mealPrice']>0){ ?> <tr>
        <td align="right">Meal Charges</td>
        <td align="center">:</td>
        <td align="right"><?php echo number_format($meal=$rest['mealPrice']); ?> INR</td>
      </tr><?php } ?>
	  <?php if($rest['extraBaggagePrice']>0){ ?>
      <tr>
        <td align="right">Extra Baggage Charges</td>
        <td align="center">:</td>
        <td align="right"><?php echo number_format($bagg=$rest['extraBaggagePrice']); ?> INR</td>
      </tr>
	  <?php } ?>
     
    <?php  if($LoginUserDetails['userType']=='agent'){ 
      $gst=($rest['agentGst']>0)?$rest['agentGst']:round($rest['agentCommision']*18/100);
      ?>  <tr>
        <td align="right">Commission</td>
        <td align="center">:</td>
        <td align="right">-(<?php echo number_format($comm=$rest['agentCommision']);  ?> INR)</td>
      </tr>
       <tr>
        <td align="right">GST </td>
        <td align="center">:</td>
        <td align="right"><?php echo number_format($gst); ?>  INR</td>
      </tr>
	   <tr>
        <td align="right">TDS </td>
        <td align="center">:</td>
        <td align="right"><?php echo number_format($tds=round($rest['agentCommision']*5/100)); ?>  INR</td>
      </tr>
	  <?php } ?>
      <tr>
        <td align="right"><strong>Grand Total</strong></td>
        <td align="center"><strong>:</strong></td>
        <td align="right"><div style="width:100px;"><strong><?php if($LoginUserDetails['userType']=='agent'){  echo number_format($rest['agentBaseFare']+$rest['agentTax']+$seat+$meal+$bagg+$gst+$tds-round($comm=$rest['agentCommision']));  } else { echo number_format($rest['agentBaseFare']+$rest['agentTax']+$seat+$meal+$bagg); }?> INR</strong></div></td>
      </tr>
    </table></td>
  </tr> 
  <tr>
    <td colspan="3"><table width="100%" border="0" cellpadding="0">
      <tr>
        <td width="53%">
		<table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #ddd;">
  <tr>
    <td><div style=" font-weight:600; text-decoration: underline; padding:10px;">Terms & Condition</div>
		<div  style=" padding:10px;"><?php echo strip_tags(stripslashes($adminData['invoiceTerms'])); ?></div> </td>
  </tr>
</table>
		</td>
        <td width="47%" align="center"><div style=" font-weight:600;">For <?php echo strtoupper($adminData['invoiceCompany']); ?>.</div>
		<div>Computer Generated Report, Requires No Signature</div>		</td>
      </tr>
    </table></td>
    </tr>
</table>


</div>
 
 
 
 
<button type="button" class="btn btn-secondary btn-sm" onclick='printDiv();' style="float:right;">Print / Download</button>


<script>
function printDiv() 
{

  var divToPrint=document.getElementById('DivIdToPrint'); 
  var newWin=window.open('','Print-Window'); 
  newWin.document.open(); 
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>'); 
  newWin.document.close(); 

}
</script>