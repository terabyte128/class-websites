<!DOCTYPE html>
<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.min.js"></script>
        <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.css">
        <title>Calendar</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/class-header.php'; ?>                    
                <div class="page-content">
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/messages.php'; ?>                    
                    <!-- main content goes here -->
                    <div id="calendar" class='card'></div>

                    <!-- end main content -->
                </div>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
            </div>
        </div>
        <script type="text/javascript">
            $(function() {

                var events = [{
                        title: 'Test Event',
                        start: "2014-1-21",
                        allDay: true
                    },
                    {
                        title: 'Another Event',
                        start: "2014-1-22",
                        allDay: true
                    }

                ]

                $("#calendar").fullCalendar({
                    events: events
                });
                
                $("#assignmentsTab").removeClass("active");
                $("#filesTab").removeClass("active");
                $("#calendarTab").addClass("active");

            });
        </script>
    </body>
</html>
