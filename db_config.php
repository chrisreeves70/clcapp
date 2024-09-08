<?php
$serverName = "cloudserveradmin.database.windows.net";
$connectionOptions = array(
    "Database" => "cloud_test_db",
    "Uid" => "cloudserveradmin",
    "PWD" => "Scout1st",
    "TrustServerCertificate" => false // Recommended to validate SSL certificates
);

// Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true)); // Prints errors if connection fails
}
?>
