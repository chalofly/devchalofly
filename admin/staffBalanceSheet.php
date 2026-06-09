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
                  Balance Sheet - <?php echo $getUserDetails['firstName']; ?>
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
                                 <input name="keyword" type="text" class="form-control" id="keyword" placeholder="Reference No." value="<?php echo $_REQUEST['keyword']; ?>"  >
                              </div>
                           </div>
                           <div class="col-xl-1 mobileforncol">
                              <button class="btn btn-light bg-primary border-primary text-white" type="submit" style="padding: 6px 12px; border-radius:6px; margin-left: 7px; width:100%;height:37px; margin-top: 2px;"><i class="fa fa-search" aria-hidden="true"></i></button>
                           </div>
                           <div class="col-xl-1 mobileforncol">
                              <a href="<?php echo $fullurl; ?>staff-export-balancesheet.php?fromdate=<?php echo $_REQUEST['fromdate']; ?>&todate=<?php echo $_REQUEST['todate']; ?>&status=<?php echo $_REQUEST['status']; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&agentId=<?php echo $_SESSION['userid']; ?>" target="_blank"><button class="btn btn-light bg-primary border-primary text-white" type="button" style="padding: 6px 12px; border-radius:6px; margin-left: 7px; width:100%;height:37px; margin-top: 2px;">Export</button></a>
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
                              <th align="left">Date</th>
                              <th align="left">Account</th>
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

                              $totalCreditAmt=0;
                              $totalDebitAmt=0;
                              $balance=0;

                              $limit=clean($_GET['records']);
                              $page=clean($_GET['page']); 
                              $sNo=1;
                              
                              $targetpage='display.html?ga=staffBalanceSheet&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
                              
                             // $rs=GetRecordList('*','sys_balanceSheet',' where 1 '.$search.' and agentId="'.$_SESSION['userid'].'"  order by id desc ','25',$page,$targetpage); 
							 
                              $rs=GetRecordList('*','sys_balanceSheet',' where 1 '.$search.' order by id desc ','25',$page,$targetpage); 
                                                               
                              $totalentry=$rs[1]; 
                              $paging=$rs[2];  
                                                               
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
							  
							  $getUserDetails = getUserDetails($agentWebsitePages['agentId']);
                              
                              ?>
<tr>
	<td align="left" valign="top"><?php echo date('l d M Y h:i A', strtotime($agentWebsitePages['addDate'])); ?></td>
	
	<td align="left" valign="top"><?php echo $getUserDetails["firstName"]. " ". $getUserDetails["lastName"]; ?></td>
	
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

<tr>
	<td colspan="8" valign="top" style="padding:0px;">
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