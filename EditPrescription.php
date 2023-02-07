<h1 style="background-color:DodgerBlue;">Edit Prescription: </h1>
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
    $prescription_id = $_GET["prescription_id"];

    if ($prescription_id == 0) {

        echo "
        <script>
            alert('Error);
            document.location.href = 'index.html';
        </script>
    ";


    }
 

    // Execute Query
    $query = "SELECT * FROM prescriptions WHERE prescription_id = '$prescription_id'";
    $cname__select_Query = mysqli_query($conn, $query);

    // While there is info in row
    while ($rows = mysqli_fetch_assoc($cname__select_Query)) {
      $medication_id = $rows['medication_id'];
      $user_id = $rows['user_id'];
      $start_date = $rows['start_date'];
      $end_date = $rows['end_date'];
      $notes = $rows['notes'];
      $times_to_take_a_day = $rows['times_per_day'];
      $hours_to_take = $rows['hours_to_take'];

    }
  }


if (isset($_POST["submit"])) {
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  $notes = $_POST['notes'];
  $times_to_take_a_day = $_POST['times_per_day'];
  $hours_to_take = $_POST['hours_to_take'];
  $hours_array = explode('/', $hours_to_take);


    $query = "UPDATE prescriptions SET start_date = '$start_date', 
    end_date = '$end_date', 
    notes= '$notes',
    times_per_day = '$times_to_take_a_day',
    hours_to_take = '$hours_to_take',
    is_archived = '0'
    WHERE prescription_id = '$prescription_id'";

    mysqli_query($conn, $query);

    echo "
        <script>
            alert('Successfully Edited');
            document.location.href = '.php';
        </script>
    ";
}

?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit Prescription</title>
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

      .button {
            border: none;
            color: white;
            padding: 16px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }

        .button1 {
            background-color: white; 
            color: #4CAF50; 
            border: 5px solid #4CAF50;
            font-size: 32px;
        }

        .button1:hover {
            background-color: #4CAF50;
            color: white;
        }

</style>
<button onclick="window.location.href='mainUser.php?id=<?php echo $user_id; ?>'" class="button button1">Main User</button> <br> <br>

  <body>
    <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">       
    <?php 
echo '<p>User ID: ' .$user_id. '</p>';
$NameSelect = mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = $user_id");
$NameResult = mysqli_fetch_assoc($NameSelect);
echo '<p>User Name: ' . $NameResult["name"] . '</p>';
?>

<?php 
echo '<p>Medicament ID: ' . $medication_id . '</p>';
$MedSelect = mysqli_query($conn, "SELECT * FROM `medications` WHERE `medication_id` = $medication_id");
$MedResult = mysqli_fetch_assoc($MedSelect);
echo '<p>Medicament Name: ' . $MedResult["name"] . '</p>';
?>


    
    <label for="start_date">Start Date:</label><br>
    <input type="date" id="start_date" name="start_date" value="<?php echo $start_date?>" >"<br>

    <label for="end_date">End Date:</label><br>
    <input type="date" id="end_date" name="end_date" value="<?php echo $end_date?>"><br>

    <label for="times_per_day">Times to take a day:</label> <br>
    <input type="text" name="times_per_day" id="times_per_day" value="<?php echo $times_to_take_a_day?>"> <br>
    
    <label for="hours_to_take">Hours to take:</label> <br>
    <input type="text" name="hours_to_take" id="hours_to_take" value="<?php echo $hours_to_take?>"> <br>

    <label for="notes">Notes:</label><br>
    <textarea id="notes" name="notes" value="<?php echo $notes?>"></textarea><br><br>
         
    <button type = "submit" name = "submit">Submit</button>

    </form>
