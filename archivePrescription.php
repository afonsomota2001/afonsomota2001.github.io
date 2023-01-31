<?php
require 'connection.php';

//Connection Error
if ($conn->connect_error){     

     die("Connection failed: " . $conn->connect_error);
 
}
// Connected to Database JaneDB
// Object oriented  -> pointing 
if($conn->query("SELECT DATABASE()")){
     
  $dbSuccess =true;
  //
  $result = $conn->query("SELECT DATABASE()");
  $row = $result->fetch_row();
  $result->close();

}
// Get the prescription_id of the prescription to be archived
$prescription_id = $_GET['prescription_id'];

// Mark the prescription as archived
$sql = "UPDATE prescriptions SET is_archived=1 WHERE prescription_id=$prescription_id";
mysqli_query($conn, $sql);


$selectuserID = "SELECT user_id FROM `prescriptions` WHERE prescription_id=$prescription_id ";
$result = mysqli_query($conn, $selectuserID);
$row = mysqli_fetch_assoc($result);
$userID = $row['user_id'];

header("Location: mainUser.php?id=$userID");

?>