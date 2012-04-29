<?php

/**
*  api.php
*
*  ondango api
*
*  @author Daniel Villacres
*  undertango@gmail.com
*
*  $shop_id = 87;
*  $api_key = "f877615136d70e0ffc2fb224d5872d6a8fd2xbd7";
*
*
*/

class o_api {

  // function to get all products and all sales
  function get_data($fn,$dt) {

    //$api_key = $_SESSION['api_key'];
    //$shop_id = $_SESSION['shop_id'];
    
    $shop_id = 87;
    $api_key = "f877615136d70e0ffc2fb224d5872d6a8fd2xbd7";
    
    if( isset($dt) ) {
      $date = $dt;
    }
    $api_url = "http://api.ondango-labs.com/";
    $api_function = $fn."/all/";
    $api_method = "GET";
    if( isset($dt) ) {
      $api_params = array (
  	      "api_key" => $api_key,
  	      "shop_id" => $shop_id,
              "date" => $date
      );
    } else {
      $api_params = array (
  	      "api_key" => $api_key,
  	      "shop_id" => $shop_id
      );
    }

    $curl = curl_init ();
    curl_setopt_array ($curl, array (
      	  CURLOPT_URL => $api_url . $api_function . "?" . http_build_query ($api_params),
	  CURLOPT_CUSTOMREQUEST => $api_method,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_FOLLOWLOCATION => true
    ));

    $rst = json_decode(curl_exec ($curl));
    curl_close ($curl);

    return $rst;
 
  } // end get_data function
  
  // function to get product details by product_id
  function get_product_details($prod_id) {

    $api_key = $_SESSION['api_key'];
    $shop_id = $_SESSION['shop_id'];
    
    $api_url = "http://api.ondango-labs.com/";
    $api_function = "products/";
    $api_method = "GET";
    $api_params = array (
	    "api_key" => $api_key,
  	    "shop_id" => $shop_id,
            "product_id" => $prod_id
    );
    
    $curl = curl_init ();
    curl_setopt_array ($curl, array (
      	  CURLOPT_URL => $api_url . $api_function . "?" . http_build_query ($api_params),
	  CURLOPT_CUSTOMREQUEST => $api_method,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_FOLLOWLOCATION => true
    ));

    $rst = json_decode(curl_exec ($curl));
    curl_close ($curl);

    return $rst;
 
  } // end get_product_details function
  
  // function to get fanpages
  function get_fanpages() {

    //$api_key = $_SESSION['api_key'];
    //$shop_id = $_SESSION['shop_id'];
    
    $shop_id = 87;
    $api_key = "f877615136d70e0ffc2fb224d5872d6a8fd2xbd7";
    
    $api_url = "http://api.ondango-labs.com/";
    $api_function = "fanpages/all/";
    $api_method = "GET";
    $api_params = array (
  	    "api_key" => $api_key,
  	    "shop_id" => $shop_id
    );

    $curl = curl_init ();
    curl_setopt_array ($curl, array (
      	  CURLOPT_URL => $api_url . $api_function . "?" . http_build_query ($api_params),
	  CURLOPT_CUSTOMREQUEST => $api_method,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_FOLLOWLOCATION => true
    ));

    $rst = json_decode(curl_exec ($curl));
    curl_close ($curl);

    return $rst;
 
  } // end get_fanpages function

} // class end