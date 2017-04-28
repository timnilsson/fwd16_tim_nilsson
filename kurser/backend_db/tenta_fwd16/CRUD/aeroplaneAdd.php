<?php

include_once 'config.php';

session_start();
if (empty($_SESSION['email'])) {
    header("location: index.php");
} else {
    echo "Welcome " . $_SESSION['name'];
    
    if (isset($_POST['submit'])) {
        $aeroplaneName = $_POST['name'];
        $aeroplaneSpeed = $_POST['speed'];
        $aeroplaneRange = $_POST['range'];
        $planeMakerID = $_POST['aeroplanemakers'];
        
        if (empty($aeroplaneName) || empty($aeroplaneSpeed) || empty($aeroplaneRange)) {
            if (empty($aeroplaneName)) {
                echo '<p class="fail">Aeroplane field is empty</p>';
            }
            if (empty($aeroplaneSpeed)) {
                echo '<p class="fail">Speed field is empty</p>';
            }
            if (empty($aeroplaneRange)) {
                echo '<p class="fail">Range field is empty</p>';
            }
        }else {
            $sqlStatement = "INSERT INTO aeroplane(aeroplaneName, aeroplaneTopSpeed, aeroplaneRange, planeMakerID) VALUES(:aeroplaneName, :aeroplaneSpeed, :aeroplaneRange, :planeMakerID)";
            $sqlQuery = $pdo->prepare($sqlStatement);
            $sqlQuery->bindParam(':aeroplaneName', $aeroplaneName);
            $sqlQuery->bindParam(':aeroplaneSpeed', $aeroplaneSpeed);
            $sqlQuery->bindParam(':aeroplaneRange', $aeroplaneRange);
            $sqlQuery->bindParam(':planeMakerID', $planeMakerID);
            $sqlQuery->execute();
            
            echo '<p class="succes">Aeroplane added<p>';
            echo '<a href="aeroplane.php">View result</a>';
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
        
        <a href="aeroplane.php">Home</a>
        </br>
        <a href="logout.php">Log out</a>
        
        <form method="post">
            <input type="text" name="name" placeholder="Aeroplane name"><br>
            <input type="text" name="speed" placeholder="Aeroplane speed"><br>
            <input type="text" name="range" placeholder="Aeroplane range"><br>
            
            <select name="aeroplanemakers">
                <?php 
                    
                    $sqlStatement = "SELECT * FROM plane_maker";
                    $sqlQuery = $pdo->prepare($sqlStatement);
                    $sqlQuery->execute();
                
                    while ($row = $sqlQuery->fetch()) {
                        echo "<option value=\"{$row['planeMakerID']}\">{$row['planeMakerName']}</option>";
                    }
                    
                    
                    
                ?>
            </select>
            </br>
            <input type="submit" name="submit" value="Submit"><br>
        </form>
        
        
    </body>
</html>

