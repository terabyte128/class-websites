<?php

//connects you to the database as defined by constants.php
require_once 'constants.php';

try {
    $db = new PDO(DSN, MYSQL_USER, MYSQL_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    die("Unable to connect to DB \n " . $ex->getMessage());
}
?>
