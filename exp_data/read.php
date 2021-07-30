<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../dbclass.php';
include_once '../common.php';
include_once 'exp_data.php';

// $Auth = $_SERVER['AUTH_TOKEN'];

$common = new Common();

$tablename = 'exp_data';

if (!isset($_GET['family'])) {
    $common->errorHandling('family');
    return;
} else {
    $tablename = $_GET['family'];
}

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$exp_data = new ExpenseData($connection, $tablename);

$stmt = $exp_data->readByCurrentMonth();
$count = $stmt->rowCount();

if ($count > 0) {
    $exp = array();
    $exp["status"] = true;
    $exp["data"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $p  = array(
            "id" => $id,
            "user" => $user,
            "category" => $category,
            "date" => $date,
            "isExpense" => intval($is_expense) === 1,
            "isPaid" => intval($is_paid) === 1,
            "detail" => $detail,
            "amount" => intval($amount),
            "note" => $note,
        );
        array_push($exp["data"], $p);
    }
    http_response_code(200);
    die(json_encode($exp));
} else {
    http_response_code(200);
    die(json_encode(
        array("status" => false, "data" => array(), "message" => "Opps.. No Expense/Income data found.")
    ));
}
