<div>
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/teacher/<?php echo $_GET['teacher']; ?>">
                    <?php echo $response['first_name'] . " " . $response['last_name']; ?>
                > 
                <?php echo $classData['class_name']; ?>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li id="homeTab"><a href="/teacher/<?php echo $_GET['teacher']; ?>/class/<?php echo $_GET['class']; ?>">Home</a></li>
                <li id="assignmentsTab"><a href="/teacher/<?php echo $_GET['teacher']; ?>/class/<?php echo $_GET['class']; ?>/assignments">Assignments</a></li>
                <li id="linksTab"><a href="/teacher/<?php echo $_GET['teacher']; ?>/class/<?php echo $_GET['class']; ?>/links">Links</a></li>
                <li id="calendarTab"><a href="/teacher/<?php echo $_GET['teacher']; ?>/class/<?php echo $_GET['class']; ?>/calendar">Calendar</a></li>
            </ul>
        </div>
    </nav>
</div>