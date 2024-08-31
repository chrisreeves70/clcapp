<?php
$serverName = "DESKTOP-7I4N79S\\SQLEXPRESS";
$connectionOptions = array(
    "Database" => "track",
    "UID" => "", // Leave blank for Windows Authentication
    "PWD" => "", // Leave blank for Windows Authentication
    "Authentication" => "ActiveDirectoryIntegrated", // Use Windows Authentication
    "TrustServerCertificate" => true // Bypass SSL certificate validation
);

// Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true)); // Prints errors if connection fails
}
?>