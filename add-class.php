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
                        <?php if ($isTeacherPage) { ?>
                        <p class="title">Add Class</p>
                        <?php } ?>
                    </div>
                    <!-- end main content -->
                </div>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
            </div>
        </div>
    </body>
</html>

