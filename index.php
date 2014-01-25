<!DOCTYPE html>
<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
        <title>Transfusion - Home</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
                <div class="page-content">
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/messages.php'; ?>
                    <br />
                    <div id="students" class='card'>
                        <p class='title'><strong>For students:</strong></p>
                        <form role="form">
                            <div class="form-group">
                                <label for="teacherSearch">Search for your teacher by last name to find information about your class</label>
                                <input id="teacherSearch" class="form-control" placeholder="last name">
                            </div>
                            <button type="submit" class="btn btn-default">Search</button>
                        </form>
                    </div>
                    <br />
                    <div id="teachers" class='card'>
                        <p class='title'><strong>For teachers:</strong></p>
                        <a href="#" onclick="$('#loginModal').modal('show');">Login</a>
                        <br />
                        <a href="/create.php">Create an account</a>
                        <br />
                        <a href="#">What is <strong>transfusion</strong>?</a>
                    </div>
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
                        <form role="form" id="loginForm" onsubmit="login();
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
                            $(function() {
                                $("#loginModal").modal({
                                    show: false
                                });
                            });

                            $("#loginModal").on("shown.bs.modal", function() {
                                $("#username").focus();
                            });

                            function login() {
                                var username = $("#username").val();
                                var password = $("#password").val();

                                $.ajax({
                                    url: "ajax/login-submit.php",
                                    type: "POST",
                                    data: {
                                        'username': username,
                                        'password': password
                                    },
                                    success: function(response) {
                                        if (response === "200 Success") {
                                            window.location = "/teacher/" + username;
                                        } else {
                                            $("#loginTitle").css("color", "red");
                                            $("#loginTitle").text(response);
                                        }
                                    }
                                });
                            }
        </script>
    </body>
</html>
