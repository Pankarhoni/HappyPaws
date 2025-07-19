<?php
session_start(); // Ensure session is started

$response = ['isLoggedIn' => false];

// Check if the session variable for user_id is set
if (isset($_SESSION['USER_ID'])) {
    $response['isLoggedIn'] = true;
}

// Return response as JSON
header('Content-Type: application/json');
echo json_encode($response);

