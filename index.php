<?php
// Get the X-Forwarded-For header from the request
$xffHeader = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : 'Not provided';

// Get the actual client IP address
$clientIp = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Not provided';

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, "https://ipinfo.io/$clientIp/json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL session and decode JSON response
$response = curl_exec($ch);
$geolocationData = json_decode($response, true);

// Close cURL session
curl_close($ch);

// Output both the X-Forwarded-For header, actual client IP, and geolocation information
echo "X-Forwarded-For Header: $xffHeader<br>";
echo "Actual Client IP: $clientIp<br>";

if ($geolocationData && isset($geolocationData['country'])) {
    echo "Country: {$geolocationData['country']}<br>";
    // You can include more information like city, region, etc. depending on the API response
} else {
    echo "Geolocation information not available.<br>";
}
?>