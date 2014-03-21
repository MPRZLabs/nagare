<?php
echo '<?xml version="1.0" encoding="UTF-8" ?>';
?>
<rss version="2.0">
<channel>
  <title>Michcioperz's lifestream</title>
  <link>http://status.ijestfajnie.pl</link>
<?php
  $db = new SQLite3("jinsei.sqlite");
  $results = $db->query('SELECT * FROM stuff ORDER BY time DESC LIMIT 100');
  while ($row = $results->fetchArray()) { ?>
  <item>
    <title><?php echo date('Y-m-d H:i:s',$row['time'])." >> ".$row['type'].": ".$row['data']; ?></title>
  </item>
<?php }
  $db->close();
?>
</channel>
</rss>
