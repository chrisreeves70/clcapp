<?php
include 'db_config.php';
include 'loggly_logger.php'; // Include logging configuration

if (isset($_GET['id'])) {
    $task_id = intval($_GET['id']);

    // Log the task deletion attempt
    $logger->info("Attempting to delete task with ID: $task_id");

    // Prepare the SQL statement to delete the task
    $query = "DELETE FROM tasks WHERE id = ?";
    $params = array($task_id);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        // Log the error if the query fails
        $logger->error("Failed to delete task with ID: $task_id. Error: " . print_r(sqlsrv_errors(), true));
        die(print_r(sqlsrv_errors(), true)); // Print errors if query fails
    } else {
        // Log successful deletion
        $logger->info("Successfully deleted task with ID: $task_id");
    }

    // Redirect to the main page after deletion
    header("Location: index.php");
    exit();
} else {
    // Log if no task ID is specified
    $logger->warning("No task ID specified for deletion.");
    echo "No task ID specified.";
}
?>
