<?php

/**
*  functions.php
*
*  widget functions
*
*  @author Daniel Villacres
*  undertango@gmail.com
*
*/

/*
include_once('sale.php');
include_once('product.php');

# retrieve all sales
$os = new sale();
$os->get_sales();

# retrieve products id's
$op = new product();
$op->get_products();
*/

include_once('sale.php');
include_once('product.php');
include_once('fanpage.php');

function calculate_best_sales() {
  
  $os = new sale();
  $os->get_sales();
  
  $op = new product();
  $op->get_products();

  // sum sales by product
  for( $i = 0; $i < $os->no; $i++ ) {
    for( $j = 0; $j < $os->ns[$i]; $j++) {
      $prod_id_sale = $os->product_id[$i][$j]; // sale product id
      $prod_quantity = $os->quantity[$i][$j]; // sale quantity

      for( $k = 0; $k < $op->np; $k++ ) {
        if( strcmp($op->product_id[$k], $prod_id_sale) == 0 ) {
          $op->total_sales[$k] = $op->total_sales[$k] + $prod_quantity;
        }
      }
    }
  }
  
  // sort sales array descendant
  arsort($op->total_sales);
  $i = 0; // best sales counter

  foreach( $op->total_sales as $key => $val ) {
    if( $i < BEST_SALES ) {
      $best_sale_id[$i] = $op->product_id[$key];
      $i++;
    }
  }
  
  unset( $os );
  unset( $op );
  
  return $best_sale_id;
  
} // end calculate_best_sales function

// get best seller product details
function get_best_sales_info($a) {

  $op = new product();
  
  for( $i = 0; $i < BEST_SALES; $i++ ) {
    $op->get_best_sale($a[$i], $i);
  }
  
  return $op;
    
}

// set image url
function get_image_url($product_id, $filename) {

  // take file name without extension
  $point_position = strrpos($filename, ".");
  $fname = substr($filename, 0, $point_position); // file name with no extension
  $fext = substr($filename, -3); // file extension  
  $url = BASE_IMG_URL.$product_id."/".$fname."_m.".$fext;  
  
  return $url;
  
} // end get_image_url function

// obtain facebook link of product
function get_fb_product_url($product_id, $title) {

  // fanpages
  $ofp = new fanpage();
  $ofp->get_fanpages();
  
  $fanpage_id = $ofp->fanpage_id;
  $fanpage_url = $ofp->fanpage_url;
  
  // base url
  $b_url = $fanpage_url."?v=app_134919589893626&app_data=";
  
  // fix product title
  $title = strtolower( str_replace(" ", "-", $title) );
  $url = $b_url . $product_id . "-" . $title;
  
  unset($ofp);
  
  return $url;
    
}