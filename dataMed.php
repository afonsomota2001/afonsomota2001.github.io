<?php
require 'connection.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit Medications</title>
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
  <button onclick = "window.location.href='index.html'" class="button button1">Menu</button> <br>
  <button onclick = "window.location.href='introMed.php'" class="button button2">Insert Medication </button> <br>

  <br>
<br>
<br>
  <table border = 1 cellspacing = 0 cellpadding = 10>
      <tr>
        <td>Medication ID</td>
        <td>Name</td>
        <td>Dose</td>
        <td>Frequency</td>
        <td>Number of Pills</td>

      </tr>
      <?php
      $i = 1;
      $rows = mysqli_query($conn, "SELECT *FROM medications ORDER BY medication_id ASC")
      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
        <td><?php echo $row["medication_id"]; ?></td>
        <td><?php echo $row["name"]; ?></td>
        <td><?php echo $row["dose"]; ?></td>
        <td><?php echo $row["frequency"]; ?></td>
        <td><?php echo $row["number_of_pills"]; ?></td>
        <td><?php echo '<a href="infoEditMed.php?medication_id=',$row["medication_id"],'">Edit</a>'; ?></td>
        <td><?php echo '<a href="infoAddMed.php?medication_id=',$row["medication_id"],'">Add Pills</a>'; ?></td>
        <td><?php echo '<a href="infoDeleteMed.php?medication_id=',$row["medication_id"],'">Remove All Pills</a>'; ?></td>
        

      </tr>
      <?php endforeach; ?>
    </table>
    <br>
    

  </body>
</html>
