<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db-connect.php';

//$classUID = $_GET['classUID'];

try {
    $assnQuery = $db->prepare("SELECT * FROM `assignment` WHERE `class_id`=? ORDER BY `expire_date` ASC");
    $assnQuery->execute(array($classUID));
} catch(PDOException $e) {
    die($e->getMessage());
}
?>
