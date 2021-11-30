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
include_once 'exp_data.php';

$tablename = 'exp_data';

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
    $common->errorHandling('expense');
    return;
}

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$exp_data = new ExpenseData($connection, $tablename);

$exp_data->is_expense = $data->isExpense ? '1' : '0';
$exp_data->is_paid = $data->isPaid ? '1' : '0';
$exp_data->date = $data->date;
$exp_data->user = $data->user;
$exp_data->category = $data->category;
$exp_data->detail = isset($data->detail) ? $data->detail : "";
$exp_data->amount = $data->amount;
$exp_data->note = $data->note;

http_response_code(200);
if ($exp_data->create()) {
    die(json_encode(array("status" => true, "message" => "Yeah.. Expense/Income was created.")));
} else {
    die(json_encode(array("status" => false, "message" => "Opps.. Unable to create Expense/Income.")));
}
