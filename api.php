<?php

  $return = array();
  
  $action = ( isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : null );
  
  switch($action) {
    case null:
      $return['code'] = 1;
      $return['emsg'] = "Missing action parameter";
      break;
    default:
      $return['code'] = 2;
      $return['emsg'] = "Unknown action parameter";
  }
  
  echo(json_encode($return));
  die();
?>
