<?php
require 'connection.php';

// Get user ID from login page
$user_id = $_GET['id'];

if(isset($_POST["submit"])){
    // Get form data
    $medication_id = $_POST['medication_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $notes = $_POST['notes'];

    // Check if a prescription with the same medication ID already exists for the user
    $check_query = "SELECT * FROM prescriptions WHERE user_id = '$user_id' AND medication_id = '$medication_id'";
    $check_result = mysqli_query($conn, $check_query);
    if(mysqli_num_rows($check_result) > 0){
        echo "<script>alert('A prescription with the same medication ID already exists for this user. Please enter a different medication ID.');</script>";
    } else {
        // Insert data into prescriptions table
        $sql = "INSERT INTO prescriptions (user_id, medication_id, start_date, end_date, notes) VALUES ('$user_id', '$medication_id', '$start_date', '$end_date', '$notes')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Successfully Added'); document.location.href = 'mainUser.php?id=$user_id';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
}

?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Insert Medication</title>
  </head>
  <style>
         html,body{
            background-color: #a5b4d63b;
            margin: 0%;
            height: 100%;
          }

        .div{
            background: linear-gradient(#79a5fd, #ff7300);
      }
        form, table {
        display: inline-block;
       vertical-align: top;
      }
</style>
  <body>
  <h1 style="background-color:DodgerBlue;">Prescription:</h1>
    <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">

    <?php echo '<p>User ID: ' . $user_id . '</p>';?>

    <label for="medication_id">Medication Id:</label> <br>
    <input type="text" name="medication_id" id = "medication_id"> <br>
    <br>
    
    <label for="start_date">Start Date:</label><br>
    <input type="date" id="start_date" name="start_date"><br>

    <label for="end_date">End Date:</label><br>
    <input type="date" id="end_date" name="end_date"><br>

    <label for="notes">Notes:</label><br>
    <textarea id="notes" name="notes"></textarea><br><br>
         
    <button type = "submit" name = "submit">Submit</button>

    </form>

    <table border="1" cellspacing="0" cellpadding="10">
  <tr>
    <th>Medication ID</th>
    <th>Medication Name</th>
    <th>Dose</th>
    <th>Frequency</th>

  </tr>

  <?php
    // Get all medications from medications table
    $query = "SELECT * FROM `medications`";
    $result = mysqli_query($conn, $query);

  // While there are rows in the result
  while($row = mysqli_fetch_assoc($result)){
    $medication_id = $row['medication_id'];
    $medication_name = $row['name'];
    $dose = $row['dose'];
    $frequency = $row['frequency'];
  
    // Output a row in the table for each medication
    echo "<tr>";
    echo "<td>$medication_id</td>";
    echo "<td>$medication_name</td>";
    echo "<td>$dose</td>";
    echo "<td>$frequency</td>";
    echo "</tr>";
  }
  ?>
</table>

    <br>
    <a href="dataPrescription.php">Prescriptions</a> <br>


  </body>
</html>
