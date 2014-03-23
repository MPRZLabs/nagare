<!DOCTYPE html>
<html>
  <head>
    <title>Lifestream Report Form</title>
  </head>
  <body>
    <form action="api.php" method="post">
      <input type="hidden" name="action" value="publish">
      <label for="type">Type</label>
      <select id="type" name="type">
        <option value="Location" selected>Location</option>
        <option value="General mood">General mood</option>
        <option value="Activity">Activity</option>
        <option value="Music mood">Music mood</option>
      </select>
      <label for="data">Data</label>
      <input type="text" name="data" id="data">
      <label for="user">User</label>
      <input type="text" name="user" id="user" placeholder="Username">
      <label for="pass">User</label>
      <input type="password" name="pass" id="pass" placeholder="Password">
      <input type="submit">
    </form>
  </body>
</html>
