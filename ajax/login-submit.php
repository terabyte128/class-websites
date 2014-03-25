<?php

/**
 * This logs in a teacher by checking their credentials against the teacher_login
 * table. If successful, it sets up session cookies for the teacher's name, username
 * and ID. Called from /index.php via ajax.
 */

session_start();

# get login data from POST
$username = $_POST['username'];
$password = $_POST['password'];

# pull in the constants file and the file that creates the database object
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db-connect.php";

try {
    $authenticate = $db->prepare('SELECT * FROM ' . TEACHER_LOGIN_TABLE . ' WHERE username = ? AND password = ?');
    $authenticate->execute(array($username, $password));
    $authResponse = $authenticate->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    die("Unable to access database.");
}

if ($authenticate->rowCount() > 0) {
    # Login success
    # Regenerate the session ID to avoid session fixation
    session_regenerate_id();

    # Store the user data. Password was verified via auth query.
    $_SESSION['username'] = $username;
    $_SESSION['firstName'] = $authResponse['first_name'];
    $_SESSION['lastName'] = $authResponse['last_name'];
    $_SESSION['teacherID'] = $authResponse['uid'];
    
    echo '200 Success';

} else {
    unset($_SESSION['username']);
    unset($_SESSION['firstName']);
    unset($_SESSION['lastName']);
    unset($_SESSION['teacherID']);
    
    echo "Your username or password are incorrect, please try again.";
}
?>
