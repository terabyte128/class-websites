<?php

/**
 * This will return all the assignments for a given class via a JSON array.
 * Called by /class-pages/calendar.php via ajax.
 */

$classUID = $_POST['classUID'];

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db-connect.php';

try {
    $assnQuery = $db->prepare("SELECT * FROM `assignment` WHERE `class_id`=? ORDER BY `expire_date` ASC");
    $assnQuery->execute(array($classUID));
} catch (PDOException $e) {
    die($e->getMessage());
}

$events = array();

# create and format an array
while ($value = $assnQuery->fetch(PDO::FETCH_ASSOC)) {
    $event = array();
    $event['title'] = $value['title'];
    $event['start'] = $value['expire_date'];
    $event['allday'] = "true";
    $event['description'] = $value['description'];
    $event['uid'] = $value['uid'];
    array_push($events, $event);
}

# return it json-ified
print_r(json_encode($events));
?>
