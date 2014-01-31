<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/check-session.php'; ?>
<?php
# connect to database to pull in previous preferences
# pull in the constants file and the file that creates the database object
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/constants.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db-connect.php";

# prepare the database for a query
$stmt = $db->prepare("SELECT * FROM " . TEACHER_LOGIN_TABLE . " WHERE `username`=?");
try {
    # pull values from the database
    $stmt->execute(array($_SESSION['username']));
    $response = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = $e->getMessage();
    # otherwise, something went wrong
    echo "Failed to get preferences: " . $message;
}
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
                url: 'ajax/update-preferences.php',
                success: function(response) {
                    if (response !== "200 Success") {
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
                url: "ajax/update-preferences.php",
                data: {
                    'pk': column,
                    'name': column,
                    'value': checked ? 1 : 0
                },
                success: function(response) {
                    if (response !== "200 Success") {
                        showMessage(response, "danger");
                    }
                    $("#publicEmailSaving").fadeOut(800);
                }
            });
        }
        </script>
    </body>
</html>
