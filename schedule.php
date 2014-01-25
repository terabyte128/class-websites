<?php

$classIDs = $_GET['classes'];

if (preg_match("/^[0-9-]+$/", $classIDs)) {

    $classID = explode("-", $classIDs);

    print_r($classID);
} else {
    echo 'invalid characters';
}
?>
