<?php

//private page
function getUserIP() {
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }
    return $ip;
}
//get user IP
$user_ip = getUserIP();
$allowed_ip = array('127.0.0.1', '149.255.59.20','90.207.203.133');
if (!isset($user_ip) || !in_array($user_ip, $allowed_ip)) {
    
    echo "<div style='text-align:center;font-size: 32px;font-weight:bold;'>403 Forbidden</div>";
    header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
    exit;
}

function defaultRocketChat($name,$msg) {
    define('ROCKETCHAT_WEBHOOK1', 'https://rc.jonathanallen.org.uk/hooks/tYLcoeH3hniq4q74b/gmy3bbK6WwLKRRLwjmRtkt63EcK58EDCTziYbgKeBmBKxZs5');
    // Make your message
    $message = json_encode(array('alias' => $name,'avatar' => 'https://parrotmedia.co.uk/img/g18159.png','msg' => $msg));
    // Use curl to send your message
    $c = curl_init(ROCKETCHAT_WEBHOOK1);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_HEADER, false);
    curl_setopt($c, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));
    curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($c, CURLOPT_POST, true);
    curl_setopt($c, CURLOPT_POSTFIELDS, $message);
    curl_exec($c);
    curl_close($c);
}



// LBA Business reviews
$placeid = "ChIJReBlEir510cRYIV3Yjs3hbk"; // https://developers.google.com/maps/documentation/javascript/examples/places-placeid-finder#maps_places_placeid_finder-javascript

include("api-key.php");

$url = 'https://maps.googleapis.com/maps/api/place/details/json?reference=' . $placeid . '&key=' . $apikey . '&fields=review';

$curl = curl_init();
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_REFERER, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
$str = curl_exec($curl);
// get http code for error handling
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
$response = json_decode($str, true);
//get api status
/*possible status
    INVALID_REQUEST: This request was invalid.
    OK: The response contains a valid result.
    OVER_QUERY_LIMIT: The webpage has gone over its request quota.
    NOT_FOUND The referenced location was not found in the Places database.
    REQUEST_DENIED: The webpage is not allowed to use the PlacesService.
    UNKNOWN_ERROR: The PlacesService request could not be processed due to a server error. The request may succeed if you try again.
    ZERO_RESULTS: No result was found for this request.

*/
$status = $response['status'];
if($status == "OK") {
    $state = true;
    // drop into reviews section of json
    $reviews = $response['result']['reviews'];
    $no_reviews = count($reviews);
    // find timestamp and sort so newest is first
    $time = array_column($reviews, 'time');
    array_multisort($time, SORT_DESC, $reviews);
} else {
    $state = false;
}

//db connection

include("../php/connect.php");


$db = new mysqli($DATABASE_HOST,$DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME) or die("Database Connection Failed");

$newreviews = 0;
if($state == true && $no_reviews >= 1) {
    foreach ($reviews as $review) {
        $author_name = $db->escape_string($review['author_name']);
        $author_url = $review['author_url'];
        $profileimg = $db->real_escape_string($review['profile_photo_url']);
        $rating = $db->escape_string($review['rating']);
        $relative_time = $db->escape_string($review['relative_time_description']);
        $text = $db->escape_string($review['text']);
        $time = $db->escape_string($review['time']);
        $date = date('Y-m-d H:i:s', $time);
        
        $sql = "SELECT * FROM reviews WHERE author_name = '$author_name' and date_time = '$date'";
        $result = $db->query($sql) or die($db->error);
        $match = $result->num_rows;
        if($match == 0) {
            $newreviews++;
            mysqli_query($db, "INSERT INTO `reviews` (author_name,author_url,profile_photo_url,rating,relative_time,text,date_time) VALUES ('$author_name','$author_url','$profileimg','$rating','$relative_time','$text','$date')") or die($db->error);
        }
    }
   //success
   if($newreviews >=1) {
    $name = "Google Review Bot";
    $msg = "New Reviews: " . $newreviews;
    defaultRocketChat($name,$msg);
}
//print
    echo "New Reviews: " . $newreviews;
} else {
    //error
    $name = "Google Review Bot - ERROR!";
    $msg = "ERROR! Status: " . $status . ". No. Reviews: " . $no_reviews;
    defaultRocketChat($name,$msg);
    //print
    echo "ERROR! Status: " . $status . ". No. Reviews: " . $no_reviews;
}?>
