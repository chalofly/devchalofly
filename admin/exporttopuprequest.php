<?php 
include "inc.php"; 
include "config/logincheck.php"; 

$managerwhere='';
if($LoginUserDetails['userType']!=0){
exit();
}

header('Content-type: application/excel');
$filename = 'topup_request_'.mt_rand().'.xls';
header('Content-Disposition: attachment; filename='.$filename);
$data = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">
<head>
    <!--[if gte mso 9]>
    <xml>
        <x:ExcelWorkbook>
            <x:ExcelWorksheets>
                <x:ExcelWorksheet>
                    <x:Name>Sheet 1</x:Name>
                    <x:WorksheetOptions>
                        <x:Print>
                            <x:ValidPrinterInfo/>
                        </x:Print>
                    </x:WorksheetOptions>
                </x:ExcelWorksheet>
            </x:ExcelWorksheets>
        </x:ExcelWorkbook>
    </xml>
    <![endif]-->
</head>

<body>	
			<table>
				<tr>
					<th>SN</th>
					<th>Agent Info</th>
                                 <th>Contact</th>
                                 <th>Reference Number</th>
                                 <th>Request Date</th>
                                 <th>Requested Amount</th>
                                 <th>Mode of Payment</th>
                                 <th>Notes</th>
                                 <th>Status</th>
				</tr>';
				
$search='';
$sn=1;

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
                                 
 

$query=GetPageRecord('*','offlineRechargeRequest','1 '.$search.' order by id desc'); 
while($rest=mysqli_fetch_array($query)){


$agent=GetPageRecord('*','sys_userMaster','id="'.$rest['agentId'].'" order by id asc');
$agentInfo=mysqli_fetch_array($agent);

if($rest['referenceNumber']!=''){ $referenceNumber = stripslashes($rest['referenceNumber']); } else{$referenceNumber = "---";}

		$data .= '<tr>
					<td>'.$sn.'</td>
					<td>'.$agentInfo['agentId'].' - '.stripslashes($agentInfo['companyName']).'</td>
					<td>'.stripslashes($agentInfo['phone']).'</td>
					<td>'.$referenceNumber.'</td>
					<td>'.date('d-m-Y',strtotime($rest['addDate'])).'</td>
					<td>'.stripslashes($rest['requestedAmount']).' INR</td>
					<td>'.$rest['paymentMode'].'</td>
					<td>'.$rest['note'].'</td>
					<td>'.$rest['status'].'</td>
				</tr>';
$sn++;
}

		$data .= '
			</table>
</body>
</html>';
echo $data;

?>