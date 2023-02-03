<?php
require 'connection.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Data Medications</title>
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
  <button onclick = "window.location.href='stock.php'" class="button button2">Check Stock </button> <br>

  <br>
<br>
<br>
  <table border = 1 cellspacing = 0 cellpadding = 10>
      <tr>
        <td>Medication ID</td>
        <td>Name</td>
        <td>Dose</td>
        <td>Frequency</td>

      </tr>
      <?php
      $i = 1;
      $rows = mysqli_query($conn, "SELECT m.medication_id, m.name, m.dose, m.frequency, s.number_of_pills
                              FROM medications m
                              JOIN stock s ON m.medication_id = s.medication_id
                              ORDER BY m.name ASC");
      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
        <td><?php echo $row["medication_id"]; ?></td>
        <td><?php echo $row["name"]; ?></td>
        <td><?php echo $row["dose"]; ?></td>
        <td><?php echo $row["frequency"]; ?></td>

        <td><?php echo '<a href="infoEditMed.php?medication_id=',$row["medication_id"],'">Edit</a>'; ?></td>

      </tr>
      <?php endforeach; ?>
    </table>
    <br>
    

  </body>
</html>
