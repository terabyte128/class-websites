<div class="card">
    <p class="title"><?php echo $classData['class_name']; ?></p>
    <?php if ($isLoggedIn && $isTeacherPage) { ?>
        <a href="#" id="class_description" class="editable" data-type="textarea"><?php echo $classData['class_description']; ?></a>
        <br /><br />
    <?php } else { ?>
        <p style="white-space: pre-wrap;" id="class_description"><?php echo $classData['class_description']; ?></p>
    <?php } ?>
</div>

<script type="text/javascript">
    $(".editable").editable({
        mode: 'inline',
        pk: '<?php echo $classURL; ?>',
        url: '/ajax/update-class-description.php',
        success: function(response) {
            if (response.indexOf("200 Success") === -1) {
                showMessage(response, "danger");
            }
        }
    });
</script>