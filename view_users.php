<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
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
        .btn {
            border-radius: 30px;
            padding: 10px 20px;
        }
        table {
            margin-top: 20px;
            width: 100%;
        }
        th, td {
            text-align: center;
            padding: 15px;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .actions {
            display: flex;
            justify-content: center;
            gap: 10px; /* Space between action buttons */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Users List</h1>

        <a href="index.php" class="btn btn-primary mb-3">Back to Tasks</a> <!-- Button to go back to tasks -->

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th> <!-- Column for action buttons -->
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db_config.php'; // Include the database configuration file

                // Fetch users from the database
                $query = "SELECT id, name, email FROM users"; // SQL query to select user details
                $result = sqlsrv_query($conn, $query); // Execute the query

                if ($result === false) { // Check if the query execution failed
                    die(print_r(sqlsrv_errors(), true)); // Print errors if the query fails
                }

                // Loop through each user and display their details in the table
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>"; // Display User ID
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>"; // Display User Name
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>"; // Display User Email
                    echo "<td class='actions'>";
                    echo "<a href='delete_user.php?id=" . urlencode($row['id']) . "' class='btn btn-danger btn-sm'>Delete</a>"; // Delete button
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

