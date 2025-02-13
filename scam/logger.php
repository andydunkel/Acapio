<?php
// Define the log file
$logFile = "scammer_log.txt";

// Get visitor details
$ip = $_SERVER['REMOTE_ADDR']; // IP Address
$time = date("Y-m-d H:i:s");   // Timestamp
$userAgent = $_SERVER['HTTP_USER_AGENT']; // Browser & OS info
$lang = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : "Unknown";
$referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "Direct Access";

// Get the "o" parameter (unique identifier for tracking)
$identifier = isset($_GET['o']) ? $_GET['o'] : "Unknown";

// Format the log entry
$logEntry = "$time | IP: $ip | ID: $identifier | User-Agent: $userAgent | Lang: $lang | Referrer: $referrer\n";

// Append log entry to file
file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
?>
