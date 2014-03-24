<?php

$assignmentId = $_POST['assignmentId'];

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/check-session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db-connect.php';

# check that it's the teacher's assignment to delete
try {
    $query = $db->prepare("SELECT `teacher_id` FROM `assignment` WHERE `uid`=?");
    $query->execute(array($assignmentId));
} catch (PDOException $e) {
    if ($response['teacher_id'] !== $_SESSION['teacherID']) {
        die("You may only delete assignments from your own classes.");
    }
} catch (PDOException $e) {
    die("Unable to access database: " . $e->getMessage());
}

try {
    $query = $db->prepare("DELETE FROM `assignment` WHERE `uid`=?");
    $query->execute(array($assignmentId));
    echo 200;
} catch (PDOException $e) {
    die("Unable to access database: " . $e->getMessage());
}
?>
