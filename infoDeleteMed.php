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

$medication_id = $_GET['medication_id'];

// Mark the prescription as archived
$medication_id = mysqli_real_escape_string($conn, $_GET['medication_id']);
$sql = "UPDATE medications SET number_of_pills = 0 WHERE medication_id=$medication_id";
mysqli_query($conn, $sql);


header("Location: dataMed.php");

?>