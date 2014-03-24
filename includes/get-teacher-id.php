<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db-connect.php';

$teacherUsername = $_POST['teacherUsername'];

try {
    $query = $db->prepare("SELECT `uid` FROM `teacher_login` WHERE `username`=?");
    $query->execute(array($teacherUsername));
    
    $response = $query->fetch(PDO::FETCH_ASSOC);
    
    echo $response['uid'];
} catch(PDOException $e) {
    die($e->getMessage());
}

?>
