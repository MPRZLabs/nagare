<?php
  error_reporting(E_ALL);
  date_default_timezone_set('Europe/Berlin');
  $db = new SQLite3("jinsei.sqlite");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Michcioperz's lifestream</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <style>
      .jumbotron {
        margin-top:20px;
      }
    </style>
    <link rel="alternate" type="application/rss+xml" href="rss.php">
  </head>
  <body>
    <div class="container">
      <div class="jumbotron">
<?php
  echo "        <h1>Michcioperz's simple life log</h1>";
  $columns = $db->query('SELECT * FROM columns ORDER BY ord ASC');
  while ($col = $columns->fetchArray()) {
    $row = $db->query('SELECT * FROM stuff WHERE type="'.$col['name'].'" ORDER BY time DESC LIMIT 1')->fetchArray();
    echo "        <h3><span class=\"glyphicon ".$col['glyphicon']."\"></span> ".$col['name'].": <strong>".$row['data']."</strong> <small>last updated <time class=\"timeago\" datetime=\"".date('c',$row['time'])."\">".date('c',$row['time'])."</time></small></h3>";
  }
?>
        <div class="pull-right"><button type="button" class="btn btn-default" id="btn--refresh"><span class="glyphicon glyphicon-refresh"></span> Refresh</button><br /><small>will auto-refresh every 60 seconds</small></div>
      </div>
      <div class="jumbotron">
        <h2>History of updates:</h2>
        <ul>
<?php
  $results = $db->query('SELECT * FROM stuff ORDER BY time DESC LIMIT 50');
  while ($row = $results->fetchArray()) {
    echo "          <li class=\"lekaboom\"><a href=\"ed.php?id=".$row['rid']."\" alt=\"edit row\"><small>#".$row['rid']."</small></a> &laquo; <small><time class=\"timeago\" datetime=\"".date('c',$row['time'])."\">".date('c',$row['time'])."</time></small> &raquo; ".$row['type'].": ".$row['data']."</li>";
  }
?>
        </ul>
      </div>
      <footer>Powered by <a href="http://github.com/MPRZLabs/nagare">流れ</a>, a script quickly written by Michcioperz, with code so messy so no serious programmer would ever look at. <a href="s.php">Submission panel (password required)</a></footer>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.3.1/jquery.timeago.min.js"></script>
    <script>
      $("button#btn--refresh").click(function() {
        window.location.reload();
      });
      $(document).ready(function() {
        $('time.timeago').timeago();
        setInterval(function () { window.location.reload(); }, 60000);
      });
    </script>
  </body>
</html>
<?php
  $db->close();
?>
