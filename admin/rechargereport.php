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
                  Recharge Report
                  <div class="newoptionmenu">
                     <form  action="" method="get" enctype="multipart/form-data">
                        <table border="0" cellpadding="0" cellspacing="0">
                           <tr>
                              <td><input type="text" class="form-control" id="startDate" name="startDate" readonly="" placeholder="From" value="<?php echo $startDate; ?>" style="width:130px;"></td>
                              <td style="padding-left:5px;"><input type="text" class="form-control" id="endDate" name="endDate" readonly="" placeholder="From" value="<?php echo $endDate; ?>" style="width:130px;">
							  <input name="page" type="hidden" value="<?php echo $_REQUEST['page']; ?>" /><input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
							  </td>
                              <td style="padding-left:5px;">
                                 <select name="user" class="form-control"  style="width:130px;">
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
                                 <select name="branchId" class="form-control" style="width:130px;">
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
                              <td>&nbsp;</td>
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
                        <table class="table table-hover mb-0">
                           <thead>
                              <tr>
                                 <th>From Account</th>
                                 <th>To Account</th>
                                 <th>Branch</th>
                                 <th>Amount</th>
								 <th>Type</th>
                                 <th>Date</th>
                              </tr>
                           </thead>
							<tbody>
<?php
$search='';

$totalCreditAmt=0;
$totalDebitAmt=0;
$balance=0;

$totalno=0;

$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1;

$targetpage='display.html?ga=rechargereport&user='.$_REQUEST['user'].'&branchId='.$_REQUEST['branchId'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&';

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(addDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(addDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}

if($_REQUEST['user']!=""){
	$search.=' and agentId="'.$_REQUEST['user'].'"';
}

if($_REQUEST['branchId']!=""){
	$search.=' and agentId in (select id from sys_userMaster where usedReferalCode in (select referralCode from sys_userMaster where branchId in (select id from roleMaster where branchId in (select id from branchMaster where id="'.$_REQUEST['branchId'].'" ) ) ) )';
}

if($LoginUserDetails["userType"]!=0){
	$search.=' and agentId in (select id from sys_userMaster where usedReferalCode="'.$LoginUserDetails["referralCode"].'")';
}

$rs=GetRecordList('*','sys_balanceSheet',' where 1 and paymentType="Credit" '.$search.' order by id desc  ','25',$page,$targetpage);

$totalentry=$rs[1];
$paging=$rs[2];

while($rsData=mysqli_fetch_array($rs[0])){

$fromAccount=GetPageRecord('firstName,lastName','sys_userMaster','1 and id="'.$rsData["addedBy"].'"');
$fromAccountData=mysqli_fetch_array($fromAccount);

$agentInfo=GetPageRecord('firstName,lastName,usedReferalCode','sys_userMaster','1 and id="'.$rsData["agentId"].'"');
$agentInfoData=mysqli_fetch_array($agentInfo);

$userInfo=GetPageRecord('firstName,lastName,referralCode,usedReferalCode,branchId','sys_userMaster','1 and referralCode="'.$agentInfoData["usedReferalCode"].'"');
$userInfoData=mysqli_fetch_array($userInfo);


$rst=GetPageRecord('*','roleMaster',' id="'.$userInfoData['branchId'].'"  '); 
$restrole=mysqli_fetch_array($rst);

$rstb=GetPageRecord('*','branchMaster',' id="'.$restrole['branchId'].'"  '); 
$restbranch=mysqli_fetch_array($rstb);
?>
	<tr>
		<td><?php if(mysqli_num_rows($fromAccount)>0){ echo $fromAccountData["firstName"]." ".$fromAccountData["lastName"]; }else{echo "--";} ?></td>
		<td><?php echo $agentInfoData["firstName"]." ".$agentInfoData["lastName"]; ?></td>
		<td><?php echo $restbranch["name"]; ?></td>
		<td><?php echo $rsData["amount"]; ?></td>
		<td><?php echo $rsData["paymentType"]; ?></td>
		<td><?php echo date("d-m-Y H:i:s",strtotime($rsData["addDate"])); ?></td>
	</tr>
<?php $totalno++; } ?>
							
							</tbody>
						</table>
                        <?php if($totalno==1){ ?>
                        <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">Data not found</div>
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