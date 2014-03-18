<div class="card">
    <p class="title">Assignments 
        <?php if ($isTeacherPage) { ?>
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
                <form role="form" id="loginForm" onsubmit="addClass();
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

</script>