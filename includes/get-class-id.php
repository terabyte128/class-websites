<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db-connect.php';

$classURL = $_POST['classURL'];
$teacherUID = $_POST['teacherUID'];

try {
    $query = $db->prepare("SELECT `uid` FROM `class` WHERE `class_url`=? AND `teacher_id=?");
    $query->execute(array($classURL, $teacherUID));
    
    $response = $query->fetch(PDO::FETCH_ASSOC);
    
    echo $response['uid'];
} catch(PDOException $e) {
    die($e->getMessage());
}

?>
