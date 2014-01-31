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
                        <form role="form" onsubmit='createAccount(); return false;'>
                            <div class="form-group">
                                <label for="firstName">First name</label>
                                <input id="firstName" class="form-control" onkeyup="updateUsername();" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="middleInitial">Middle initial</label>
                                <input id="middleInitial" class="form-control" onkeyup="updateUsername();" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last name</label>
                                <input id="lastName" class="form-control" onkeyup="updateUsername();" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="emailAddress">Email address</label>
                                <input id="emailAddress" type="email" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="school">School</label>
                                <input id="school" class="form-control" onkeyup="updateUsername();" placeholder="" required>
                            </div>
                            <div style="display: none;" id="usernameWrapper">
                                <p>
                                    Your username will be:
                                    <br />
                                    <span id="username" style="font-weight: bold; font-size: 24px;"></span>
                                    <br />
                                    You will use this whenever you log in.
                                </p>
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
                                    function updateUsername() {
                                        if (!$("#usernameWrapper").is(":visible")
                                                && $("#firstName").val() !== ""
                                                && $("#middleInitial").val() !== ""
                                                && $("#lastName").val() !== ""
                                                && $("#school").val() !== ""
                                                ) {
                                            $("#usernameWrapper").show(100);
                                        }
                                        var username = "";
                                        username += $("#school").val().substr(0, 3).toLowerCase();
                                        username += "-";
                                        username += $("#firstName").val().substr(0, 1).toLowerCase();
                                        username += $("#middleInitial").val().substr(0, 1).toLowerCase();
                                        username += $("#lastName").val().toLowerCase();

                                        $("#username").text(username);

                                        return username;
                                    }

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
                                                'username': updateUsername(),
                                                'password': $("#password").val(),
                                                'email': $("#emailAddress").val()
                                            },
                                            'success': function(text) {
                                                loadPageWithMessage("/index.php", text, "success");
                                            }
                                        });
                                    }
        </script>
    </body>
</html>
