<?php
include 'db_config.php'; // Includes the database configuration file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name']; // Get the user's name from the form
    $email = $_POST['email']; // Get the user's email from the form
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security

    // Prepare the SQL query to insert the new user into the database
    $query = "INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)";
    $params = array($name, $email, $password_hash); // Parameters for the query
    $stmt = sqlsrv_query($conn, $query, $params); // Execute the query

    // Check if the query execution failed
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true)); // Print errors if the query fails
    }

    // Redirect to the main page after successfully adding the user
    header("Location: index.php");
    exit(); // Exit to prevent further script execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Set character encoding -->
    <title>Add User</title> <!-- Title of the page -->
</head>
<body>
    <h1>Add New User</h1> <!-- Main heading for the form -->
    <form action="add_user.php" method="POST"> <!-- Form submission to this script -->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br> <!-- Input field for user name -->
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br> <!-- Input field for user email -->
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br> <!-- Input field for password -->
        
        <input type="submit" value="Add User"> <!-- Submit button to add the user -->
    </form>
    <br>
    <a href="index.php">Back to Task List</a> <!-- Link to return to the task list -->
</body>
</html>

