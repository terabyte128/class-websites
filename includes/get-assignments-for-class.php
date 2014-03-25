<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db-connect.php';

/**
 * fetches all assignments for /class-pages/assignments.php and returns them
 * as an array of rows
 */

try {
    $assnQuery = $db->prepare("SELECT * FROM `assignment` WHERE `class_id`=? ORDER BY `expire_date` ASC");
    $assnQuery->execute(array($classUID));
} catch(PDOException $e) {
    die($e->getMessage());
}

$rows = $assnQuery->fetchAll();

?>
