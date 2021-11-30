<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    return 0;
}

include_once '../dbclass.php';
include_once '../common.php';
include_once 'category.php';

$tablename = 'category';

if (!isset($_GET['family'])) {
    $common = new Common();
    $common->errorHandling('family');
    return;
} else {
    $tablename = $_GET['family'];
}

$data = json_decode(file_get_contents("php://input"));

if (!$data) {
    $common = new Common();
    $common->errorHandling('category');
    return;
}

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$category = new CategoryOnly($connection, $tablename);

$category->id = $data->id;
$category->name = $data->name;
$category->is_expense = $data->isExpense ? '1' : '0';
$category->is_active = $data->isActive ? '1' : '0';
$category->detail = $data->detail;

http_response_code(200);
if ($category->update()) {
    die(json_encode(array("status" => true, "message" => "Yeah.. Category was updated.")));
} else {
    die(json_encode(array("status" => false, "message" => "Opps.. Unable to update Category.")));
}
