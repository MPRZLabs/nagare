<!DOCTYPE html>
<html>
  <head>
    <title>Michcioperz's lifestream</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <ul>
<?php
  $db = new SQLite3("jinsei.sqlite");
  $results = $db->query('SELECT * FROM stuff ORDER BY time DESC LIMIT 50');
  while ($row = $results->fetchArray()) {
    echo "      <li>".date('c',$row['time'])." >> ".$row['type'].": ".$row['data']."</li>";
  }
  $db->close();
?>
    </ul>
  </body>
</html>
