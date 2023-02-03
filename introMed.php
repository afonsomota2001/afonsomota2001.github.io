<?php
require 'connection.php';

if(isset($_POST["submit"])){
  $name = $_POST["name"];
  $dose = $_POST["dose"];
  $frequency = $_POST["frequency"];
  $deposit_number = $_POST["deposit_number"];
  $number_of_pills = $_POST["number_of_pills"];


  $query = "INSERT INTO `medications` (`medication_id`, `name`, `dose`, `frequency`) VALUES (NULL,  '$name','$dose', '$frequency')";
  mysqli_query($conn, $query);

  $medication_id = mysqli_insert_id($conn);

  $queryAdd = "INSERT INTO `stock` (`deposit_number`,`medication_id`, `number_of_pills`) VALUES ('$deposit_number','$medication_id', '$number_of_pills')";
  mysqli_query($conn, $queryAdd);

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

    Optional
    <label for="deposit_number">Deposit Number:</label><br>
    <input type="text" id="deposit_number" name="deposit_number"><br><br>

    <label for="number_of_pills">Number of pills:</label><br>
    <input type="text" id="number_of_pills" name="number_of_pills"><br><br>
    
    <button type = "submit" name = "submit">Submit</button>
</form> 
<br>
<br>
<a href="dataMed.php">Dados medicamentos</a> <br>
<a href="javascript:history.back()">Back</a>

</body>



