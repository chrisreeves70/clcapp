<?php
include 'db_config.php'; // Include the database configuration file

$sql = "SELECT * FROM tasks"; // SQL query to select all tasks
$stmt = sqlsrv_query($conn, $sql); // Execute the query

if ($stmt === false) { // Check if the query execution failed
    die(print_r(sqlsrv_errors(), true)); // Print errors if the query fails
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Tasks</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> <!-- Include Bootstrap CSS -->
</head>
<body>
    <div class="container">
        <h1>Tasks</h1>
        <table class="table table-bordered"> <!-- Start of the table to display tasks -->
            <thead>
                <tr>
                    <th>ID</th> <!-- Column for Task ID -->
                    <th>User ID</th> <!-- Column for User ID -->
                    <th>Title</th> <!-- Column for Task Title -->
                    <th>Description</th> <!-- Column for Task Description -->
                    <th>Status</th> <!-- Column for Task Status -->
                    <th>Due Date</th> <!-- Column for Task Due Date -->
                </tr>
            </thead>
            <tbody>
                <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) { ?> <!-- Loop through each task -->
                    <tr>
                        <td><?php echo $row['id']; ?></td> <!-- Display Task ID -->
                        <td><?php echo $row['user_id']; ?></td> <!-- Display User ID -->
                        <td><?php echo $row['title']; ?></td> <!-- Display Task Title -->
                        <td><?php echo $row['description']; ?></td> <!-- Display Task Description -->
                        <td><?php echo $row['status']; ?></td> <!-- Display Task Status -->
                        <td><?php echo $row['due_date']->format('Y-m-d'); ?></td> <!-- Display Task Due Date -->
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

