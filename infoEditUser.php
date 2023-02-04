<h1 style="background-color:DodgerBlue;">Edit: </h1>
<?php
require 'connection.php';
include 'alert.php';

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
      $infoID = $_GET["id"];

 
     if($infoID ==0){
       
      header('Location:data.php'); 
  }
                
      // Execute Query
      $query="SELECT * FROM users WHERE id= '$infoID'";
      $cname__select_Query= mysqli_query($conn, $query);
  
  // While there is info in row
       
  while($rows=mysqli_fetch_assoc($cname__select_Query)){
              
                 $name = $rows['name'];
                 $date = $rows['date'];
                 $pathology = $rows['pathology'];
                 $id_number = $rows['id_number'];
                 $user_id = $rows['id'];
                 $profile_picture = $rows['profile_picture'];
                


        }
          
}

if($conn->query("SELECT DATABASE()")){
     
    $dbSuccess =true;
    //
    $result = $conn->query("SELECT DATABASE()");
    $row = $result->fetch_row();
    $result->close();

}
     
if(isset($_POST["submit"])){
  $name = $_POST["name"];
  $date = date('Y-m-d',strtotime($_POST['dateofbirth']));
  $pathology = $_POST["pathology"];
  $id_number = $_POST["id_number"];

  if($_FILES["profile_picture"]["error"] == 4){
    echo
    "<script> alert('Image Does Not Exist'); </script>"
    ;
  }
  else{
    $fileName = $_FILES["profile_picture"]["name"];
    $fileSize = $_FILES["profile_picture"]["size"];
    $tmpName = $_FILES["profile_picture"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if ( !in_array($imageExtension, $validImageExtension) ){
      echo
      "
      <script>
        alert('Invalid Image Extension');
      </script>
      ";
    }
    else if($fileSize > 100000000){
      echo
      "
      <script>
        alert('Image Size Is Too Large');
      </script>
      ";
    }
    else{
      $profile_picture = uniqid();
      $profile_picture .= '.' . $imageExtension;

      move_uploaded_file($tmpName, 'img/' . $profile_picture);
  
      $query = "UPDATE users SET name ='$name', date='$date', pathology='$pathology', id_Number='$id_number', profile_picture = '$profile_picture' WHERE id = '$infoID'";
      mysqli_query($conn, $query);
      echo
      

      "
      <script>
        alert('Successfully Edited');
        document.location.href = 'data.php';
      </script>
      ";
    }
  }
}
 
if ($dbSuccess) {
 
        //  Get the details of the company selected 
            $infoID = $_GET["id"];
 
       if($infoID ==0){
            
           // If nothing is selected
             
            header('Location:data.php'); 
        }
                      
            // Execute Query
            $query="SELECT * FROM users WHERE id= '$infoID'";
            $cname__select_Query= mysqli_query($conn, $query);
        
        // While there is info in row
             
        while($rows=mysqli_fetch_assoc($cname__select_Query)){
                    
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
    <title>Edit User</title>
  </head>
  <body>
  <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">

      <?php
      $i = 1;
      $rows = mysqli_query($conn, "SELECT *FROM users WHERE id= '$infoID'")
      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
      <td><?php echo 'USER ID:' ,$row["id"],' '?></td><br>
        <td><?php echo $row["name"]; ?>
        
        <label for="name">New Name </label>
        <input type="text" name="name" id = "name" value="<?php echo $name?>" > <br>
        </td>
        <br>
 
        <td><?php echo $row["date"]; ?>
        <label for="date">New birthday date: </label> 
        <input type="date" name="dateofbirth" class="form-control" value="<?php echo $date?>"> <br>
      </td>
      <br>
        <td> <img src="img/<?php echo $row["profile_picture"]; ?>" width = 200 title="<?php echo $row['profile_picture']; ?>"> 
        <label for="profile_picture">Fotografia : </label>
      <input type="file" name="profile_picture" id = "profile_picture" accept=".jpg, .jpeg, .png" value="<?php echo $profile_picture ?>"> 
      <br> <br>
        </td>
               
        <br>
        <td><?php echo $row["pathology"]; ?></td>
        <label for="pathology">New pathology : </label>
        <input type="text" name="pathology" id = "pathology" value="<?php echo $pathology?>"> <br>
        <br>
        <td><?php echo $row["id_number"]; ?></td>
        <label for="id_number">New patient number (9 digits): </label>
        <input type="number" name="id_number" id = "id_number" min="99999999" max="1000000000" value = "<?php echo $id_number?>"> <br>
       
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
