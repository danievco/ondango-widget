<?php

/**
*  sale.php
*
*  sales class
*
*  @author Daniel Villacres
*  undertango@gmail.com
*
*/

include_once('api.php');

class sale {

  // get sales from ondango api
  function get_sales() {

    $oapi = new o_api();

    $today = date("Y-m-d");
    $pdate = "0,".$today;
    $rs = $oapi->get_data("sales",$pdate);

    $this->sold_products = 0; // sold products

    $a = $rs->data;
    $this->no = count($rs->data); // number of orders

    for( $i = 0; $i < $this->no; $i++ ) {

      $ord = $a[$i]->Order;
      $this->ns[$i] = count($ord->Sales); // number of sales
      $sale[$i] = $ord->Sales;

      for( $j = 0; $j < $this->ns[$i]; $j++ ) {

        $sa = $sale[$i];

        $this->product_id[$i][$j] = $sa[$j]->Sale->product_id;
        $this->quantity[$i][$j] = $sa[$j]->Sale->quantity;
        $this->sold_products++;
               
      } // for $j
    } // for $i
        
  } // end get_sales function
} // class end