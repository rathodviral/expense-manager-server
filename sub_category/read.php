<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$sub_category = new SubCategory($connection, $tablename);

$stmt = $sub_category->read();
$count = $stmt->rowCount();

if ($count > 0) {
    $exp = array();
    $exp["status"] = true;
    $exp["data"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $p  = array(
            "id" => $id,
            "name" => $name,
            "isExpense" => intval($is_expense) === 1,
            "detail" => $detail,
            "catgoryId" => $category_id,
        );
        array_push($exp["data"], $p);
    }
    http_response_code(200);
    die(json_encode($exp));
} else {
    http_response_code(200);
    die(json_encode(
        array("status" => false, "data" => array(), "message" => "Opps.. No SubCategory data found.")
    ));
}
