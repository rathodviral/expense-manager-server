<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  return 0;
}

include_once '../dbclass.php';
include_once 'user.php';

$data = json_decode(file_get_contents("php://input"));

if (!$data) {
  http_response_code(400);
  die(json_encode(
    array("status" => false, "message" => "Opps.. User information not found.")
  ));
  return;
}

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$user_data = new User($connection);

$user_data->username = $data->username;
$user_data->password = $data->password;
$user_data->detail = $data->detail;
$user_data->family = $data->family;

if ($user_data->create()) {
  http_response_code(200);
  die(json_encode(array("status" => true, "message" => "Yeah.. User was created.")));
} else {
  http_response_code(200);
  die(json_encode(array("status" => false, "message" => "Opps.. Unable to create User.")));
}
