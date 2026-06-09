<?php 
if($_REQUEST['fileName']!=''){

$dir='../FLYTBOJSON/'.$_REQUEST['fileName'];

unlink($dir);

?>

<script>
loccation.href="<?php echo $fullurl; ?>display.html?ga=flightlogs";

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
                                    <h4 class="card-title cardtitle">Flight Logs<div class="float-right">
				  
									</div></h4> 
							  
                                        <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th>Log File </th>
												  <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php



$dir='../FLYTBOJSON';
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		
	if($file!='..'){
	if($file!='.'){ 
?>

<tr>
  <td width="90%"><a  style="cursor:pointer;" onclick="loadpop('Flight Log',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=flightlog&log=<?php echo $file; ?>"><?php echo str_replace('Airgennie','TBO-',str_replace('FlyShop','TBO-',$file)); ?></a></td>
  
  <td width="10%"><a onclick="return confirm('Do you really want to delete?');" href="<?php echo $fullurl; ?>display.html?ga=flightlogs&fileName=<?php echo $file; ?>">Delete</a></td>
  </tr>


<?php   }   }  }
        closedir($dh);
     }
} ?>
                                            </tbody>
                                        </table>
                           
							
						  </div>
								 
                             
</div>
                             

                        </div>

                         
						
						
						
						 
                     

             </div><!--end col-->

            <!-- end row -->

    </div>

        <!-- End Page-content -->

         
    </div>
	</div>	</div>