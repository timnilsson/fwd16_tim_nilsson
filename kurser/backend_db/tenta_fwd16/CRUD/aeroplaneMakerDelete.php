<?php

include_once 'config.php';

session_start();
if (empty($_SESSION['email'])) {
    header("location: index.php");
} else {
    $planeMakerID = $_GET['planeMakerID'];

    $sqlStatement = "DELETE FROM plane_maker WHERE planeMakerID=:planeMakerID";
    $sqlQuery = $pdo->prepare($sqlStatement);
    $sqlQuery->bindparam(':planeMakerID', $planeMakerID);
    $sqlQuery->execute();

    header("Location:aeroplaneMaker.php");
}