<?php
include 'db_config.php'; // Include database configuration

if (isset($_GET['id'])) { // Check if the task ID is provided in the URL
    $taskId = $_GET['id']; // Get the task ID from the URL

    // Update the task status to done in the database
    $query = "UPDATE tasks SET is_done = 1 WHERE id = ?"; // Prepare the update query
    $params = array($taskId); // Set the parameters for the query
    $stmt = sqlsrv_query($conn, $query, $params); // Execute the query

    if ($stmt === false) { // Check if the query execution failed
        die(print_r(sqlsrv_errors(), true)); // Print errors if it fails
    }

    // Redirect back to the index page after updating the task
    header("Location: index.php");
    exit(); // Exit to ensure no further code is executed
} else {
    echo "No task ID provided."; // Show message if no task ID is given
}
?>

