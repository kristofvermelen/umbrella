<?php
// Get the X-Forwarded-For header from the request
$xffHeader = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : 'Not provided';

// Get the actual client IP address
$clientIp = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Not provided';

// Output both the X-Forwarded-For header and the actual client IP address
echo "X-Forwarded-For Header: $xffHeader<br>";
echo "Actual Client IP: $clientIp";
?>