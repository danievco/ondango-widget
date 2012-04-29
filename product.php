<?php

/**
*  product.php
*
*  product class
*
*  @author Daniel Villacres
*  undertango@gmail.com
*
*/

include_once('api.php');

class product {

  // get all id products from ondango api
  function get_products() {

    $oapi = new o_api();
    $rp = $oapi->get_data("products");

    $this->np = count($rp->data); // number of products

    for ( $i = 0; $i < $this->np; $i++ ) {

      $a_prod = $rp->data[$i]; // array products

      $this->product_id[$i] = $a_prod->Product->product_id;
      $this->total_sales[$i] = 0; // initialize total sales
                  
    }

  } // end get_products function
  
  // get best sale info
  function get_best_sale($prod_id,$prod_ndx) {
  
    $x = $prod_ndx; // product index
    $oapi = new o_api();
    $rp = $oapi->get_product_details($prod_id);
        
    $this->product_id[$x] = $rp->data[0]->Product->product_id;
    $this->title[$x] = $rp->data[0]->Product->title;
    $this->price[$x] = $rp->data[0]->Product->price;
    
    if( !empty($rp->data[0]->Product->price_old) ) {
      $this->price_old[$x] = $rp->data[0]->Product->price_old;
      echo "<p>Old Price: ".$this->price_old[$x]."<br>";
    }    
    
    // Images info    
    $images = $rp->data[0]->Image;
    $this->n_img[$x] = count($images);
    
    for( $i = 0; $i < $this->n_img[$x]; $i++ ) {
    
      $this->image_id[$x][$i] = $images[$i]->image_id;
      $this->fileurl[$x][$i] = $images[$i]->fileurl;
      $this->filename[$x][$i] = $images[$i]->filename;
    }
  
  } // end get_product_by_id function
} // class end