<?php
include 'db_config.php'; // Include your database configuration file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_id = $_POST['id'];
    $is_done = isset($_POST['is_done']) ? 1 : 0; // Checkbox returns 'on' if checked

    // Update the task status in the database
    $query = "UPDATE tasks SET is_done = ? WHERE id = ?";
    $params = array($is_done, $task_id);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true)); // Print errors if query fails
    }

    // Redirect back to the main page after updating
    header("Location: index.php");
    exit();
}
?>
