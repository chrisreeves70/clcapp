<?php
include 'db_config.php'; // Includes the database configuration file

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title']; // Get the task title from the form
    $description = $_POST['description']; // Get the task description from the form
    $user_id = $_POST['user_id']; // Get the selected user ID from the form

    // Prepare the SQL query to insert a new task
    $query = "INSERT INTO tasks (title, description, user_id) VALUES (?, ?, ?)";
    $params = array($title, $description, $user_id); // Parameters for the query
    $stmt = sqlsrv_query($conn, $query, $params); // Execute the query

    // Check if the query execution failed
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true)); // Print errors if the query fails
    }

    header("Location: index.php"); // Redirect to the main page after successful insertion
    exit(); // Exit to prevent further script execution
}

// Fetch users for the dropdown menu
$query = "SELECT id, name FROM users"; // SQL query to get user IDs and names
$stmt = sqlsrv_query($conn, $query); // Execute the query

// Check if the query execution failed
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true)); // Print errors if the query fails
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Task</title> <!-- Title of the page -->
</head>
<body>
    <h1>Add Task</h1> <!-- Main heading for the form -->
    <form method="POST"> <!-- Form submission method is POST -->
        <label for="title">Title:</label>
        <input type="text" name="title" required> <!-- Input field for task title -->
        <br>
        <label for="description">Description:</label>
        <textarea name="description"></textarea> <!-- Textarea for task description -->
        <br>
        <label for="user_id">User:</label>
        <select name="user_id" required> <!-- Dropdown to select a user -->
            <?php while ($user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)): ?> <!-- Loop through users -->
                <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option> <!-- Option for each user -->
            <?php endwhile; ?>
        </select>
        <br>
        <input type="submit" value="Add Task"> <!-- Submit button to add the task -->
    </form>
</body>
</html>

