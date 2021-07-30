<?php
include_once 'dbclass.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$table_name = array('invoice', 'measurement');
$file_name = '';
$table_name = '';
if (!$connection) {
    die('Could not connect');
}

if (isset($_GET['fileName']) && isset($_GET['tableName'])) {
    $file_name =  $_GET['fileName'];
    $table_name =  $_GET['tableName'];
} else {
    die(json_encode(array("status" => false, "message" => "No fileName and tableName found")));
}

$backup_file = 'C:/ProgramData/MySQL/MySQL Server 5.5/Uploads/' . $file_name;
$query = "LOAD DATA INFILE '" . $backup_file . "' INTO TABLE " . $table_name;
$stmt = $connection->prepare($query);
$stmt->execute();
$count = $stmt->errorInfo();
if ($stmt->errorCode() !== '00000') {
    die(json_encode($stmt->errorInfo()));
} else {
    die("Laod data process complete");
}
