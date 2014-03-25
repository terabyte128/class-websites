<!--
Adds a class for a teacher via ajax. Calls /ajax/create-class-submit.php
-->


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/get-teacher-from-database.php';
if (!$isTeacherPage) {
    header('location: /');
}
?>

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
                        <p class="title">Add Class</p>
                        <form role="form" onsubmit="createClass();
                                return false;">
                            <div class="form-group">
                                <label for="className">Name:</label>
                                <input class="form-control" type="text" id="className" required>
                                <p style="margin-top: 5px;"><span class=" glyphicon glyphicon-info-sign" style="color: firebrick;"></span> Once you create a class it cannot be renamed.</p>
                            </div>
                            <div class="form-group">
                                <label for="classDescription">Description:</label>
                                <textarea rows="3" class="form-control" type="text" id="classDescription" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-lg btn-default">Create Class</button>
                        </form>
                        <br />
                    </div>
                    <!-- end main content -->
                </div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
            </div>
        </div>
        <script type="text/javascript">

                            function createClassURL(className) {
                                var classURL = className.toLowerCase().replace(/ /g, "-");
                                return classURL;
                            }

                            function createClass() {
                                $.ajax({
                                    url: '/ajax/create-class-submit.php',
                                    type: 'POST',
                                    data: {
                                        className: $("#className").val(),
                                        classURL: createClassURL($("#className").val()),
                                        classDescription: $("#classDescription").val()
                                    },
                                    success: function(response) {
                                        if (response.indexOf("200") !== -1) {
                                            window.location = "/teacher/<?php echo $response['username']; ?>/class/" + createClassURL($("#className").val());
                                        } else {
                                            showMessage(response, "danger");
                                        }
                                    }
                                })
                            }
        </script>
    </body>
</html>

