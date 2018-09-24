<?php

error_reporting(0);
 
function badRequest() {
    http_response_code(400);
    header('Location: /');
    die();
}
//Make sure that it is a POST request.
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
    badRequest(); //Request method must be POST
}

//Make sure that the content type of the POST request has been set to application/json
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if(strcasecmp($contentType, 'application/json') != 0){
    badRequest(); //Content type must be: application/json
}

//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));

//Attempt to decode the incoming RAW post data from JSON.
$decoded = json_decode($content, true);

//If json_decode failed, the JSON is invalid.
if(!is_array($decoded)){
    badRequest(); //Received content contained invalid JSON!
}

if (!array_key_exists ("id", $decoded) || !array_key_exists("url", $decoded)) {
    badRequest();
}

$id = $decoded["id"];
$url = $decoded["url"];
$entry = date('Y-m-d H:i:s') . " | " . $id . " | " . $url . PHP_EOL;

file_put_contents('repository.txt', $entry , FILE_APPEND | LOCK_EX);

http_response_code(204);
