<?php
// Loggly URL and token (replace with your actual Loggly URL and token)
$loggly_url = "http://logs-01.loggly.com/inputs/9e1a9ba6-793d-4d1b-81d8-6cccf3511ba9/tag/http/";

// Create a test message
$log_message = array(
    "message" => "Test log entry from Azure PHP application",
    "timestamp" => date('Y-m-d H:i:s')
);

// Convert the log message to JSON format
$log_json = json_encode($log_message);

// Send the log entry to Loggly
$context = stream_context_create(array(
    'http' => array(
        'method'  => 'POST',
        'header'  => "Content-Type: application/json\r\n",
        'content' => $log_json
    )
));

$result = file_get_contents($loggly_url, false, $context);

if ($result === FALSE) {
    echo "Failed to send log entry to Loggly.";
} else {
    echo "Test log entry sent to Loggly successfully.";
}
?>
