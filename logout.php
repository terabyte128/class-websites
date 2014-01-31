<?php require_once 'includes/message-control.php'; ?>

<?php

session_start();

unset($_SESSION['username']);
unset($_SESSION['firstName']);
unset($_SESSION['lastName']);
unset($_SESSION['teacherID']);

echo '<script type="text/javascript">';
echo 'loadPageWithMessage("/index.php", "Logged out successfully.", "success");';
echo '</script>';

?>
