<!DOCTYPE html>
<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.min.js"></script>
        <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.css">
        <title>Assignments</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/class-header.php'; ?>                    
                <div class="page-content">
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/messages.php'; ?>                    
                    <!-- main content goes here -->
                    <div class="card" id='assign1'>
                        <h4>Sample Assignment &mdash; 20 pts</h4>
                        <p class="description">A cool thing that does stuff and decodes the meaning of life.</p>
                        <p><strong>Homework &mdash; Due February 3</strong></p>
                    </div>
                    <div class="card">
                        <h4>Another Assignment &mdash; 50 pts</h4>
                        <p class="description">
                            Oh my. This assignment is worth a lot indeed. If I were you I'd get started on it right 
                            away so that you don't turn it in late - each day is 20% off!
                        </p>
                        <p><strong>Homework &mdash; Due February 17</strong></p>
                    </div>      
                    <div class="card">
                        <h4>Yet Another Assignment &mdash; 5 pts</h4>
                        <p class="description">
                            Wow. This assignment has quite the description! Luckily it's not worth that much so I wouldn't
                            prioritize it if I were you. There are more important things in life, like watching butterflies,
                            exploring, going on adventures, or finding love. I'd say that this is therefore a pretty low
                            priority. 
                        </p>
                        <p><strong>Homework &mdash; Due February 23</strong></p>
                    </div>      
                    <!-- end main content -->
                </div>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
            </div>
        </div>
        <script type="text/javascript">
            $(function() {
                $("#assignmentsTab").addClass("active");
                $("#filesTab").removeClass("active");
                $("#calendarTab").removeClass("active");
            });
        </script>
    </body>
</html>
