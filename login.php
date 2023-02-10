<?php

if (isset($_COOKIE["user_id"])) {
  $user_id = $_COOKIE["user_id"];
  header("Location: mainUser.php?id=$user_id");
  exit();
}
require 'connection.php';


if(isset($_POST["submit"])){

  // Get the user's input
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $password = mysqli_real_escape_string($conn, $_POST["password"]);

  
     $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  $result = mysqli_query($conn, $query);
   
  if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_array($result);
    $user_id = $user["id"];

    // Set the cookie
    setcookie("user_id", $user_id, time() + 3600 );

    // Redirect to mainUser.php page
    header("Location: mainUser.php?id=$user_id");
    exit;
} else {
    // Login failed, show error message
    echo "Invalid email or password. Please try again.";


  mysqli_close($conn);
}
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
<a href="index.html">Back</a> <br>
</body>
