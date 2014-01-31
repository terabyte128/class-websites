<?php
session_start();

# get the teacher username
$usernameFromGet = $_GET['teacher'];

# pull in constants file and create the database object
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db-connect.php";

# query the database for uid, first name, and last name
$dbQuery = $db->prepare("SELECT uid, first_name, last_name FROM " . TEACHER_LOGIN_TABLE . " WHERE `username`=?");

# query the database for information about the teacher
try {
    $dbQuery->execute(array($usernameFromGet));
    $response = $dbQuery->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Failed to get information from database: ' . $e->getMessage());
}

# check if teacher is logged in
if (isset($_SESSION['username'])) {
    $isLoggedIn = true;
    # check if the teacher is on their own page
    if ($_SESSION['username'] === $usernameFromGet) {
        $isTeacherPage = true;
    } else {
        $isTeacherPage = false;
    }
} else {
    $isLoggedIn = false;
}

# now query the database for information about the class
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.min.js"></script>
        <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.css">
        <title><?php echo $_GET['teacher'] . ' - transfusion'; ?></title>
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/class-header.php'; ?>                    
                <div class="page-content">
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/messages.php'; ?>                    
                    <!-- main content goes here -->
                    
                    <!-- end main content -->
                </div>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
            </div>
        </div>
        <script type="text/javascript">
            $(function() {
                $("#assignmentsTab").addClass("active");
                $("#filesTab").removeClass("active");
                $("#calendarTab").removeClass("active");
            });
        </script>
    </body>
</html>

