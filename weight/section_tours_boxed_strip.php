<style>
  .touersoffer{padding: 0 20px 20px;box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px ; border-radius: 5px; margin-top: 30px;}
  .offerheading h3{margin: 0; padding: 30px 0 20px;}
  </style>
  <div class="offerrow">
<div class="row">
  <div class="col-12 col-lg-12">
<div class="touersoffer">

    <div class="offerheading">
        <h3><?php echo stripslashes($clientwebsitesection['sectionName']); ?></h3>
    </div>

    <div class="owl-carousel owl-theme">

    <?php 
    $bb = GetPageRecord('*', 'sys_packageBuilder', 'showwebsite=1 and showinPopular=1 and queryId=0 and grossPrice>0 order by id desc'); 

    while ($packagelist = mysqli_fetch_array($bb)) {  
    ?>

        <div class="item">

            <div class="holidestibox phoneholibox" style="margin-top:0px;">

                <div class="card" style="margin-top:0px; overflow:hidden; position:relative;">

                    <div class="holiimg">

                        <a target="_blank" href="<?php echo $fullurl; ?>package/<?php echo stripslashes($packagelist['seoURL']); ?>">

                            <img src="<?php echo $packagephotourl . $packagelist['coverPhoto']; ?>" 
                                 class="img-fluid"
                                 alt="<?php echo stripslashes($packagelist['name']); ?>">

                        </a>

                    </div>

                    <div class="card-body" style="background-color:#000000ad; position:absolute; bottom:0; width:100%; text-align:center; z-index:1;">

                        <h5 class="card-title">

                            <a target="_blank"
                               href="<?php echo $fullurl; ?>package/<?php echo stripslashes($packagelist['seoURL']); ?>"
                               style="color:#fff; font-weight:600; font-size:18px; margin-bottom:6px !important;">

                               <?php echo stripslashes($packagelist['name']); ?>

                            </a>

                        </h5>

                    </div>

                </div>

            </div>

        </div>

    <?php } ?>

    </div>

</div>

  </div>
</div>
  </div>

