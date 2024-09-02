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
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        h1 {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-group {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .btn {
            border-radius: 30px;
            padding: 10px 20px;
            margin: 0 10px;
        }
        table {
            margin-top: 20px;
            width: 100%;
        }
        th, td {
            text-align: center; /* Center-align text in table headers and cells */
            padding: 15px; /* Add padding for more space */
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .actions {
            display: flex;
            justify-content: center;
            gap: 10px; /* Add space between action buttons */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Chore Tracker 3000</h1>

        <div class="btn-group">
            <a href="add_task.php" class="btn btn-primary">Add Task</a>
            <a href="add_user.php" class="btn btn-secondary">Add User</a>
            <a href="view_users.php" class="btn btn-info">View Users</a>
        </div>

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Chore</th>
                    <th>Description</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                include 'db_config.php';

                // Fetch tasks from the database
                $query = "SELECT tasks.id, tasks.title AS chore, tasks.description, tasks.is_done, users.name AS user_name 
                          FROM tasks 
                          JOIN users ON tasks.user_id = users.id";
                $result = sqlsrv_query($conn, $query);

                if ($result === false) {
                    die(print_r(sqlsrv_errors(), true));
                }

                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['chore']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
                    echo "<td>" . ($row['is_done'] ? 'Done' : 'Not Done') . "</td>";
                    echo "<td class='actions'>";
                    echo "<a href='mark_done.php?id=" . urlencode($row['id']) . "' class='btn btn-success btn-sm'>Mark as Done</a> ";
                    echo "<a href='delete_task.php?id=" . urlencode($row['id']) . "' class='btn btn-danger btn-sm'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
