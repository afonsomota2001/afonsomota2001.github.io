<?php
require 'connection.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Lista Utilizadores</title>
  </head>
  <style>
    .button {
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 24px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.button1 {
  background-color: white; 
  color: black; 
  border: 5px solid #FF3333;
}

.button1:hover {
  background-color: #FF3333;
  color: white;
}
.button2 {
            background-color: white; 
            color: #008CBA; 
            border: 2px solid #008CBA;
        }

        .button2:hover {
            background-color: #008CBA;
            color: white;
        }
</style>

  <body>
  <button onclick = "window.location.href='index.html'" class="button button1">Menu Principal </button> <br>
  <button onclick = "window.location.href='introUser.php'" class="button button2">Upload Utilizador </button> <br>

  <br>
<br>
Active Users
<br>
<br>
  <table border = 1 cellspacing = 0 cellpadding = 10>
      <tr>
        <td>User ID</td>
        <td>Name</td>
        <td>Date of birth</td>
        <td>Image</td>
        <td>Pathology</td>
        <td>Patient Number</td>
      </tr>
      <?php
      $i = 1;
      $rows = mysqli_query($conn, "SELECT * FROM users WHERE is_archived = 0 ORDER BY id ASC")
      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
        <td><?php echo $row["id"]; ?></td>
        <td><?php echo $row["name"]; ?></td>
        <td><?php echo $row["date"]; ?></td>
        <td> <img src="img/<?php echo $row["profile_picture"]; ?>" width = 200 title="<?php echo $row['profile_picture']; ?>"> </td>
        <td><?php echo $row["pathology"]; ?></td>
        <td><?php echo $row["id_number"]; ?></td>
        <td><?php echo '<a href="archiveUser.php?id=',$row["id"],'">Archive</a>'; ?></td>



      </tr>
      <?php endforeach; ?>
    </table>
    <br>
    
    Unactive Users
<br>
<br>
  <table border = 1 cellspacing = 0 cellpadding = 10>
      <tr>
        <td>User ID</td>
        <td>Name</td>
        <td>Date of birth</td>
        <td>Image</td>
        <td>Pathology</td>
        <td>Patient Number</td>
      </tr>
      <?php
      $i = 1;
      $rows = mysqli_query($conn, "SELECT * FROM users WHERE is_archived = 1 ORDER BY id ASC")
      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
        <td><?php echo $row["id"]; ?></td>
        <td><?php echo $row["name"]; ?></td>
        <td><?php echo $row["date"]; ?></td>
        <td> <img src="img/<?php echo $row["profile_picture"]; ?>" width = 200 title="<?php echo $row['profile_picture']; ?>"> </td>
        <td><?php echo $row["pathology"]; ?></td>
        <td><?php echo $row["id_number"]; ?></td>
        <td><?php echo '<a href="activateUser.php?id=',$row["id"],'">Activate</a>'; ?></td>



      </tr>
      <?php endforeach; ?>
    </table>
    <br>

  </body>
</html>
