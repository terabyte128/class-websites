<?php

/**
 * This returns the salt for a given teacher username, so that passwords
 * can be hashed client-side before being sent over to the server for verification
 * Called by /index.php via ajax.
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db-connect.php';

$username = $_POST['username'];

try {
    $query = $db->prepare("SELECT `salt` FROM `teacher_login` WHERE `username`=?");
    $query->execute(array($username));

    $response = $query->fetch(PDO::FETCH_ASSOC);

    if ($query->rowCount() === 0) {
        die("USER_NOT_FOUND");
    }

    echo $response['salt'];
} catch (PDOException $e) {
    die($e->getMessage());
}

?>
