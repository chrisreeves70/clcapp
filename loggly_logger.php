<?php
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\SocketHandler;

// Create a logger instance
$logger = new Logger('my_logger');

// Loggly URL
$logglyUrl = 'http://logs-01.loggly.com/inputs/9e1a9ba6-793d-4d1b-81d8-6cccf3511ba9/tag/http/';

// Add a Loggly handler
$logger->pushHandler(new SocketHandler($logglyUrl));

// Add records to the log
$logger->info('This is an informational message.');
$logger->error('This is an error message.');
