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
$user_id = $_GET['id'];
$result = mysqli_query($conn, "SELECT COUNT(*) as count FROM users WHERE is_archived = 0");
$row = mysqli_fetch_assoc($result);
$count = $row['count'];

if ($count<=3){// Mark the prescription as active
$sql = "UPDATE users SET is_archived=0 WHERE id=$user_id";
mysqli_query($conn, $sql);
echo
"
<script>
  alert('Successfully Activated');
  document.location.href = 'data.php';
</script>
";
}else{
  echo
"
<script>
  alert('Can not activate due to the fact that there is already 4 active users');
  document.location.href = 'data.php';
</script>
";
}


?>