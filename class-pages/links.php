<!--

This file pulls in a database query and builds a list of links from it
using PHP within HTML

-->
    
<?php
$classUID = $classData['uid'];
require $_SERVER['DOCUMENT_ROOT'] . "/includes/get-links-for-class.php";
?>

<div class="card">
    <p class="title">Links
        <?php if ($isTeacherPage) { ?>&nbsp;
            <button onclick="$('#addLink').modal('show');" class="btn btn-success">Add</button>

            <button id="deleteAllButton" class="btn btn-danger">Delete all</button>
        <?php } ?>
    </p>
</div>

<?php while ($link = $linkQuery->fetch(PDO::FETCH_ASSOC)) { ?>

    <div class="card link-card" id="<?= $link['uid'] ?>">
        <a name="<?= $link['uid'] ?>"></a>
        <h4><?= $link['title'] ?> <a target="_blank" href="<?= $link['url'] ?>"><span class="glyphicon glyphicon-link"></span></a>
            <?php if ($isTeacherPage) { ?>
                <button class="btn btn-warning btn-delete-link" style="float: right;<?php if (empty($link['description'])) echo 'margin-top: -6px;' ?>" >Delete</button>
            <?php } ?>
        </h4>

        <p class="description">
            <?= $link['description'] ?>
        </p>
    </div>   

<?php } ?>

<div class="modal fade" id="addLink" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="addTitle">Add New Link</h4>
            </div>
            <div class="modal-body">
                <!-- name, value, category, due date -->
                <form role="form" id="linkForm" onsubmit="addLink();
                    return false;">
                    <div class="form-group">
                        <label for="linkName">Link Name:</label>
                        <input type="text" id="linkName" class="form-control" required>
                    </div>  
                    <div class="form-group">
                        <label for="linkURL">Link URL:</label>
                        <input type="url" id="linkURL" class="form-control" required>
                    </div> 
                    <div class="form-group">
                        <label for="linkDescription">Description (optional):</label>
                        <textarea id="linkDescription" class="form-control"></textarea>
                    </div>  

                    <button type="submit" id="createButton" class="btn btn-default btn-success">Create</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script type="text/javascript">
                function addLink() {
                    $("#addLink").modal("hide");

                    $.ajax({
                        url: '/ajax/add-link.php',
                        type: "POST",
                        data: {
                            'classUID': '<?= $classData['uid']; ?>',
                            'teacherUID': '<?= $classData['teacher_id']; ?>',
                            'linkName': $("#linkName").val(),
                            'linkDescription': $("#linkDescription").val(),
                            'linkURL': $("#linkURL").val()
                        },
                        success: function(response) {
                            if (response.indexOf("200") === -1) {
                                showMessage(response, 'danger');
                            } else {
                                loadPageWithMessage('./links', 'Link added successfully.', 'success');
                            }
                        }
                    })
                }
                
                $(".btn-delete-link").popover({
					title: "Are you sure?",
					content: '<button class="btn btn-danger" onclick="deleteLink($(this).closest(\'.link-card\').attr(\'id\'));">Yes</button><span> </span><button class="btn btn-default" onclick="$(\'.btn\').popover(\'hide\');">No</button>',
					placement: 'left',
					html: true
				});
                
                $("#deleteAllButton").popover({
					title: "Are you sure?",
					content: '<button class="btn btn-danger" onclick="deleteAllLinks();">Yes</button><span> </span><button class="btn btn-default" onclick="$(\'.btn\').popover(\'hide\');">No</button>',
					placement: 'left',
					html: true
				});

                function deleteAllLinks() {
                   $.ajax({
                        url: '/ajax/delete-all-links-for-class.php',
                        type: "POST",
                        data: {
                            'classId': "<?= $classUID ?>"
                        },
                        success: function(response) {
                            if (response.indexOf("200") === -1) {
                                showMessage(response, 'danger');
                            } else {
                                loadPageWithMessage('./links', 'Links deleted successfully.', 'success');
                            }
                        }
                    });
                }

                function deleteLink(id) {
                    $.ajax({
                        url: '/ajax/delete-link.php',
                        type: "POST",
                        data: {
                            'linkId': id
                        },
                        success: function(response) {
                            if (response.indexOf("200") === -1) {
                                showMessage(response, 'danger');
                        	} else {
                        		loadPageWithMessage('./links', 'Link deleted successfully.', 'success');
							}
                        }
                    });
                }
</script>