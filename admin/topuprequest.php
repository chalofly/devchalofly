<?php

   if($_REQUEST['startDate']!='' && $_REQUEST['endDate']!='' ){

   $startDate=date('d-m-Y',strtotime($_REQUEST['startDate']));

   $endDate=date('d-m-Y',strtotime($_REQUEST['endDate']));

   } else {

   $startDate=date('d-m-Y',strtotime('-30 Days'));

   $endDate=date('d-m-Y');

   }



   $totalno='1';

   $totalmail='0';

   $select='';

   $where='';

   $rs='';  

   $wheremain=''; 

   

   $searchwhere='';

   $searchwhereuser='';

   $mainwhere=''; 

   $noteswhere='';

   

   

   if($LoginUserDetails['userType']!=0){ 

   $mainwhere=' and (addedBy="'.$_SESSION['userid'].'" or  assignTo="'.$_SESSION['userid'].'")  ';

   

   if($_REQUEST['statusid']==1){ 

   $noteswhere='and id in (select queryId from queryNotes) and statusId=1';

   }

   

   if($_REQUEST['statusid']==''){ 

   $noteswhere='and id in (select queryId from queryNotes)';

   }

   

   } else {

   $mainwhere=' and 1 '; 

   }

   

   

   

   $searchcity='';

   if($_REQUEST['searchcity']!=''){

   $searchcity=' and  destinationId="'.$_REQUEST['searchcity'].'"';

   }

   

   

   $searchsource='';

   if($_REQUEST['searchsource']!=''){

   $searchsource=' and  leadSource="'.$_REQUEST['searchsource'].'"';

   }

   

   

   

   

   

   $searchusers=''; 

   if($_REQUEST['searchusers']!=''){

    $searchusers=' and assignTo in (select id from sys_userMaster where id="'.$_REQUEST['searchusers'].'") ';

   }

   

   $statusid='';

   if($_REQUEST['statusid']!=''){

   $statusid=' and  statusId="'.$_REQUEST['statusid'].'"';

   }

   

   if($_REQUEST['keyword']!=''){

   $searchwhereuser=' and (id="'.decode($_REQUEST['keyword']).'" or clientId in (select id from userMaster where firstName like "%'.$_REQUEST['keyword'].'%" or lastName like "%'.$_REQUEST['keyword'].'%"  or mobile like "%'.$_REQUEST['keyword'].'%" or email like "%'.$_REQUEST['keyword'].'%") )';

   }

   

   $wheresdate='  and date(dateAdded)<="'.date('Y-m-d',strtotime($endDate)).'" and  date(dateAdded)>="'.date('Y-m-d',strtotime($startDate)).'"   '; 

   

   $destinationIdwhere='';

   if($_REQUEST['searchcity']!=''){

    $destinationIdwhere='  and destinationId='.$_REQUEST['searchcity'].'   '; 

   }

    

   

   ?>

<style>

   .table td, .table th {

   vertical-align: top;

   }

   .statusbox{margin-right: 5px; padding: 10px; text-align: center; background-color: #000000; font-size: 13px; color: #fff; border-radius: 4px; text-transform:uppercase;}

   .notes{font-size: 12px; background-color: #FFFFCC; border: 1px solid #FFCC33; padding: 0px 5px; color: #ff6a00; font-weight: 600; float: left; margin-top: 2px; border-radius: 2px;}

</style>

<div class="wrapper">

   <div class="container-fluid">

      <div class="main-content">

         <div class="page-content">

            <div class="newboxheading">

               <div class="newhead">

                  Topup Request

                  <div class="newoptionmenu">

                     <form  action="" method="get" enctype="multipart/form-data">

                        <table border="0" cellpadding="0" cellspacing="0">

                           <tr>

                              <td><input type="text" class="form-control" id="startDate" name="startDate" readonly="" placeholder="From" value="<?php echo $startDate; ?>" style="width:130px;"></td>

                              <td style="padding-left:5px;"><input type="text" class="form-control" id="endDate" name="endDate" readonly="" placeholder="From" value="<?php echo $endDate; ?>" style="width:130px;">

							  <input name="page" type="hidden" value="<?php echo $_REQUEST['page']; ?>" /><input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />

							  </td>

                              <td style="padding-left:5px;">

                                 <select name="user" id="user" class="form-control"  style="width:130px;">

                                    <option value="" >All Agents</option>

<?php  



	$qryRef='';

	if($LoginUserDetails["userType"]!=0){

		$qryRef.=' and usedReferalCode="'.$LoginUserDetails["referralCode"].'"';

	}



$rs22=GetPageRecord('id,firstName,lastName','sys_userMaster',' 1 and userType="agent" '.$qryRef.' order by firstName desc'); 

while($restuser=mysqli_fetch_array($rs22)){ 

?>

<option value="<?php echo $restuser['id']; ?>" <?php if($restuser['id']==$_REQUEST['user']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($restuser['firstName']); ?> <?php echo stripslashes($restuser['lastName']); ?></option>

                                    <?php } ?>

                                 </select>

                              </td>



							  <td style="padding-left:5px;">

                                 <select name="paymentMode" id="paymentMode" class="form-control" style="width:130px;">

<option value="">All Payment Mode</option>

<option value="Cash" <?php if('Cash'==$_REQUEST['paymentMode']){ ?>selected="selected"<?php } ?>>Cash</option>

<option value="Cheque" <?php if('Cheque'==$_REQUEST['paymentMode']){ ?>selected="selected"<?php } ?>>Cheque</option>

<option value="NEFT" <?php if('NEFT'==$_REQUEST['paymentMode']){ ?>selected="selected"<?php } ?>>NEFT</option>

<option value="DD" <?php if('DD'==$_REQUEST['paymentMode']){ ?>selected="selected"<?php } ?>>DD</option>

<option value="Credit" <?php if('Credit'==$_REQUEST['paymentMode']){ ?>selected="selected"<?php } ?>>Credit</option>

                                 </select>

								 

								

                              </td>

							  

							  <td style="padding-left:5px;">

                                 <select name="branchId" id="branchId" class="form-control" style="width:130px;">

<option value="">All Branch</option>

<?php

$rsBranch=GetPageRecord('*','branchMaster','1 and name!="" order by id desc'); 

while($rsBranchData=mysqli_fetch_array($rsBranch)){ 

?>

<option value="<?php echo $rsBranchData['id']; ?>" <?php if($rsBranchData['id']==$_REQUEST['branchId']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($rsBranchData['name']); ?></option>

                                    <?php } ?>

                                 </select>

                              </td>

                              

                              <td style="padding-left:5px;"><button type="submit" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button></td>

                            <?php

                            if($LoginUserDetails['userType']==0){



                            ?>

                              <td style="padding-left:5px;"><button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px;" onclick="exportData();"><i class="fa fa-excel" aria-hidden="true"></i> Export</button></td>

                           <?php } ?>

                           </tr>

                        </table>

                     </form>

                  </div>

               </div>

            </div>

            <!-- start page title -->

            <div class="">

               <div class="col-md-12 col-xl-12" style="padding-top: 32px;">

                  <div class="card" style="min-height:500px;">

                     <div class="card-body"  style="padding:0px;">

                        <table class="table">

                           <thead>

                              <tr>

                                 <th>Agent Info</th>

                                 <th>Contact</th>

                                 <th>Reference Number</th>

                                 <th>Request Date</th>

                                 <th>Requested Amount</th>

                                 <th>Attachment</th>

                                 <th>Mode of Payment</th>

                                 <th>Notes</th>

                                 <th>Status</th>

                                 <th>&nbsp;</th>

                              </tr>

                           </thead>

                           <tbody>

                              <?php 

                                 $limit=clean($_GET['records']);

                                 $page=clean($_GET['page']); 

                                 $sNo=1;

                                 $search='';

                                 

                                 if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){

                                 $search.=' and DATE(addDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(addDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';

                                 }

                                 

                                 

                                 if($_REQUEST['agentId']!=''){

                                 $search.=' and agentId="'.$_REQUEST['agentId'].'" ';

                                 }

								 

if($_REQUEST['user']!=""){

	$search.=' and agentId="'.$_REQUEST['user'].'"';

}



if($_REQUEST['branchId']!=""){

	$search.=' and agentId in (select id from sys_userMaster where usedReferalCode in (select referralCode from sys_userMaster where branchId in (select id from roleMaster where branchId in (select id from branchMaster where id="'.$_REQUEST['branchId'].'" ) ) ) )';

}

                                 

if($_REQUEST['paymentMode']!=''){

	$search.=' and paymentMode="'.$_REQUEST['paymentMode'].'" ';

}

                                 

                                 

if($_REQUEST['status']!=''){

	$search.=' and status="'.$_REQUEST['status'].'" ';

}

                                 

if($_REQUEST['requestedAmount']!=''){

	$search.=' and requestedAmount="'.$_REQUEST['requestedAmount'].'" ';

}

                                 

if($LoginUserDetails["userType"]!=0){

	$search.=' and agentId in (select id from sys_userMaster where usedReferalCode="'.$LoginUserDetails["referralCode"].'")';

}

                                 

$targetpage='display.html?ga='.$_REQUEST['ga'].'&paymentMode='.$_REQUEST['paymentMode'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&user='.$_REQUEST['user'].'&branchId='.$_REQUEST['branchId'].'&'; 

                                 

$rs=GetRecordList('*','offlineRechargeRequest','where 1 '.$search.' order by id desc','25',$page,$targetpage);



$totalentry=$rs[1]; 

$paging=$rs[2];  

                                 

while($rest=mysqli_fetch_array($rs[0])){

                                 

//Agent Info

$agent=GetPageRecord('*','sys_userMaster','id="'.$rest['agentId'].'" order by id asc');

$agentInfo=mysqli_fetch_array($agent);

                                 ?>

                              <tr>

                                 <td align="left" valign="top"><strong><?php  echo ($agentInfo['agentId']); ?></strong> - <strong><?php echo stripslashes($agentInfo['companyName']); ?></strong></strong></td>

                                 <td align="left" valign="top"><?php echo stripslashes($agentInfo['phone']); ?></td>

                                 <td align="left" valign="top"><strong><?php if($rest['referenceNumber']!=''){ echo stripslashes($rest['referenceNumber']); } else{echo "---";}?></strong></td>

                                 <td align="left" valign="top"><?php echo date('d-m-Y',strtotime($rest['addDate'])); ?></td>

                                 <td align="left" valign="top"><?php echo stripslashes($rest['requestedAmount']); ?> INR</td>

                                 <td align="left" valign="top"><?php if($rest['attachment']!=''){ ?><a target="_blank" href="upload/<?php echo stripslashes($rest['attachment']); ?>">View</a><?php }else{echo "--";} ?></td>

                                 <td align="left" valign="top"><?php echo $rest['paymentMode']; ?></td>

                                 <td align="left" valign="top"><?php echo $rest['note']; ?></td>

                                 <td align="left" valign="top" style="text-transform:uppercase;"><?php echo $rest['status']; ?></td>

                                 <td align="left" valign="top" style="text-transform:uppercase;">
									<?php if($_SESSION['userid']==1){ ?>
                                    <?php if($rest['status']!='approved'){ ?>

                                    <button type="button" class="btn btn-secondary btn-sm" onclick="loadpop('Update Topup Request Status',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=topupUpdateStatus&id=<?php echo encode($rest['id']); ?>">Update Status</button>
									<?php }?>
                                    <?php }?>	

                                 </td>

                              </tr>

                              <?php $sNo++; } ?>

                           </tbody>

                        </table>

                        <?php if($sNo==1){ ?>

                        <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Data </div>

                        <?php } else { ?>

                        <div class="mt-3 pageingouter">

                           <div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>

                           <div class="pagingnumbers"><?php echo $paging; ?></div>

                        </div>

                        <?php } ?>

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

</div>

<script>

   $( function() {

      $( "#startDate" ).datepicker({ 

     dateFormat: 'dd-mm-yy' 

        });

     

     $( "#endDate" ).datepicker({ 

     dateFormat: 'dd-mm-yy' 

        });

    } );

</script>

<script>

   function exportData(){

   var startDate = $('#startDate').val();  

   var endDate = $('#endDate').val();  

   var user = $('#user').val();  

   var paymentMode = $('#paymentMode').val();  

   var branchId = $('#branchId').val();  

   

   	window.location.href="<?php echo $fullurl; ?>exporttopuprequest.php?startDate="+startDate+"&endDate="+endDate+"&user="+user+"&paymentMode="+paymentMode+"&branchId="+branchId;



   }

</script>