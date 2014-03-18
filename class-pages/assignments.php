<div class="card">
    <p class="title">Assignments 
        <?php if ($isTeacherPage) { ?>&nbsp;
            <button onclick="$('#addAssignment').modal('show');" class="btn btn-default">Add new</button>
        <?php } ?>
    </p>
</div>
<div class="modal fade" id="addAssignment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="addTitle">Add New Assignment</h4>
            </div>
            <div class="modal-body">
                <!-- name, value, category, due date -->
                <form role="form" id="loginForm" onsubmit="addClass();
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
                        <label for="assignDescription">Description:</label>
                        <textarea id="assignDescription" class="form-control"></textarea>
                    </div>  
                    <button type="submit" id="createButton" class="btn btn-default btn-success">Create</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script type="text/javascript">
            var categories = ["Homework", "Classwork", "Test", "Lab Report"];

            $("#assignCategory").typeahead({
                local: categories
            });
</script>