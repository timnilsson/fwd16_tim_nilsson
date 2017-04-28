<?php

include_once 'config.php';

session_start();
if (empty($_SESSION['email'])) {
    header("location: index.php");
} else {
    $aeroplaneID = $_GET['aeroplaneID'];
    
    $sqlStatement = "SELECT * FROM aeroplane JOIN plane_maker ON aeroplane.planeMakerID = plane_maker.planeMakerID WHERE aeroplaneID=:aeroplaneID";
    $sqlQuery = $pdo->prepare($sqlStatement);
    $sqlQuery->bindParam(':aeroplaneID', $aeroplaneID);
    $sqlQuery->execute();
    
    $row = $sqlQuery->fetch();
    //$aeroplaneName = $row['aeroplaneName'];
    //$aeroplaneSpeed = $row['aeroplaneTopSpeed'];
    //$aeroplaneRange = $row['aeroplaneRange'];
    $planeMaker = $row['planeMakerID'];
    
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
            $sqlStatement = "UPDATE aeroplane SET aeroplaneName = :aeroplaneName, aeroplaneTopSpeed = :aeroplaneSpeed, aeroplaneRange = :aeroplaneRange, planeMakerID = :planeMakerID WHERE aeroplaneID = :aeroplaneID";
            $sqlQuery = $pdo->prepare($sqlStatement);
            
            $sqlQuery->bindParam(':aeroplaneName', $aeroplaneName);
            $sqlQuery->bindParam(':aeroplaneSpeed', $aeroplaneSpeed);
            $sqlQuery->bindParam(':aeroplaneRange', $aeroplaneRange);
            $sqlQuery->bindParam(':planeMakerID', $planeMakerID);
            $sqlQuery->bindParam(':aeroplaneID', $aeroplaneID);
            
            $sqlQuery->execute();
            
            header("Location: aeroplane.php");
        }
    }
    
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit aeroplane</title>
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        
        <a href="aeroplane.php">Home</a>
        </br>
        <a href="logout.php">Log out</a>
        
        <form method="post">
            <input type="text" name="name" value="<?php echo $row['aeroplaneName'] ?>"><br>
            <input type="text" name="speed" value="<?php echo $row['aeroplaneTopSpeed'] ?>"><br>
            <input type="text" name="range" value="<?php echo $row['aeroplaneRange'] ?>"><br>
            
            <select name="aeroplanemakers">
                <?php 
                    
                    $sqlStatement = "SELECT * FROM plane_maker";
                    $sqlQuery = $pdo->prepare($sqlStatement);
                    $sqlQuery->execute();
                
                    while ($row = $sqlQuery->fetch()) {
                        if ($row['planeMakerID'] == $planeMaker) {
                            echo "<option value = \"{$row['planeMakerID']}\" selected>{$row['planeMakerName']}</option>";
                        }else {
                            echo "<option value = \"{$row['planeMakerID']}\">{$row['planeMakerName']}</option>";
                        }   
                    }
                    
                    
                    
                ?>
            </select>
            </br>
            <input type="submit" name="submit" value="Submit"><br>
        </form>
        
        
    </body>
</html>

