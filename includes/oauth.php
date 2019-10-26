<?php
session_start();

require 'config.php';
require '../twitteroauth-master/autoload.php';

use Abraham\TwitterOAuth\TwitterOAuth;

$requestToken = [];
$requestToken['oauth_token'] = $_SESSION['oauth_token'];
$requestToken['oauth_tokenS'] = $_SESSION['oauth_token_secret'];

if (isset($_REQUEST['oauth_token'])&& $requestToken['oauth_token'] != $_REQUEST['oauth_token']){
    header('location:index.php');
}

$conn = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET,$requestToken{'oauth_token'}, $requestToken['oauth_token_secret']);

$at = $conn->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));

$_SESSION['oauth_token'] = $accessToken['oauth_token'];
$_SESSION['oauth_tokenS'] = $accessToken['oauth_token_secret'];

$twitter = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET, $accessToken['oauth_token'], $accessToken['oauth_token_secret']);

$user = $twitter->get('account/verify_credentials');


header('location:index.php');