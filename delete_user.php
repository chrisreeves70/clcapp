<?php
include 'db_config.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Delete the user from the database
    $query = "DELETE FROM users WHERE id = ?";
    $params = array($userId);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Redirect back to the view_users page
    header("Location: view_users.php");
    exit();
}
?>
