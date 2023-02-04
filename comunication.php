<?php

require 'connection.php';
include 'alert.php';

$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];
$user_id = $_GET['user_id'];


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all prescriptions within the specified date range for a specific user
$sql = "SELECT * FROM prescriptions WHERE user_id = $user_id AND date >= '$start_date' AND date <= '$end_date'";
$result = $conn->query($sql);

// Initialize an array to store the prescriptions
$prescriptions = array();

// If there are any prescriptions, loop through the result and add each prescription to the array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $prescription = array(
            "id" => $row['id'],
            "user_id" => $row['user_id'],
            "medication_id" => $row['medication_id'],
            "hours_to_take" => $row['hours_to_take'],
            "date" => $row['date']
        );
        array_push($prescriptions, $prescription);
    }
}

// Close the database connection
$conn->close();

// Return the prescriptions as a JSON object
echo json_encode($prescriptions);

?>