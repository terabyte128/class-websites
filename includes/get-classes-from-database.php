<?php

/**
 * Retrieves either a single class or every class from the database based upon
 * arguments passed through inclusion in other files
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/get-teacher-from-database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db-connect.php';

if (isset($classURL)) {
    $singleClass = true;
} else {
    $singleClass = false;
}

$teacherUID = $response['uid'];

try {
    $params = array($teacherUID);
    $queryString = "SELECT * from `class` WHERE `teacher_id`=?";
    if ($singleClass) {
        $queryString .= " AND `class_url`=?";
        array_push($params, $classURL);
    }
    $classQuery = $db->prepare($queryString);
    $classQuery->execute($params);
} catch (PDOException $e) {
    die($e->getMessage());
}
?>
