<!--
Teacher's non-specific homepage (not for any classes in particular)
-->

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/get-teacher-from-database.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
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
                                <a class='title editable' href='#' data-name='page_title' data-emptytext="Click to edit title"><?php echo $response['page_title']; ?></a>
                            </p>
                            <p>
                                <a id="pageContent" class='editable' href='#' data-name='page_content' data-type='textarea' data-emptytext="Click to edit description"><?php echo $response['page_content']; ?></a>
                            </p>

                        <?php } ?>
                            
                        <?php if ($response['show_email'] === "1") { ?>
                            <hr>
                            <p>Send an email to this teacher &nbsp;<a href="mailto:<?= $response['email'] ?>"><span class="glyphicon glyphicon-envelope" style="top: 3px; color: rgb(194, 188, 168);"></span></a></p>
                        <?php } ?>
                    </div>
                    <!-- end main content -->
                </div>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
            </div>
        </div>
        <script type="text/javascript">
            $(function() {
                $(".editable").editable({
                    mode: 'inline',
                    pk: '<?php echo $_SESSION["username"]; ?>',
                    url: '/ajax/update-preferences.php',
                    success: function(response) {
                        if (response.indexOf("200 Success") === -1) {
                            showMessage(response, "danger");
                        }
                    }
                });

            });

        </script>
    </body>
</html>
