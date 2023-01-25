<h1 style="background-color:DodgerBlue;">Edit: </h1>
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


if ($dbSuccess) {
 
    //  Get the details of the company selected 
        $medication_id = $_GET["medication_id"];
  
   
       if($medication_id ==0){
        //header('Location:dataMed.php'); 
       // If nothing is selected
  
    }
                  
        // Execute Query
        $query="SELECT * FROM medications WHERE medication_id= '$medication_id'";
        $cname__select_Query= mysqli_query($conn, $query);
    
    // While there is info in row
         
    while($rows=mysqli_fetch_assoc($cname__select_Query)){
                
                   $name = $rows['name'];
                   $dose = $rows['dose'];
                   $frequency = $rows['frequency'];
                   $medication_id= $rows['medication_id'];
  
                  
  
  
          }
            
  }


if($conn->query("SELECT DATABASE()")){
    
   $dbSuccess =true;
   //
   $result = $conn->query("SELECT DATABASE()");
   $row = $result->fetch_row();
   $result->close();

 
     $query = "UPDATE medications SET name ='$name', dose='$dose', frequency='$frequency', WHERE medication_id = '$medication_id'";
     mysqli_query($conn, $query);
     echo
     

     "
     <script>
       alert('Successfully Edited');
       document.location.href = 'data.php';
     </script>
     ";
   }

 






?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit Medication: <?php echo $row["name"]; ?> </title>
  </head>
  <body>
  <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">

      <?php
      $i = 1;
      $rows = mysqli_query($conn, "SELECT *FROM medications WHERE medication_id= '$infomedication_id'")
      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
      <td><?php echo 'Medication ID:' ,$row["medication_id"],' '?></td><br>
        
      <td><?php echo $row["name"]; ?>
        
      <label for="name">New Name </label>
        <input type="text" name="name" id = "name" value="<?php echo $name?>" > <br>
        </td>
        <br>
 
        <td><?php echo $row["dose"]; ?>
        <label for="dose">New Dose </label> 
        <input type="text" name="dose" class="form-control" value="<?php echo $dose?>"> <br>
      </td>
      <br>
               
        <br>
        <td><?php echo $row["frequency"]; ?></td>
        <label for="frequency">New frequency : </label>
        <input type="text" name="frequency" id = "frequency" value="<?php echo $frequency?>"> <br>
        <br>
    
       
        <button type = "submit" name = "submit">Submit</button>
        </form>
        <br>
      </tr>
      <?php endforeach; ?>
    <br>
    <a href="introUser.php">Upload de Utilizador</a> <br>
</form>
  </body>
</html>
<a href="data.php">User List </a> <br>
