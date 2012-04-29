<?php

/**
*  fanpage.php
*
*  fanpage class
*
*  @author Daniel Villacres
*  undertango@gmail.com
*
*/

include_once('api.php');

class fanpage {

  // get fanpages from ondango api
  function get_fanpages() {

    $oapi = new o_api();
    $rf = $oapi->get_fanpages();
    
    $this->fanpage_id = $rf->data[0]->Fanpage->fanpage_id;
    $this->fanpage_url = $rf->data[0]->Fanpage->fanpage_url;

  } // end get_fanpages function
  
} // class end