<?php
// Function to get geolocation data for an IP address using ipinfo.io API
function getGeolocationData($ip) {
    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, "https://ipinfo.io/$ip/json");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session and decode JSON response
    $response = curl_exec($ch);
    $geolocationData = json_decode($response, true);

    // Close cURL session
    curl_close($ch);

    return $geolocationData;
}

// Get the actual client IP address
//$clientIp = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Not provided';
$clientIp = isset($headers['X-Client-Ip']) ? $$headers['X-Client-Ip'] : 'Not provided';

// Get all HTTP headers
$headers = getallheaders();

// Output all HTTP headers
echo "<br><br>";
echo "All HTTP Headers:<br><br>";
foreach ($headers as $key => $value) {
    //echo "$key: $value<br>";
    if ($key === 'Client-Ip') {
        $clientIp = $value;
    }
}


// Remove port if present in the actual client IP
$clientIpParts = explode(":", $clientIp);
$clientIp = $clientIpParts[0];

// Get geolocation data for the actual client IP
$clientGeolocation = getGeolocationData($clientIp);

// Get the X-Forwarded-For header from the request
$xffHeader = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : 'Not provided';

// Remove port if present in the X-Forwarded-For header
$xffHeaderParts = explode(":", $xffHeader);
$xffHeaderWithoutPort = $xffHeaderParts[0];
$xffGeolocation = getGeolocationData($xffHeaderWithoutPort);

echo "Actual Client IP: $clientIp<br>";
// Output geolocation information for the actual client IP
if ($clientGeolocation && isset($clientGeolocation['country'])) {
    echo "Geolocation for Actual IP - Country: {$clientGeolocation['country']}, City: {$clientGeolocation['city']}<br>";
    // You can include more information like region, etc. depending on the API response
} else {
    echo "Geolocation information for Actual IP not available.<br>";
}


// Output both the X-Forwarded-For header, actual client IP, and geolocation information
echo "<br>X-Forwarded-For Header: $xffHeaderWithoutPort<br>";


// Output geolocation information for the X-Forwarded-For header
if ($xffGeolocation && isset($xffGeolocation['country'])) {
    echo "Geolocation for X-Forwarded-For - Country: {$xffGeolocation['country']}, City: {$xffGeolocation['city']}<br>";
    // You can include more information like region, etc. depending on the API response
} else {
    echo "Geolocation information for X-Forwarded-For not available.<br>";
}



?>