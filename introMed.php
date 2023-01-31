<?php
require 'connection.php';

if(isset($_POST["submit"])){
  $name = $_POST["name"];
  $dose = $_POST["dose"];
  $frequency = $_POST["frequency"];


  $query = "INSERT INTO `medications` (`medication_id`, `name`, `dose`, `frequency`) VALUES (NULL,  '$name','$dose', '$frequency')";
  
  
  mysqli_query($conn, $query);
  echo
      "
      <script>
        alert('Successfully Added');
        document.location.href = 'dataMed.php';
      </script>
      ";

}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ficha de medicamento</title>
  </head>
  <style>
         html,body{
            background-color: #a5b4d63b;
            margin: 0%;
            height: 100%;
          }
    </style>

<body>
<h1 style="background-color:Red;">Medicamento:</h1>
    <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">
  
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br>
  
    <label for="dose">Dose:</label><br>
    <input type="text" id="dose" name="dose"><br>
  
    <label for="frequency">Frequency:</label><br>
    <input type="text" id="frequency" name="frequency"><br><br>
    
    <button type = "submit" name = "submit">Submit</button>
</form> 
<br>
<br>
<a href="dataMed.php">Dados medicamentos</a> <br>
<a href="javascript:history.back()">Back</a>

</body>



