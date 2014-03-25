<?php
$db = new SQLite3("jinsei.sqlite");
$str = 'SELECT * FROM stuff WHERE rid='.$db->escapeString($_REQUEST['id']).' LIMIT 1';
$row = $db->query($str)->fetchArray();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Lifestream Report Form</title>
  </head>
  <body>
    <h4>Editing row #<?php echo $row['rid']; ?></h4>
    <form action="api.php" method="post">
      <input type="hidden" name="action" value="editrow">
      <input type="hidden" name="id" value="<?php echo $row['rid']; ?>">
      <label for="type">Type</label>
      <select id="type" name="type">
        <option value="Location" selected>Location</option>
        <option value="General mood">General mood</option>
        <option value="Activity">Activity</option>
        <option value="Music mood">Music mood</option>
      </select>
      <label for="data">Data</label>
      <input type="text" name="data" id="data" value="<?php echo $row['data'] ?>">
      <label for="user">User</label>
      <input type="text" name="user" id="user" placeholder="Username">
      <label for="pass">User</label>
      <input type="password" name="pass" id="pass" placeholder="Password">
      <input type="submit">
    </form>
  </body>
</html>
