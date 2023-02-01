<?php
require 'connection.php';

// Check for connection error
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the medication_id from the URL
$medication_id = $_GET['medication_id'];


if (isset($_POST['submit'])) {

  $num_pills_toAdd = $_POST['num_pills'];

  $result = mysqli_query($conn, "SELECT number_of_pills FROM medications WHERE medication_id = $medication_id");
  $row = mysqli_fetch_assoc($result);
  $num_pills_inDisp = $row['number_of_pills'];
  
  $num_pills_total = $num_pills_toAdd + $num_pills_inDisp;

  $sql = "UPDATE medications SET number_of_pills = $num_pills_total WHERE medication_id = $medication_id";
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
        <td>Number of pills </td>
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
        <td><?php echo $row["number_of_pills"]; ?></td>

      </tr>
      <?php endforeach; ?>
    </table>
    <br>

    <form action="" method="post">
  <label for="num_pills">Number of pills to add:</label>
  <input type="text" id="num_pills" name="num_pills">
  <input type="submit" name="submit" value="Submit">
</form>


  </body>
</html>
