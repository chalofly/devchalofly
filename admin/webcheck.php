 
<?php
if($_REQUEST['dltid']!=''){
      deleteRecord('sys_webCheckMaster','id="'.decode($_REQUEST['dltid']).'"');  
   ?>
<script>
   alert('Successfully Deleted!');
   window.location.href = 'display.html?ga=webcheck';
</script>
<?php
   } 
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
                                    <h4 class="card-title cardtitle">Web Check<div class="float-right">
									
									 
									
									
								<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Suppliers') !== false) { ?>	<button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop2('Add Web Check',this,'600px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static"  popaction="action=webcheck" >Add Web Check</button> <?php } ?>
									</div></h4> 
							  
                                        <table class="table">
							<thead>
								<tr>
									<th width="1%">&nbsp;</th>
									<th width="70%">Flight</th>
									<th width="1%">Status</th>
									<th width="10%">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&'; 
$rs=GetRecordList('*','sys_webCheckMaster',' order by id asc  ','75',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){
?>
								
<tr>
<td width="1%" align="left" valign="top"><?php if(isset($rest['logo'])){ ?><img src="upload/<?php echo stripslashes($rest['logo']); ?>" width="50" height="50"><?php } ?></td>
	<td align="left" valign="top"><a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&id=<?php echo encode($rest['id']); ?>&add=1"><?php echo stripslashes($rest['flightName']); ?></a></td>
	<td align="left" valign="top"><?php echo newstatusbadges($rest['status']); ?></td>
	<td align="left" valign="top">
		<div style="display:flex; align-items:center; gap:8px;">
	<button type="button" class="btn alpha-primary text-primary-800 btn-icon" onclick="loadpop2('Edit Web Check',this,'600px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static"  popaction="action=webcheck&id=<?php echo encode($rest['id']); ?>" ><i class="fa fa-pencil" aria-hidden="true"></i></button>
 	<a href="javascript:void(0);" onclick="dltfunction(<?php echo encode($rest['id']); ?>);">
                                          <button type="button" class="btn btn-danger btn-sm">
                                             <i class="fa fa-trash" aria-hidden="true"></i>
                                          </button>
                                    </a>
</div>
</td>
									

							  </tr>
								 <?php $sNo++; } ?>
							</tbody>
						</table>
                           <?php if($sNo==1){ ?>

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

                         
						
						
						
						 
                     

             </div><!--end col-->

            <!-- end row -->

    </div>

        <!-- End Page-content -->

         
    </div>
	</div>	</div>
	<script>
   function dltfunction(id)
   {
      if(confirm('Are you sure your want to delete?'))
      {
        window.location.href = 'display.html?ga=webcheck&dltid='+id;
      }
   }  
 </script>