<?php

session_start();

# get a database entry and the new value of it
$column = $_POST['name'];
$value = $_POST['value'];
$sessionVar = $_POST['pk'];

$value = strip_tags($value);

# pull in the constants file and the file that creates the database object
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/constants.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db-connect.php";

# prepare the database for a query
$stmt = $db->prepare("UPDATE " . TEACHER_LOGIN_TABLE . " SET $column=? WHERE `username`=?");
try {
    # update the values
    $stmt->execute(array($value, $_SESSION['username']));
    echo "200 Success";

    # if all is good, update session variables so that updated values show up 
    # without having to log in again
    
    if (isset($_SESSION[$sessionVar])) {
        $_SESSION[$sessionVar] = $value;
    }
    
} catch (PDOException $e) {
    $message = $e->getMessage();
    # otherwise, something went wrong
    echo "Failed to update preferences: " . $message;
}
?>
