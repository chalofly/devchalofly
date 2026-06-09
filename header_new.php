<div id="header">

    <div class="headerbar">

        <!-- MOBILE MENU ICON -->

        <div class="mobilemainmenu" onclick="$('.mobilemainmenuboxss').toggle();">
            <i class="fa fa-bars"></i>
        </div>

        <!-- MOBILE MENU -->

        <div class="mobilemainmenuboxss">

            <?php if($_SESSION['mobileapppage']==1){ ?>
            <a href="<?php echo $fullurl; ?>">
                <i class="fa fa-home"></i> Home
            </a>
            <?php } ?>

            <a href="<?php echo $fullurl; ?>flightpage.php">
                <i class="fa fa-plane"></i> Flights
            </a>

            <a href="<?php echo $fullurl; ?>hotels">
                <i class="fa fa-building"></i> Hotels
            </a>

            <a href="<?php echo $fullurl; ?>holidays">
                <i class="fa fa-suitcase"></i> Holidays
            </a>

            <a href="<?php echo $fullurl; ?>buses">
                <i class="fa fa-bus"></i> Buses
            </a>

            <a href="<?php echo $fullurl; ?>visa">
                <i class="fa fa-cc-visa"></i> Visa
            </a>

            <a href="<?php echo $fullurl; ?>contact-us">
                <i class="fa fa-phone"></i> Contact
            </a>

        </div>

        <!-- LOGO -->

        <div id="logo">

            <?php if($LoginUserDetails['userType']=='distributor'){ ?>

            <a href="<?php echo $fullurl; ?>agent">
                <img src="<?php echo $fullurl; ?>images/logo.png">
            </a>

            <?php } else { ?>

            <a href="<?php echo $fullurl; ?>">
                <img src="<?php echo $fullurl; ?>images/logo.png">
            </a>

            <?php } ?>

        </div>

        <!-- MAIN MENU -->

        <div id="menu" style="display:flex;">

            <a href="<?php echo $fullurl; ?>flightpage.php" class="<?php if($selectedpage=="flights"){ ?>active<?php } ?>">
                <i class="fa fa-plane"></i>
                Flights
            </a>

            <a href="<?php echo $fullurl; ?>hotels">
                <i class="fa fa-building"></i>
                Hotels
            </a>

            <a href="<?php echo $fullurl; ?>holidays">
                <i class="fa fa-suitcase"></i>
                Holidays
            </a>

            <a href="<?php echo $fullurl; ?>buses">
                <i class="fa fa-bus"></i>
                Buses
            </a>

        </div>

        <!-- RIGHT MENU -->

        <div id="rightmenu">

            <?php if($_SESSION['agentUserid']==''){ ?>

            <!-- ACCOUNT DROPDOWN -->

            <div class="dropdown">

                <button class="btn accountbtn dropdown-toggle" type="button" data-toggle="dropdown">

                    <i class="fa fa-user"></i>
                    Account

                </button>

                <div class="dropdown-menu dropdown-menu-right">

                    <?php if($LoginUserDetails['userType']=='agent'){ ?>

                    <a class="dropdown-item" href="<?php echo $fullurl; ?>dashboard">
                        <i class="fa fa-home"></i> Dashboard
                    </a>

                    <a class="dropdown-item" href="<?php echo $fullurl; ?>balance-sheet">
                        <i class="fa fa-credit-card"></i> Balance Sheet
                    </a>

                    <?php } ?>

                    <a class="dropdown-item" href="<?php echo $fullurl; ?>flight-bookings">
                        <i class="fa fa-list"></i> Bookings
                    </a>

                    <a class="dropdown-item" href="<?php echo $fullurl; ?>my-profile">
                        <i class="fa fa-user"></i> My Profile
                    </a>

                    <a class="dropdown-item" href="<?php echo $fullurl; ?>logout">
                        <i class="fa fa-sign-out"></i> Logout
                    </a>

                </div>

            </div>

            <?php } else { ?>

            <!-- AGENT LOGIN -->

            <a href="<?php echo $fullurl; ?>login" class="agentloginbtn">

                <i class="fa fa-user"></i>
                Agent Login

            </a>

            <!-- LOGIN SIGNUP -->
			<div class="dropdown">

                <button class="btn accountbtn dropdown-toggle" type="button" data-toggle="dropdown">

                    <i class="fa fa-user-circle"></i>
                    Login / Signup

                </button>

                <div class="dropdown-menu dropdown-menu-right">

                     <div class="logintoptext">

                        <strong>Hey Traveller</strong>

                        <span>
                            Get deals & manage your trips
                        </span>

                    </div>

                    <a class="dropdown-item"  onclick="$('#clientloginbox').show();loadclientloginbox(1);">
                        <i class="fa fa-user-circle"></i> Login / Signup
                    </a>

                   <a class="dropdown-item" onclick="$('#clientloginbox').show();loadclientloginbox(1);">
                        <i class="fa fa-suitcase"></i> My Bookings
                    </a>

                    <a class="dropdown-item" href="<?php echo $fullurl; ?>offers">
                        <i class="fa fa-certificate"></i> Offers
                    </a>


                </div>

            </div>


            <?php } ?>

        </div>

    </div>

</div>

<style>

/* ================= HEADER ================= */

body{
    margin:0;
    padding:0;
    font-family:'Quicksand', sans-serif;
    background:#ffffff;
}

#header{
    width:100%;
    background:#ffffff;
    box-shadow:0 2px 12px rgba(0,0,0,0.05);
    position:relative;
    z-index:9999;
}

.headerbar{
    max-width:1350px;
    margin:auto;
    height:84px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 20px;
}

/* LOGO */

#logo{
    display:flex;
    align-items:center;
}

#logo img{
    height:58px;
    width:auto;
    display:block;
}

/* MENU */

#menu{
    display:flex;
    align-items:center;
    gap:12px;
    margin-left:auto;
    margin-right:400px;
}

#menu a{
    height:58px;
    padding:0 24px;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    text-decoration:none;
    color:#2d2d2d;
    font-size:16px;
    font-weight:700;
    transition:0.3s;
}

#menu a i{
    color:#1d6fff;
    font-size:18px;
}

#menu a:hover{
    background:#f3f7ff;
}

#menu a.active{
    background:#eaf3ff;
    border:2px solid #1d6fff;
    color:#1d6fff;
}

/* RIGHT MENU */

#rightmenu{
    display:flex;
    align-items:center;
}

/* ACCOUNT BUTTON */

.accountbtn,
.loginbtn{
    background:#1d6fff !important;
    border:none !important;
    color:#fff !important;
    height:58px;
    padding:0 26px !important;
    border-radius:14px !important;
    font-size:16px !important;
    font-weight:700 !important;
    display:flex !important;
    align-items:center;
    gap:10px;
}

.accountbtn i,
.loginbtn i{
    font-size:18px;
}

/* DROPDOWN */

.dropdown-menu{
    border:none !important;
    border-radius:15px !important;
    box-shadow:0 10px 35px rgba(0,0,0,0.12) !important;
    padding:10px !important;
    margin-top:12px !important;
}

.dropdown-item{
    padding:12px 15px !important;
    border-radius:10px;
    font-weight:600;
}

.dropdown-item:hover{
    background:#f5f7fb !important;
}

/* MOBILE */

.mobilemainmenu{
    display:none;
}

.mobilemainmenuboxss{
    display:none;
}

@media(max-width:991px){

.headerbar{
    height:70px;
    padding:0 15px;
}

.mobilemainmenu{
    display:block;
    font-size:24px;
    margin-right:12px;
}

#menu{
    display:none;
}

#logo img{
    height:42px;
}

.accountbtn,
.loginbtn{
    height:44px;
    padding:0 14px !important;
    font-size:13px !important;
}

.mobilemainmenuboxss{
    position:fixed;
    left:0;
    top:0;
    width:280px;
    height:100%;
    background:#fff;
    z-index:99999;
    box-shadow:0 0 40px rgba(0,0,0,0.2);
    padding-top:20px;
}

.mobilemainmenuboxss a{
    display:block;
    padding:15px 20px;
    border-bottom:1px solid #eee;
    text-decoration:none;
    color:#222;
    font-weight:600;
}

}
</style>

<script>

$(document).mouseup(function(e){

var container = $(".mobilemainmenuboxss");

if (!container.is(e.target) && container.has(e.target).length === 0){

container.hide();

}

});

</script>