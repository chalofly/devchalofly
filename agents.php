<?php
include "inc.php"; 
include "config/logincheck.php";  
$selectedpage=''; 
$selectleft='agent'; 

if($LoginUserDetails['userType']=='distributor'){ } else {
header("Location:".$fullurl."");
exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Agents - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title> 
<?php include "headerinc.php"; ?>
</head>

<body class="greyouter">
  <?php include "header.php"; ?>



<!--------------Left Menu---------------->


<?php include "left.php"; ?>





<!--------------Mid Body---------------->


<section class="profile">
        <div class="listcontent">

            <div class="card">
                <div class="card-body">
                    <div class="bodysection bodypricesection">
                        <h1>Agents <button type="button" class="bodyhandbuttonright" onClick="loadpop('Top Up Request',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addagent">+ Add Agent</button></h1>
                         
						
                        <div class="tbtabcontent" style="border-top-left-radius: 14px;">
						<div class="row">
						<div class="col-lg-12"> 
<form method="get" id="searchform"  style="margin-bottom:20px; margin-left:5px;">
		<div class="row newinputbookrow">
		 
		<input name="stage" type="hidden" value="<?php echo $_REQUEST['stage']; ?>" />
		
		<div class="col-xl-2"style="padding-right: 0px;">
			<div class="input-group">
	 	<input type="text" name="keyword" class="form-control newsearchsec"  placeholder="Search by name" value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;width:150px;">

<input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
		
			</div>
			</div>
		
				
		 
		
		
			
			
					<div class="col-xl-1 mobileforncol">
 
			<button class="btn btn-light bg-primary border-primary text-white" type="submit" style="padding: 6px 12px; border-radius:6px; margin-left: 7px; width:100%;height:37px; margin-top: 2px;"><i class="fa fa-search" aria-hidden="true"></i></button>
			
			
			</div>
				<div class="col-xl-1 mobileforncol">
			<a href="export-balancesheet.php?fromdate=<?php echo $_REQUEST['fromdate']; ?>&todate=<?php echo $_REQUEST['todate']; ?>&status=<?php echo $_REQUEST['status']; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>" target="_blank"><button class="btn btn-light bg-primary border-primary text-white" type="button" style="padding: 6px 12px; border-radius:6px; margin-left: 7px; width:100%;height:37px; margin-top: 2px;">Export</button></a>

	  

			</div>

				
				
				 	</div>
		</form>
 
</div>
						 
</div>
                        
	<div class="table-responsive">
 

	<table border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" class="table balancesheettable" style=" margin-bottom:0px;">
			<thead>
			<tr style="background-color: #f6f6f6;">
			<th>ID</th>
			
			<th>Company</th>
			<th> Name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Location</th>
			<th width="1%">Status</th>
			<th width="12%">
			
			<div align="center">Wallet&nbsp;(INR)</div>
			
			</th> 
			<th width="1%">
			
			<div align="center">Balance</div>

			</th>
			<th width="1%">Registration Date</th>
			<!--<th width="1%">Action</th>-->
			</thead>
	<tbody> 
<?php
$totalno='1';
$totalmail='0';
$select='';
$where='';
$rs=''; 
$select='*'; 
$wheremain=''; 
$sql='';

if($LoginUserDetails["userType"]==1){
$sql.=' and usedReferalCode="'.$LoginUserDetails["referralCode"].'"';
}

if($_REQUEST["searchusers"]!=""){
$sql.=' and usedReferalCode="'.$_REQUEST["searchusers"].'"';
}

$where=' where (userType="agent") and parentId="'.$LoginUserDetails['id'].'"  and (firstName like "%'.$_REQUEST['keyword'].'%" or lastName like "%'.$_REQUEST['keyword'].'%" or email like "%'.$_REQUEST['keyword'].'%" or mobile like "%'.$_REQUEST['keyword'].'%" or company like "%'.$_REQUEST['keyword'].'%" or agentId like "%'.$_REQUEST['keyword'].'%" or city in ( select id from cityMaster where name like "%'.$_REQUEST['keyword'].'%")) '.$sql.' order by status desc';

$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 

$targetpage='agent?status'.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 

//$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','sys_userMaster','  '.$where.'  ','25',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
?>

<tr>
                                 <td><?php echo stripslashes($rest['agentId']); ?></td>
                                  
                                 <td><?php echo stripslashes($rest['company']); ?></td>
                                 <td><?php echo stripslashes($rest['submitName']); ?> <?php echo stripslashes($rest['firstName']); ?> <?php echo stripslashes($rest['lastName']); ?></td>
                                 <td><?php echo stripslashes($rest['email']); ?></td>
                                 <td><?php if( (trim($rest['mobile']))!='<span class="lightgraytext">Not Provided</span>'){  echo stripslashes($rest['mobileCode']); ?><?php } echo (trim($rest['mobile'])); ?></td>
                                 <td><?php if($rest['city']!=''){ echo getCityName($rest['city']); ?>, <?php echo getCountryName($rest['country']); } else { echo '<span class="lightgraytext">Not Selected</span>'; }?></td>
                                 <td width="1%"><?php echo $rest['status']; ?></td>
                                  
                                  <td width="1%">

                                    <div align="center">

										<?php

										   $a=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet','agentId="'.$rest['id'].'" and paymentType="Credit" and offlineAgent=0 '); 

										   $agentCreditAmt=mysqli_fetch_array($a); 

										   $b=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet','agentId="'.$rest['id'].'" and paymentType="Debit" and offlineAgent=0 '); 

										   $agentDebitAmt=mysqli_fetch_array($b); 

										   echo $totalwalletBalance=round($agentCreditAmt['totalcreditAmt']-$agentDebitAmt['totaldebitAmt']);

										?>

									</div>

                                 </td>
								 
								 <td width="12%" style="text-align:center">

                                     
									<button type="button" style="position:static" class="bodyhandbuttonright" onClick="loadpop('Add Balance',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addbalance&agentId=<?php echo $rest['id']; ?>">Add Balance</button>

                                    

                                 </td>
                     
                                 <td width="1%">
                                    <div align="center" style="width:82px;"><?php if(date('d-m-Y', strtotime($rest['dateAdded']))=='01-01-1970'){ echo '-'; } else {  echo date('d-m-Y', strtotime($rest['dateAdded'])); } ?></div>                                 </td>
									
                                 <!--<td width="1%">
								 
                                    <a class="dropdown-item neweditpan" onClick="loadpop('Top Up Request',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addagent&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>                                 </td>
                              </tr>-->
								
								<?php $totalno++; } ?>
								<tr>
								  <td colspan="10" valign="top" style="padding:0px;"><div class="card-footer text-right" style="overflow:hidden;width: 100%; ">
		 
										<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
											<div class="pagingnumbers"><?php echo $paging; ?></div>
											
						 
			  </div></td>
							  </tr>
							</tbody>
		      </table>
					 

		    </div>

					  

            </div>

        </div>
        </div>
        </div>
        </div>
    </section>




<!-- HTML -->




  <?php include "footerinc.php"; ?>

</body>
</html>
