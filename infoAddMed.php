<?php
require 'connection.php';
include 'alert.php';

// Check for connection error
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the medication_id from the URL
$medication_id = $_GET['medication_id'];

// get user_id from cookie
if (isset($_COOKIE["user_id"])) {
  $user_id = $_COOKIE["user_id"];
} else {
  echo
        "
        <script>
          alert('~First iniciate session');
          document.location.href = 'index.html';
        </script>
        ";
}

if (isset($_POST['submit'])) {

  $num_pills_toAdd = $_POST['num_pills'];

  $result = mysqli_query($conn, "SELECT number_of_pills FROM stock WHERE medication_id = $medication_id");
  $row = mysqli_fetch_assoc($result);
  $num_pills_inDisp = $row['number_of_pills'];
  
  $num_pills_total = $num_pills_toAdd + $num_pills_inDisp;

  $sql = "UPDATE stock SET number_of_pills = $num_pills_total WHERE medication_id = $medication_id";
  mysqli_query($conn, $sql);

  date_default_timezone_set('GMT'); 
  $current_time = date("Y-m-d H:i:s");
  $sql_historic = "INSERT INTO historic_add VALUES ('$add_id', '$medication_id', '$current_time' , '$num_pills_toAdd', $user_id)";
  
  mysqli_query($conn, $sql_historic);

  header("Location: stock.php");

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
  $rows = mysqli_query($conn, "SELECT *FROM medications WHERE medication_id = $medication_id");
  
  while ($row = mysqli_fetch_array($rows)) {
    $medication_id = $row['medication_id'];
    $rowsStock = mysqli_query($conn, "SELECT *FROM stock WHERE medication_id = $medication_id");
    $rowStock = mysqli_fetch_array($rowsStock);
  ?>
  <tr>
    <td><?php echo $row["medication_id"]; ?></td>
    <td><?php echo $row["name"]; ?></td>
    <td><?php echo $row["dose"]; ?></td>
    <td><?php echo $row["frequency"]; ?></td>
    <td><?php echo $rowStock["number_of_pills"]; ?></td>
  </tr>
  <?php } ?>
</table>
<br>

<form action="" method="post">
  <label for="num_pills">Number of pills to add:</label>
  <input type="text" id="num_pills" name="num_pills">
  <input type="submit" name="submit" value="Submit">
</form>


  </body>
</html>
