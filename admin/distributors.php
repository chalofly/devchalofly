<?php
$u = decode($_REQUEST['u']);

if($_REQUEST['u']==''){

$u=$_SESSION['userid'];

}

$abcd=GetPageRecord('*','userMaster','id="'.$u.'"'); 

$result=mysqli_fetch_array($abcd); 

?> 

<div class="wrapper">

   <div class="container-fluid">

      <div class="main-content">

         <div class="page-content">

            <!-- start page title -->

            <div class="row">

               <div class="col-md-12 col-xl-12">

                  <div class="card" style="min-height:500px;">

                     <div class="card-body" style="padding:0px;">

                        <h4 class="card-title cardtitle">

                           Distributors

                           <div class="float-right">

                              <form  action="" class="newsearchsecform" style="left:80px;"  method="get" enctype="multipart/form-data">

<table border="0" cellpadding="0" cellspacing="0" style="margin-bottom:10px;">

	<tr>

		<td style="padding:5px;">

<input type="text" name="keyword" class="form-control newsearchsec"  placeholder="Search by name" value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;width:150px;">

<input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />

		</td>

	<?php

	if($LoginUserDetails["userType"]==0){

	?>

		<td style="padding:5px;">

<select name="searchusers" class="form-control" style="width:150px;">

	<option value="">All Users</option>

    <?php  

		$rs22=GetPageRecord('referralCode,firstName,lastName','sys_userMaster',' 1 and userType="1" order by firstName desc'); 

        while($restuser=mysqli_fetch_array($rs22)){ 

	?>

    <option value="<?php echo $restuser['referralCode']; ?>" <?php if($restuser['referralCode']==$_REQUEST['searchusers']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($restuser['firstName']); ?> <?php echo stripslashes($restuser['lastName']); ?></option>

    <?php } ?>

</select>

		</td>

	<?php } ?>

		 <td style="padding-left:5px;"><button type="submit" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px;"  ><i class="fa fa-search" aria-hidden="true"></i> Search</button></td>

</table>								 



                              </form>

                              <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop2('Add Distributor',this,'600px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static"  popaction="action=addDistributor" >Add Distributor</button> 

                           </div>

                        </h4>

                        <table class="table table-hover mb-0">

                           <thead>

                              <tr>

                                 <th>ID</th>

                                 <th>Company</th>
								<th>Emp Refral</th>
                                 <th> Name</th>

                                 <th>Email</th>

                                 <th>Mobile</th>

                                 <th>Location</th>

                                 <th width="1%">Status</th>

                                 <th width="12%">

                                    <div align="center">Wallet&nbsp;(INR)</div>                                 </th>

                                 <th width="1%">

                                    <div align="center">Balance</div>                                 </th>

                                 <th width="1%">Registration Date</th>

                                 <th width="1%">&nbsp;</th>
                              </tr>
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



$where=' where (userType="distributor") and (firstName like "%'.$_REQUEST['keyword'].'%" or lastName like "%'.$_REQUEST['keyword'].'%" or email like "%'.$_REQUEST['keyword'].'%" or mobile like "%'.$_REQUEST['keyword'].'%" or company like "%'.$_REQUEST['keyword'].'%" or agentId like "%'.$_REQUEST['keyword'].'%" or city in ( select id from cityMaster where name like "%'.$_REQUEST['keyword'].'%")) '.$sql.' order by status desc';



$limit=clean($_GET['records']);

$page=clean($_GET['page']); 

$sNo=1; 

$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 

$rs=GetRecordList('*','sys_userMaster','  '.$where.'  ','25',$page,$targetpage);



                                 $totalentry=$rs[1];

                                 

                                 $paging=$rs[2];  

                                 while($rest=mysqli_fetch_array($rs[0])){ 

                                 ?>

                              <tr>

                                 <td><?php echo stripslashes($rest['agentId']); ?></td>

                                 <td><?php echo stripslashes($rest['company']); ?></td>
								 <td><?php echo stripslashes($rest['usedReferalCode']); ?></td>

                                 <td><?php echo stripslashes($rest['submitName']); ?> <?php echo stripslashes($rest['firstName']); ?> <?php echo stripslashes($rest['lastName']); ?></td>

                                 <td><?php echo checkemail(stripslashes($rest['email'])); ?></td>

                                 <td><?php if(checkmobile(trim($rest['mobile']))!='<span class="lightgraytext">Not Provided</span>'){  echo stripslashes($rest['mobileCode']); ?><?php } echo checkmobile(trim($rest['mobile'])); ?></td>

                                 <td><?php if($rest['city']!=''){ echo getCityName($rest['city']); ?>, <?php echo getCountryName($rest['country']); } else { echo '<span class="lightgraytext">Not Selected</span>'; }?></td>

                                 <td width="1%"><?php echo newstatusbadges($rest['status']); ?></td>

                                 <td width="12%">

                                    <div align="center">

										<?php

										   $a=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet','agentId="'.$rest['id'].'" and paymentType="Credit" and offlineAgent=0 '); 

										   $agentCreditAmt=mysqli_fetch_array($a); 

										   $b=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet','agentId="'.$rest['id'].'" and paymentType="Debit" and offlineAgent=0 '); 

										   $agentDebitAmt=mysqli_fetch_array($b); 

										   echo $totalwalletBalance=round($agentCreditAmt['totalcreditAmt']-$agentDebitAmt['totaldebitAmt']);

										?>
									</div>                                 </td>

                                 <td width="1%">

                                    <div align="center"><a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&id=<?php echo encode($rest['id']); ?>&view=1">

                                       <button type="button" class="btn btn-primary btn-sm">View</button>

                                       </a>                                    </div>                                 </td>

                                 <td width="1%">

                                    <div align="center" style="width:82px;"><?php if(date('d-m-Y', strtotime($rest['dateAdded']))=='01-01-1970'){ echo '-'; } else {  echo date('d-m-Y', strtotime($rest['dateAdded'])); } ?></div>                                 </td>

                                 <td width="1%">
<?php if($_SESSION['userid']==1){ ?>
                                    <a class="dropdown-item neweditpan" onclick="loadpop2('Edit Distributor',this,'600px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static"  popaction="action=addDistributor&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>   <?php } ?>                              </td>
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