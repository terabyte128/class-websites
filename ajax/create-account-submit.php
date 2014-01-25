<?php

# pull in values from POST data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$school = $_POST['school'];
$username = $_POST['username'];
$password = $_POST['password'];
$emailAddress = $_POST['email'];

# pull in the constants file and the file that creates the database object
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/constants.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db-connect.php";

# create a salt to append to the password
function generateSalt($max = 15) {
    $characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
    $i = 0;
    $salt = "";
    while ($i < $max) {
        $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
        $i++;
    }
    return $salt;
}

$salt = generateSalt();

# add the salt to the end of the password and hash it using sha1
$passwordHash = sha1($password . $salt);


$stmt = $db->prepare('INSERT INTO ' . TEACHER_LOGIN_TABLE . ' (first_name, last_name, school, email, username, password, salt) VALUES(?, ?, ?, ?, ?, ?, ?)');
try {
    $stmt->execute(array($firstName, $lastName, $school, $emailAddress, $username, $passwordHash, $salt));
    echo "Account created successfully! You may now log in.";
} catch (PDOException $e) {
    $message = $e->getMessage();

    if (strpos($message, "Duplicate entry") !== false) {
        echo "That username has been taken! If you believe this is in error, please <a href='mailto:sam@ingrahamrobotics.org'>contact Sam</a> and we'll get it sorted out.";
    } else {
        echo $message;
    }
}
?>
