<?php
function makeHeadder(){
    $header = <<<HEADER
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title> KF6012</title>
  <link rel="stylesheet" type="text/css" href="css/main.css"/>
  <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <script type="text/javascript" src="scripts/functions.js"></script>
    
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGuro5XLHOH2OpC2hYdxDB3ReQujjdq00">
        </script>

</head>
<body>
HEADER;
    return $header;
}