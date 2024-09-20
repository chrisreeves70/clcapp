<?php
$serverName = "cloudserveradmin.database.windows.net"; // Define the server name
$connectionOptions = array(
    "Database" => "cloud_test_db", // database name
    "Uid" => "cloudserveradmin", // username for database access
    "PWD" => "Scout1st", // password for database access
    "TrustServerCertificate" => false // validates SSL certificates for security
);

// Establishes the connection to the database
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Check if the connection was successful
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true)); // Print errors if the connection fails
}
?>
