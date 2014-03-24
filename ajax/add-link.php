<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/check-session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db-connect.php';

$teacherUID = $_POST['teacherUID'];
$classUID = $_POST['classUID'];
$linkName = $_POST['linkName'];
$linkDescription = $_POST['linkDescription'];
$linkURL = $_POST['linkURL'];


try {
    $query = $db->prepare("INSERT INTO `link` (`title`, `description`, `class_id`, `teacher_id`, `url`) VALUES (?, ?, ?, ?, ?)");
    $query->execute(array($linkName, $linkDescription, $classUID,  $teacherUID, $linkURL));
} catch(PDOException $e) {
    die($e->getMessage());
}

echo 200;
?>
