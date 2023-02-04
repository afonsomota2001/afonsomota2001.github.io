<h1 style="background-color:DodgerBlue;">Edit: </h1>
<?php
require 'connection.php';
include 'alert.php';

// Connection Error
if ($conn->connect_error) {     
    die("Connection failed: " . $conn->connect_error);
}

// Connected to Database JaneDB
if ($conn->query("SELECT DATABASE()")) {
    $dbSuccess = true;
    $result = $conn->query("SELECT DATABASE()");
    $row = $result->fetch_row();
    $result->close();
}

if ($dbSuccess) {
    $medication_id = $_GET["medication_id"];
    if ($medication_id == 0) {
        header('Location:dataMed.php'); 
    }

    // Execute Query
    $query = "SELECT * FROM medications WHERE medication_id = '$medication_id'";
    $cname__select_Query = mysqli_query($conn, $query);

    // While there is info in row
    while ($rows = mysqli_fetch_assoc($cname__select_Query)) {
        $name = $rows['name'];
        $dose = $rows['dose'];
        $frequency = $rows['frequency'];
        $medication_id = $rows['medication_id'];
    }
}

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $dose = $_POST["dose"];
    $frequency = $_POST["frequency"];
    $deposit_number = $_POST["deposit_number"];
    $number_of_pills = $_POST["number_of_pills"];

    // fix the error in SQL syntax
    $query = "UPDATE medications SET name = '$name', dose = '$dose', frequency = '$frequency' WHERE medication_id = '$medication_id'";
    mysqli_query($conn, $query);

    $sqlAdd = "UPDATE stock SET deposit_number = '$deposit_number', number_of_pills = '$number_of_pills' WHERE medication_id = '$medication_id'";

    $result = mysqli_query($conn, $sqlAdd);

    echo "
        <script>
            alert('Successfully Edited or Added');
            document.location.href = 'stock.php';
        </script>
    ";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit Medication: </title>
  </head>
  <body>
  <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">

      <?php
      $i = 1;
      $rows = mysqli_query($conn, "SELECT *FROM medications WHERE medication_id= '$medication_id'")
      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
      <td><?php echo 'Medication ID:' ,$row["medication_id"],' '?></td><br>
        
      <td><?php echo $row["name"]; ?>
        
      <label for="name">New Name </label>
        <input type="text" name="name" id = "name" value="<?php echo $name?>" > <br>
        </td>
        <br>
 
        <td><?php echo $row["dose"]; ?>
        <label for="dose">New Dose </label> 
        <input type="text" name="dose" class="form-control" value="<?php echo $dose?>"> <br>
      </td>
      <br>
               
        <br>
        <td><?php echo $row["frequency"]; ?></td>
        <label for="frequency">New frequency : </label>
        <input type="text" name="frequency" id = "frequency" value="<?php echo $frequency?>"> <br>
        <br>


        <label for="deposit_number">Deposit Number:</label><br>
        <select name="deposit_number">
          <?php
          for ($i = 1; $i <= 8; $i++) {
            $query = "SELECT deposit_number FROM stock WHERE deposit_number = $i";
            $result = mysqli_query($conn, $query);

          if (mysqli_num_rows($result) == 0) {
          echo "<option value='$i'>$i</option>";
          }
        }
          ?>

</select><br><br>

    <label for="number_of_pills">Number of pills:</label><br>
    <input type="text" id="number_of_pills" name="number_of_pills"><br><br>
    
    
       
        <button type = "submit" name = "submit">Submit</button>
        </form>
        <br>
      </tr>
      <?php endforeach; ?>
    <br>
    <a href="introUser.php">Upload de Utilizador</a> <br>
</form>
  </body>
</html>
<a href="data.php">User List </a> <br>
