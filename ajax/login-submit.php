<?php

session_start();

# get login data from POST
$username = $_POST['username'];
$password = $_POST['password'];


# pull in the constants file and the file that creates the database object
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db-connect.php";

try {
    # get the salt from the server to check if the password is valid
    $getSalt = $db->prepare("SELECT `salt` FROM " . TEACHER_LOGIN_TABLE . " WHERE `username`=?");
    $getSalt->execute(array($username));
    
    # fetch response from server
    $serverResponse = $getSalt->fetch(PDO::FETCH_ASSOC);
    $salt = $serverResponse['salt'];
} catch(PDOException $e) {
    die("Unable to access database: " . $e->getMessage());
}

# create a hash from the password + the salt to check against the database
$passwordHash = sha1($password . $salt);

try {
    $authenticate = $db->prepare('SELECT * FROM ' . TEACHER_LOGIN_TABLE . ' WHERE username = ? AND password = ?');
    $authenticate->execute(array($username, $passwordHash));
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
