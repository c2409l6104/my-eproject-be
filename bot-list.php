<?php
$apiKey = 'AIzaSyDjpm_i5G46VEqsBpiXJQ5tLQQ08-x7Bz0'; // Replace with your actual API key
$url = "https://generativelanguage.googleapis.com/v1beta/models?key=$apiKey";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "cURL error: " . curl_error($ch);
} else {
    $data = json_decode($response, true);
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
curl_close($ch);
?>
