<?php
// Get the X-Forwarded-For header from the request
$xffHeader = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : 'Not provided';

// Output the X-Forwarded-For header value
echo "X-Forwarded-For Header: $xffHeader";
?>