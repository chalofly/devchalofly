<?php 
include "inc.php";  
$page='about-us';
 

$rs=GetPageRecord('*','cmsPages','url="'.$page.'"');  
$pagecontent=mysqli_fetch_array($rs); 
?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title><?php echo $pagecontent['tabTitle']; ?></title> 
<meta name="title" content="<?php echo stripslashes($pagecontent['metaTitle']); ?>">
<meta name="keywords" content="<?php echo stripslashes($pagecontent['metaKeyword']); ?>">
<meta name="description" content="<?php echo stripslashes($pagecontent['metaDescription']); ?>">
<meta name="keywords" content="<?php echo stripslashes($pagecontent['seoTag1']); ?>">
<meta name="keywords" content="<?php echo stripslashes($pagecontent['seoTag2']); ?>">
<meta name="keywords" content="<?php echo stripslashes($pagecontent['seoTag3']); ?>">
<meta name="robots" content="<?php echo $pagecontent['robotTag']; ?>">

<meta property="og:site_name" content="<?php echo $pagecontent['ogsiteName']; ?>"/>

<meta property="og:type" content="<?php echo $pagecontent['ogType']; ?>"/>

<meta property="og:title" content="<?php echo $pagecontent['ogmetaTitle']; ?>"/>

<meta property="og:description" content="<?php echo $pagecontent['ogmetaDescription']; ?>"/>

<meta property="og:image" content="<?php echo $pagecontent['ogImage']; ?>"/>

<meta property="og:url" content="<?php echo $pagecontent['ogURL']; ?>"/>

<meta name="twitter:title" content="<?php echo $pagecontent['twitterMetaTitle']; ?>"/>

<meta name="twitter:description" content="<?php echo $pagecontent['twitterMetaDescription']; ?>"/>

<meta property="twitter:image" content="<?php echo $pagecontent['twitterImage']; ?>"/>

<meta property="twitter:site" content="<?php echo $pagecontent['twitterSite']; ?>"/>

<meta property="twitter:creator" content="<?php echo $pagecontent['twitterCreator']; ?>"/>

<?php include "headerinc.php"; ?>

  <link rel="stylesheet" href="<?php echo $fullurl; ?>css/footer-css.css">

</head>



<body class="greybluebg">



<?php include "header.php"; ?>

<section class="holidaybanner"
style="background-image:url('<?php echo $packagephotourl.$pagecontent['photo']; ?>');">

    <div class="container holidabancontainer">
        <div class="row">
            <div class="col-lg-12">

                <div class="holidaysearch">
                    <h1>
                        <?php echo stripslashes($pagecontent['name']); ?>
                    </h1>
                </div>

            </div>
        </div>
    </div>

</section>






<section class="holidaydestination"> 

	<div class="container" style="margin-top:30px;">

        <div class="row offerboxes"> 
<?php echo (stripslashes($pagecontent['description'])); ?>

</div>

    </div> 

	

	</section>
 



<?php include "footer.php"; ?>

















<script>



    $( function() {

    $( "#departuredate" ).datepicker(

	{

changeMonth: true,

            changeYear: true,

            yearRange: '-100:+0',

			dateFormat: 'dd-mm-yy',

			maxDate: new Date()

	

	}

	

	);

  } );

  

  

  

 function getSearchCityHotel(citysearchfield,cityresultfield,listsearch){

var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  

var citysearchfield = citysearchfield;



if(citysearchfieldval!=''){  

$('#'+listsearch).show();

$('#'+listsearch).load('searchcitylistshotel.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);

}

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



 

</script>
 <?php include "footerinc.php"; ?>
</body>

</html>

