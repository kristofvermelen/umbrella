<?php

echo "Proximus XFF test for Umbrella"

// Get the X-Forwarded-For header from the request
$xffHeader = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : 'Not provided';

// Send a response to the client with the X-Forwarded-For header value
echo "X-Forwarded-For Header: $xffHeader";

?>