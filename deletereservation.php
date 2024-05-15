<?php
include '../Controller/reservationC.php';
$eventC = new ReservationC();
$p=null;
$p=$_GET["reservation_id"];
$eventC->deletereservation($p);
header('Location:dashh.php');
?>
