<?php

include_once 'config.php';

session_start();
if (empty($_SESSION['email'])) {
    header("location: index.php");
} else {
    $aeroplaneID = $_GET['aeroplaneID'];

    $sqlStatement = "DELETE FROM aeroplane WHERE aeroplaneID=:aeroplaneID";
    $sqlQuery = $pdo->prepare($sqlStatement);
    $sqlQuery->bindparam(':aeroplaneID', $aeroplaneID);
    $sqlQuery->execute();

    header("Location:aeroplane.php");
}



