<?php
require 'connection.php';

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to get all the prescriptions for the current date
$query = "SELECT * FROM prescriptions WHERE start_date <= CURDATE() AND end_date >= CURDATE()";
$result = mysqli_query($conn, $query);

// Check if there are any prescriptions for the current date
if (mysqli_num_rows($result) > 0) {
    // Loop through all the prescriptions
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if it's time to take the medication_id
        if (date("H:i") == $row["hours_to_take"]) {
            // Get the user_id and medication_id information
            $user_id = $row["user_id"];
            $medication_id = $row["medication_id"];

            // Query to get the stock information for the medication_id
            $stock_query = "SELECT * FROM stock WHERE medication_id = '$medication_id'";
            $stock_result = mysqli_query($conn, $stock_query);

            // Check if there is any stock information for the medication_id
            if (mysqli_num_rows($stock_result) > 0) {
                // Loop through the stock information
                while ($stock_row = mysqli_fetch_assoc($stock_result)) {
                    // Get the location of the medication_id
                    $location = $stock_row["deposit_number"];

                    // Show the alert to take the medication_id
                    echo '<script type="text/javascript">';
                    echo 'alert("It is time to take your ' . $medication_id . ' medication_id. It is located in ' . $location . '.");';
                    echo '</script>';
                }
            }
        }
    }
}

?>

