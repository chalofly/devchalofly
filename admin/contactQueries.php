<?php 
   $u = decode($_REQUEST['u']);
   
   if($_REQUEST['u']==''){
   $u=$_SESSION['userid'];
   }
   $abcd=GetPageRecord('*','userMaster','id="'.$u.'"'); 
   $result=mysqli_fetch_array($abcd); 
   if($_REQUEST['dltid']!=''){
      deleteRecord('contactQueries','id="'.decode($_REQUEST['dltid']).'"');  
   ?>
<script>
   alert('Successfully Deleted!');
   window.location.href = 'display.html?ga=contactQueries';
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
                        <h4 class="card-title cardtitle">
                           Contact Queries
                           <div class="float-right">
                              <form  action=""  class="newsearchsecform"  style="left:80px;"  method="get" enctype="multipart/form-data">	
                                 <input type="text" name="keyword" class="form-control newsearchsec"  placeholder="Search by name"  value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;">
                                 <input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
                              </form>
                              
                           </div>
                        </h4>
                        <table class="table table-hover mb-0">
                           <thead>
                              <tr>
                                 <th>S.No</th>
                                 <th>Name</th>
                                 <th>Email</th>
                                 <th>Mobile</th>
                                 <th>Message</th>
								 <th>Date</th>
                         <th>Action</th>
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
                                 
                                 $where=' where name like "%'.$_REQUEST['keyword'].'%" or email like "%'.$_REQUEST['keyword'].'%" or mobile like "%'.$_REQUEST['keyword'].'%" order by id desc'; 
                                 $limit=clean($_GET['records']);
                                 $page=clean($_GET['page']); 
                                 $sNo=1; 
                                 $targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
                                 $rs=GetRecordList('*','contactQueries','  '.$where.'  ','25',$page,$targetpage);
                                 
                                 $totalentry=$rs[1];
                                 
                                 $paging=$rs[2];  
                                 while($rest=mysqli_fetch_array($rs[0])){ 
                                 ?>
                              <tr>
                                 <td><?php echo $totalno; ?></td>
								 
                                 <td><?php echo stripslashes($rest['name']); ?></br>
								 <?php if($rest['pnr'] != "") { echo 'PNR: '.stripslashes($rest['pnr']); } ?></br>
								 <?php if($rest['msgtype'] != "") { echo 'Msg: '.stripslashes($rest['msgtype']); } ?>
								 </td>
								 
                                 <td><?php echo checkemail(stripslashes($rest['email'])); ?></td>
								 
                                 <td><?php if(checkmobile(trim($rest['mobile']))!='<span class="lightgraytext">Not Provided</span>'){  echo stripslashes($rest['mobileCode']); ?><?php } echo checkmobile(trim($rest['mobile'])); ?></td>
                                
                                 <td width="1%"><?php echo ($rest['message']); ?></td>
                               
                                 <td width="1%">
                                    <div align="center" style="width:82px;"><?php if(date('d-m-Y', strtotime($rest['created_at']))=='01-01-1970'){ echo '-'; } else {  echo date('d-m-Y', strtotime($rest['created_at'])); } ?></div>
                                 </td>
                               <td width="5%">
                                 <div style="display:flex; align-items:center; gap:8px;">
                                   
                                    <!-- DELETE BUTTON -->
                                    <a href="javascript:void(0);" onclick="dltfunction(<?php echo encode($rest['id']); ?>);">
                                          <button type="button" class="btn btn-danger btn-sm">
                                             <i class="fa fa-trash" aria-hidden="true"></i>
                                          </button>
                                    </a>

                                 </div>
                              </td>
                              </tr>
                              <?php $totalno++; } ?>
                           </tbody>
                        </table>
                        <?php if($totalno==1){ ?>
                        <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Queries</div>
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
   function dltfunction(id)
   {
      if(confirm('Are you sure your want to delete?'))
      {
        window.location.href = 'display.html?ga=contactQueries&dltid='+id;
      }
   }  
 </script>