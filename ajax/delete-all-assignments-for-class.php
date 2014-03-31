<?php

/**
 * This deletes an assignment from the assignments table. Called from
 * /class-pages/assignments.php via ajax. 
 */
$classId = $_POST['classId'];

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/check-session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db-connect.php';

# check that it's the teacher's assignment to delete
try {
    $query = $db->prepare("SELECT `teacher_id` FROM `class` WHERE `uid`=?");
    $query->execute(array($classId));
    $response = $query->fetch(PDO::FETCH_ASSOC);
    if ($response['teacher_id'] !== $_SESSION['teacherID']) {
        die("You may only delete assignments from your own classes.");
    }
} catch (PDOException $e) {
    die("Unable to access database: " . $e->getMessage());
}

try {
    $query = $db->prepare("DELETE FROM `assignment` WHERE `class_id`=?");
    $query->execute(array($classId));
    echo 200;
} catch (PDOException $e) {
    die("Unable to access database: " . $e->getMessage());
}
?>
