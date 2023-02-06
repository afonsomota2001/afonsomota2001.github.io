<?php
require 'connection.php';
include 'alert.php';

// Connection Error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Connected to Database JaneDB
// Object oriented  -> pointing 
if ($conn->query("SELECT DATABASE()")) {
    $dbSuccess = true;
    //
    $result = $conn->query("SELECT DATABASE()");
    $row = $result->fetch_row();
    $result->close();
}

if ($dbSuccess) {
    // Get the details of the company selected
    $infoID = $_GET["id"];

    if ($infoID == 0) {
        // If nothing is selected
        header('Location:data.php');
    }

    // Execute Query
    $query = "SELECT * FROM users WHERE id='$infoID'";
    $cname__select_Query = mysqli_query($conn, $query);

    // While there is info in row
    while ($rows = mysqli_fetch_assoc($cname__select_Query)) {
        $name = $rows['name'];
        $date = $rows['date'];
        $pathology = $rows['pathology'];
        $id_number = $rows['id_number'];
        $user_id = $rows['id'];
        $profile_picture = $rows['profile_picture'];
    }
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Main Utilizador</title>
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

.button3 {
            background-color: white; 
            color: #00F7FF; 
            border: 2px solid #00F7FF;
        }

.button3:hover {
            background-color: #00F7FF;
            color: white;
        }

</style>

  <body>
  <button onclick = "window.location.href='index.html'" class="button button1">Menu </button> <br>
  <button onclick = "window.location.href='introUser.php'" class="button button2">Upload User </button> <br>
  <button onclick = "window.location.href='introPrescription.php?id=<?php echo $user_id; ?>'" class="button button3">Insert Prescription</button>

 
  <br>
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
      $rows = mysqli_query($conn, "SELECT *FROM users WHERE id=$user_id")
      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
        <td><?php echo $row["id"]; ?></td>
        <td><?php echo $row["name"]; ?></td>
        <td><?php echo $row["date"]; ?></td>
        <td> <img src="img/<?php echo $row["profile_picture"]; ?>" width = 200 title="<?php echo $row['profile_picture']; ?>"> </td>
        <td><?php echo $row["pathology"]; ?></td>
        <td><?php echo $row["id_number"]; ?></td>
        <td><?php echo '<a href="infoEditUser.php?id=',$row["id"],'">Edit</a>'; ?></td>
      </tr>
      <?php endforeach; ?>
      </table>
    <br>
    <br>

    <br>
  
  Active Prescriptions
  <br>
  <br>

    <table border="1" cellspacing="0" cellpadding="10">
  <tr>
        <td>Prescription ID</td>
        <td>Medication ID</td>
        <td>Medication name</td>
        <td>Start Date</td>
        <td>End Date</td>
        <td>Tooks per day</td>
        <td>Hours to take</td>
        <td>Notes</td>

  </tr>

  <?php
$queryPres = "SELECT * FROM prescriptions WHERE user_id = $infoID AND is_archived = 0 ";
$resultPre = mysqli_query($conn, $queryPres);

while ($rowPres = mysqli_fetch_assoc($resultPre)) {
    $queryMed = "SELECT * FROM medications WHERE medication_id='" . $rowPres['medication_id'] . "'";
    $name_select = mysqli_query($conn, $queryMed);
    $infoMed = mysqli_fetch_assoc($name_select);
    ?>

  <td><?php echo $rowPres["prescription_id"];?></td>
  <td><?php echo $rowPres["medication_id"];?></td>
  <td><?php echo $infoMed["name"];?></td>
  <td><?php echo $rowPres["start_date"];?></td>
  <td><?php echo $rowPres["end_date"];?></td>
  <td><?php echo $rowPres["times_per_day"];?></td>
  <td><?php echo $rowPres["hours_to_take"];?></td>
  <td><?php echo $rowPres["notes"];?></td>
  <td><?php echo '<a href="EditPrescription.php?prescription_id=',$rowPres["prescription_id"],'">Edit</a>'; ?></td>
  <td><?php echo '<a href="archivePrescription.php?prescription_id=',$rowPres["prescription_id"],'">Archive</a>'; ?></td>

   </tr>
      <?php
      }  
?> 

    </table>
    <br>

    Archived Prescriptions 
      <br>
  <br>

    <table border="1" cellspacing="0" cellpadding="10">
    <tr>
        <td>Prescription ID</td>
        <td>Medication ID</td>
        <td>Medication name</td>
        <td>Start Date</td>
        <td>End Date</td>
        <td>Tooks per day</td>
        <td>Hours to take</td>
        <td>Notes</td>

  </tr>

  <?php
$queryPres = "SELECT * FROM prescriptions WHERE user_id = $infoID AND is_archived = 1 ";
$resultPre = mysqli_query($conn, $queryPres);

while ($rowPres = mysqli_fetch_assoc($resultPre)) {
    $queryMed = "SELECT * FROM medications WHERE medication_id='" . $rowPres['medication_id'] . "'";
    $name_select = mysqli_query($conn, $queryMed);
    $infoMed = mysqli_fetch_assoc($name_select);
    ?>

  <td><?php echo $rowPres["prescription_id"];?></td>
  <td><?php echo $rowPres["medication_id"];?></td>
  <td><?php echo $infoMed["name"];?></td>
  <td><?php echo $rowPres["start_date"];?></td>
  <td><?php echo $rowPres["end_date"];?></td>
  <td><?php echo $rowPres["times_per_day"];?></td>
  <td><?php echo $rowPres["hours_to_take"];?></td>
  <td><?php echo $rowPres["notes"];?></td>

   </tr>
      <?php
      }  
?> 

    </table>
    <br>
  </body>
</html>

