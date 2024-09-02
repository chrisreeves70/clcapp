<?php
include 'db_config.php'; 

if (isset($_GET['id'])) {
    $task_id = intval($_GET['id']);

    // Prepare the SQL statement to delete the task
    $query = "DELETE FROM tasks WHERE id = ?";
    $params = array($task_id);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true)); // Print errors if query fails
    }

    // Redirect to the main page after deletion
    header("Location: index.php");
    exit();
} else {
    echo "No task ID specified.";
}
?>
