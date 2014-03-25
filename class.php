<?php
/**
 * Generates general page things for all class pages
 */

#assume homepage unless something else is set
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = "home";
}
$classURL = $_GET['class'];
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/get-classes-from-database.php'; ?>
<?php $classData = $classQuery->fetch(PDO::FETCH_ASSOC); ?>


<!DOCTYPE html>
<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
        <title><?php echo $classData['class_name'] . ' - transfusion'; ?></title>
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/class-header.php'; ?>                    
                <div class="page-content">
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/messages.php'; ?>                    
                    <!-- main content goes here -->
                    <?php
                    if (in_array($page, array("home", "assignments", "calendar", "links"))) {
                        include $_SERVER['DOCUMENT_ROOT'] . "/class-pages/$page.php";
                    } else {
                        echo "Page doesn't exist.";
                    }
                    ?>
                    <!-- end main content -->
                </div>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
            </div>
        </div>
        <script type="text/javascript">
            $(function() {
<?php if ($classQuery->rowCount() === 0) { ?>
                    loadPageWithMessage('/', 'Class not found.', 'danger');
<?php } ?>

                // figure out which page we're on and update the menu accordingly by adding the "active" class
                var path = window.location.pathname;
                if (path.indexOf("assignments") !== -1) {
                    $("#assignmentsTab").addClass("active");
                } else if (path.indexOf("calendar") !== -1) {
                    $("#calendarTab").addClass("active");
                } else if (path.indexOf("links") !== -1) {
                    $("#linksTab").addClass("active");
                } else {
                    $("#homeTab").addClass("active");
                }
            });
        </script>
    </body>
</html>

