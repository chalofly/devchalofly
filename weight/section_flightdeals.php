<style>

    .offerheadingflight {

        overflow: hidden;

        clear: both;

        padding: 20px;

        display: flex;

        justify-content: space-between;

    }



    .offerheading p {

        font-size: 22px;

        margin: 20px 0px;

        font-weight: 500;

    }



    .offersection h2 {

        font-size: 17px;

        margin: 5px 0px;

    }



    .offersection p {

        color: var(--darkgray);

        font-size: 14px;

    }



    .offersectiondeal h2 {

        font-size: 17px;

        margin: 5px 0px;

        color: #fff;

        text-align: center;

    }



    .offersectiondeal p {

        color: var(--darkgray);

        font-size: 14px;

        color: #fff;

        text-align: center;

    }



    .offerheadingflight .offerlaftside {

        float: left;

    }



    .offerheadingflight .offerrightside {

        float: left;

        width: 60%;

    }



    .offerheadingflight .middleofferside {

        float: right;

    }



    .offerheadingflight .offerrightside ul {

        list-style: none;

        margin: 0;

        padding: 0;

    }



    .offerheadingflight h2 {

        font-size: 21px;

        margin: 0;

        padding-right: 30px;

    }



    .offerheadingflight .offerrightside ul li a {

        padding: 10px 15px;

        font-weight: 700;

        font-size: 16px;

        color: #4d4d4d;

    }



    .offerheadingflight .offerrightside ul li a:hover {

        background: #00a1e5;

        color: #fff;

        border-radius: 30px;

    }



    .offerheadingflight .offerrightside ul li .active {

        background: #00a1e5;

        color: #fff;

        border-radius: 30px;

    }



    .offerheadingflight .middleofferside ul {

        list-style: none;

        margin: 0;

        padding: 0;

    }



    .offerheadingflight .middleofferside ul li a {

        padding: 10px 15px;

        font-weight: 700;

        font-size: 16px;

        color: #00a1e5;

    }



    .offerheadingflight .middleofferside ul li a:hover {

        color: #4d4d4d;

    }



    .offerbardeals {

        padding: 10px 0px;

        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;

        border-radius: 5px;

    }



    .offersectiondeal {

        margin: 0 5px;

        background: #00a1e5;

        padding: 10px;

        border-radius: 4px;

        height: 300px;

    }



    .owl-carousel {

        padding: 0 35px;

    }





    .owl-nav .owl-prev {

        position: absolute;

        top: 50%;

        left: 5px;

        right: -1.5em;

        margin-top: -1.65em;

    }



    .owl-nav .owl-next {

        position: absolute;

        top: 50%;

        right: 5px;

        margin-top: -1.65em;

    }



    .owl-nav button {

        background-color: #00a1e5 !important;

        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;

    }



    .owl-nav button {

        width: 28px !important;

        height: 28px !important;

        border-radius: 50%;

    }



    .owl-nav span {

        font-size: 30px !important;

        color: #fff !important;

        position: relative;

        top: -11px !important;

    }



    .blugbg {

        border: solid 1px #00a1e5;

        background: #95d5f0;

        padding: 20px;

        border-radius: 10px;

        margin: 30px 0;

    }



    .essent {

        font-size: 18px;

        color: #57646a;

        font-weight: 700;

    }



    .playstore {

        background: #002f7c;

        border-radius: 10px;

        border: solid 1px #002f7c;

        padding: 30px 40px;

        position: relative;

    }

    .tabgroup table tr td{

        width: 25%;

        vertical-align: top;

    }









    .tabs {

  li {

    float:left;

  }

  a {

    text-align:center;

    text-decoration:none;

    text-transform:uppercase;

  }

}

.clearfix:after {

  content:"";

  display:table;

  clear:both;

}



.tabgroup{padding:20px;}





@media (max-width: 576px){

        .tabgroup table tr td {

    width: 100% !important;

}

    

}





</style>

<link rel="stylesheet" href="css/owl.theme.min.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">







<div class="row offerrow">

    <div class="col-12 col-lg-12">

        <div class="offerbardeals">

            <div class="offerheadingflight">



                <div class="offerlaftside">

                    <h2><?php echo stripslashes($clientwebsitesection['sectionName']); ?></h2>

                </div>

                <div class="offerrightside tabs-nav">

               

                    <ul class="tabs clearfix" data-tabgroup="first-tab-group">

                    <li><a href="#tab1" class="active">All Offers</a></li>

                    <li><a href="#tab2">Flights</a></li>

                    <li><a href="#tab3">Buses</a></li>

                    <li><a href="#tab4">Group Booking</a></li>

                    <li><a href="#tab5">Holidays</a></li>

                    <li><a href="#tab6">Bank Offer</a></li>

                    </ul>



                </div>





                <div class="middleofferside">

                    <ul>

                        <li><a href="">View All Offers <i class="fa fa-long-arrow-right" aria-hidden="true"></i> </a>

                        </li>



                    </ul>

                </div>

            </div>







                



            <section id="first-tab-group" class="tabgroup">

<div id="tab1">
    <div class="owl-carousel owl-theme">

<?php
$ddd = GetPageRecord('*', 'sys_specialDeal', 'status=1 ORDER BY id DESC');

while($results = mysqli_fetch_array($ddd)) {
?>

    <div class="item">

        <div class="offersection">

            <a onclick="loadpop('Deal Details',this,'700px')" 
               data-toggle="modal"
               data-target=".bs-example-modal-center"
               popaction="action=viewdetails&id=<?php echo encode($results['id']); ?>"
               style="cursor:pointer;">

                <div class="offerimg mobileofferimg">
                    <img src="<?php echo $imgurl . $results['image']; ?>"
                         alt="<?php echo stripslashes($results['title']); ?>"
                         class="img-fluid">
                </div>

            </a>

            <h2 class="mt-2">
                <?php echo stripslashes($results['title']); ?>
            </h2>

            <p class="mt-2">
                <?php
                $description = stripslashes($results['description']);
                $words = explode(' ', $description);
                echo implode(' ', array_slice($words, 0, 20));
                ?>...
            </p>

        </div>

    </div>

<?php } ?>

</div>
</div>

<div id="tab2">
    <div class="owl-carousel owl-theme">

<?php
$ddd = GetPageRecord('*', 'sys_specialDeal', 'status=1 and dealType="flight" ORDER BY id DESC');

while($results = mysqli_fetch_array($ddd)) {
?>

    <div class="item">

        <div class="offersection">

            <a onclick="loadpop('Deal Details',this,'700px')" 
               data-toggle="modal"
               data-target=".bs-example-modal-center"
               popaction="action=viewdetails&id=<?php echo encode($results['id']); ?>"
               style="cursor:pointer;">

                <div class="offerimg mobileofferimg">
                    <img src="<?php echo $imgurl . $results['image']; ?>"
                         alt="<?php echo stripslashes($results['title']); ?>"
                         class="img-fluid">
                </div>

            </a>

            <h2 class="mt-2">
                <?php echo stripslashes($results['title']); ?>
            </h2>

            <p class="mt-2">
                <?php
                $description = stripslashes($results['description']);
                $words = explode(' ', $description);
                echo implode(' ', array_slice($words, 0, 20));
                ?>...
            </p>

        </div>

    </div>

<?php } ?>

</div>
</div>

            <div id="tab3">

                <div class="owl-carousel owl-theme">

<?php
$ddd = GetPageRecord('*', 'sys_specialDeal', 'status=1 and dealType="bus" ORDER BY id DESC');

while($results = mysqli_fetch_array($ddd)) {
?>

    <div class="item">

        <div class="offersection">

            <a onclick="loadpop('Deal Details',this,'700px')" 
               data-toggle="modal"
               data-target=".bs-example-modal-center"
               popaction="action=viewdetails&id=<?php echo encode($results['id']); ?>"
               style="cursor:pointer;">

                <div class="offerimg mobileofferimg">
                    <img src="<?php echo $imgurl . $results['image']; ?>"
                         alt="<?php echo stripslashes($results['title']); ?>"
                         class="img-fluid">
                </div>

            </a>

            <h2 class="mt-2">
                <?php echo stripslashes($results['title']); ?>
            </h2>

            <p class="mt-2">
                <?php
                $description = stripslashes($results['description']);
                $words = explode(' ', $description);
                echo implode(' ', array_slice($words, 0, 20));
                ?>...
            </p>

        </div>

    </div>

<?php } ?>

</div>

            </div>







 <div id="tab4">

                <div class="owl-carousel owl-theme">

<?php
$ddd = GetPageRecord('*', 'sys_specialDeal', 'status=1 and dealType="group_booking" ORDER BY id DESC');

while($results = mysqli_fetch_array($ddd)) {
?>

    <div class="item">

        <div class="offersection">

            <a onclick="loadpop('Deal Details',this,'700px')" 
               data-toggle="modal"
               data-target=".bs-example-modal-center"
               popaction="action=viewdetails&id=<?php echo encode($results['id']); ?>"
               style="cursor:pointer;">

                <div class="offerimg mobileofferimg">
                    <img src="<?php echo $imgurl . $results['image']; ?>"
                         alt="<?php echo stripslashes($results['title']); ?>"
                         class="img-fluid">
                </div>

            </a>

            <h2 class="mt-2">
                <?php echo stripslashes($results['title']); ?>
            </h2>

            <p class="mt-2">
                <?php
                $description = stripslashes($results['description']);
                $words = explode(' ', $description);
                echo implode(' ', array_slice($words, 0, 20));
                ?>...
            </p>

        </div>

    </div>

<?php } ?>

</div>

            </div>

			

			

 <div id="tab6">

                <div class="owl-carousel owl-theme">

<?php
$ddd = GetPageRecord('*', 'sys_specialDeal', 'status=1 and dealType="bank_offer" ORDER BY id DESC');

while($results = mysqli_fetch_array($ddd)) {
?>

    <div class="item">

        <div class="offersection">

            <a onclick="loadpop('Deal Details',this,'700px')" 
               data-toggle="modal"
               data-target=".bs-example-modal-center"
               popaction="action=viewdetails&id=<?php echo encode($results['id']); ?>"
               style="cursor:pointer;">

                <div class="offerimg mobileofferimg">
                    <img src="<?php echo $imgurl . $results['image']; ?>"
                         alt="<?php echo stripslashes($results['title']); ?>"
                         class="img-fluid">
                </div>

            </a>

            <h2 class="mt-2">
                <?php echo stripslashes($results['title']); ?>
            </h2>

            <p class="mt-2">
                <?php
                $description = stripslashes($results['description']);
                $words = explode(' ', $description);
                echo implode(' ', array_slice($words, 0, 20));
                ?>...
            </p>

        </div>

    </div>

<?php } ?>

</div>

            </div>





            <div id="tab5">

 <div class="owl-carousel owl-theme">

<?php
$ddd = GetPageRecord('*', 'sys_specialDeal', 'status=1 and dealType="holiday" ORDER BY id DESC');

while($results = mysqli_fetch_array($ddd)) {
?>

    <div class="item">

        <div class="offersection">

            <a onclick="loadpop('Deal Details',this,'700px')" 
               data-toggle="modal"
               data-target=".bs-example-modal-center"
               popaction="action=viewdetails&id=<?php echo encode($results['id']); ?>"
               style="cursor:pointer;">

                <div class="offerimg mobileofferimg">
                    <img src="<?php echo $imgurl . $results['image']; ?>"
                         alt="<?php echo stripslashes($results['title']); ?>"
                         class="img-fluid">
                </div>

            </a>

            <h2 class="mt-2">
                <?php echo stripslashes($results['title']); ?>
            </h2>

            <p class="mt-2">
                <?php
                $description = stripslashes($results['description']);
                $words = explode(' ', $description);
                echo implode(' ', array_slice($words, 0, 20));
                ?>...
            </p>

        </div>

    </div>

<?php } ?>

</div>


            </div>



          



        </section>



            

        </div>

    </div>

</div>











<!-- ---------Flight Content section-------------->



<div class="row">

    <div class="col-12 col-lg-12">

        <div class="blugbg">

            <div class="essent"><img src="images/righticon.png"> Discover essential information on current domestic and

                international travel regulations before setting off. Your safety is our

                priority! <span style="color: #00a1e5;">Read</span></div>

        </div>

    </div>

</div>









<div class="row">

    <div class="col-lg-12">

        <div class="playstore">

            <div class="row">

                <div class="col-lg-6 col-12">

                    <div class="playdisgd"><img src="images/playstoremobile.png"></div>

                    <div class="downlaod">

                        <h4>Download Chalofly App Now!</h4>

                        <h5>Get More Offer & More Discounts</h5>

                        <div><a href=""><img src="images/googleplay.png"></a> <a href=""><img

                                    src="images/macleplay.png"></a></div>

                    </div>



                </div>

                <div class="col-lg-6 col-12">

                    <div class="imagerights"><img src="images/rightlogoapp.png"></div>



                </div>

                <div></div>

            </div>

            <style>

                .playdisgd {

                    width: 18%;

                    float: left;

                }



                .playdisgd {

                    text-align: center;

                    padding-top: 25px;

                }



                .downlaod {

                    width: 82%;

                    float: left;

                }



                .downlaod h4 {

                    font-size: 30px;

                    color: #fff;

                    font-weight: 700;

                    margin: 0 0 10px;

                }



                .downlaod h5 {

                    font-size: 24px;

                    color: #fff;

                    font-weight: 700;

                    margin: 0 0 30px;

                }



                .imagerights {

                    position: absolute;

                    right: 70px;

                }



                .imagerights img {

                    width: 257px;

                }

            </style>

        </div>

    </div>

</div>



<!--<div class="row offerrow mt-5">



        <div class="offerheading">



          <h3 style="display:none;"><?php echo stripslashes($clientwebsitesection['sectionName']); ?></h3>



        </div>



        <?php



        $cc = GetPageRecord('*', 'cmsPages', ' pageType="Services"  and url="flights" and status=1');



        while ($cms = mysqli_fetch_array($cc)) {



            ?>



          <div class="col-lg-12">



            <div class="offersection">



              

              <?php echo stripslashes($cms['description']); ?> 



            </div>



          </div>



        <?php } ?>





      </div>-->





<!-- ---------Flight Content section-------------->







<script>

$('.tabgroup > div').hide();

$('.tabgroup > div:first-of-type').show();

$('.tabs a').click(function(e){

  e.preventDefault();

    var $this = $(this),

        tabgroup = '#'+$this.parents('.tabs').data('tabgroup'),

        others = $this.closest('li').siblings().children('a'),

        target = $this.attr('href');

    others.removeClass('active');

    $this.addClass('active');

    $(tabgroup).children('div').hide();

    $(target).show();

  

})

</script>







