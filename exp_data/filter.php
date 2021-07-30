<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$exp_data = new ExpenseData($connection, $tablename);

if (isset($_GET['id'])) {
    $exp_data->id = intval($_GET['id']);
}

if (isset($_GET['isExpense'])) {
    $exp_data->is_expense = $_GET['isExpense'];
}

if (isset($_GET['user'])) {
    $exp_data->user = $_GET['user'];
}

if (isset($_GET['date'])) {
    $exp_data->date = $_GET['date'];
}

if (isset($_GET['category'])) {
    $exp_data->category = $_GET['category'];
}

$stmt = $exp_data->readByFilter();
$count = $stmt->rowCount();

if ($count > 0) {
    $exp = array();
    $exp["status"] = true;
    $exp["data"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $p  = array(
            "id" => $id,
            "isExpense" => $is_expense,
            "user" => $user,
            "date" => $date,
            "category" => $category,
            "detail" => $detail,
            "amount" => $amount,
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
