<?php
include "../php/errors.php";
require "../php/idaydreamDBconnect.php";

$active = $_POST['active'];
$volID = $_POST['volID'];

if (!empty($active) AND !empty($volID)){
    $active = mysqli_real_escape_string($cnxn, strtolower($active));
    $volID = intval($volID);

    $sql = "UPDATE Volunteer
                SET active = '$active'
                WHERE volunteerID = '$volID'";
    $result = mysqli_query($cnxn, $sql);
}