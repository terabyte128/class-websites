<?php

/*
 * var events = [{
  title: 'Test Event',
  start: "2014-1-21",
  allDay: true
  },
  {
  title: 'Another Event',
  start: "2014-1-22",
  allDay: true
  }

  ]
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

while ($value = $assnQuery->fetch(PDO::FETCH_ASSOC)) {
    $event = array();
    $event['title'] = $value['title'];
    $event['start'] = $value['expire_date'];
    $event['allday'] = "true";
    $event['description'] = $value['description'];
    $event['uid'] = $value['uid'];
    array_push($events, $event);
}
print_r(json_encode($events));
?>
