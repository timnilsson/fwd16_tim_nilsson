<!DOCTYPE html>

<?php
    // Include the config file
    include_once("config.php");
    
    // Prepare and execute an sql question to get information from the database
    $sqlStatement = "CALL sp_with_join";
    $sqlQuery = $pdo->prepare($sqlStatement);
    $sqlQuery->execute();
?>

<html>
    <head>
        <title>Game info page</title>
        <link rel="stylesheet" href="css/style.css" />
        <meta charset="UTF-8" />
    </head>
    <body>
        <header id="top">
            <h1>Game info page</h1>
            <a href="index.php">Home</a>
            <a href="add.php">+ Add new entry</a>
        </header>
        
        <main>
        <?php 
            
            // Prepare the content for each card
            $cardContent = "";
            // As long as there is another row to get from the database table
            while($row = $sqlQuery->fetch()) {
                // Define the html content for displaying the data
                $cardContent = "<div class='gamecard'>"
                                . "<header class='headinfo'>"
                                . "<span>" . $row['gameName'] . "</span>"
                                . "<a href=\"edit.php?gameID=$row[gameID]\">Edit</a>"
                                . "<a href=\"delete.php?gameID=$row[gameID]\" onClick=\"return confirm('Do you really want to delete this post? It will be gone forever!')\">Delete</a>"
                                . "</header>"
                                . "<p class='description'>" . $row['gameDescription'] . "</p>"
                                . "<div class='extrainfo'>"
                                . "<a href=\"$row[gameLink]\">STORE LINK</a>"
                                . "<span>" . $row['gameReleaseDate'] . "</span>"
                                . "<span>" . $row['gamePrice'] . "</span>"
                                . "<span>" . $row['publisherName'] . "</span>"
                                . "</div>"
                                . "</div>";
                // Print the html content
                echo $cardContent;
            }
        ?>
       
        </main>
    </body>
</html>