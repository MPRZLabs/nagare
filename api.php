<?php
  error_reporting(E_ALL);
  $return = array();
  $dbdbdb = array();
  
  $action = ( isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : null );
  
  function opentehbase() {
    global $dbdbdb;
    if (!dbisopen()) {
      $dbdbdb['db'] = new SQLite3("jinsei.sqlite");
    }
    return $dbdbdb['db'];
  }
  
  function dbisopen() {
    global $dbdbdb;
    return array_key_exists('db', $dbdbdb);
  }
  
  function checkcreds() {
    if (isset($_REQUEST['user']) && $_REQUEST['user'] != null && isset($_REQUEST['pass']) && $_REQUEST['pass'] != null) {
      $base = opentehbase();
      $usr = $base->query('SELECT * FROM users WHERE username="'.$base->escapeString($_REQUEST['user']).'" LIMIT 1')->fetchArray();
      if (strcmp(hash('sha512',$_REQUEST['user']."||".$_REQUEST['pass']), $usr['passhash']) == 0) {
        return $usr['accesslevel'];
      } else {
      }
    }
    return 0;
  }
  
  function editrow($id, $type, $data) {
    opentehbase()->query("UPDATE stuff SET type = '".$type."', data = '".$data."' WHERE rid = ".$id);
  }
  
  function getcolumns() {
    $cols = array();
    $base = opentehbase();
    $qry = $base->query('SELECT * FROM columns ORDER BY ord ASC');
    while ($col = $qry->fetchArray()) {
      $cols[$col['name']] = array();
      $cols[$col['name']]['glyphicon'] = $col['glyphicon'];
      $cols[$col['name']]['order'] = $col['ord'];
    }
    return $cols;
  }
  
  function publish() {
    
  }
  
  switch($action) {
    case "getcolumns":
      $return['code'] = 0;
      $return['emsg'] = "Responding to request";
      $return['data'] = getcolumns();
      break;
    case "publish":
      $cds = checkcreds();
      switch($cds) {
        case 7:
        case 6:
        case 5:
        case 4:
          $base = opentehbase();
          $type = $base->escapeString($_REQUEST['type']);
          $data = $base->escapeString($_REQUEST['data']);
          if ($type != "" && $data != "") {
            $time = time();
            $query = "INSERT INTO stuff (time, type, data) VALUES ('$time','$type','$data')";
            $base->exec($query);
            $return['code'] = 0;
            $return['emsg'] = "Responding to request";
            $return['data'] = array('time'=>$time);
          } else {
            $return['code'] = 4;
            $return['emsg'] = "Missing type or data";
          }
          break;
        default:
          $return['code'] = 3;
          $return['emsg'] = "Insufficient privileges";
          $return['data'] = array('level'=>$cds);
      }
      break;
    case "editrow":
      $cds = checkcreds();
      switch($cds) {
        case 7:
        case 6:
        case 5:
        case 4:
          $base = opentehbase();
          $id = $_REQUEST['id'];
          $type = $base->escapeString($_REQUEST['type']);
          $data = $base->escapeString($_REQUEST['data']);
          editrow($id, $type, $data);
          $return['code'] = 0;
          $return['emsg'] = "Responding to request";
          break;
        default:
          $return['code'] = 3;
          $return['emsg'] = "Insufficient privileges";
          $return['data'] = array('level'=>$cds);
      }
      break;
    case null:
      $return['code'] = 1;
      $return['emsg'] = "Missing action parameter";
      break;
    default:
      $return['code'] = 2;
      $return['emsg'] = "Unknown action parameter";
  }
  
  if (dbisopen()) {
    opentehbase()->close();
  }
  
  echo(json_encode($return));
  die();
?>
