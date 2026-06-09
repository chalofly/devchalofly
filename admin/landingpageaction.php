<?php
include "config/database.php"; 
include "config/function.php"; 
include "config/setting.php"; 

function getUserNameNew($id){
$a=GetPageRecord('firstName','sys_userMaster','id="'.$id.'"'); 
$displayData=mysqli_fetch_array($a);
return $displayData['firstName'];
}

?>
<script src="<?php echo $landingpagedatas; ?>assets/scripts/jquery-3.4.1.js"> </script>

<?php if($_POST['action']=='submitquery' &&  $_POST['clientName']!='' ){


$startDate=date('Y-m-d',strtotime($_POST["startDate"]));   
$endDate=date('Y-m-d',strtotime($_POST["endDate"]));     
$submitName=addslashes($_POST['submitName']);  

$name=addslashes($_POST['clientName']); 
$mobile=addslashes($_POST['mobileNumber']);   
$email=addslashes($_POST['clientEmail']);   
$details=addslashes($_POST['enquiryFor']); 
$adult=addslashes($_POST['adult']);
$child=addslashes($_POST['child']);
$destination=addslashes($_POST['destination']);
	
//$where='id!=1'; 
//$aaa=GetPageRecord('id','sys_userMaster','1 order by id rand()',$where); 
$addedBy= 404;
 
$dateAdded=date('Y-m-d H:i:s');
 
 
$bb=GetPageRecord('*','userMaster','email="'.$email.'" and userType=4');   
$clientidcheck=mysqli_fetch_array($bb);
 

if($clientidcheck['email']==''){

$namevalue4 ='userType="4",submitName="'.$submitName.'",firstName="'.$name.'",mobile="'.$mobile.'",status=1,email="'.$email.'",addedBy="'.$addedBy.'",dateAdded="'.time().'"';
$clientId=addlistinggetlastid('userMaster',$namevalue4); 

} else {
 
$clientId=$clientidcheck['id'];

}

  
$rs=GetPageRecord('*','sys_userMaster','id=1 '); 
$invoicedataa=mysqli_fetch_array($rs);



//cityId
//destinationId

$rs1=GetPageRecord('*','cityMaster','name="'.$destination.'"');
$editresult=mysqli_fetch_array($rs1);
$destinationId=$editresult['id']; 



$namevalue ='startDate="'.$startDate.'",endDate="'.$endDate.'",clientId="'.$clientId.'",name="'.$name.'",phone="'.$mobile.'",countryId=101,email="'.$email.'",serviceId=1,adult="'.$adult.'",child="'.$child.'",destinationId="'.$destinationId.'",cityId="'.$destinationId.'",infant=0,assignTo=1,leadSource=43,details="'.$details.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"'; 

$queryId=addlistinggetlastid('queryMaster',$namevalue);   



$rs=GetPageRecord('*', 'sys_packageBuilder', 'name="'.$details.'"'); 
$package=mysqli_fetch_array($rs);



$a=GetPageRecord('*','sys_packageBuilder','name="'.$details.'"');   
$packagedata=mysqli_fetch_array($a);



  

$namevalue ='name="'.addslashes($packagedata['name']).''.'",startDate="'.$packagedata['startDate'].'",endDate="'.$packagedata['endDate'].'",adult="'.$packagedata['adult'].'",child="'.$packagedata['child'].'",days="'.$packagedata['days'].'",destinations="'.$packagedata['destinations'].'",notes="'.addslashes($packagedata['notes']).'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",inclusionExclusion="'.addslashes($packagedata['inclusionExclusion']).'",depositAmount="'.$packagedata['depositAmount'].'",depositDueDate="'.$packagedata['depositDueDate'].'",billingType=1,bookingDays="'.$packagedata['bookingDays'].'",grossPrice="'.$packagedata['grossPrice'].'",netPrice="'.$packagedata['netPrice'].'",extraMarkup="'.$packagedata['extraMarkup'].'",linkSharing="'.$packagedata['linkSharing'].'",coverPhoto="'.$packagedata['coverPhoto'].'",terms="'.addslashes($packagedata['terms']).'",queryId="'.$queryId.'"';   

$lstaddid=addlistinggetlastid('sys_packageBuilder',$namevalue);


$rs=GetPageRecord('*','sys_PackageTips',' packageId="'.$packagedata['id'].'" order by id asc');

while($eventDatatips=mysqli_fetch_array($rs)){   



$namevalue ='packageId="'.$lstaddid.'",title="'.addslashes($eventDatatips['title']).'",description="'.addslashes($eventDatatips['description']).'",iconset="'.addslashes($eventDatatips['iconset']).'"';   

addlistinggetlastid('sys_PackageTips',$namevalue); 



}



  

  

$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$packagedata['id'].'" order by id asc');

while($eventData=mysqli_fetch_array($rs)){  





$namevalue ='packageId="'.$lstaddid.'",startDate="'.$eventData['startDate'].'",endDate="'.$eventData['endDate'].'",checkIn="'.$eventData['checkIn'].'",checkOut="'.$eventData['checkOut'].'",singleRoom="'.$eventData['singleRoom'].'",doubleRoom="'.$eventData['doubleRoom'].'",tripleRoom="'.$eventData['tripleRoom'].'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",quadRoom="'.$eventData['quadRoom'].'",cwbRoom="'.$eventData['cwbRoom'].'",cnbRoom="'.$eventData['cnbRoom'].'",name="'.addslashes($eventData['name']).'",hotelCategory="'.$eventData['hotelCategory'].'",hotelRoom="'.addslashes($eventData['hotelRoom']).'",mealPlan="'.addslashes($eventData['mealPlan']).'",sectionType="'.$eventData['sectionType'].'",days="'.$eventData['days'].'",transferCategory="'.$eventData['transferCategory'].'",vehicle="'.$eventData['vehicle'].'",packageDays="'.$eventData['packageDays'].'",mealCategory="'.addslashes($eventData['mealCategory']).'",description="'.addslashes($eventData['description']).'",adultCost="'.$eventData['adultCost'].'",childCost="'.$eventData['childCost'].'",markupPercent="'.$eventData['markupPercent'].'",markupValue="'.$eventData['markupValue'].'",singleRoomCost="'.$eventData['singleRoomCost'].'",doubleRoomCost="'.$eventData['doubleRoomCost'].'",tripleRoomCost="'.$eventData['tripleRoomCost'].'",quadRoomCost="'.$eventData['quadRoomCost'].'",cwbRoomCost="'.$eventData['cwbRoomCost'].'",cnbRoomCost="'.$eventData['cnbRoomCost'].'",daySubject="'.addslashes($eventData['daySubject']).'",dayDetails="'.addslashes($eventData['dayDetails']).'",eventPhoto="'.$eventData['eventPhoto'].'",flightNo="'.$eventData['flightNo'].'",fromDestination="'.$eventData['fromDestination'].'",toDestination="'.$eventData['toDestination'].'",flightDuration="'.$eventData['flightDuration'].'",destinationName="'.$eventData['destinationName'].'"';   

addlistinggetlastid('sys_packageBuilderEvent',$namevalue); 
} 

$namevalue3 ='details="Query Created",queryId="'.$queryId.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",logType="add_query"'; 
addlisting('queryLogs',$namevalue3); 
?>
<script>alert('Thank you! Your query has been submitted see you soon');</script>

<?php


$clientName=$submitName . $name;
$clientMobile=$mobile;
$userName=getUserNameNew(1);
$travelDate=date("d M Y",strtotime($startDate));
$pax=urlencode($adult.' Adult + '.$child.' Child');

$data='https://api.easysocial.in/api/v1/wa-templates/send/clbknqlvp0ci09naicpy82iw9/90/78/API/91'.urlencode($clientMobile).'?header1=https://storage.googleapis.com/easysocial_production/iyaatra/iyaatra-welcome.png&body1='.urlencode($clientName).'&body2='.urlencode($userName).'&body3='.urlencode($destination).'&body4='.encode($queryId).'&body5='.urlencode($travelDate).'&body6='.$pax;


file_get_contents($data);

header("Location: ".$fullurlproposal."sharepackage/".$_REQUEST['packageId']."/package.html");
  
?>

<script>

parent.$('#clientName').val('');
parent.$('#addeditfrm').hide();
parent.$('#thanksmsg').show();
</script>
 
 <?php
 
}