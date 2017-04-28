<?php

include_once 'config.php';

session_start();
if (empty($_SESSION['email'])) {
    header("location: index.php");
} else {
    echo "Welcome " . $_SESSION['name'];
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
        <span> | </span>
        <a href="aeroplaneMakerAdd.php">Add new aeroplane maker</a>
        </br>
        <a href="logout.php">Log out</a>
        
        <table>
            <tr class="hl">
                <td>Maker name</td>
                <td>Update</td>
            </tr>
            
            <?php 
                $sqlQuery = $pdo->query("SELECT * FROM plane_maker");
                
                while ($row=$sqlQuery->fetch()) {
                    echo "<tr>";
                        echo "<td>" . $row['planeMakerName'] . "</td>";
                        echo "<td><a href=\"aeroplaneMakerEdit.php?planeMakerID=$row[planeMakerID]\">Edit</a> | <a href=\"aeroplaneMakerDelete.php?planeMakerID=$row[planeMakerID]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </body>
</html>
