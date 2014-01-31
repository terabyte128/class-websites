<div>
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo $response['first_name'] . " " . $response['last_name'];?></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php if($isTeacherPage && $isLoggedIn) { ?>
            <ul class="nav navbar-nav">
                <li id="preferencePane"><a href="/preferences">Preferences</a></li>
            </ul>
            <?php } ?>
            
        </div>
    </nav>
</div>