<?php 

   $u = decode($_REQUEST['u']);

   

   if($_REQUEST['u']==''){

   $u=$_SESSION['userid'];

   }

   $abcd=GetPageRecord('*','userMaster','id="'.$u.'"'); 

   $result=mysqli_fetch_array($abcd);  
   if($_REQUEST['dltid']!=''){
      deleteRecord('popularDestinations','id="'.decode($_REQUEST['dltid']).'"');  
   ?>
<script>
   alert('Successfully Deleted!');
   window.location.href = 'display.html?ga=popular-destinations';
</script>
<?php
   } 
   ?>

<div class="wrapper">

   <div class="container-fluid">

      <div class="main-content">

         <div class="page-content">

            <div class="newboxheading">

               <div class="newhead">

                  Popular Airline Destinations

                  <div class="newoptionmenu">

                     <div> <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop2('Add Popular Destination',this,'600px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static" popaction="action=addpopulardestination">Add</button></div>

                     <div>

                        <form action="" class="" style="left:172px;"  method="get" enctype="multipart/form-data">	

                           <input type="text" name="keyword" class="form-control newsearchsec"  placeholder="Search by name"  value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;">

                           <input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />

                        </form>

                     </div>

                  </div>

               </div>

            </div>

            <!-- start page title -->

            <div class="">

               <div class="col-md-12 col-xl-12" style="padding-top:32px;">

                  <div class="card">

                     <div class="card-body">

                        <table class="table table-hover mb-0">

                           <thead>

                              <tr>

                                 <th width="18%">Destination</th>

                                 <th width="18%">From Sector</th>

                                 <th width="18%">To Sector</th>

                                 <th width="18%">Starting Price</th>

                                 <th width="15%">Status</th>

                                 <th width="15%">Type</th>

                                 <th width="4%">&nbsp;</th>

                              </tr>

                           </thead>

                           <tbody>

                              <?php

                                 $where4='';

                                 if($_REQUEST['keyword']!=''){

                                 $where4=' and (fromSector like "%'.$_REQUEST['keyword'].'%" or toSector like "%'.$_REQUEST['keyword'].'%")';

                                 }



                                 $totalno='1';

                                 $select='';

                                 $where='';

                                 $rs=''; 

                                 $select='*'; 

                                 $wheremain=''; 

                                 $where=' where 1 '.$where4.'  order by destinationId,id desc'; 

                                 $limit=clean($_GET['records']);

                                 $page=clean($_GET['page']); 

                                 $sNo=1; 

                                 $targetpage='display.html?ga='.$_REQUEST['ga'].'&s='.$_REQUEST['s'].'&'; 

                                 $rs=GetRecordList('*','popularDestinations','  '.$where.'  ','25',$page,$targetpage);

                                 

                                 $totalentry=$rs[1];

                                 

                                 $paging=$rs[2];  

                                 while($rest=mysqli_fetch_array($rs[0])){ 

                                 

                                 $a=GetPageRecord('name','websiteDestination','id="'.($rest['destinationId']).'"');  

                                 $data=mysqli_fetch_array($a); 

                                  

                                 ?>

                              <tr>

                                 <td width="18%"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp; <?php echo stripslashes($data['name']); ?></td>

                                 <td width="18%"><?php echo stripslashes($rest['fromSector']); ?></td>

                                 <td width="18%"><?php echo stripslashes($rest['toSector']); ?></td>

                                 <td width="18%"><?php echo stripslashes($rest['startingPrice']); ?></td>

                                 

								 <td width="15%"><?php echo newstatusbadges($rest['status']); ?></td>

								 

								 <td width="15%"><?php if($rest['type']==1){echo "Popular Airline Destination"; } if($rest['type']==0){echo "Domestic Airline Destination"; } ?></td>

								 

                                 <td width="4%">
                                    <div style="display:flex; align-items:center; gap:8px;">
                                       <a class="dropdown-item neweditpan" onclick="loadpop2('Edit Destination',this,'600px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static" popaction="action=addpopulardestination&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>   
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
   function dltfunction(id)
   {
      if(confirm('Are you sure your want to delete?'))
      {
        window.location.href = 'display.html?ga=popular-destinations&dltid='+id;
      }
   }  
 </script> 