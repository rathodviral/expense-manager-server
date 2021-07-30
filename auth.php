<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'dbclass.php';
include_once 'user/user.php';
include_once 'token.php';
include_once 'category/category.php';
include_once 'sub_category/sub_category.php';

$data = json_decode(file_get_contents("php://input"));

if (!$data) {
    die(json_encode(
        array("status" => false, "message" => "Opps.. Username/Password not found.")
    ));
    return;
}

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$userclass = new User($connection);
$tokenclass = new Token();

$userclass->username = $data->username;
$userclass->password = $data->password;
$tokenData = time() . "_" . $userclass->username . "-" . $userclass->password;
$token = $tokenclass->createToken($tokenData);


$stmt = $userclass->authorize();
$count = $stmt->rowCount();

if ($count > 0) {
    $user = array();
    $user["status"] = true;
    $user["token"] = $token;
    $user["message"] = "Success";
    $user["data"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $p  = array(
            "username" => $username,
            "isAdmin" => $is_admin === '1',
            "family" => $family,
            "detail" => $detail,
        );
        $user["data"] = $p;
    }
    // if (!$user["data"]["isAdmin"]) {
    //     $family = $user["data"]["family"];
    //     $category = new Category($connection,  $family);
    //     $category_data = $category->readData();
    //     $sub_category = new SubCategory($connection,  $family);
    //     $sub_category_data = $sub_category->readData();
    //     $user["data"]["category"] = $category_data;
    //     $user["data"]["subCategory"] = $sub_category_data;
    //     http_response_code(200);
    //     die(json_encode($user));
    // } else {
    //     http_response_code(200);
    //     die(json_encode($user));
    // }
    http_response_code(200);
    die(json_encode($user));
} else {
    http_response_code(200);
    die(json_encode(
        array("status" => false, "message" => "Opps.. Username/Password not match.")
    ));
}
