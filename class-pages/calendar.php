<?php
$classUID = $classData['uid'];
?>

<div>
    <div id="calendar" class='card'></div>
</div>

<style type="text/css">
    .popover {
        width: 200px;
    }
</style>

<script type="text/javascript">
    $.ajax({
        url: '/ajax/get-assignments-for-calendar.php',
        type: "POST",
        data: {
            'classUID': '<?= $classUID ?>'
        },
        success: function(response) {
            console.log(response);
            $("#calendar").fullCalendar({
                events: JSON.parse(response),
                eventMouseover: function(event) {
                    $(this).popover({
                        html: true,
                        title: '<a href="./assignments#' + event.uid + '">' + event.title + '</a>',
                        content: event.description,
                        placement: 'top'
                    })
                }
            });
        }
    });
</script>