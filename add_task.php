<?php
include 'db_config.php'; // database configuration file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_POST['user_id'];

    // Insert new task
    $query = "INSERT INTO tasks (title, description, user_id) VALUES (?, ?, ?)";
    $params = array($title, $description, $user_id);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true)); // Print errors if query fails
    }

    header("Location: index.php"); // Redirect to the main page
    exit();
}

// Fetch users for the dropdown
$query = "SELECT id, name FROM users";
$stmt = sqlsrv_query($conn, $query);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true)); // Print errors if query fails
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Task</title>
</head>
<body>
    <h1>Add Task</h1>
    <form method="POST">
        <label for="title">Title:</label>
        <input type="text" name="title" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description"></textarea>
        <br>
        <label for="user_id">User:</label>
        <select name="user_id" required>
            <?php while ($user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)): ?>
                <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
            <?php endwhile; ?>
        </select>
        <br>
        <input type="submit" value="Add Task">
    </form>
</body>
</html>
