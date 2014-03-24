<?php
$classUID = $classData['uid'];
require $_SERVER['DOCUMENT_ROOT'] . "/includes/get-links-for-class.php";
?>

<div class="card">
    <p class="title">Links
        <?php if ($isTeacherPage) { ?>&nbsp;
            <button onclick="$('#addLink').modal('show');" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></button>

            <button onclick="deleteAllLinks();" class="btn btn-danger"><span class="glyphicon glyphicon-minus"></span> all</button>
        <?php } ?>
    </p>
</div>

<?php while ($link = $linkQuery->fetch(PDO::FETCH_ASSOC)) { ?>

    <div class="card link-card" id="<?= $link['uid'] ?>">
        <a name="<?= $link['uid'] ?>"></a>
        <h4><?= $link['title'] ?> <a target="_blank" href="<?= $link['url'] ?>"><span class="glyphicon glyphicon-link"></span></a>
            <?php if ($isTeacherPage) { ?>
                <button class="btn btn-warning" style="float: right;<?php if (empty($link['description'])) echo 'margin-top: -6px;' ?>" onclick="deleteLink($(this).closest('div').attr('id'), true)"><span class="glyphicon glyphicon-minus"></span></button>
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
                
                function deleteAllLinks() {
                    if (!confirm("Are you sure you want to delete all links?")) {
                        return;
                    }
                    $(".link-card").each(function() {
                        deleteLink($(this).attr("id"), false);
                    });
                    loadPageWithMessage('./links', 'Links deleted successfully.', 'success');
                }

                function deleteLink(id, needsConfirm) {
                    if (needsConfirm) {
                        if (!confirm("Are you sure you want to delete this link?")) {
                            return;
                        }
                    }
                    $.ajax({
                        url: '/ajax/delete-link.php',
                        type: "POST",
                        data: {
                            'linkId': id
                        },
                        success: function(response) {
                            if (needsConfirm) {
                                if (response.indexOf("200") === -1) {
                                    showMessage(response, 'danger');
                                } else {
                                    loadPageWithMessage('./links', 'Link deleted successfully.', 'success');
                                }
                            }
                        }
                    });
                }
</script>