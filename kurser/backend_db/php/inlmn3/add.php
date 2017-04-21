<!doctype html>

<?php

    // Include the config file
    include_once("config.php");
    
    // Variables that will tell if all the fields has been filled in
    $gameNameEmpty = false;
    $gameDescriptionEmpty = false;
    $gameLinkEmpty = false;
    $gameReleaseDateEmpty = false;
    $gamePriceEmpty = false;
    
    // If the submit button has been clicked
    if (isset($_POST['submitNew'])) {
        // Set variables for the information recieved
        $gameName = $_POST['gameName'];
        $gameDescription = $_POST['gameDescription'];
        $gameLink = $_POST['gameLink'];
        $gameReleaseDate = $_POST['gameReleaseDate'];
        $gamePrice = $_POST['gamePrice'];
        $publisherID = $_POST['publisherID'];
        
        // If any field is empty, set the corresponding variables as true
        if (empty ($gameName) || empty ($gameDescription) || empty ($gameLink) || empty ($gameReleaseDate) || empty ($gamePrice)) {
            if (empty($gameName)) {
                $gameNameEmpty = true;
            }
            if (empty($gameDescription)) {
                $gameDescriptionEmpty = true;
            }
            if (empty($gameLink)) {
                $gameLinkEmpty = true;
            }
            if (empty($gameReleaseDate)) {
                $gameReleaseDateEmpty = true;
            }
            if (empty($gamePrice)) {
                $gamePriceEmpty = true;
            }
        } else {
            // If all the fields has been filled in
            // SQL statement to insert another row to the database table, using multiple placeholders
            $sqlStatement = "INSERT INTO game(gameName, gamePrice, gameDescription, gameLink, gameReleaseDate, publisherID) VALUES(:gameName, :gamePrice, :gameDescription, :gameLink, :gameReleaseDate, :publisherID)";
            $sqlQuery = $pdo->prepare($sqlStatement);
            // Execute the statement. The parameter is using an array to define what each placeholder should be
            $sqlQuery->execute(array(':gameName' => $gameName, ':gamePrice' => $gamePrice, ':gameDescription' => $gameDescription, ':gameLink' => $gameLink, ':gameReleaseDate' => $gameReleaseDate, ':publisherID' => $publisherID));
            // Go back to the index page
            header("Location: index.php");
        }
        
    }
    
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
        </header>
        
        <main>
            <form name="editGame" method="POST" action="add.php">
                <h3>Game Title:</h3>
                <input type="text" name="gameName" size="30"/>
                <?php if ($gameNameEmpty) {
                    // Print an error message if the field has not been filled in
                    echo "<span class='emptyfield'>* This field is required</span>";
                }
                ?>
                <h3>Game Description:</h3>
                <textarea name="gameDescription" rows="5" cols="30"></textarea>
                <?php if ($gameDescriptionEmpty) {
                    // Print an error message if the field has not been filled in
                    echo "<span class='emptyfield'>* This field is required</span>";
                }
                ?>
                <h3>Game Link:</h3>
                <input type="text" name="gameLink" size="30"/>
                <?php if ($gameLinkEmpty) {
                    // Print an error message if the field has not been filled in
                    echo "<span class='emptyfield'>* This field is required</span>";
                }
                ?>
                <h3>Game Release Date:</h3>
                <input type="text" name="gameReleaseDate" size="30"/>
                <?php if ($gameReleaseDateEmpty) {
                    // Print an error message if the field has not been filled in
                    echo "<span class='emptyfield'>* This field is required</span>";
                }
                ?>
                <h3>Game Price:</h3>
                <input type="text" name="gamePrice" size="30"/>
                <?php if ($gamePriceEmpty) {
                    // Print an error message if the field has not been filled in
                    echo "<span class='emptyfield'>* This field is required</span>";
                }
                ?>

                <h3>Game Publisher:</h3>
                <select name="publisherID">
                    <?php 
                        // SQL statement to select all the info from the publisher table
                        $sqlStatement = "SELECT * FROM publisher";
                        $sqlQuery = $pdo->prepare($sqlStatement);
                        $sqlQuery->execute();                 
                        
                        // As long as there is another row to get, place the content of that row in an option tag
                        while($row = $sqlQuery->fetch()) {                         
                                echo "<option value = \"{$row['publisherID']}\">{$row['publisherName']}</option>";                
                        }                   
                    ?>
                </select>
                <br />
                <input type="submit" name="submitNew" value="Submit" id="subbtn"/>
            </form>
        </main>
        
    </body>
</html>

