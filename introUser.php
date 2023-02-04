
<?php
require 'connection.php';
include 'alert.php';
if(isset($_POST["submit"])){
  $name = $_POST["name"];
  $date = date('Y-m-d',strtotime($_POST['dateofbirth']));
  $pathology = $_POST["pathology"];
  $id_number = $_POST["id_number"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM users WHERE is_archived = 0");
  $row = mysqli_fetch_assoc($result);
  $count = $row['count'];

  if($_FILES["image"]["error"] == 4){
    echo
    "<script> alert('Image Does Not Exist'); </script>"
    ;
  }
  else{
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

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
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;
      move_uploaded_file($tmpName, 'img/' . $newImageName);

      if ($count<=3){
      $query = "INSERT INTO users VALUES ('$id','$name','$pathology','$email','$password','$date','$id_number','$newImageName', 0)";
      mysqli_query($conn, $query);
      echo
      "
      <script>
        alert('Successfully Added');
        document.location.href = 'data.php';
      </script>
      ";
      }else{
        $query = "INSERT INTO users VALUES ('$id','$name','$pathology','$email','$password','$date','$id_number','$newImageName', 1)";
        mysqli_query($conn, $query);
        echo
        "
        <script>
          alert('The user was added but it is set as unactive due to the fact that there is already 4 active users');
          document.location.href = 'data.php';
        </script>
        ";
      }
      
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ficha Utilizador</title>
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
</style>

  <body>
  <h1 style="background-color:DodgerBlue;">Utilizador:</h1>
    <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">
    <label for="email">Email: </label>
        <input type="text" name="email" id = "email" required value=""> <br>

        <label for="password">Password: </label>
        <input type="text" name="password" id = "password" required value=""> <br>
    
      <label for="name">Nome : </label>
        <input type="text" name="name" id = "name" required value=""> <br>
      <div class = "form-group">
        <label for="date">Data de nascimento : </label> 
        <input type="date" name="dateofbirth" class="form-control"> <br>
      </div>
        <label for="pathology">Patologia : </label>
        <input type="text" name="pathology" id = "pathology" required value=""> <br>
     
        <label for="id_number">Número de Utente (9 dígitos): </label>
        <input type="number" name="id_number" id = "id_number" min="99999999" max="1000000000"> <br>

      <label for="image">Fotografia : </label>
      <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png" value=""> <br> <br>
      
      <button type = "submit" name = "submit">Submit</button>
    </form>
    <br>
    <a href="data.php">Dados</a> <br>

  </body>
</html>
