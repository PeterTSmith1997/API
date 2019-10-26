<?php
session_start();
require 'config.php';
require "twitteroauth-master/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;
$request_token = [];
$request_token['oauth_token'] = $_SESSION['oauth_token'];
$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];
if (isset($_REQUEST['oauth_token']) &&
    $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
    header('Location: index.php');
}
//Now we make a TwitterOAuth instance with the temporary request
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,
    $request_token['oauth_token'], $request_token['oauth_token_secret']);
$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
//Session is stored on the server and cannot be accessed by the user.
//Used in send_tweet.php
$_SESSION['oauth_token'] = $access_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $access_token['oauth_token_secret'];
//Now we make a TwitterOAuth instance with the users access_token
$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,
    $access_token['oauth_token'], $access_token['oauth_token_secret']);
// Let's get the user's info
$user_info = $twitter->get('account/verify_credentials');
header('Location: index.php');