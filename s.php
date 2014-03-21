<!DOCTYPE html>
<html>
  <head>
    <title>Lifestream Report Form</title>
  </head>
  <body>
    <form action="rep.php" method="post">
      <label for="type">Type</label>
      <select id="type" name="type">
        <option value="Location" selected>Location</option>
        <option value="Activity">Activity</option>
        <option value="Music mood">Music mood</option>
      </select>
      <input type="text" name="data">
      <input type="submit">
    </form>
  </body>
</html>
