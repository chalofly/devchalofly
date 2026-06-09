<?php  
include "inc.php"; 
include "config/logincheck.php";
?>
<style>
.sharefooterbox{width:430px; position:fixed; right:0px; bottom:0px; background-color:#FFFFFF; z-index:999; box-shadow: 0px 0px 100px #000000a1; border-radius: 10px; overflow:hidden; padding:15px; font-size:13px; display:none;}
.sharefooterbox .heading { font-size: 15px; margin-bottom: 10px; font-weight: 600; background-color: #eee; padding: 5px 10px; position: relative; border-radius: 4px; }
.sharefooterbox span { position: absolute; right: 16px; font-size: 12px; top:5px; }
.sharefooterbox .loadshareflightbox{max-height:400px; overflow:auto;}
.sharechek{font-size:12px;line-height: 21px;padding-top: 0px;display: inline-block;padding-left: 18px;position: absolute; right:0px; top:10px;}
.sharechek .sck{width: 14px !important;height: 16px !important;position: absolute !important;left: 0px !important;}
.ymessage{margin: 0px !important; font-size: 11px; float: left; width: 100%; padding: 0px; margin-top: 2px !important;}
.sortby{border-top: solid 1px #ccc; overflow: hidden; clear: both; padding: 15px 0;}
.sortyb{float: left; width: 12%;}
.sortyb p{font-size: 16px; font-weight: 700; color: #000; margin: 0; padding-top: 10px;}
.sortbyaling{float: left; width: 88%;}
.sortbyaling ul{list-style: none; margin: 0; padding: 0;}
.sortbyaling ul li {background: #fff; float: left; padding: 10px 15px; margin-right: 10px; border: solid 1px #00a1e5; border-radius: 4px; font-size: 16px; color: #00a1e5; font-weight: 700;}
.sortbyaling ul li a:hover{background: #00a1e5; color: #fff;}
.sortbyaling ul .active{background: #00a1e5; color: #fff;}
.itemlist{border: solid 1px #ccc !important;}
.viewbtnpa{border-top: solid 1px #ccc; margin-top: 10px; padding: 10px 35px 0;}
.viewbtnpa a{font-size: 16px; font-weight: 600; color: #00a1e5;}
.bookdetail {
    display: flex;
    justify-content: space-between;
    margin-top: 5px;
    padding: 20px 20px 0;
}
.refundtable {
    font-size: 12px;
    margin-top: 5px;
    padding-left: 20px;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{
    background-image: none;
    background-color: #fff;
    padding: 5px;
    text-align: center;
    border: 0px !important;
    border-radius: 10px !important;
}
.filtersidebar .ui-slider-horizontal .ui-slider-handle {
    top: -7px !important;
}
.boxcontentnew {
  display: none;
 }
.boxcontentnew ul{list-style: none; margin: 0 0 15px; padding: 0;}

.boxcontentnew ul li{width: 24%; margin: 0 0.5%; float: left; border-radius: 4px;}
.boxcontentnew ul li .boxnewa{color: #000; background: #f4f4fe; border: solid 1px #ccc; margin: 0; border-radius: 4px; overflow: hidden;}
.boxcontentnew ul li .boxnewb{color: #000; background: #fff; border: solid 1px #ccc; margin: 0;border-radius: 4px; overflow: hidden;}
.boxcontentnew ul li .boxnewc{color: #000; background: #fff; border: solid 1px #ccc; margin: 0;border-radius: 4px; overflow: hidden;}
.boxcontentnew ul li .boxnewd{color: #000; background: #fff; border: solid 1px #ccc; margin: 0;border-radius: 4px; overflow: hidden;}
.crpcon{background: #f7ab29; padding: 10px 15px; font-weight: 600; text-align: center; font-size: 16px;}
.crpconb{background: #58ff2d; padding: 10px 15px; font-weight: 600; text-align: center; font-size: 16px;}
.crpconc{background: #e581eb; padding: 10px 15px; font-weight: 600; text-align: center; font-size: 16px;}
.crpcond{background: #5dfbfe; padding: 10px 15px; font-weight: 600; text-align: center; font-size: 16px;}
.situated{display: block; clear: both; overflow: hidden;}
.situated .insideb{float: left; width: 50%;}
.situated .insideb p{text-align: center; font-size: 14px; margin: 0; padding: 10px 0;}
.situated .insideb p span{display: block; font-weight:700;}
.cancellationbt{display: block; clear: both; padding: 0 10px 10px;}
.cancellationbt ul{display:block; list-style: none; margin: 0; padding: 0;}
.boxcontentnew ul li .cancellationbt ul li{float:none; width: 100%;font-weight: 500; padding-bottom: 5px; font-size: 12px;}
.boxcontentnew ul li .cancellationbt ul li i{color: #759b75;}
.crpcon input{position: inherit !important;}
.crpconb input{position: inherit !important;}
.crpconc input{position: inherit !important;}
.crpcond input{position: inherit !important;}
.fbtn-danger {
    border: none !important;
    border-radius: 16px !important;
    padding: 10px !important;
    font-weight: 600;
    font-size: 14px;
    background:var(--bs-orange) !important;
   color: var(--bs-white);
   width: 140px !important;
}
</style>
<?php
$minprice=0;
$mainlistcount=1;
/*
$a=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and uniqueSessionId="'.$_SESSION['uniqueSessionId'].'" group by FLIGHT_NO,FLIGHT_CODE order by AMT asc');
*/
$a=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and uniqueSessionId="'.$_SESSION['uniqueSessionId'].'" group by ResultIndex order by AMT asc');
while($res=mysqli_fetch_array($a)){

$b=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'"   and FLIGHT_NO="'.$res['FLIGHT_NO'].'" and DEP_TIME="'.$res['DEP_TIME'].'" and FLIGHT_CODE="'.$res['FLIGHT_CODE'].'" group by PCC  order by AMT asc  ');
$flightprice=mysqli_fetch_array($b);

$bc=GetPageRecord('STOP','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and apiType="tbo"  and FLIGHT_NO="'.$res['FLIGHT_NO'].'" and DEP_TIME="'.$res['DEP_TIME'].'" and FLIGHT_CODE="'.$res['FLIGHT_CODE'].'" group by PCC  order by AMT asc  ');
$getstop=mysqli_fetch_array($bc);

$endSearch=$flightprice['endSearch'];
$str_arr = explode (",", $flightprice['agfare']);  
$basefares = explode ("=", $str_arr[2]);
$deptime= $res['DEP_DATE'].' '.$res['DEP_TIME'];
$deptime=date('hi',strtotime($deptime));
$arrtime= $res['DEP_DATE'].' '.$res['ARRV_TIME'];
$arrtime=date('hi',strtotime($arrtime));
preg_match("/([0-9]+)/", $res['DUR'], $matches);
$D_TIME= $res['DEP_TIME'];
$arrtime= $res['ARRV_TIME'];
$DEP_DATE=$res['DEP_DATE'];
$ARRV_DATE=$res['ARRV_DATE'];

if($ns==1 && $mainlistcount==1){
	$minprice=$basefares[1]; 
}
$maxprice=$basefares[1];
?>
<script>
$('#flightnameid<?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>').show();
</script>

<script>
$('#seatleft<?php echo stripslashes($res['id']); ?>').text('<?php echo stripslashes($flightprice['SEAT']); ?>');
$('#itemlist<?php echo stripslashes($res['id']); ?>').attr('data-price','<?php echo $basefares[1]; ?>');
</script>


<div id="itemlist<?php echo stripslashes($res['id']); ?>" class="bookrow item itemlist"  data-price="" data-duration="<?php echo trim($matches[1]);?>" data-depart="<?php echo $deptime; ?>" data-arrive="<?php echo str_replace(':','',$arrtime); ?>" data-category="<?php echo $res['STOP']; ?>stop D<?php if(date('H',strtotime($D_TIME))<12 && date('H',strtotime($D_TIME))>5){ echo '12'; } if(date('H',strtotime($D_TIME))<18 && date('H',strtotime($D_TIME))>12){ echo '18'; }  if(date('H',strtotime($D_TIME))<24 && date('H',strtotime($D_TIME))>18){ echo '1'; }  if(date('H',strtotime($D_TIME))<6 && date('H',strtotime($D_TIME))>0){ echo '6'; }   ?> A<?php if(date('H',strtotime($arrtime))<12 && date('H',strtotime($arrtime))>5){ echo '12'; } if(date('H',strtotime($arrtime))<18 && date('H',strtotime($arrtime))>12){ echo '18'; }  if(date('H',strtotime($arrtime))<24 && date('H',strtotime($arrtime))>18){ echo '1'; }  if(date('H',strtotime($arrtime))<6 && date('H',strtotime($arrtime))>0){ echo '6'; } ?> <?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>">
  <div class="row" style="padding: 0px 12px;">
    <div class="col-lg-9">
	
<?php
$segments=GetPageRecord('*','wig_flight_json_bkp','ResultIndex="'.$res['ResultIndex'].'" ORDER BY id ASC');
while($segmentsData=mysqli_fetch_array($segments)){
?>

      <div class="bookdetail">
        <div class="bookimg">
          <div class="bkimg"> <img src="<?php echo $imgurl.getflightlogo(stripslashes($segmentsData['FLIGHT_NAME'])); ?>" alt=""> </div>
          <h6><?php echo stripslashes($segmentsData['FLIGHT_NAME']); ?> <br>
            <span><?php echo stripslashes($segmentsData['FLIGHT_CODE']); ?> <?php echo stripslashes($segmentsData['FLIGHT_NO']); ?></span></h6>
        </div>
        <div class="bookboxprice">
          <h6><?php echo stripslashes($segmentsData['DEP_TIME']); ?></h6>
          <p class="destination"><?php echo stripslashes($segmentsData['ORG_CODE']); ?></p>
        </div>
        <div class="nonstop">
          <h4><?php echo $segmentsData['DUR']; ?></h4>
          <div class="nonstopborder"><i class="fa fa-plane" aria-hidden="true"></i> </div>
		  
		  <!--
          <span style="display:none;">
          <?php if($getstop['STOP']==0){ ?>
          Non Stop
          <?php }else{ ?>
          <span style="color:#bf0000 !important; cursor:pointer;" id="hoverstop<?php echo $segmentsData['id']; ?>" ><?php echo $getstop['STOP'].' Stop '; ?></span>
          <?php } ?>
          </span>
          <div class="stoptooltip" id="stoptooltip<?php echo $segmentsData['id']; ?>" ></div>
		  -->
		  
        </div>
		
		<div><div class="flhtext" style="line-height: 18px; color: #393939; text-transform: uppercase; font-size: 11px !important;"><i class="fa fa-suitcase" aria-hidden="true"></i> <?php $segmentsDataArr=(array) unserialize(stripslashes($flightprice['PARAM_DATA'])); echo $segmentsDataArr['Segments'][0][0]['Baggage']; ?><br />
<i class="fa fa-briefcase" aria-hidden="true"></i> <?php echo $segmentsDataArr['Segments'][0][0]['CabinBaggage']; ?></div> 
<?php if($flightprice['apiType']!='AK'){?><i class="fa fa-info-circle" aria-hidden="true" style="cursor:pointer;" onclick="loadpop('Flight Details (<?php echo stripslashes($flightprice['FLIGHT_NAME']); ?>  - <?php echo stripslashes($flightprice['FLIGHT_CODE']); ?>-<?php echo stripslashes($flightprice['FLIGHT_NO']); ?>)',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=showflightdetails&id=<?php echo $flightprice['id']; ?>"></i><?php } ?></div>
        <div class="bookboxprice">
          <h6><?php echo stripslashes($segmentsData['ARRV_TIME']); ?>
<?php 
$now = strtotime(date('Y-m-d',strtotime($segmentsData['ARRV_DATE']))); // or your date as well
$your_date = strtotime(date('Y-m-d',strtotime($segmentsData['DEP_DATE'])));
$datediff = $now - $your_date;
$plusdays=round($datediff / (60 * 60 * 24));
if($plusdays>0){
?>
            <span style="color:#CC3300; font-size:11px; display: block;">+<?php echo $plusdays; ?> Day(s)</span>
<?php } ?>
          </h6>
          <p class="destination"><?php echo stripslashes($segmentsData['DES_CODE']); ?></p>
        </div>
      </div>
	  
      <div class="bookmsg">
        <?php if(stripslashes(getfaretypedetails(stripslashes($segmentsData['FLIGHT_NAME']),stripslashes($segmentsData['PCC'])))!=''){?>
        <p><?php echo stripslashes(getfaretypedetails(stripslashes($segmentsData['FLIGHT_NAME']),stripslashes($segmentsData['PCC']))); ?></p>
        <?php } ?>
      </div>
      <div class="refundtable">
        <table>
          <tbody>
            <tr>
              <td><i class="fa fa-credit-card-alt" aria-hidden="true"></i> <span class="green">
                <?php if($segmentsData['refundyes']=='1'){ echo '<span class="refundablespan">Refundable</span>'; } else { echo '<span class="nonrefundablespan">Non Refundable</span>'; } ?>
                </span>&nbsp;&nbsp;&nbsp;</td>
              <td><i class="fa fa-user-circle-o" aria-hidden="true"></i> <span class="red"> <?php echo stripslashes($segmentsData['SEAT']); ?> Seat Left </span> </td>
              <td><div class="blackbox">
                  <h5><i class="fa fa-list" aria-hidden="true"></i> <?php echo $_SESSION['PC'];  ?></h5>
                </div></td>
            </tr>
          </tbody>
        </table>
      </div>
	  
<?php } ?>	  
	  
	  
    </div>
    <div class="col-lg-3">
      <div class="bookbtn">
        <h4><?php echo convertfromtocurrencywithcurr('INR',$_SESSION['currency'],$basefares[1]+$flightprice['agentFixedMakup']); ?></h4>
      </div><a href="<?php echo $fullurl; ?>flight-review-book?i=<?php echo encode($res['id']); ?>">	 <!--
      <a id="booknowlink<?php echo stripslashes($res['id']); ?>" onclick="loadmoreflight('<?php echo stripslashes($res['id']); ?>','<?php echo $res['FLIGHT_NO']; ?>','<?php echo $res['DEP_TIME']; ?>','<?php echo $res['FLIGHT_CODE']; ?>');" style="cursor:pointer;">	  -->
      <button type="button" class="btn fbtn-danger" style="width:100%;">Book Now </button>
      </a> 
	</div>
<!--
    <div class="viewbtnpa">
		<a href="javascript:void(0)" class="but">View Flight Details</a>
		<div class="boxcontentnew" style="display:none;">
        <ul>
          <li>
            <div class="boxnewa">
              <div class="crpcon">
                <input type="radio" />
                SME CrpCon</div>
              <div class="situated">
                <div class="insideb">
                  <p>Publish Fare <span><i class="fa fa-inr"></i> 8369</span></p>
                </div>
                <div class="insideb">
                  <p>Offer Fare <span><i class="fa fa-inr"></i> 8265</span></p>
                </div>
              </div>
              <div class="cancellationbt">
                <ul>
                  <li><i class="fa fa-check"></i> Cabin Baggage - 70KG</li>
                  <li><i class="fa fa-check"></i> Check-In Baggage - 15KG</li>
                  <li><i class="fa fa-check"></i> Cancellation fees - Applicable</li>
                  <li><i class="fa fa-check"></i> Reissue fees - Applicable</li>
                  <li><i class="fa fa-check"></i> Seat - Chargeable </li>
                  <li><i class="fa fa-check"></i> Meal - Chargeable</li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="boxnewb">
              <div class="crpconb">
                <input type="radio" />
                Saver </div>
              <div class="situated">
                <div class="insideb">
                  <p>Publish Fare <span><i class="fa fa-inr"></i> 8369</span></p>
                </div>
                <div class="insideb">
                  <p>Offer Fare <span><i class="fa fa-inr"></i> 8265</span></p>
                </div>
              </div>
              <div class="cancellationbt">
                <ul>
                  <li><i class="fa fa-check"></i> Cabin Baggage - 70KG</li>
                  <li><i class="fa fa-check"></i> Check-In Baggage - 15KG</li>
                  <li><i class="fa fa-check"></i> Cancellation fees - Applicable</li>
                  <li><i class="fa fa-check"></i> Reissue fees - Applicable</li>
                  <li><i class="fa fa-check"></i> Seat - Chargeable </li>
                  <li><i class="fa fa-check"></i> Meal - Chargeable</li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="boxnewc">
              <div class="crpconc">
                <input type="radio" />
                Flexi </div>
              <div class="situated">
                <div class="insideb">
                  <p>Publish Fare <span><i class="fa fa-inr"></i> 8369</span></p>
                </div>
                <div class="insideb">
                  <p>Offer Fare <span><i class="fa fa-inr"></i> 8265</span></p>
                </div>
              </div>
              <div class="cancellationbt">
                <ul>
                  <li><i class="fa fa-check"></i> Cabin Baggage - 70KG</li>
                  <li><i class="fa fa-check"></i> Check-In Baggage - 15KG</li>
                  <li><i class="fa fa-check"></i> Cancellation fees - Applicable</li>
                  <li><i class="fa fa-check"></i> Reissue fees - Applicable</li>
                  <li><i class="fa fa-check"></i> Seat - Chargeable </li>
                  <li><i class="fa fa-check"></i> Meal - Chargeable</li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="boxnewd">
              <div class="crpcond">
                <input type="radio" />
                Super6E</div>
              <div class="situated">
                <div class="insideb">
                  <p>Publish Fare <span><i class="fa fa-inr"></i> 8369</span></p>
                </div>
                <div class="insideb">
                  <p>Offer Fare <span><i class="fa fa-inr"></i> 8265</span></p>
                </div>
              </div>
              <div class="cancellationbt">
                <ul>
                  <li><i class="fa fa-check"></i> Cabin Baggage - 70KG</li>
                  <li><i class="fa fa-check"></i> Check-In Baggage - 15KG</li>
                  <li><i class="fa fa-check"></i> Cancellation fees - Applicable</li>
                  <li><i class="fa fa-check"></i> Reissue fees - Applicable</li>
                  <li><i class="fa fa-check"></i> Seat - Chargeable </li>
                  <li><i class="fa fa-check"></i> Meal - Chargeable</li>
                </ul>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
-->	
  </div>
  <div class="loadmoreprice" id="moreflight<?php echo stripslashes($res['id']); ?>" style="display:none;"></div>
</div>
<?php $mainlistcount++; } ?>

<script>
   $("#flightsCount").text('<?php echo ($mainlistcount-1); ?>');
   $("#flightsCountInput").val('<?php echo ($mainlistcount-1); ?>');


function flightdetailsbox(id, secid, tabid) {
	if (tabid == 4) {
		$('#flightdetails' + id).html('Loading...');
	}

	var secid = $('input[name="flightprice' + id + '"]:checked').val();
	$('#flightdetails' + id).load('flightdetailsbox.php?id=' + secid + '&mainid=' + id + '&tabid=' + tabid);
}


function hidedetailbtn(id) {
	var blk = $('#flightdetails' + id).css('display');
	if (blk == 'block') {
		$('#viewdetailbtn' + id).text('Show Details');
		$('#flightdetails' + id).hide();
	} else {
		$('#viewdetailbtn' + id).text('Hide Details');
		$('#flightdetails' + id).show();
	}
}


function hideallfilterarrow() {
	$('#departurefa').hide();
	$('#durationfa').hide();
	$('#arrivalfa').hide();
	$('#pricefa').hide();
	$('#departurefaReturn').hide();
	$('#durationfaReturn').hide();
	$('#arrivalfaReturn').hide();
	$('#pricefaReturn').hide();
}

function getSortedPrice() {
	var pricefilterid = $('#pricefilterid').val();
	var $wrap = $('.listouter');
	hideallfilterarrow();
	$('#pricefa').show();
	$wrap.find('.item').sort(function(a, b) {
			if (pricefilterid == 1) {
				$('#pricefilterid').val('0');
				$('#pricefa').removeClass('fa-caret-down');
				$('#pricefa').addClass('fa-caret-up');
				return +a.getAttribute('data-price') - +b.getAttribute('data-price');
			} else {
				$('#pricefilterid').val('1');
				$('#pricefa').removeClass('fa-caret-up');
				$('#pricefa').addClass('fa-caret-down');
				return +b.getAttribute('data-price') - +a.getAttribute('data-price');
			}
		})
		.appendTo($wrap);
}
getSortedPrice();

function getSortedArrival() {
	var pricefilterid = $('#arrivalfilterid').val();
	var $wrap = $('.listouter');
	hideallfilterarrow();
	$('#arrivalfa').show();
	$wrap.find('.item').sort(function(a, b) {
			if (pricefilterid == 1) {
				$('#arrivalfilterid').val('0');
				$('#arrivalfa').removeClass('fa-caret-down');
				$('#arrivalfa').addClass('fa-caret-up');
				return +a.getAttribute('data-arrive') - +b.getAttribute('data-arrive');
			} else {
				$('#arrivalfilterid').val('1');
				$('#arrivalfa').removeClass('fa-caret-up');
				$('#arrivalfa').addClass('fa-caret-down');
				return +b.getAttribute('data-arrive') - +a.getAttribute('data-arrive');
			}
		})
		.appendTo($wrap);
}

function getSortedDeparture() {
	var pricefilterid = $('#departurefilterid').val();
	var $wrap = $('.listouter');
	hideallfilterarrow();
	$('#departurefa').show();
	$wrap.find('.item').sort(function(a, b) {
			if (pricefilterid == 1) {
				$('#departurefilterid').val('0');
				$('#departurefa').removeClass('fa-caret-down');
				$('#departurefa').addClass('fa-caret-up');
				return +a.getAttribute('data-depart') - +b.getAttribute('data-depart');
			} else {
				$('#departurefilterid').val('1');
				$('#departurefa').removeClass('fa-caret-up');
				$('#departurefa').addClass('fa-caret-down');
				return +b.getAttribute('data-depart') - +a.getAttribute('data-depart');
			}
		})
		.appendTo($wrap);
}

function getSortedDuration() {
	var pricefilterid = $('#durationfilterid').val();
	var $wrap = $('.listouter');
	hideallfilterarrow();

	$('#durationfa').show();
	$wrap.find('.item').sort(function(a, b)

			{
				if (pricefilterid == 1) {
					$('#durationfilterid').val('0');

					$('#durationfa').removeClass('fa-caret-down');

					$('#durationfa').addClass('fa-caret-up');
					return +a.getAttribute('data-duration') -

						+b.getAttribute('data-duration');
				} else {
					$('#durationfilterid').val('1');

					$('#durationfa').removeClass('fa-caret-up');

					$('#durationfa').addClass('fa-caret-down');
					return +b.getAttribute('data-duration') -

						+a.getAttribute('data-duration');

				}
			})

		.appendTo($wrap);

}


var $filterCheckboxes = $('#allFilterDiv input[type="checkbox"]');
$filterCheckboxes.on('change', function() {
	var selectedFilters = {};
	$filterCheckboxes.filter(':checked').each(function() {
		if (!selectedFilters.hasOwnProperty(this.name)) {
			selectedFilters[this.name] = [];
		}
		selectedFilters[this.name].push(this.value);
	});

	// create a collection containing all of the filterable elements

	var $filteredResults = $('.itemlist');
	// loop over the selected filter name -> (array) values pairs
	$.each(selectedFilters, function(name, filterValues) {
		// filter each .flower element
		$filteredResults = $filteredResults.filter(function() {
			var matched = false,
				currentFilterValues = $(this).data('category').split(' ');
			// loop over each category value in the current .flower's data-category
			$.each(currentFilterValues, function(_, currentFilterValue) {
				// if the current category exists in the selected filters array
				// set matched to true, and stop looping. as we're ORing in each
				// set of filters, we only need to match once
			if ($.inArray(currentFilterValue, filterValues) != -1) {
				matched = true;
				return false;
			}
			});

			// if matched is true the current .flower element is returned
			return matched;
		});
	});
	$('.itemlist').hide().filter($filteredResults).show();
});


$(function() {
	var maxprice = Number($('#maxprice').val());
	var minprice = Number($('#minprice').val());
	$("#slider-ranges").slider({
		range: true,
		min: minprice,
		max: maxprice,
		values: [minprice, maxprice],
		slide: function(event, ui) {
			$("#amountfilter").val("" + ui.values[0] + " - " + ui.values[1]);
			showProducts(ui.values[0], ui.values[1]);
		}
	});

	$("#amountfilter").val("" + $("#slider-ranges").slider("values", 0) +
		" - " + $("#slider-ranges").slider("values", 1));
});


function showProducts(minPrice, maxPrice) {
	$(".item").hide().filter(function() {
		var price = parseInt($(this).data("price"), 10);
		return price >= minPrice && price <= maxPrice;
	}).show();
}
</script>
<input name="maxprice" id="maxprice" type="hidden" value="<?php echo $maxprice; ?>">
<input name="minprice" id="minprice" type="hidden" value="<?php echo $minprice; ?>">
<div id="shareMail" style="display:none;"></div>
<script>
function showratetablebox(id){
var morefrebt = $('#morefrebt'+id).text();
if(morefrebt=='+ More Fare'){
$('#ratetablebox'+id).css('height','auto');
$('#morefrebt'+id).text('- Less Fare');
} else { 
$('#ratetablebox'+id).css('height','50px');
$('#morefrebt'+id).text('+ More Fare');
}
}


function scbfun(){ 
var checkedValue = null;
var totalval='';
var checkedValue = null; 
var inputElements = document.getElementsByClassName('sck');
for(var i=0; inputElements[i]; ++i){ 
	if(inputElements[i].checked){
	  totalval+=checkedValue = inputElements[i].value+',';
	}
}

if(totalval!=''){
$('#loadshareflightbox').load('loadshareflightbox.php?checkval='+totalval);
$('.sharefooterbox').show();
} else {
$('.sharefooterbox').hide();
}
}

 
function PrintElem(elem){
	//Popup($(elem).html());
    var range = document.createRange();
    range.selectNode(document.getElementById(elem));
    window.getSelection().removeAllRanges(); // clear current selection
    window.getSelection().addRange(range); // to select text
    document.execCommand("copy");
    window.getSelection().removeAllRanges();// to deselect
    alert('Copied...');
}
	
function shareEmail(elem){
	// If you want to store the data in another HTML element
    $( "#shareMail" ).html( $( "#"+elem ).html() );

     // If you want to store the data in a js var
     myVar = $( "#shareMail" ).html();
		
	//var divData=$("#"+elem).html();	
	window.open('shareFlightDetailsOnMail.php?data='+encodeURI(myVar), 'new div', 'height=400,width=600');
}
	
function shareWhatsApp(elem){		
// If you want to store the data in another HTML element
	$( "#shareMail" ).html( $( ".finalsharewhatsapp").html() ); 
// If you want to store the data in a js var
   myVar = $( "#shareMail" ).text();
	 
//myVar = '';
	//var divData=$("#"+elem).html();	
	//window.open('shareFlightDetailsOnMail.php?data='+encodeURI(myVar), 'new div', 'height=400,width=600');
	
	window.open('https://api.whatsapp.com/send?phone=&text='+encodeURI($( ".finalsharewhatsapp").text()),'_blank');
}



function Popup(data){
	var mywindow = window.open('', 'new div', 'height=400,width=600');
	mywindow.document.write('<html><head><title>Download</title>');

        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');

    mywindow.document.write('<style>@media print { .hidelogos {display:none;} h2{ margin-bottom:0px; padding-bottom:0px;}</style></head><body >');

    mywindow.document.write('<h2><?php echo stripslashes($LoginUserDetails['companyName']); ?></h2>Phone: <?php echo stripslashes($LoginUserDetails['countryCode']); ?><?php echo stripslashes($LoginUserDetails['phone']); ?><br>Email: <?php echo stripslashes($LoginUserDetails['email']); ?></br>Address: <?php echo stripslashes($LoginUserDetails['address']); ?><hr></br>'+data);

    mywindow.document.write('</body></html>');

	mywindow.print();
	mywindow.close();
    return true;
}
</script>

<div class="sharefooterbox">
  <div class="heading">Share Flights <span onclick="$('.sck').prop('checked', false);$('.loadshareflightbox').html('');$('.sharefooterbox').hide();" style="cursor:pointer;">X</span></div>
  <div class="loadshareflightbox" id="loadshareflightbox"> </div>
  <!--
<button type="button" class="btn btn-danger" style="width:100%;" onclick="PrintElem('#loadshareflightbox');">Download</button>
-->
  <button type="button" class="btn btn-danger" style="width:28%;" onclick="PrintElem('loadshareflightbox');">Copy</button>
  <button type="button" class="btn btn-success" style="width:30%;" onclick="shareWhatsApp('loadshareflightbox');">WhatsApp</button>
  <button type="button" class="btn btn-primary" style="width:28%;" onclick="shareEmail('loadshareflightbox');">Email</button>
</div>
<script>
<?php if($endSearch==0){ ?>
 parent.$('#flightresult').load('flight_result_display_multi_city.php?undercons=<?php echo $undercons; ?>'); 
<?php } else  { ?>
 $('#loadingflight').hide(); 
<?php } ?>
/*
function showtooltip(id){
$('#stoptooltip'+id).show();
$('#stoptooltip'+id).load('websiteloadpopup.php?action=stoptooltip&id='+id);
}*/
/*
function loadmoreflight(id,FLIGHT_NO,DEP_TIME,FLIGHT_CODE){
var dd=$('#moreflight'+id).css('display');
var FLIGHT_NO = encodeURI(FLIGHT_NO);
var DEP_TIME = encodeURI(DEP_TIME);
var FLIGHT_CODE = encodeURI(FLIGHT_CODE);

if(dd=='block'){
$('#moreflight'+id).hide();
$('#booknowlink'+id+' i').addClass('fa-angle-down');
$('#booknowlink'+id+' i').removeClass('fa-angle-up');
} else {
$('#moreflight'+id).show();
$('#booknowlink'+id+' i').addClass('fa-angle-up');
$('#booknowlink'+id+' i').removeClass('fa-angle-down');
$('#moreflight'+id).load('loadmoreflight.php?FLIGHT_NO='+FLIGHT_NO+'&DEP_TIME='+DEP_TIME+'&FLIGHT_CODE='+FLIGHT_CODE);
}

}*/
</script>

<script>
<?php
$a=GetPageRecord('*','sys_flightName','1 order by name asc');
while($res=mysqli_fetch_array($a)){

$ab=GetPageRecord('id','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and FLIGHT_NAME="'.stripslashes($res['name']).'" group by ResultIndex order by AMT asc');
$flight=mysqli_num_rows($ab);

$abc=GetPageRecord('FLIGHT_NO,DEP_TIME,FLIGHT_CODE','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and FLIGHT_NAME="'.stripslashes($res['name']).'" group by FLIGHT_NO order by AMT asc');
$resf=mysqli_fetch_array($abc);

$b=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'"  and FLIGHT_NO="'.$resf['FLIGHT_NO'].'" and DEP_TIME="'.$resf['DEP_TIME'].'" and FLIGHT_CODE="'.$resf['FLIGHT_CODE'].'" group by PCC order by AMT asc  ');
$flightprice=mysqli_fetch_array($b);

$str_arr = explode (",", $flightprice['agfare']);  
$basefares = explode ("=", $str_arr[2]);
?>
$('.totalflight<?php echo stripslashes($res['id']); ?>').html('(<?php echo stripslashes($flight); ?>)<span>&#8377;<?php echo $basefares[1]+$flightprice['agentFixedMakup']; ?></span>');
<?php 
} 
?>
</script>
<script>
$(".but").click (function(){
  // Close all open windows
  $(".boxcontentnew").stop().slideUp(300); 
  // Toggle this window open/close
  $(this).next(".boxcontentnew").stop().slideToggle(300);
  //hitter test// 
  $(".hitter").show()
});

$(".hitter").click (function(){
  // Close all open windows
  $(".boxcontentnew").stop().slideUp(300); 
});
</script>