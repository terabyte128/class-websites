<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/get-classes-from-database.php'; ?>

<div>
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/teacher/<?php echo $usernameFromGet; ?>"><?php echo $response['first_name'] . " " . $response['last_name']; ?></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php while ($class = $classQuery->fetch(PDO::FETCH_ASSOC)) { ?>   
                <ul class="nav navbar-nav">
                    <li><a href="/teacher/<?php echo $usernameFromGet; ?>/class/<?php echo $class['class_url'] ?>"><?php echo $class['class_name'] ?></a></li>
                </ul>
            <?php } ?>
            <?php if ($isTeacherPage && $isLoggedIn) { ?>
                <ul class="nav navbar-nav">
                    <li id="preferencePane"><a href="/teacher/<?php echo $usernameFromGet; ?>/preferences">Preferences</a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li id="addClassPane"><a href="/teacher/<?php echo $usernameFromGet; ?>/add">Add Class</a></li>
                </ul>
            <?php } ?>

        </div>
    </nav>
</div>
<script type="text/javascript">

    // figure out which page we're on and update the menu accordingly by adding the "active" class
    var path = window.location.pathname;
    if (path.indexOf("preferences") !== -1) {
        $("#preferencePane").addClass("active");
    } else if (path.indexOf("add") !== -1) {
        $("#addClassPane").addClass("active");
    }
</script>