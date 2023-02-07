<?php

// Start a session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Clear the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie("user_id", "", time() - 3600);
    
}

// Redirect the user to the login page
header("Location: index.html");
exit;

?>
