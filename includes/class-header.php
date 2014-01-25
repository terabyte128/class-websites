<div>
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo $_GET['teacher'] . " > " . $_GET['class']; ?></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li id="homeTab"><a href="#home">Home</a></li>
                <li id="assignmentsTab"><a href="#assignments">Assignments</a></li>
                <li id="filesTab"><a href="#files">Files</a></li>
                <li id="calendarTab"><a href="#calendar">Calendar</a></li>
            </ul>
        </div>
    </nav>
</div>