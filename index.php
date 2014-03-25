<?php
/**
 * Homepage
 */

session_start();

if (isset($_SESSION['firstName'])) {
    $isLoggedIn = true;
} else {
    $isLoggedIn = false;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
        <title>Transfusion - Home</title>
        <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha1.js"></script>

    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
                <div class="page-content">
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/messages.php'; ?>
                    <div id="students" class='card'>
                        <p class='title'><strong>For students:</strong></p>
                        <form role="form" class='form-inline' onsubmit="search($('#teacherSearch').val());
                                return false;">
                            <p>Search for your teacher by name:</p>
                            <div class="form-group">
                                <label for="teacherSearch" class='sr-only'>Search for your teacher by name:</label>
                                <input id="teacherSearch" class="form-control" placeholder="" value="<?php if (isset($query)) echo $query; ?>">
                            </div>
                            <div class='form-group'>
                                <button type="submit" class="btn btn-default">Search</button>
                            </div>
                            <br />
                            <br />
                            <a href="/schedule/create">Create a schedule</a>
                        </form>
                        <br />
                    </div>
                    <?php if (!$isLoggedIn) { ?>
                        <div id="teachers" class='card'>
                            <p class='title'><strong>For teachers:</strong></p>
                            <a href="#" onclick="$('#loginModal').modal('show');">Login</a>
                            <br />
                            <a href="/create">Create an account</a>
                            <br />
                            <a href="/what">What is <strong>transfusion</strong>?</a>
                        </div>
                    <?php } ?>
                </div>
                <div class='card'>
                    <a href='/credits'>Credits</a>
                </div>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
            </div>
        </div>
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="loginTitle">Teacher Login</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="loginForm" onsubmit="getSalt();
                                return false;">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" id="username" class="form-control" required>
                            </div>      
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" class="form-control" required>
                            </div>  
                            <button type="submit" id="loginButton" class="btn btn-default btn-success">Login</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <script type="text/javascript">
                            function search(query) {
                                if (query !== "") {
                                    hideMessage();
                                    window.location = "/search/" + query;
                                } else {
                                    showMessage("Please enter a query.", "warning");
                                }
                            }

                            $(function() {
                                $("#loginModal").modal({
                                    show: false
                                });
                            });

                            $("#loginModal").on("shown.bs.modal", function() {
                                $("#username").focus();
                            });


                            function getSalt() {

                                var username = $("#username").val();

                                $.ajax({
                                    url: "ajax/get-salt.php",
                                    type: "POST",
                                    data: {
                                        'username': username
                                    },
                                    success: function(response) {
                                        if (response.indexOf("USER_NOT_FOUND") === -1) {
                                            login(response);
                                        } else {
                                            $("#loginTitle").css("color", "red");
                                            $("#loginTitle").text("Your username or password are incorrect!");
                                        }
                                    }
                                });
                            }

                            function login(salt) {
                                $("#loginButton").button('loading');

                                var username = $("#username").val();
                                var password = $("#password").val();

                                var hashedPassword = CryptoJS.SHA1(password + salt)

                                $.ajax({
                                    url: "ajax/login-submit.php",
                                    type: "POST",
                                    data: {
                                        'username': username,
                                        'password': hashedPassword.toString()
                                    },
                                    success: function(response) {
                                        if (response === "200 Success") {
                                            window.location = "/teacher/" + username;
                                        } else {
                                            $("#loginTitle").css("color", "red");
                                            $("#loginTitle").text(response);
                                            $("#loginButton").button('reset');
                                        }
                                    }
                                });
                            }
        </script>
    </body>
</html>
