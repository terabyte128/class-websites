<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db-connect.php';

/**
 * fetches all links for /class-pages/links.php and returns them
 * as an executed query 
 */


try {
    $linkQuery = $db->prepare("SELECT * FROM `link` WHERE `class_id`=? ORDER BY `uid` DESC");
    $linkQuery->execute(array($classUID));
} catch(PDOException $e) {
    die($e->getMessage());
}
?>
