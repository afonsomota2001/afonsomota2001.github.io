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
// Get the medication_id of the prescription to be archived
$medication_id = $_GET['medication_id'];


// Mark the prescription as archived
$sql = "UPDATE prescription SET is_archived=1 WHERE medication_id=$medication_id";
mysqli_query($conn, $sql);

// Close the database connection
mysqli_close($conn);

// Redirect the user back to the main page
header("Location: mainUser.php");
exit;
?>