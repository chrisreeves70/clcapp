<?php
include 'db_config.php'; // Includes the database configuration file
include 'loggly_logger.php'; // Includes logging configuration

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $task_id = intval($_GET['id']); // Gets the task ID and convert it to an integer

    // Log the task deletion attempt
    $logger->info("Attempting to delete task with ID: $task_id");

    // Prepare the SQL statement to delete the task
    $query = "DELETE FROM tasks WHERE id = ?";
    $params = array($task_id); // Parameters for the query
    $stmt = sqlsrv_query($conn, $query, $params); // Execute the query

    // Check if the query execution failed
    if ($stmt === false) {
        // Log the error if the query fails
        $logger->error("Failed to delete task with ID: $task_id. Error: " . print_r(sqlsrv_errors(), true));
        die(print_r(sqlsrv_errors(), true)); // Print errors if the query fails
    } else {
        // Log successful deletion
        $logger->info("Successfully deleted task with ID: $task_id");
    }

    // Redirect to the main page after deletion
    header("Location: index.php");
    exit(); // Exit to prevent further script execution
} else {
    // Log if no task ID is specified
    $logger->warning("No task ID specified for deletion.");
    echo "No task ID specified."; // Inform the user that no ID was provided
}
?>

