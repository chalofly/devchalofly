
<style>
  .offerheadingflight{overflow: hidden; clear: both; padding: 20px 0;}
  .offerheading p{font-size: 22px; margin: 20px 0px; font-weight: 500;}
  .offersection h2{font-size: 17px; margin: 5px 0px;}
  .offersection p { color: var(--darkgray); font-size: 14px;}
  .offersectiondeal h2{font-size: 17px; margin: 5px 0px; color: #fff; text-align: center;}
  .offersectiondeal p { color: var(--darkgray); font-size: 14px; color: #fff; text-align: center;}
  .offerheadingflight .offerlaftside{float: left;}
  .offerheadingflight .offerrightside{float: left;}
  .offerheadingflight .middleofferside{float: right;}
  .offerheadingflight .offerrightside ul{list-style: none; margin: 0; padding: 0;}
  
  .offerheadingflight h2{font-size: 21px; margin: 0; padding-right: 30px;}
  .offerheadingflight .offerrightside ul li{float: left; }
  .offerheadingflight .offerrightside  ul li a{padding: 10px 15px;font-weight: 700; font-size: 16px; color: #4d4d4d;}
  .offerheadingflight .offerrightside ul li a:hover{background: #00a1e5;  color: #fff; border-radius: 30px;}
  .offerheadingflight .offerrightside ul li .active{background: #00a1e5;  color: #fff; border-radius: 30px;}
  .offerheadingflight .middleofferside ul{list-style: none; margin: 0; padding: 0;}
  .offerheadingflight .middleofferside ul li a{padding: 10px 15px;font-weight: 700; font-size: 16px; color: #00a1e5;}
  .offerheadingflight .middleofferside ul li a:hover{color: #4d4d4d;}
  .offerbardeals{padding: 10px 0px;box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px !important; border-radius: 5px;}
  .offersectiondeal{margin: 0 5px; background: #00a1e5; padding: 10px; border-radius: 4px; height: 335px;}
  .owl-theme .owl-controls .owl-page{
    position: absolute;
    left: 0;
    top: -200px;
}




</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css" />
         <script src="https://trivikal.com/assets/plugins/bootstrap/js/popper.min.js"></script> 
        
         <script src="https://trivikal.com/assets/plugins/bootstrap/js/bootstrap.bundle.js"></script> 
   


<div class="row offerrow offerbardeals">


        <div class="offerheadingflight">

          <div class="offerlaftside"> <h2><?php echo stripslashes($clientwebsitesection['sectionName']); ?></h2></div>
<div class="offerrightside">
  <ul>
  <li><a href="" class="active">All Offers</a></li>
  <li><a href="">Flights </a></li>
  <li><a href="">Buses </a></li>
  <li><a href="">Group Booking </a></li>
  <li><a href="">Holidays </a></li>
  <li><a href="">Bank Offers</a></li>
    
  </ul>
</div>
<div class="middleofferside">
  <ul>
  <li><a href="">View All Offers <i class="fa fa-long-arrow-right" aria-hidden="true"></i>  </a></li>
    
  </ul></div>
        </div>

        <div class="owl-carousel owl-theme">
        <?php

        $a = GetPageRecord('*', 'sys_specialDeal', ' dealType="flight"  and addBy=1 and status=1 order by id desc');

        while ($spdeals = mysqli_fetch_array($a)) {

        ?>
<div class="item">
          <div class="col-lg-12">

            <div class="offersectiondeal">

              <a onClick="loadpop('Deal Details',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewdetails&id=<?php echo encode($spdeals['id']); ?>" style="cursor:pointer;">

                <div class="offerimg mobileofferimg">

                  <img src="<?php echo $imgurl; ?><?php echo $spdeals['image']; ?>" alt="<?php echo stripslashes($spdeals['title']); ?>">

                </div>

              </a>



              <h2 class="mt-2"><?php echo stripslashes($spdeals['title']); ?></h2>

              <p class="mt-2"><?php echo substr(nl2br(stripslashes($spdeals['description'])), 0, 40); ?>...</p>



            </div>

          </div>
</div>

        <?php } ?>

        </div>
      </div>
	  
	  

	  
	  
	 <!-- ---------Flight Content section-------------->
	  
	  
	  
	  
	  <div class="row offerrow mt-5">

        <div class="offerheading">

          <h3 style="display:none;"><?php echo stripslashes($clientwebsitesection['sectionName']); ?></h3>

        </div>

        <?php

        $cc = GetPageRecord('*', 'cmsPages', ' pageType="Services"  and url="flights" and status=1');

        while ($cms = mysqli_fetch_array($cc)) {

        ?>

          <div class="col-lg-12">

            <div class="offersection">

              <!-- <h6 class="mt-2">
               
              </h6> -->
              <?php echo stripslashes($cms['description']); ?> 

            </div>

          </div>

        <?php } ?>


      </div>
	  
      
	   <!-- ---------Flight Content section-------------->
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
     <script>
      $('.owl-carousel').owlCarousel({
         loop: true,
         margin: 10,
         nav: true,
         responsive: {
            0: {
               items: 1
            },
            600: {
               items: 3
            },
            1400: {
               items: 4
            }
         }
      })
   </script>