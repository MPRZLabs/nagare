<?php
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
  </head>
  <body>
    <div class="container">
      <div class="jumbotron">
<?php
  $location = $db->query('SELECT * FROM stuff WHERE type="Location" ORDER BY time DESC LIMIT 1')->fetchArray();
  $musicmood = $db->query('SELECT * FROM stuff WHERE type="Music mood" ORDER BY time DESC LIMIT 1')->fetchArray();
  $activity = $db->query('SELECT * FROM stuff WHERE type="Activity" ORDER BY time DESC LIMIT 1')->fetchArray();
  echo "        <h1>Michcioperz's simple life log</h1>";
  echo "        <h3><span class=\"glyphicon glyphicon-screenshot\"></span> Location: <strong>".$location['data']."</strong> <small>last updated <time class=\"timeago\" datetime=\"".date('c',$location['time'])."\">".date('c',$location['time'])."</time></small></h3>";
  echo "        <h3><span class=\"glyphicon glyphicon-folder-open\"></span> Activity: <strong>".$activity['data']."</strong> <small>last updated <time class=\"timeago\" datetime=\"".date('c',$activity['time'])."\">".date('c',$activity['time'])."</time></small></h3>";
  echo "        <h3><span class=\"glyphicon glyphicon-headphones\"></span> Music mood: <strong>".$musicmood['data']."</strong> <small>last updated <time class=\"timeago\" datetime=\"".date('c',$musicmood['time'])."\">".date('c',$musicmood['time'])."</time></small></h3>";
?>
      </div>
      <div class="jumbotron">
        <h2>History of updates:</h2>
        <ul>
<?php
  $results = $db->query('SELECT * FROM stuff ORDER BY time DESC LIMIT 50');
  while ($row = $results->fetchArray()) {
    echo "          <li><small><time class=\"timeago\" datetime=\"".date('c',$row['time'])."\">".date('c',$row['time'])."</time></small> &raquo; ".$row['type'].": ".$row['data']."</li>";
  }
?>
        </ul>
      </div>
      <footer>Powered by <a href="http://github.com/MPRZLabs/nagare">流れ</a>, a script quickly written by Michcioperz, with code so messy so no serious programmer would ever look at. <a href="s.php">Submission panel (password required)</a></footer>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.3.1/jquery.timeago.min.js"></script>
    <script>
      $(document).ready(function() {
        $('time.timeago').timeago();
      });
    </script>
  </body>
</html>
<?php
  $db->close();
?>
