<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/message-control.php'; ?>

<?php

session_start();

if (!isset($_SESSION['username'])) {
    echo '<script type="text/javascript">';
    echo 'loadPageWithMessage("/index.php", "Please login first to access preferences.", "danger");';
    echo '</script>';
}
?>
