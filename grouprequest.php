<?php
   include "inc.php"; 
   include "config/logincheck.php";  
   $selectedpage=''; 
   $selectleft='group-request'; 
   
   if($LoginUserDetails['userType']=='agent'){ } else {
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
      <title>Flight Group Request - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
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
				  <h1>Flight Group Request</h1>
                     <div class="tbtabcontent" style="border-top-left-radius: 14px;min-height:600px;">
                        <div class="row">
							<div class="col-md-12">
<form  method="post" target="actoinfrm" action="<?php echo $fullurl; ?>frmaction.html" >
<input type="hidden" name="action" value="grouprequest" />
<table >
<tbody>
   <tr>
	   <td>
			<div class="form-group">
				<label for="tripType">Trip Type</label>
				<select class="form-control" name="tripType" id="tripType" required="">
					<option value="">Select</option>
					<option value="OneWay">One Way</option>
					<option value="RoundTrip">Round Trip</option>
				</select>
			</div>
	   </td>
      <td>
         <div class="form-group">
            <label for="sector_id">From</label>
            <div style="height:0px; font-size:0px; position:relative; width: 100%; text-align: left;" id="searchcitylistsfromCity"></div>
            <input type="text" onClick="$('#pickupCitySearchfromCity').select();" class="form-control" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity','fromDestinationFlight','searchcitylistsfromCity');" id="pickupCitySearchfromCity" name="fromcitydesti" value="DEL - NEW DELHI" autocomplete="off">
            <input name="fromDestinationFlight" id="fromDestinationFlight" type="hidden" value="DEL-India" autocomplete="nope">
         </div>
      </td>
      <td>
         <div class="form-group">
            <label for="sector_id">To</label>
            <div style="height:0px; font-size:0px; position:relative; width: 100%; text-align: left;" id="searchcitylistsfromCity2"></div>
            <input type="text" onClick="$('#pickupCitySearchfromCity2').select();" class="form-control" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity2','fromDestinationFlight2','searchcitylistsfromCity2');" id="pickupCitySearchfromCity2" name="tocitydesti" value="BOM - MUMBAI" autocomplete="off" >
            <input name="toDestinationFlight" id="fromDestinationFlight2" type="hidden" value="BOM-India" autocomplete="nope">
         </div>
      </td>
	  
	  <td>
		<div class="form-group">
            <label for="sector_id">Travel Date</label>
			<input type="date" class="form-control" name="fromDate" id="fromDate" required />
		</div>
	  </td>
	  
	  <td id="returnDateDiv" style="display:none;">
		<div class="form-group">
            <label for="sector_id">Return Date</label>
			<input type="date" class="form-control" name="returnDate" id="returnDate" />
		</div>
	  </td>
	  
	  <td>
		<div class="form-group">
            <label for="sector_id">Preferred Airline</label>
			<input type="text" class="form-control" name="preferredAirline" id="preferredAirline" required />
		</div>
	  </td>
	  
	  <td>
		<div class="form-group">
            <label for="sector_id">No. of Travellers</label>
			<input type="text" class="form-control" name="pax" id="pax" required />
		</div>
	  </td>
	</tr>
	
	<tr>
		<td>
			<div class="form-group">
				<label for="sector_id">Class</label>
				<input type="text" class="form-control" name="class" id="class" required />
			</div>
		</td>
		
		<td>
			<div class="form-group">
				<label for="sector_id">Lead Pax Name</label>
				<input type="text" class="form-control" name="leadPaxName" id="leadPaxName" required />
			</div>
		</td>
		<td style="width:20%">
			<div class="form-group">
				<label for="sector_id">Lead Pax Mobile Number</label>
				<input type="text" class="form-control" name="leadPaxNumber" id="leadPaxNumber" required />
			</div>
		</td>
		<td>
			<div class="form-group">
				<label for="sector_id">Remark</label>
				<input type="text" class="form-control" name="remark" id="remark" />
			</div>
		</td>
	</tr>
	
	<tr>
		<td>
			<div class="form-group">
				<input type="submit" class="btn btn-info" name="submit" id="submit" onclick="this.form.submit(); this.disabled=true; this.value='submit...';" value="Submit" />
			</div>
		</td>
	</tr>
</tbody>
</table>

</form>
<script>

$("#tripType").change(function(){
  if(this.value=="RoundTrip"){
		$("#returnDateDiv").show();
		$("#returnDate").val("");
	}else{
		$("#returnDateDiv").hide();
		$("#returnDate").val("");
	}
});

</script>

							</div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- HTML -->
      <?php include "footerinc.php"; ?>
	  
<script>
function getflightSearchCIty(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('admin/searchflightcitylists.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
}
}
</script>
   </body>
</html>