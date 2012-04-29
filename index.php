<?php

/**
*  index.php
*
*  Widget Main page
*
*  @author Daniel Villacres
*  undertango@gmail.com
*
*/

session_start();

// api_key and shop_id values
$_SESSION['api_key'] = $_GET['api_key'];
$_SESSION['shop_id'] = $_GET['shop_id'];

// validate api_key and shop_id presence

if( empty( $_SESSION['api_key'] )) {
  echo "<p>Not so fast Alter! You must to tell us the API Key.";
  exit;
}

if( empty( $_SESSION['shop_id'] )) {
  echo "<p>Easy Kiddo! We need to know the Shop ID.";
  exit;
}

// number of best sales and base images url
define("BEST_SALES", 3);
define("BASE_IMG_URL", "http://static-products.ondango.com/");

include_once('functions.php');

$a_bs = calculate_best_sales();

// get product info of best sales
$obs = get_best_sales_info($a_bs);

// set url of images
for( $i = 0; $i < BEST_SALES; $i++ ) {
  for( $j = 0; $j < $obs->n_img[$i]; $j++) {
    // url images
    $url_img[$i][$j] = get_image_url($obs->product_id[$i], $obs->filename[$i][$j]);
  }
  // product facebook url
  $prod_url[$i] = get_fb_product_url($obs->product_id[$i], $obs->title[$i]);
}

?>

<head>
  <meta charset="utf-8">
  <title>widget</title>
  <link rel="stylesheet" href="css/global.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
  <script src="js/slides.min.jquery.js"></script>
	
  <script>
    $(function(){
	    $('#slides').slides({
		    play: 5000,
		    pause: 2500,
		    animationStart: function(current){
			    $('.caption').animate({
				    bottom:-35
			    },100);
			    if (window.console && console.log) {
				    // example return of current slide number
				    console.log('animationStart on slide: ', current);
			    };
		    },
		    animationComplete: function(current){
			    $('.caption').animate({
				    bottom:0
			    },200);
			    if (window.console && console.log) {
				    // example return of current slide number
				    console.log('animationComplete on slide: ', current);
			    };
		    },
		    slidesLoaded: function() {
			    $('.caption').animate({
				    bottom:0
			    },200);
		    }
	    });
    });
  </script>

</head>

<body>

    <div id="slides">
        <h1>Best Sales!</h1>       
        <div class="slides_container">
<?php

  for( $i = 0; $i < BEST_SALES; $i++ ) {
  
    //$url_img = get_image_url($obs->product_id[$i], $obs->filename[$i][0]);
    
    echo "<div class='slide'>
            <a href='".$prod_url[$i]."' >
            <img src='".$url_img[$i][0]."' alt='".$obs->title[$i]."'></a>
            <div class='caption'>
              <p>".$obs->title[$i]."
              <br>".$obs->price[$i]."
            </div>
          </div>\n";

  } // for slide items

?>

    </div>
  </div>
  </body>
</html>