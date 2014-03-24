

<?php
$classUID = $classData['uid'];
require $_SERVER['DOCUMENT_ROOT'] . "/includes/get-assignments-for-class.php";
?>

<div class="card">
    <p class="title">Assignments 
        <?php if ($isTeacherPage) { ?>&nbsp;
            <button onclick="$('#addAssignment').modal('show');" class="btn btn-success">Add new</button>
        <?php } ?>
        <button id="toggleExpired" onclick="$('.expired').slideToggle(200);
                    $(this).text() === 'Show expired' ? $(this).text('Hide expired') : $(this).text('Show expired');
                    return false;" class="btn btn-default">Show expired</button>
                <?php if ($isTeacherPage) { ?>
            <button onclick="deleteAllAssignments();" class="btn btn-danger">Delete all</button>
        <?php } ?>
    </p>
</div>

<?php while ($assignment = $assnQuery->fetch(PDO::FETCH_ASSOC)) { ?>

    <div class="card assignment-card  

         <?php
         if (strtotime($assignment['expire_date']) < time()) {
             echo ' expired"';
             echo ' style="display:none; ';
         }
         ?>
         " id="<?= $assignment['uid'] ?>">
        <h4><?= $assignment['title'] ?> &mdash; <?= $assignment['value'] ?> pts  
            <?php if ($isTeacherPage) { ?>
                <button class="btn btn-warning" style="float: right;" onclick="deleteAssignment($(this).closest('div').attr('id'), true)">Delete</button>
            <?php } ?>
        </h4>

        <p class="description">
            <?= $assignment['description'] ?>
        </p>
        <p><strong><?= $assignment['category'] ?> &mdash; Due <?= date("F d, Y", strtotime($assignment['expire_date'])) ?></strong></p>
    </div>   

<?php } ?>

<div class="modal fade" id="addAssignment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="addTitle">Add New Assignment</h4>
            </div>
            <div class="modal-body">
                <!-- name, value, category, due date -->
                <form role="form" id="loginForm" onsubmit="addAssignment();
                    return false;">
                    <div class="form-group">
                        <label for="assignName">Assignment Name:</label>
                        <input type="text" id="assignName" class="form-control" required>
                    </div>  
                    <div class="form-group">
                        <label for="assignCategory">Category:</label>
                        <input type="text" id="assignCategory" class="form-control" required>
                    </div> 
                    <div class="form-group">
                        <label for="assignValue">Point Value:</label>
                        <input type="number" id="assignValue" class="form-control" required>
                    </div>   
                    <div class="form-group">
                        <label for="assignDescription">Description:</label>
                        <textarea id="assignDescription" class="form-control" required></textarea>
                    </div>  
                    <div class="form-group">
                        <label for="dueDate">Due Date:</label>
                        <input id="dueDate" class="form-control" required>
                    </div>  
                    <button type="submit" id="createButton" class="btn btn-default btn-success">Create</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script type="text/javascript">

                $(function() {
                    if (window.location.hash.indexOf("expired") !== -1) {
                        $("#toggleExpired").click();
                    }
                });

                var categories = ["Homework", "Classwork", "Test", "Lab Report"];

                $("#assignCategory").typeahead({
                    local: categories
                });

                $("#dueDate").datepicker({
                    format: "yyyy-mm-dd"
                });

                function deleteAllAssignments() {
                    if (!confirm("Are you sure you want to delete all assignments?")) {
                        return;
                    }
                    $(".assignment-card").each(function() {
                        deleteAssignment($(this).attr("id"), false);
                    });
                    loadPageWithMessage('./assignments', 'Assignments deleted successfully.', 'success');
                }

                function deleteAssignment(id, confirm) {
                    if (confirm) {
                        if (!confirm("Are you sure you want to delete this assignment?")) {
                            return;
                        }
                    }
                    $.ajax({
                        url: '/ajax/delete-assignment.php',
                        type: "POST",
                        data: {
                            'assignmentId': id
                        },
                        success: function(response) {
                            if (response.indexOf("200") === -1) {
                                showMessage(response, 'danger');
                                loadPageWithMessage('./assignments', 'Assignment deleted successfully.', 'success');
                                return response;
                            }
                        }
                    });
                }

                function addAssignment() {
                    $("#addAssignment").modal("hide");

                    $.ajax({
                        url: '/ajax/add-assignment.php',
                        type: "POST",
                        data: {
                            'classUID': '<?php echo $classData['uid']; ?>',
                            'teacherUID': '<?php echo $classData['teacher_id']; ?>',
                            'assignName': $("#assignName").val(),
                            'assignDescription': $("#assignDescription").val(),
                            'assignValue': $("#assignValue").val(),
                            'assignCategory': $("#assignCategory").val(),
                            'dueDate': $("#dueDate").val()
                        },
                        success: function(response) {
                            if (response.indexOf("200") === -1) {
                                showMessage(response, 'danger');
                            } else {
                                loadPageWithMessage('./assignments', 'Assignment added successfully.', 'success');
                            }
                        }
                    })
                }
</script>