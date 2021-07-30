<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE, OPTIONS");
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

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$category = new Category($connection, $tablename);

if (isset($_GET['id'])) {
    $category->id = intval($_GET['id']);
} else {
    http_response_code(200);
    die(json_encode(array("status" => false, "message" => "Opps.. Category id found.")));
    return;
}

if ($category->delete()) {
    http_response_code(200);
    die(json_encode(array("status" => true, "message" => "Category was deleted.")));
} else {
    http_response_code(200);
    die(json_encode(array("status" => false, "message" => "Unable to delete Category.")));
}
