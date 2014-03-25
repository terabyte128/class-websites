<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/get-teacher-from-database.php'; ?>
<?php if(!isset($_SESSION['username'])) {
    header('location: /');
}

/**
 * Allows teachers to update preferences through calls to php files via ajax.
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
        <title>Transfusion - Preferences</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/teacherhome-header.php'; ?>                    
                <div class="page-content">
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/messages.php'; ?>
                    <div class="card">
                        <p class='title'><strong>Teacher Preferences</strong></p>
                        <form>
                            <p style="font-size: 16px;">Class preferences:</p>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="publicEmail" onclick="updateCheckbox('show_email')"> Allow students to view your email address and send you emails
                                    <span id="publicEmailSaving" style="display: none; color: #47a447;">&mdash; <span id="publicEmailSavingText">updating...</span></span>
                                </label>
                            </div>
                            <!--<div class="checkbox">
                                <label>
                                    <input type="checkbox" id="deleteAssignmentsAfterDue"> Delete assignments 5 days after their due date
                                </label>
                            </div>-->
                            <hr>
                            <p style="font-size: 16px;">Personal information (click blue text to edit):</p>
                            <div class="form-group">
                                <label for="firstName">First name:</label>
                                <a class="editable" href="#" id="first_name" data-pk="firstName"><?php echo $_SESSION['firstName']; ?></a>
                                <br />
                                <label for="lastName">Last name:</label>
                                <a class="editable" href="#" id="last_name" data-pk="lastName"><?php echo $_SESSION['lastName']; ?></a>
                                <br />
                                <label for="email">Email address:</label>
                                <a class="editable" href="#" id="email" data-pk="undefined" data-type="email"><?php echo $response['email']; ?></a>
                            </div>
                        </form>
                    </div>
                </div>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
            </div>
        </div>
        <script type="text/javascript">
                                        $(function() {
                                            // allow text to be editable, update database dynamically
                                            $(".editable").editable({
                                                pk: '<?php echo $_SESSION["username"]; ?>',
                                                url: '/ajax/update-preferences.php',
                                                success: function(response) {
                                                    if (response.indexOf("200 Success") === -1) {
                                                        showMessage(response, "danger");
                                                    }
                                                }
                                            });

                                            //check if true/false is true; update checkbox accordingly
                                            if (<?php echo $response['show_email']; ?> === 1) {
                                                $("#publicEmail").attr("checked", "true");
                                                checked = true;
                                            } else {
                                                checked = false;
                                            }
                                        });

                                        //track if the checkbox is checked
                                        var checked;

                                        //update database from checkbox
                                        function updateCheckbox(column) {
                                            checked = !checked;
                                            $("#publicEmailSaving").fadeIn(800);
                                            $.ajax({
                                                type: "POST",
                                                url: "/ajax/update-preferences.php",
                                                data: {
                                                    'pk': column,
                                                    'name': column,
                                                    'value': checked ? 1 : 0
                                                },
                                                success: function(response) {
                                                    if (response.indexOf("200 Success") === -1) {
                                                        showMessage(response, "danger");
                                                    }
                                                    $("#publicEmailSaving").fadeOut(800);
                                                }
                                            });
                                        }
        </script>
    </body>
</html>
