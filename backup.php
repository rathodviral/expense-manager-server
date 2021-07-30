<?php
include_once 'dbclass.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$table_name = array('invoice', 'measurement');

// $command = "mysqldump --opt -h $dbhost -u $dbuser -p $dbpass " . "aakar_app > $backup_file";
// system($command);

if (!$connection) {
    die('Could not connect');
}

session_start();

if (isset($_SESSION['counter'])) {
    $_SESSION['counter'] = false;
} else {
    $_SESSION['counter'] = true;
}

if ($_SESSION['counter']) {
    foreach ($table_name as $value) {
        $backup_file = 'C:/ProgramData/MySQL/MySQL Server 5.5/Uploads/' . $value . '-' . date("y-m-d-h-s") . '.sql';
        $query = "SELECT * INTO OUTFILE '" . $backup_file . "' FROM " . $value;
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $count = $stmt->errorInfo();
        if ($stmt->errorCode() !== '00000') {
            die(json_encode($stmt->errorInfo()));
        }
    }
    echo "Backup process complete, you can check - C:/ProgramData/MySQL/MySQL Server 5.5/Uploads/";
} else {
    echo "Backup already taken, you can check - C:/ProgramData/MySQL/MySQL Server 5.5/Uploads/";
}
