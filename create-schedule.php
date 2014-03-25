<!--
allows students to create schedules consisting of multiple classes
-->

<!DOCTYPE html>
<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
        <title>Transfusion - Create Schedule</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
                <div class="page-content">
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/messages.php'; ?>
                    <div class="card">
                        <p class="title">Create a schedule</p>
                        <form onsubmit="return false;">
                            <label for="teacherSearch">Search for your teacher:</label>
                            <input type="text" class="form-control" id="teacherSearch" onkeyup="search();">
                        </form>
                        <br />
                        <label>Click on classes you'd like to include in your schedule:</label>
                        <ul id="teacherList">

                        </ul>
                        <form onsubmit="return false;">
                            <label for="url">Copy the URL:</label>
                            <input onclick="this.select();" type="text" id="url" class="form-control">
                        </form>
                        <br />
                        <label>Paste it into your address bar to access your schedule.</label>
                        <br />
                    </div>

                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
                </div>
            </div>
        </div>
        <script type='text/javascript'>

                            $(function() {
                                $("#url").val("http://" + window.location.hostname + "/schedule/");
                            });
                            var parsed;
                            function search() {
                                var query = $("#teacherSearch").val();

                                $.ajax({
                                    url: '/ajax/search-for-teacher.php',
                                    type: "POST",
                                    data: {
                                        'query': query
                                    },
                                    success: function(response) {
                                        $("#teacherList").html("");

                                        parsed = JSON.parse(response);
                                        $.each(parsed, function() {
                                            $("#teacherList").append('<li>' + this.first_name + " " + this.last_name + "</li>");
                                            $.each(this.classes, function() {
                                                $("#teacherList").append('<li style="margin-left: 20px;"><a href="#" onclick="add(' + this.uid + ');">' + this.name + "</a></li>");
                                            });
                                        });
                                    }
                                })
                            }


                            function add(id) {
                                console.log(id);
                                if ($("#url").val().match("/$")) {
                                    $("#url").val($("#url").val() + id);
                                } else {
                                    $("#url").val($("#url").val() + "-" + id);
                                }
                            }
        </script>
    </body>
</html>
