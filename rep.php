<?php
  $db = new SQLite3("jinsei.sqlite");
  $type = $db->escapeString($_POST['type']);
  $data = $db->escapeString($_POST['data']);
  $time = time();
  $db->exec("CREATE TABLE IF NOT EXISTS stuff (time integer, type text, data text)");
  $query = "INSERT INTO stuff VALUES ('$time','$type','$data')";
  $db->exec($query);
  $db->close();
?>
