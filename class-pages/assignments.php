<!--

This file pulls in a database query and builds a list of assignments from it
using PHP within HTML

-->


<?php
if (!isset($assnQuery)) {
    $classUID = $classData['uid'];
    require $_SERVER['DOCUMENT_ROOT'] . "/includes/get-assignments-for-class.php";
    $schedule = true;
}

if (!isset($isTeacherPage)) {
    $isTeacherPage = false;
}
?>

<div class="card">
    <p class="title">Assignments 
        <?php if ($isTeacherPage) { ?>&nbsp;
            <button onclick="$('#addAssignment').modal('show');" class="btn btn-success">Add</button>

            <button onclick="deleteAllAssignments();" class="btn btn-danger">Delete all</button>
        <?php } ?>
        <button id="toggleExpired" onclick="$('.expired').slideToggle(200);
                $(this).text() === 'Show expired' ? $(this).text('Hide expired') : $(this).text('Show expired');
                return false;" class="btn btn-default">Show expired</button>
    </p>
</div>

<?php foreach ($rows as $assignment) { ?>

    <div class="card assignment-card  

         <?php
         if (strtotime($assignment['expire_date']) < time() - 86400) {
             echo ' expired"';
             echo ' style="display:none; ';
         }
         ?>
         " id="<?= $assignment['uid'] ?>">
        <a name="<?= $assignment['uid'] ?>"></a>
        <h4><?= $assignment['title'] ?> &mdash; <?= $assignment['value'] ?> pts 
            <?php if ($isTeacherPage) { ?>
                <button class="btn btn-warning btn-delete-assignment" style="float: right;">Delete</button>
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

<?php if ($isTeacherPage) { ?>
                var categories = ["Homework", "Classwork", "Test", "Lab Report"];

                $("#assignCategory").typeahead({
                    local: categories
                });

                $("#dueDate").datepicker({
                    format: "yyyy-mm-dd"
                });

				$(".btn-delete-assignment").popover({
					title: "Are you sure?",
					content: '<button class="btn btn-danger" onclick="deleteAssignment($(this).closest(\'.assignment-card\').attr(\'id\'));">Yes</button><span> </span><button class="btn btn-default" onclick="$(\'.btn\').popover(\'hide\');">No</button>',
					placement: 'left',
					html: true
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

                function deleteAssignment(id) {
                    $.ajax({
                        url: '/ajax/delete-assignment.php',
                        type: "POST",
                        data: {
                            'assignmentId': id
                        },
                        success: function(response) {
                            if (response.indexOf("200") === -1) {
                                showMessage(response, 'danger');
                            } else {
                                loadPageWithMessage('./assignments', 'Assignment deleted successfully.', 'success');
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

<?php } ?>
</script>