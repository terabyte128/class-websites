<?php
/**
 * This adds an assignment to the assignments table and associates it with a
 * specific teacher_id and class_id. Called by /class-pages/assignments.php 
 * via ajax
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/check-session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db-connect.php';

$teacherUID = $_POST['teacherUID'];
$classUID = $_POST['classUID'];
$assignName = $_POST['assignName'];
$assignDescription = $_POST['assignDescription'];
$assignValue = $_POST['assignValue'];
$assignCategory = $_POST['assignCategory'];
$dueDate = $_POST['dueDate'];

try {
    $query = $db->prepare("INSERT INTO `assignment` (`title`, `description`, `class_id`, `teacher_id`, `category`, `value`, `expire_date`) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $query->execute(array($assignName, $assignDescription, $classUID,  $teacherUID, $assignCategory, $assignValue, $dueDate));
} catch(PDOException $e) {
    die($e->getMessage());
}

echo 200;
?>
