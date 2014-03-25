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
        <title>Transfusion - Home</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
                <div class="page-content">
                    <div class="card">
                        <p class="title">
                            What is transfusion?
                        </p>
                        <p>
                            transfusion allows teachers to post assignments and 
                            relevant class information online for their students
                            to see. It does not require students to login or
                            create an account in order to use it, so they can
                            check information about their classes quickly and easily.
                            <br /><br />
                            <strong>Features:</strong>
                        </p>
                        <ul>
                            <li>Teacher announcements and links for all classes</li>
                            <li>Teachers can maintain multiple pages, one for each of their classes</li>
                            <li>For each individual class, teachers can post:
                                <ul>
                                    <li>General announcements</li>
                                    <li>Links</li>
                                    <li>Assignments</li>
                                </ul>
                            <li>Students can submit work via an online dropbox</li>
                            <li>A calendar is automatically generated with all the assignments from a class
                            </li>
                            <li>Schedule Pages: students can select the classes in their schedule and create a link to a page which includes:
                                <ul>
                                    <li>A unified assignments page</li>
                                    <li>A unified calendar</li>
                                </ul>
                            </li>
                        </ul>
                        <br />
                        <button class="btn btn-default" onclick="window.location = '/create';">Try It Out</button>
                        <br /><br />
                    </div>
                </div>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
            </div>
        </div>
    </body>
</html>
