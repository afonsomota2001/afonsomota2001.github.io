<?php
require 'connection.php';

if(isset($_POST["submit"])){
    $email = $_POST['email'];
    $password = $_POST['password'];

$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $query);
   
if (mysqli_num_rows($result) > 0) {
    // Login successful, show user's personal data
    $row = mysqli_fetch_assoc($result);
    $id = $row["id"];

    // Redirect to mainUser.php page
    header("Location: mainUser.php?id=$id");
    exit;
} else {
    // Login failed, show error message
    echo "Invalid email or password";
}

mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <style>
         html,body{
            background-color: #A6FFAC;
            margin: 0%;
            height: 100%;
          }
    </style>

<body>
<h1 style="background-color:Green;">Login:</h1>
<form action="" method="post">
  <label for="email">Email:</label><br>
  <input type="text" id="email" name="email"><br>

  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password"><br><br>

  <button type = "submit" name = "submit">Submit</button>
</form> 
<br>
<br>
<a href="index.php">Back</a> <br>
</body>
