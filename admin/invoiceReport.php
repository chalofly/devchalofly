<?php
   $getUserDetails = getUserDetails($_SESSION['userid']);
   $totalwalletBalance=getagentbalance($_SESSION['userid']);
?>
<div class="wrapper">
   <div class="container-fluid">
      <div class="main-content">
         <div class="page-content">
            <div class="newboxheading">
               <div class="newhead">
                  Invoice Report
                  <div class="newoptionmenu">
                     <div>
                        <!--
                           <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop('Add Payment',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addNewTransaction&agentId=<?php //echo $_SESSION['userid']; ?>">Add Balance </button> 
                           -->
                     </div>
                  </div>
               </div>
            </div>
            <!-- start page title -->
            <div style="padding-top: 34px;">
               <div class="col-md-12 col-xl-12" style="padding-left:50px;padding-top:25px;">
                  <div class="card-body">
                     <form method="get" id="searchform" style="margin-bottom:20px; margin-left:5px;">
                        <div class="row newinputbookrow">
                           <input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
                           <div class="col-xl-2" style="padding-right: 0px;">
                              <div class="input-group">
                                 <input type="text" id="fromdate" name="fromdate" class="form-control" placeholder="From Date" value="<?php echo $_REQUEST['fromdate']; ?>"  readonly >
                              </div>
                           </div>
                           <div class="col-xl-2" style="padding-right: 0px;padding-left:7px;">
                              <div class="input-group">
                                 <input type="text" id="todate" name="todate" class="form-control" placeholder="To Date"  value="<?php echo $_REQUEST['todate']; ?>" readonly>
                              </div>
                           </div>
                           <script>
                              $( function() {
                              $( "#fromdate" ).datepicker({ dateFormat: 'dd-mm-yy' });
                              $( "#todate" ).datepicker({ dateFormat: 'dd-mm-yy' });
                              } );
                           </script>
                           <div class="col-xl-2" style="padding-right: 0px;padding-left:7px;">
                              <div class="input-group">
                                 <input name="keyword" type="text" class="form-control" id="keyword" placeholder="Booking No." value="<?php echo $_REQUEST['keyword']; ?>"  >
                              </div>
                           </div>
                           <div class="col-xl-1 mobileforncol">
                              <button class="btn btn-light bg-primary border-primary text-white" type="submit" style="padding: 6px 12px; border-radius:6px; margin-left: 7px; width:100%;height:37px; margin-top: 2px;"><i class="fa fa-search" aria-hidden="true"></i></button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="col-md-12 col-xl-12" style="padding-left:0px; padding-right:0px;">
                  <div class="card-body" style=" background-color:#FFFFFF;">
                     <table class="table table-bordered table-striped" style=" margin-bottom:0px;">
                        <thead>
                           <tr>
								<th>Date</th>
								<th>Booking No. </th>
								<th>Agent</th>
								<th>Airline</th>
								<th>Departure</th>
								<th>Arrival</th>
								<th><div align="center">PNR</div></th>
								<th align="center"><div align="center">Commission</div></th>
								<th align="center" style="text-align:center;"><div align="center">GST</div></th>
								<th align="center"><div align="center">TDS</div></th>
								<th align="center"><div align="center">Amount</div></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
$search='';

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(bookingDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(bookingDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}

if($_REQUEST['keyword']!=''){
$search.=' and (flightName like "%'.$_REQUEST['keyword'].'%" or flightNo like "%'.$_REQUEST['keyword'].'%" or id = "'.decode($_REQUEST['keyword']).'" or  source like "%'.$_REQUEST['keyword'].'%" or destination like "%'.$_REQUEST['keyword'].'%" or pnrNo like "%'.$_REQUEST['keyword'].'%" or bookingNumber like "%'.$_REQUEST['keyword'].'%" or totalFare like "%'.$_REQUEST['keyword'].'%" or agentId in (select id from sys_userMaster where gstin like "%'.$_REQUEST['keyword'].'%" ) or agentId in (select id from sys_userMaster where pan like "%'.$_REQUEST['keyword'].'%" ) ) ';
}


$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1;


$targetpage='display.html?ga=invoiceReport&agent='.$_REQUEST['agent'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 

$rs=GetRecordList('*','flightBookingMaster',' where status=2 '.$search.'  order by id desc  ','25',$page,$targetpage);
$totalentry=$rs[1]; 
$paging=$rs[2];  


while($rest=mysqli_fetch_array($rs[0])){ 

$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" '); 
$agentcate=mysqli_fetch_array($rs6);

$cft=GetPageRecord('*','flightBookingMaster',' uniqueSessionId="'.$rest['uniqueSessionId'].'" '); 
$cont=mysqli_num_rows($cft);

$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);


$c=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="flight_GST"'); 
$balanceSheetData=mysqli_fetch_array($c); 

$cd=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="TDS"'); 
$balanceSheetDataTDS=mysqli_fetch_array($cd); 


$ag=GetPageRecord('*','flight_booking_ssr_details',' BookingId="'.$rest['id'].'" ');  
$ssrprice=mysqli_fetch_array($ag);
                                                               
?>

<tr>
	<td align="left" valign="top"><div style="color:#999999; font-size:12px;"><?php echo date('d-m-Y', strtotime($rest['bookingDate'])); ?></div></td>
					
	<td align="left" valign="top"><?php echo encode($rest['id']); ?><?php if($cont>1){ ?><br /><span class="badge bg-blue" style="background-color: #5d5d5e;">Round Trip</span><?php } ?><?php if($rest['fixedDeparture']==1){ ?><br /><span class="badge bg-blue" >Fixed Departure</span><?php } ?></td>

	<td align="left" valign="top"><strong><?php if($agentData['userType']!='agent'){ ?><?php echo strip($agentData['firstName']); ?> <?php echo strip($agentData['lastName']); ?><?php }else{ ?><?php echo strip($agentData['company']); ?><?php } ?></strong></td>
	
	<td align="left" valign="top"><strong><?php echo stripslashes($rest['flightName']); ?>&nbsp;(<?php echo stripslashes($rest['flightNo']); ?>)</strong> </td>

	<td align="left" valign="top" style="font-size:11px;"><?php echo stripslashes($rest['source']); ?></td>

	<td align="left" valign="top" style="font-size:11px;"><?php echo stripslashes($rest['destination']); ?></td>

	<td align="left" valign="top" style="font-size:11px;"><?php echo stripslashes($rest['pnrNo']); ?></td>

	<td align="center" valign="top" style="font-size:11px;"><?php echo stripslashes($rest['agentCommision']); ?></td>

	<td align="center" valign="top">
	<?php echo round($rest['agentCommision']*18/100); $totalgst=($totalgst+round($rest['agentCommision']*18/100)); ?>
	</td>
	
	<td align="center" valign="top" style="font-size:11px;"><?php echo round($rest['agentCommision']*5/100); ?></td>

	<td align="left" valign="top" style="font-size:11px;"><div align="center"><?php echo stripslashes($rest['agentTotalFare']+$ssrprice['SeatPriceInn']+$ssrprice['MealFeeInn']+$ssrprice['BaggageFeeInn']); ?></div></td>

</tr>

		<?php $sNo++; } ?>


<tr>
	<td colspan="11" valign="top" style="padding:0px;">
		<div class="card-footer text-right" style="overflow:hidden;width: 100%; ">
			<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
			<div class="pagingnumbers"><?php echo $paging; ?></div>
		</div>
	</td>
</tr>

                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <!--end col-->
         <!-- end row -->
      </div>
      <!-- End Page-content -->
   </div>
</div>