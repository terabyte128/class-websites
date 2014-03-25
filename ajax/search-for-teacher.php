<?php

/**
 * This returns a json-encoded array of a teacher and all of their classes that 
 * match a specific query for the teacher's name. Called by /create-schedule.php
 * via ajax.
 * 
 * Example of JSON return array:
 * [
    {
        "wolfson": {
            "first_name": "Sam",
            "last_name": "Wolfson",
            "username": "wolfson",
            "uid": "10",
            "classes": {
                "ib-biology-hl": {
                    "uid": "5",
                    "name": "IB Biology HL"
                }
            }
        }
    }
]


 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db-connect.php";

$query = $_POST['query'];
$encapsulatedQuery = '%' . $query . '%';

# get teacher data
try {
    $query = $db->prepare("SELECT `first_name`, `last_name`, `uid`, `username` FROM `teacher_login` WHERE first_name LIKE ? OR last_name LIKE ? OR username LIKE ?");
    $query->execute(array($encapsulatedQuery, $encapsulatedQuery, $encapsulatedQuery));
} catch (PDOException $e) {
    die($e->getMessage());
}

$teachers = array();

while ($teacher = $query->fetch(PDO::FETCH_ASSOC)) {
    $teachers[$teacher['username']] = array();
    $teachers[$teacher['username']]['first_name'] = $teacher['first_name'];
    $teachers[$teacher['username']]['last_name'] = $teacher['last_name'];
    $teachers[$teacher['username']]['uid'] = $teacher['uid'];
    # nested query to get class data
    try {
        $classQuery = $db->prepare("SELECT `class_name`, `uid`, `class_url` FROM `class` WHERE teacher_id=?");
        $classQuery->execute(array($teacher['uid']));
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    while ($class = $classQuery->fetch(PDO::FETCH_ASSOC)) {
        $teachers[$teacher['username']]['classes'][$class['class_url']] = array();
        $teachers[$teacher['username']]['classes'][$class['class_url']]['uid'] = $class['uid'];
        $teachers[$teacher['username']]['classes'][$class['class_url']]['name'] = $class['class_name'];
    }
}

echo json_encode($teachers);
?>