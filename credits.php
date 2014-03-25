<!--
General information page about what transfusion is and does
-->
<?php
session_start();

if (isset($_SESSION['firstName'])) {
    $isLoggedIn = true;
} else {
    $isLoggedIn = false;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
        <title>Transfusion - Credits</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
                <div class="page-content">
                    <div class="card">
                        <p class="title">
                            Credits
                        </p>
                        <ul>
                            <li><a href='http://jquery.com/' target='_blank'>jQuery</a> - a feature-rich JavaScript library with a much more concise API than traditional JavaScript for client-side processing</li>
                            <li><a href='http://getbootstrap.com/' target='_blank'>Bootstrap</a> - a web framework for improving the visual design of pages and easily allowing them to be responsive</li>
                            <li><a href='http://www.eyecon.ro/bootstrap-datepicker/' target='_blank'>Bootstrap Datepicker</a> - simple plugin for selecting dates on a form input via a calendar</li>
                            <li><a href='http://vitalets.github.io/x-editable/' target='_blank'>X-editable</a> - allows inline editing of form inputs via AJAX without having to refresh the page</li>
                            <li><a href='http://arshaw.com/fullcalendar/' target='_blank'>FullCalendar</a> - a simple API for generating a calendar with events</li>
                        </ul>
                    </div>
                </div>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
            </div>
        </div>
    </body>
</html>
