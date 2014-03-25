<!--
form for teachers to create an account
-->

<!DOCTYPE html>
<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
        <title>Transfusion - Create Account</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
                <div class="page-content">
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/messages.php'; ?>
                    <div class='card'>
                        <p class='title'><strong>Create a teacher account</strong></p>
                        <form role="form" onsubmit='createAccount();
                                return false;'>
                            <div class="form-group">
                                <label for="firstName">First name</label>
                                <input id="firstName" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last name</label>
                                <input id="lastName" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="emailAddress">Email address</label>
                                <input id="emailAddress" type="email" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="school">School</label>
                                <input id="school" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="retypePassword">Retype password</label>
                                <input type="password" id="retypePassword" class="form-control" placeholder="" required>
                            </div>
                            <button type="submit" class="btn btn-default">Create account and login</button>
                            <br />
                            <br />
                        </form>
                    </div>
                </div>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
            </div>
        </div>
        <script type="text/javascript">


                            function createAccount() {
                                if ($("#password").val() !== $("#retypePassword").val()) {
                                    showMessage("Your passwords did not match, please try again.", "danger");
                                    $("#password").val("");
                                    $("#retypePassword").val("");
                                    $("#password").focus();
                                    return;
                                }

                                hideMessage();
                                $.ajax({
                                    'url': 'ajax/create-account-submit.php',
                                    'type': 'POST',
                                    'data': {
                                        'firstName': $("#firstName").val(),
                                        'lastName': $("#lastName").val(),
                                        'school': $("#school").val(),
                                        'username': $("#username").val(),
                                        'password': $("#password").val(),
                                        'email': $("#emailAddress").val()
                                    },
                                    'success': function(text) {
                                        if (text.indexOf("successfully") === -1) {
                                            showMessage(text, "danger");
                                        } else {
                                            loadPageWithMessage("/index.php", text, "success");
                                        }
                                    }
                                });
                            }
        </script>
    </body>
</html>
