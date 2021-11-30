<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'dbclass.php';
include_once 'category/category.php';
include_once 'exp_data/exp_data.php';
// include_once 'sub_category/sub_category.php';

$family = '';
$type = '';

if (!isset($_GET['family'])) {
  $common = new Common();
  $common->errorHandling('family');
  return;
} else {
  $family = $_GET['family'];
}

if (isset($_GET['type'])) {
  $type = $_GET['type'];
}

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$category = new Category($connection,  $family);
$category_data = $category->readData();

// $sub_category = new SubCategory($connection,  $family);
// $sub_category_data = $sub_category->readData();

$exp = new ExpenseData($connection,  $family);
$exp_data = $exp->readData();

$response = array();
$response["data"] = array();
if ($type === 'category') {
  $response["data"]["category"] = $category_data;
  // $response["data"]["subCategory"] = $sub_category_data;
} else if ($type === 'expense') {
  $response["data"]["expense"] = $exp_data;
} else {
  $response["data"]["category"] = $category_data;
  // $response["data"]["subCategory"] = $sub_category_data;
  $response["data"]["expense"] = $exp_data;
}
if (!empty($category_data) || !empty($sub_category_data) || !empty($exp_data)) {
  $response["status"] = true;
  $response["message"] = "Success";
} else {
  http_response_code(200);
  $response["status"] = false;
  $response["message"] = "Opps.. No data found.";
}
die(json_encode($response));
