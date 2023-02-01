<?php
require 'connection.php';

// Check for connection error
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the medication_id from the URL
$medication_id = $_GET['medication_id'];


if (isset($_POST['submit'])) {

  $num_pills = $_POST['num_pills'];


  $sql = "INSERT INTO dispenser (medication_id, num_pills) VALUES ($medication_id, $num_pills)";
  mysqli_query($conn, $sql);

  header("Location: dataMed.php");

}



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add Med</title>
  </head>

<table border = 1 cellspacing = 0 cellpadding = 10>
      <tr>
        <td>Medication ID</td>
        <td>Name</td>
        <td>Dose</td>
        <td>Frequency</td>
      </tr>
      <?php
      $i = 1;
      $rows = mysqli_query($conn, "SELECT *FROM medications WHERE medication_id = $medication_id")
      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
        <td><?php echo $row["medication_id"]; ?></td>
        <td><?php echo $row["name"]; ?></td>
        <td><?php echo $row["dose"]; ?></td>
        <td><?php echo $row["frequency"]; ?></td>

      </tr>
      <?php endforeach; ?>
    </table>
    <br>

    <form action="" method="post">
  <label for="num_pills">Number of pills:</label>
  <input type="text" id="num_pills" name="num_pills">
  <input type="submit" name="submit" value="Submit">
</form>


  </body>
</html>
