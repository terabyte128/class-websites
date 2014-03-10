<?php
session_start();

# get the teacher username
$usernameFromGet = $_GET['teacher'];

# pull in constants file and create the database object
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db-connect.php";

# query the database for uid, first name, and last name
$dbQuery = $db->prepare("SELECT * FROM " . TEACHER_LOGIN_TABLE . " WHERE `username`=?");

# query the database for information about the teacher
try {
    $dbQuery->execute(array($usernameFromGet));
    $response = $dbQuery->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Failed to get information from database: ' . $e->getMessage());
}

# check if teacher is logged in
if (isset($_SESSION['username'])) {
    $isLoggedIn = true;
    # check if the teacher is on their own page
    if ($_SESSION['username'] === $usernameFromGet) {
        $isTeacherPage = true;
    } else {
        $isTeacherPage = false;
    }
} else {
    $isLoggedIn = false;
    $isTeacherPage = false;
}
?>