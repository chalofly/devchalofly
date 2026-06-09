<?php
$abcd=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['id']).'"');
$result=mysqli_fetch_array($abcd);

$rs=GetPageRecord($select,'sys_userMaster','id=1');
$invoicedataa=mysqli_fetch_array($rs);

if($_REQUEST['ntid']!=''){
    $namevalue ='makeDone=1';
    updatelisting('queryTask',$namevalue,'id="'.decode($_REQUEST['ntid']).'"');
}

$rs=GetPageRecord($select,'sys_userMaster','id="'.$result['addedBy'].'"');
$packagecreator=mysqli_fetch_array($rs);
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php echo stripslashes($result['name']); ?></title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:#f4f7fb;
    font-family:'Poppins',sans-serif;
    color:#222;
}

.container{
    width:100%;
    max-width:1250px;
    margin:auto;
    padding:20px;
}

/* HERO */

.hero{
    position:relative;
    border-radius:28px;
    overflow:hidden;
    margin-bottom:40px;
    box-shadow:0 15px 40px rgba(0,0,0,0.15);
}

.hero img{
    width:100%;
    height:620px;
    object-fit:cover;
}

.hero-overlay{
    position:absolute;
    inset:0;
    background:linear-gradient(
        to top,
        rgba(0,0,0,0.75),
        rgba(0,0,0,0.15)
    );
    display:flex;
    align-items:flex-end;
    padding:60px;
}

.hero-content{
    color:#fff;
    width:100%;
}

.package-title{
    font-size:48px;
    font-weight:800;
    line-height:1.2;
    margin-bottom:15px;
}

.package-info{
    font-size:18px;
    opacity:0.95;
}

.company-logo{
    position:absolute;
    top:30px;
    right:30px;
    background:#fff;
    padding:10px 18px;
    border-radius:14px;
}

.company-logo img{
    height:60px;
}

/* PRICE CARD */

.price-card{
    background:#fff;
    border-radius:24px;
    padding:35px;
    text-align:center;
    margin-top:-70px;
    position:relative;
    z-index:10;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    margin-bottom:50px;
}

.price-main{
    font-size:52px;
    font-weight:800;
    color:#0b6bcb;
}

.price-sub{
    margin-top:10px;
    color:#666;
    font-size:14px;
    text-transform:uppercase;
    letter-spacing:1px;
}

.book-btn{
    display:inline-block;
    margin-top:25px;
    background:#0b6bcb;
    color:#fff;
    border:none;
    padding:16px 40px;
    border-radius:50px;
    font-size:16px;
    font-weight:700;
    cursor:pointer;
    transition:0.3s;
}

.book-btn:hover{
    background:#084f98;
}

/* DAY TITLE */

.day-title{
    background:var(--orange);
    color:#fff;
    padding:16px 28px;
    border-radius:16px;
    margin:50px 0 25px;
    font-size:22px;
    font-weight:700;
    box-shadow:0 8px 20px rgba(11,107,203,0.2);
}

/* EVENT */

.event-card{
    background:#fff;
    border-radius:24px;
    overflow:hidden;
    margin-bottom:30px;
    box-shadow:0 8px 25px rgba(0,0,0,0.06);
    transition:0.3s ease;
}

.event-card:hover{
    transform:translateY(-5px);
}

.event-row{
    display:flex;
    flex-wrap:wrap;
}

.event-image-box{
    width:40%;
    overflow:hidden;
}

.event-image{
    width:100%;
    height:100%;
    min-height:320px;
    object-fit:cover;
    transition:0.5s;
}

.event-card:hover .event-image{
    transform:scale(1.05);
}

.event-content{
    width:60%;
    padding:35px;
}

.badge{
    display:inline-block;
    background:#eef5ff;
    color:#0b6bcb;
    padding:12px;
    border-radius:30px;
    font-size:16px !important;
    font-weight:600;
    margin-bottom:15px;
}

.event-title{
    font-size:28px;
    font-weight:700;
    margin-bottom:15px;
    line-height:1.3;
}

.event-meta{
    margin-bottom:18px;
    color:#666;
    font-size:14px;
}

.event-description{
    line-height:1.9;
    color:#444;
    font-size:15px;
}

.room-box{
    background:#f8fbff;
    border-radius:16px;
    padding:20px;
    margin-top:20px;
}

.room-box div{
    margin-bottom:10px;
}

/* TIPS */

.tips-section{
    margin-top:70px;
    margin-bottom:80px; /* IMPORTANT */
    position:relative;
    z-index:2;
}

.tips-title{
    text-align:center;
    font-size:34px;
    font-weight:700;
    margin-bottom:35px;
    color:#111;
}

.tips-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:30px;
    align-items:start;
}
/* CARD */

.tip-card{
    background:#fff;
    border-radius:24px;
    overflow:hidden;
    box-shadow:0 8px 25px rgba(0,0,0,0.06);
    transition:0.3s ease;
    display:flex;
    flex-direction:column;
    min-height:420px;
    position:relative;
}

.tip-card:hover{
    transform:translateY(-4px);
}

/* HEADER */

.tip-header{
    padding:24px 28px;
    border-bottom:1px solid #f1f1f1;
    background:#fafcff;
    flex-shrink:0;
}

.tip-header h4{
    margin:0;
    font-size:24px;
    font-weight:700;
    color:#111;
    line-height:1.4;
}


/* CONTENT */

.tip-content{
    padding:28px;
    overflow-y:auto;
    max-height:450px;
    line-height:1.9;
    color:#444;
    font-size:15px;

    /* smooth scroll */
    scroll-behavior:smooth;

    /* spacing */
    padding-right:18px;
}

/* SCROLLBAR */

.tip-content::-webkit-scrollbar{
    width:8px;
}

.tip-content::-webkit-scrollbar-track{
    background:#f3f5f9;
    border-radius:20px;
}

.tip-content::-webkit-scrollbar-thumb{
    background:#c7d3e0;
    border-radius:20px;
}

.tip-content::-webkit-scrollbar-thumb:hover{
    background:#aebfd1;
}


/* FOOTER */

.footer{
    background:var(--blue);
    color:#fff;
    border-radius:28px;
    margin-top:50px;
    padding:50px;
    clear:both;
    overflow:hidden;
	position:relative;
    z-index:1;
}

.footer-flex{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:30px;
}

.agent-box{
    display:flex;
    align-items:center;
}

.agent-photo{
    width:70px;
    height:70px;
    border-radius:50%;
    overflow:hidden;
    margin-right:20px;
}

.agent-photo img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.agent-name{
    font-size:24px;
    font-weight:700;
}

.contact-line{
    margin-top:10px;
    opacity:0.9;
    font-size:14px;
    text-align: left;
}

.contact-line i{
    margin-right:8px;
}

.contact-line a{
    color:#fff;
    text-decoration:none;
}

.footer-price{
    text-align:right;
}

.footer-price h2{
    font-size:42px;
    margin-bottom:10px;
}

/* MOBILE */

@media(max-width:900px){

    .container{
        padding:12px;
    }

    .hero img{
        height:380px;
    }

    .hero-overlay{
        padding:25px;
    }

    .package-title{
        font-size:28px;
    }

    .package-info{
        font-size:14px;
    }

    .event-image-box,
    .event-content{
        width:100%;
    }

    .event-image{
        min-height:230px;
    }

    .event-content{
        padding:22px;
    }

    .event-title{
        font-size:22px;
    }

    .event-description{
        font-size:13px;
        line-height:1.7;
    }
	.tips-grid{
        grid-template-columns:1fr;
        gap:20px;
    }

    .tip-card{
        min-height:auto;
    }

    .tip-content{
        max-height:320px;
        font-size:14px;
        line-height:1.8;
        padding:22px;
    }

    .tip-header{
        padding:20px 22px;
    }

    .tip-header h4{
        font-size:20px;
    }

    .tips-title{
        font-size:28px;
    }


    .footer{
        padding:35px 25px;
    }

    .footer-price{
        text-align:left;
    }

    .price-main{
        font-size:38px;
    }

    .company-logo{
        top:15px;
        right:15px;
        padding:8px 14px;
    }

    .company-logo img{
        height:45px;
    }
}

</style>

</head>

<body>

<div class="container">

    <!-- HERO -->

    <div class="hero">

        <img src="<?php echo $fullurl; ?>package_image/<?php echo $result['coverPhoto']; ?>">

        <div class="hero-overlay">

            <div class="hero-content">

                <div class="package-title">
                    <?php echo stripslashes($result['name']); ?>
                </div>

                <div class="package-info">

                    <?php echo date('d M Y',strtotime($result['startDate'])); ?>

                    -

                    <?php echo date('d M Y',strtotime($result['endDate'])); ?>

                    &nbsp; | &nbsp;

                    Package ID:
                    <?php echo encode($result['id']); ?>

                </div>

            </div>

        </div>

        <div class="company-logo">

            <img src="<?php echo $fullurl; ?>profilepic/<?php echo $invoicedataa['invoiceLogo']; ?>">

        </div>

    </div>

    <!-- PRICE -->

    <?php if($_REQUEST['notprice']!=1){ ?>

    <div class="price-card">

        <div class="price-main">

            <?php if($result['convertedCurrency']=='INR'){ ?>

                ₹<?php echo number_format(round($result['grossPrice'])); ?>

            <?php } else { ?>

                <?php echo number_format(round($result['convertedCost'])); ?>
                <?php echo $result['convertedCurrency']; ?>

            <?php } ?>

        </div>

        <div class="price-sub">

            <?php if($result['billingType']==1){ ?>
                Total Package Price
            <?php } else { ?>
                Per Person Price
            <?php } ?>

        </div>

        <?php if($result['ebo']!=''){ ?>

        <div style="margin-top:15px;color:#0b6bcb;font-weight:600;">
            <?php echo stripslashes($result['ebo']); ?>
        </div>

        <?php } ?>

        <?php
        if($result['depositDueDate']!=''
        && $result['depositDueDate']>=date('Y-m-d')){
        ?>

        <form method="post" action="packagepayment.php">

            <input name="bookpackage" type="hidden" value="1" />
            <input name="pid" type="hidden" value="<?php echo $_REQUEST['id']; ?>" />
            <input name="qid" type="hidden" value="<?php echo encode($result['queryId']); ?>" />

            <button class="book-btn" type="submit">
                Book Now
            </button>

        </form>

        <?php } ?>

    </div>

    <?php } ?>

    <!-- ITINERARY -->

    <?php

    $n=1;

    $begin = new DateTime($result['startDate']);
    $end   = new DateTime($result['endDate']);

    for($i = $begin; $i <= $end; $i->modify('+1 day')){

    $abcde=GetPageRecord('*','sys_packageBuilderEvent',
    ' packageDays="'.$n.'" and packageId="'.$result['id'].'"');

    $dayDetailsData=mysqli_fetch_array($abcde);

    ?>

    <div class="day-title">

        Day <?php echo $n; ?>

        -

        <?php echo date('D', strtotime($i->format("Y-m-d"))); ?>

        ,

        <?php echo date('d M Y', strtotime($i->format("Y-m-d"))); ?>

    </div>

    <?php if($dayDetailsData['daySubject']!=''){ ?>

    <div class="event-card">

        <div class="event-content" style="width:100%;">

            <div class="event-title">
                <?php echo stripslashes($dayDetailsData['daySubject']); ?>
            </div>

            <div class="event-description">
                <?php echo stripslashes($dayDetailsData['dayDetails']); ?>
            </div>

        </div>

    </div>

    <?php } ?>

    <?php

    $rs=GetPageRecord('*','sys_packageBuilderEvent',
    ' packageId="'.$result['id'].'"
      and packageDays="'.$n.'"
      and name!=""
      order by sr,time(checkIn) asc');

    while($eventData=mysqli_fetch_array($rs)){

    ?>

    <div class="event-card">

        <div class="event-row">

            <!-- IMAGE -->

            <div class="event-image-box">

                <img class="event-image"

                src="<?php echo $fullurl; ?>package_image/<?php

                if($eventData['eventPhoto']!=''){

                    echo $eventData['eventPhoto'];

                } else {

                    if($eventData['sectionType']=='Accommodation'){
                        echo 'nohotel.png';
                    }
                    else if($eventData['sectionType']=='Transportation'){
                        echo 'notransfer.png';
                    }
                    else{
                        echo 'noactivity.png';
                    }

                }

                ?>">

            </div>

            <!-- CONTENT -->

            <div class="event-content">

                <div class="badge">
                    <?php echo $eventData['sectionType']; ?>
                </div>

                <div class="event-title">

                    <?php echo stripslashes($eventData['name']); ?>

                    <?php if($eventData['flightNo']!=''){ ?>

                    <span style="font-size:16px;color:#0b6bcb;">
                        (<?php echo stripslashes($eventData['flightNo']); ?>)
                    </span>

                    <?php } ?>

                </div>

                <div class="event-meta">

                    <i class="fa fa-calendar"></i>

                    <?php echo date('d M Y',strtotime($eventData['startDate'])); ?>

                    <?php if($eventData['showTime']==1){ ?>

                    &nbsp;&nbsp;

                    <i class="fa fa-clock-o"></i>

                    <?php echo date('g:i A',strtotime($eventData['checkIn'])); ?>

                    <?php } ?>

                </div>

                <div class="event-description">

                    <?php echo stripslashes($eventData['description']); ?>

                </div>

                <?php if($eventData['sectionType']=='Accommodation'){ ?>

                <div class="room-box">

                    <div>
                        <strong>Check-in:</strong>
                        <?php echo date('d M Y',strtotime($eventData['startDate'])); ?>
                    </div>

                    <div>
                        <strong>Check-out:</strong>
                        <?php echo date('d M Y',strtotime($eventData['endDate'])); ?>
                    </div>

                    <?php if($eventData['mealPlan']!=''){ ?>

                    <div>
                        <strong>Meal Plan:</strong>
                        <?php echo stripslashes($eventData['mealPlan']); ?>
                    </div>

                    <?php } ?>

                    <?php if($eventData['hotelRoom']!=''){ ?>

                    <div>
                        <strong>Room Type:</strong>
                        <?php echo stripslashes($eventData['hotelRoom']); ?>
                    </div>

                    <?php } ?>

                </div>

                <?php } ?>

            </div>

        </div>

    </div>

    <?php } ?>

    <?php $n++; } ?>

    <!-- IMPORTANT TIPS -->

    <div class="tips-section">

        <div class="tips-title">
            Important Tips
        </div>

        <div class="tips-grid">

        <?php

        $rsa=GetPageRecord('*','sys_PackageTips',
        ' packageId="'.$result['id'].'" order by id asc');

        while($packageTipsData=mysqli_fetch_array($rsa)){

        ?>

        <div class="tip-card">

            <div class="tip-header">

                <h4>
                    <?php echo stripslashes($packageTipsData['title']); ?>
                </h4>

            </div>

            <div class="tip-content">

                <?php echo stripslashes($packageTipsData['description']); ?>

            </div>

        </div>

        <?php } ?>

        </div>

    </div>

    <!-- FOOTER -->
<?php if($packagecreator['profilePhoto']!='')
{ 
  $prof_img="profilepic/".$packagecreator['profilePhoto'];
} 
else { 
   $prof_img="profilepic/whiteuserphoto.png";
    }
    ?>
    <div class="footer">

        <div class="footer-flex">

            <div class="agent-box">

                <div class="agent-photo">

                    <img src="<?php echo $fullurl. $prof_img; ?>">

                </div>

                <div>

                    <div class="agent-name">

                        <?php echo stripslashes($packagecreator['firstName']); ?>

                        <?php echo stripslashes($packagecreator['lastName']); ?>

                    </div>

                    <div class="contact-line">

                        <?php echo stripslashes($invoicedataa['invoiceCompany']); ?>

                    </div>

                    <div class="contact-line">

                        <i class="fa fa-phone"></i>

                        <?php echo strip($packagecreator['mobile']); ?>

                    </div>

                    <div class="contact-line">

                        <i class="fa fa-envelope"></i>

                        holidays@chalofly.com

                    </div>

                    <?php if($packagecreator['website']!='')
                          $website=str_replace('https://','',str_replace('http://','',$packagecreator['website']));
                        else
                          $website="chalofly.com";
                      ?>

                    <div class="contact-line">

                        <i class="fa fa-globe"></i>

                        <a href="https://<?php echo $website; ?>"
                        target="_blank">

                        <?php echo $website; ?>

                        </a>

                    </div>

                </div>

            </div>

            <div class="footer-price">

                <h2>

                    ₹<?php echo number_format(round($result['grossPrice'])); ?>

                </h2>

                <div>
                    Total Package Price
                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>