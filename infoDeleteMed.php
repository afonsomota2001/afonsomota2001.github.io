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
$medication_id = $_GET['medication_id'];

// Mark the prescription as archived
$sql = "DELETE medications WHERE medication_id=$medication_id";
mysqli_query($conn, $sql);


header("Location: dataMed.php");

?>