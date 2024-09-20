<?php
include 'db_config.php'; // Include the database configuration file

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id']; // Get the user ID from the URL

    // Prepare the SQL statement to delete the user
    $query = "DELETE FROM users WHERE id = ?";
    $params = array($userId); // Parameters for the query
    $stmt = sqlsrv_query($conn, $query, $params); // Execute the query

    // Check if the query execution failed
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true)); // Print errors if the query fails
    }

    // Redirect back to the view_users page after deletion
    header("Location: view_users.php");
    exit(); // Exit to prevent further script execution
}
?>

