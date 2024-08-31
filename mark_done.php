<?php
include 'db_config.php';

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];

    // Update the task status to done
    $query = "UPDATE tasks SET is_done = 1 WHERE id = ?";
    $params = array($taskId);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Redirect back to the index page
    header("Location: index.php");
    exit();
} else {
    echo "No task ID provided.";
}
?>
