<?php
include '../Controller/eventC.php';
$eventC = new eventC();
$eventC->deleteevent($_GET["event_id"]);
header('Location:indexx.php');
