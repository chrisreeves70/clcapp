<?php
include 'db_config.php'; // Include database configuration

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Ensure the request method is POST
    $task_id = $_POST['id']; // Get the task ID from the submitted form
    $is_done = isset($_POST['is_done']) ? 1 : 0; // Set status to 1 if checkbox is checked, otherwise 0

    // Update the task status in the database
    $query = "UPDATE tasks SET is_done = ? WHERE id = ?"; // Prepare the update query
    $params = array($is_done, $task_id); // Set the parameters for the query
    $stmt = sqlsrv_query($conn, $query, $params); // Execute the query

    if ($stmt === false) { // Check if the query execution failed
        die(print_r(sqlsrv_errors(), true)); // Print errors if it fails
    }

    // Redirect back to the main page after updating the task status
    header("Location: index.php");
    exit(); // Exit to ensure no further code is executed
}
?>
