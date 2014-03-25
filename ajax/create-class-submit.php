<?php

/**
 * This creates a new class and inserts it into the class table. Classes are
 * associated with a teacher_id. Called by /add-class.php via ajax.
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/check-session.php";

$className = $_POST['className'];
$classURL = $_POST['classURL'];
$classDescription = $_POST['classDescription'];

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db-connect.php";
try {
    $query = $db->prepare("INSERT INTO `class` (`teacher_id`, `class_name`, `class_url`, `class_description`) VALUES (?, ?, ?, ?)");
    $query->execute(array($_SESSION['teacherID'], $className, $classURL, $classDescription));
} catch(PDOException $e) {
    die($e->getMessage());
}

echo 200;

?>
