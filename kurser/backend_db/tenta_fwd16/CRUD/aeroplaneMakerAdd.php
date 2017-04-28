<?php

include_once 'config.php';

session_start();
if (empty($_SESSION['email'])) {
    header("location: index.php");
} else {
    echo "Welcome " . $_SESSION['name'];
    
    if (isset($_POST['submit'])) {
        $planeMakerName = $_POST['name'];
        
        if (empty($planeMakerName)) {
            echo '<p class="fail">Aeroplane maker field is empty</p>';
        }else {
            $sqlStatement = "INSERT INTO plane_maker(planeMakerName) VALUES(:planeMakerName)";
            $sqlQuery = $pdo->prepare($sqlStatement);
            $sqlQuery->bindParam(':planeMakerName', $planeMakerName);
            $sqlQuery->execute();
            
            echo '<p class="succes">Aeroplane maker added<p>';
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Table-summary</title>
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        </br>
        <a href="aeroplane.php">Home</a>
        <span> | </span>
        <a href="aeroplaneMaker.php">Back</a>
        </br>
        <a href="logout.php">Log out</a>
        
        <form method="post">
            <input type="text" name="name" placeholder="Aeroplane maker"></br>
            </br>
            <input type="submit" name="submit" value="Submit"><br>
        </form>
    </body>
</html>

