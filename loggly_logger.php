<?php
require 'vendor/autoload.php'; // Load Composer's autoloader for dependencies

use Monolog\Logger; // Use Monolog's Logger class
use Monolog\Handler\SocketHandler; // Use Monolog's SocketHandler for sending logs to Loggly

// Create a logger instance with the name 'my_logger'
$logger = new Logger('my_logger');

// Loggly URL for sending logs
$logglyUrl = 'http://logs-01.loggly.com/inputs/9e1a9ba6-793d-4d1b-81d8-6cccf3511ba9/tag/http/';

// Add a Loggly handler to the logger to send log messages to Loggly
$logger->pushHandler(new SocketHandler($logglyUrl));

// Add records to the log
$logger->info('This is an informational message.'); // Log an informational message
$logger->error('This is an error message.'); // Log an error message

