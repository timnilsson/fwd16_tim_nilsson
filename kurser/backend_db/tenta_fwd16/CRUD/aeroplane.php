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
        
        <a href="aeroplaneAdd.php">Add new aeroplane</a>
        <span> | </span>
        <a href="aeroplaneMakerAdd.php">Add new aeroplane maker</a>
        </br>
        <a href="logout.php">Log out</a>
        
        <table>
            <tr class="hl">
                <td>Maker name</td>
                <td>Aeroplane</td>
                <td>Top speed</td>
                <td>Range</td>
                <td>Update</td>
            </tr>
            
            <?php 
                $sqlQuery = $pdo->query("CALL sp_aeroplane");
                
                while ($row=$sqlQuery->fetch()) {
                    echo "<tr>";
                        echo "<td>" . $row['planeMakerName'] . "</td>";
                        echo "<td>" . $row['aeroplaneName'] . "</td>";
                        echo "<td>" . $row['aeroplaneTopSpeed'] . "</td>";
                        echo "<td>" . $row['aeroplaneRange'] . "</td>";
                        echo "<td><a href=\"aeroplaneEdit.php?aeroplaneID=$row[aeroplaneID]\">Edit</a> | <a href=\"aeroplaneDelete.php?aeroplaneID=$row[aeroplaneID]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </body>
</html>
