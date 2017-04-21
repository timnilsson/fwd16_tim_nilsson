<?php 

    // Include the config file
    include_once("config.php");

    // Define wich row that has been targeted
    $gameID = $_GET['gameID'];

    // SQL statement to delete a row from the database table. Using the placeholer :gameID
    $sqlStatement = "DELETE FROM game WHERE gameID=:gameID";
    $sqlQuery = $pdo->prepare($sqlStatement);
    // Define that the placeholder :gameID should be the variable $gameID
    $sqlQuery->bindparam(':gameID', $gameID);
    // Execute the SQl statement
    $sqlQuery->execute();

    // Go back to the index file
    header("Location:index.php");
?>

