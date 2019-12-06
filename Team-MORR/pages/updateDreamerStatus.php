<?php
include "../php/errors.php";
require "../php/idaydreamDBconnect.php";

$active = $_POST['active'];
$dreamerID = $_POST['dreamerID'];

if (!empty($active) AND !empty($dreamerID)){
    $active = mysqli_real_escape_string($cnxn, strtolower($active));
    $dreamerID = intval($dreamerID);

    $sql = "UPDATE Dreamer
                SET active = '$active'
                WHERE dreamerID = '$dreamerID'";
    $result = mysqli_query($cnxn, $sql);
}
