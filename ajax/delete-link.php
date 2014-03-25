<?php

/**
 * This deletes an assignment from the links table. Called from
 * /class-pages/links.php via ajax. 
 */

$linkId = $_POST['linkId'];

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/check-session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db-connect.php';

# check that it's the teacher's link to delete
try {
    $query = $db->prepare("SELECT `teacher_id` FROM `link` WHERE `uid`=?");
    $query->execute(array($linkId));
} catch (PDOException $e) {
    if ($response['teacher_id'] !== $_SESSION['teacherID']) {
        die("You may only delete assignments from your own classes.");
    }
} catch (PDOException $e) {
    die("Unable to access database: " . $e->getMessage());
}

try {
    $query = $db->prepare("DELETE FROM `link` WHERE `uid`=?");
    $query->execute(array($linkId));
    echo 200;
} catch (PDOException $e) {
    die("Unable to access database: " . $e->getMessage());
}
?>
