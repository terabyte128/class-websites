<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/get-teacher-from-database.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.min.js"></script>
        <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.css">
        <title><?php echo $response['first_name'] . " " . $response['last_name'] . " - transfusion" ?></title>
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/teacherhome-header.php'; ?>                    
                <div class="page-content">
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/messages.php'; ?>                    
                    <!-- main content goes here -->
                    <div class='card' id="mainContent">
                        <!-- if the user does not exist, notify as such -->
                        <?php if ($dbQuery->rowCount() === 0) { ?>
                            <p class="title">This user does not exist. <a href="/">Return home.</a></p>
                        <?php } ?>

                        <?php if (!($isLoggedIn && $isTeacherPage)) { ?>
                            <p class='title'>
                                <?php echo $response['page_title']; ?>
                            </p>
                            <p style="white-space: pre-wrap;"><?php echo $response['page_content']; ?></p>
                        <?php } else { ?>
                            <p>
                                <a class='title editable' href='#' data-name='page_title'><?php echo $response['page_title']; ?></a>
                            </p>
                            <p>
                                <a id="pageContent" class='editable' href='#' data-name='page_content' data-type='textarea'><?php echo $response['page_content']; ?></a>
                            </p>

                        <?php } ?>
                    </div>
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
                $(".editable").editable({
                    mode: 'inline',
                    pk: '<?php echo $_SESSION["username"]; ?>',
                    url: '/ajax/update-preferences.php',
                    success: function(response) {
                        if (response !== "200 Success") {
                            showMessage(response, "danger");
                        }
                    }
                });
            });
        </script>
    </body>
</html>
