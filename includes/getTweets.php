<?php
require 'config.php';
$app_key = CONSUMER_KEY;
$app_token = CONSUMER_SECRET;
//These are our constants.
$api_base = 'https://api.twitter.com/';
$bearer_token_creds = base64_encode($app_key.':'.$app_token);
//Get a bearer token.
$opts = array(
'http'=>array(
'method' => 'POST',
'header' => 'Authorization: Basic '.$bearer_token_creds."\r\n".
'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
'content' => 'grant_type=client_credentials'
)
);
$context = stream_context_create($opts);
$json = file_get_contents($api_base.'oauth2/token',false,$context);
$result = json_decode($json,true);
if (!is_array($result) || !isset($result['token_type']) || !isset($result['access_token'])) {
die("Something went wrong. This isn't a valid array: ".$json);
}
if ($result['token_type'] !== "bearer") {
die("Invalid token type. Twitter says we need to make sure this is a bearer.");
}
$bearer_token = $result['access_token'];
//Options for getting stuff.
$opts = array(
'http'=>array(
'method' => 'GET',
'header' => 'Authorization: Bearer '.$bearer_token
)
);
$context = stream_context_create($opts);
$json = file_get_contents($api_base.'1.1/search/tweets.json?q=%23CM0677%20Top%20Bait',false,$context);
echo($json);
