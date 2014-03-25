

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/message-control.php'; ?>

<?php

/**
 * Used by pages that require a teacher to be logged in, this checks that a 
 * session exists and redirects to the login page if it doesn't
 */

session_start();

if (!isset($_SESSION['username'])) {
    echo '<script type="text/javascript">';
    echo 'loadPageWithMessage("/index.php", "Please login first.", "danger");';
    echo '</script>';
}
?>
