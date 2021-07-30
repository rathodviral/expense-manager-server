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
include_once '../common.php';
include_once 'sub_category.php';

$tablename = 'sub_category';

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

$sub_category = new SubCategory($connection, $tablename);

$sub_category->is_expense = $data->isExpense ? '1' : '0';
$sub_category->name = $data->name;
$sub_category->detail = $data->detail;
$sub_category->category_id = $data->categoryId;
$sub_category->is_expense = $data->isExpense ? '1' : '0';

http_response_code(200);
if ($sub_category->create()) {
    die(json_encode(array("status" => true, "message" => "Yeah.. SubCategory was created.")));
} else {
    die(json_encode(array("status" => false, "message" => "Opps.. Unable to create SubCategory.")));
}
