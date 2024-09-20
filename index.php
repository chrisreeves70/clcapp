<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa; /* Set background color */
            font-family: 'Arial', sans-serif; /* Set font */
        }
        .container {
            margin-top: 50px; /* Space above the container */
        }
        h1 {
            font-size: 2.5rem; /* Font size for heading */
            text-align: center; /* Center-align heading */
            margin-bottom: 30px; /* Space below heading */
        }
        .btn-group {
            display: flex; /* Flexbox for button layout */
            justify-content: center; /* Center buttons */
            margin-bottom: 20px; /* Space below button group */
        }
        .btn {
            border-radius: 30px; /* Round button corners */
            padding: 10px 20px; /* Button padding */
            margin: 0 10px; /* Space between buttons */
        }
        table {
            margin-top: 20px; /* Space above table */
            width: 100%; /* Full width for table */
        }
        th, td {
            text-align: center; /* Center-align text in table headers and cells */
            padding: 15px; /* Add padding for more space */
        }
        th {
            background-color: #007bff; /* Blue background for header */
            color: white; /* White text for header */
        }
        .actions {
            display: flex; /* Flexbox for action buttons */
            justify-content: center; /* Center action buttons */
            gap: 10px; /* Add space between action buttons */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Chore Tracker 3000</h1>

        <div class="btn-group">
            <a href="add_task.php" class="btn btn-primary">Add Task</a> <!-- Button to add a task -->
            <a href="add_user.php" class="btn btn-secondary">Add User</a> <!-- Button to add a user -->
            <a href="view_users.php" class="btn btn-info">View Users</a> <!-- Button to view users -->
        </div>

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th> <!-- Table header for ID -->
                    <th>Chore</th> <!-- Table header for chore -->
                    <th>Description</th> <!-- Table header for description -->
                    <th>User</th> <!-- Table header for user -->
                    <th>Status</th> <!-- Table header for task status -->
                    <th>Actions</th> <!-- Table header for actions -->
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db_config.php'; // Include the database configuration file

                // Fetch tasks from the database
                $query = "SELECT tasks.id, tasks.title AS chore, tasks.description, tasks.is_done, users.name AS user_name 
                          FROM tasks 
                          JOIN users ON tasks.user_id = users.id"; // SQL query to get tasks with user info
                $result = sqlsrv_query($conn, $query); // Execute the query

                if ($result === false) {
                    die(print_r(sqlsrv_errors(), true)); // Print errors if the query fails
                }

                // Loop through the fetched tasks and display them in the table
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>"; // Display task ID
                    echo "<td>" . htmlspecialchars($row['chore']) . "</td>"; // Display chore title
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>"; // Display description
                    echo "<td>" . htmlspecialchars($row['user_name']) . "</td>"; // Display user name
                    echo "<td>" . ($row['is_done'] ? 'Done' : 'Not Done') . "</td>"; // Display task status
                    echo "<td class='actions'>"; // Actions cell
                    echo "<a href='mark_done.php?id=" . urlencode($row['id']) . "' class='btn btn-success btn-sm'>Mark as Done</a> "; // Button to mark task as done
                    echo "<a href='delete_task.php?id=" . urlencode($row['id']) . "' class='btn btn-danger btn-sm'>Delete</a>"; // Button to delete task
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

