<?php
require 'connection.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Data Prescription</title>
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
  <button onclick = "window.location.href='index.php'" class="button button1">Menu</button> <br>
  <button onclick = "window.location.href='login.php'" class="button button2">Login Page </button> <br>

  <br>
<br>
<br>
  <table border = 1 cellspacing = 0 cellpadding = 10>
      <tr>
      <td>Prescription ID</td>
        <td>Medication ID</td>
        <td>User ID</td>
        <td>Start Date</td>
        <td>End Date</td>
        <td>Notes</td>
        <td></td>
      </tr>
      <?php
      $i = 1;
      $rows = mysqli_query($conn, "SELECT *FROM prescriptions ORDER BY prescription_id ASC")
      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
        <td><?php echo $row["prescription_id"]; ?></td>
        <td><?php echo $row["medication_id"]; ?></td>
        <td><?php echo $row["user_id"]; ?></td>
        <td><?php echo $row["start_date"]; ?></td>
        <td><?php echo $row["end_date"]; ?></td>
        <td><?php echo $row["notes"]; ?></td>

        <td><?php echo '<a href="infoEditPrescription.php?id=',$row["prescription_id"],'">Edit Prescription</a>'; ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
    <br>
    

  </body>
</html>
