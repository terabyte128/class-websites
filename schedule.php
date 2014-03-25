<?php
/**
 * Grabs values for all given classes and assignments and displays them
 * in one large, amalgamated page
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db-connect.php';

$classIDs = $_GET['classes'];

if (preg_match("/^[0-9-]+$/", $classIDs)) {

    $classID = explode("-", $classIDs);

    $imploded = implode(",", $classID);
} else {
    die('invalid characters');
}

try {
    $query = $db->prepare("SELECT * FROM `class` WHERE `uid` in ($imploded)");
    $query->execute(array());
} catch (PDOException $e) {
    die($e->getMessage());
}

try {
    $assnQuery = $db->prepare("SELECT * FROM `assignment` WHERE `class_id` in ($imploded)");
    $assnQuery->execute(array());
} catch (PDOException $e) {
    die($e->getMessage());
}

$events = array();


$rows = $assnQuery->fetchAll();

foreach ($rows as $value) {
    $event = array();
    $event['title'] = $value['title'];
    $event['start'] = $value['expire_date'];
    $event['allday'] = "true";
    $event['description'] = $value['description'];
    $event['uid'] = $value['uid'];
    array_push($events, $event);
}


$eventsForJS = json_encode($events);

try {
    $linkQuery = $db->prepare("SELECT * FROM `link` WHERE `class_id` in ($imploded)");
    $linkQuery->execute(array());
} catch (PDOException $e) {
    die($e->getMessage());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
        <title>Transfusion - Home</title>
        <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha1.js"></script>

    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
                <div class="page-content">
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/messages.php'; ?>
                    <div class="card">
                        <p class="title">Schedule</p>
                        <ul>
                            <?php while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                                <li>
                                    <?= $row['class_name'] ?>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>

                    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/class-pages/assignments.php'; ?>
                    <div class="card">
                        <p class="title">Calendar</p>
                    </div>
                    <div>
                        <div id="calendar" class='card'></div>
                    </div>

                    <style type="text/css">
                        .popover {
                            width: 200px;
                        }
                    </style>
                    <script type="text/javascript">
                        $("#calendar").fullCalendar({
                            events: JSON.parse('<?= $eventsForJS ?>'),
                            eventMouseover: function(event) {
                                $(this).popover({
                                    html: true,
                                    title: '<a href="#' + event.uid + '">' + event.title + '</a>',
                                    content: event.description,
                                    placement: 'top'
                                })
                            }
                        });
                    </script>
                </div>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
            </div>
        </div>
    </body>
</html>
