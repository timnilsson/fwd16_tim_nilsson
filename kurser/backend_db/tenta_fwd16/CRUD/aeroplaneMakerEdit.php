<?php

include_once 'config.php';

session_start();
if (empty($_SESSION['email'])) {
    header("location: index.php");
} else {
    $planeMakerID = $_GET['planeMakerID'];
    
    $sqlStatement = "SELECT * FROM plane_maker WHERE planeMakerID=:planeMakerID";
    $sqlQuery = $pdo->prepare($sqlStatement);
    $sqlQuery->bindParam(':planeMakerID', $planeMakerID);
    $sqlQuery->execute();
    
    $row = $sqlQuery->fetch();
    
    //$planeMaker = $row['planeMakerID'];
    
    if (isset($_POST['submit'])) {
        $planeMakerName = $_POST['name'];
        
        if (empty($planeMakerName)) {
            echo '<p class="fail">Aeroplane maker field is empty</p>';
        }else {
            $sqlStatement = "UPDATE plane_maker SET planeMakerName = :planeMakerName WHERE planeMakerID = :planeMakerID";
            $sqlQuery = $pdo->prepare($sqlStatement);
            
            $sqlQuery->bindParam(':planeMakerName', $planeMakerName);
            $sqlQuery->bindParam(':planeMakerID', $planeMakerID);
            
            $sqlQuery->execute();
            
            header("Location: aeroplaneMaker.php");
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
            <input type="text" name="name" value="<?php echo $row['planeMakerName'] ?>"><br>
            
            </br>
            <input type="submit" name="submit" value="Submit"><br>
        </form>
        
    </body>
</html>

