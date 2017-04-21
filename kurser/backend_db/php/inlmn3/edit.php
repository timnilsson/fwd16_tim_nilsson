<!doctype html>
<?php 

    // Include the config file
    include_once("config.php");

    // Define wich row that has been targeted
    $gameID = $_GET['gameID'];

    // SQL statement to select all the information from both the game and the publisher table, using the placeholder :gameID
    $sqlStatement = "SELECT * FROM game JOIN publisher ON game.publisherID = publisher.publisherID WHERE gameID = :gameID";
    $sqlQuery = $pdo->prepare($sqlStatement);
    // Define that the placeholder :gameID should be the variable $gameID
    $sqlQuery->bindparam(':gameID', $gameID);
    // Execute the SQL statement
    $sqlQuery->execute();

    // Get the content from the specified row
    $row = $sqlQuery->fetch();
    // Assign the variable $publisherName to the corresponding column from the table row
    $publisherName = $row['publisherName'];
    
    // Variables that will tell if all the fields has been filled in
    $gameNameEmpty = false;
    $gameDescriptionEmpty = false;
    $gameLinkEmpty = false;
    $gameReleaseDateEmpty = false;
    $gamePriceEmpty = false;
    
    // If the submit button has been clicked
    if (isset($_POST['submitEdit'])) {
        // Set variables for the information recieved
        $gameName = $_POST['gameName'];
        $gameDescription = $_POST['gameDescription'];
        $gameLink = $_POST['gameLink'];
        $gameReleaseDate = $_POST['gameReleaseDate'];
        $gamePrice = $_POST['gamePrice'];
        $publisherID = $_POST['publisherID'];
        
        // If any field is empty, set the corresponding variables as true
        if (empty($gameName) || empty($gameDescription) || empty($gameLink) || empty($gameReleaseDate) || empty($gamePrice)) {
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
            // If all fields has been filled in
            // SQL statement to update the table row content, using multiple placeholders
            $sqlStatement = "UPDATE game SET gameName = :gameName, gameDescription = :gameDescription, gameLink = :gameLink, "
                    . "gameReleaseDate = :gameReleaseDate, gamePrice = :gamePrice, publisherID = :publisherID WHERE gameID = :gameID";
            $sqlQuery = $pdo->prepare($sqlStatement);
            
            // Execute the statement. The parameter is using an array to define what each placeholder should be
            $sqlQuery->execute(array(':gameName' => $gameName, ':gameDescription' => $gameDescription, ':gameLink' => $gameLink,
                ':gameReleaseDate' => $gameReleaseDate, ':gamePrice' => $gamePrice, ':publisherID' => $publisherID, ':gameID' => $gameID));
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
            <?php 
                // HTML form with data from the selected row
            ?>
            <form name="editGame" method="POST" action=<?php echo "edit.php?gameID={$gameID}"?>>
                <h3>Game Title:</h3>
                <input type="text" name="gameName" value="<?php echo $row['gameName']?>" size="30"/>
                <?php if ($gameNameEmpty) {
                    // Print an error message if the field has not been filled in
                    echo "<span class='emptyfield'>* This field is required</span>";
                }
                ?>
                <h3>Game Description:</h3>
                <textarea name="gameDescription" rows="5" cols="30"><?php echo $row['gameDescription']?></textarea>
                <?php if ($gameDescriptionEmpty) {
                    // Print an error message if the field has not been filled in
                    echo "<span class='emptyfield'>* This field is required</span>";
                }
                ?>
                <h3>Game Link:</h3>
                <input type="text" name="gameLink" value="<?php echo $row['gameLink']?>" size="30"/>
                <?php if ($gameLinkEmpty) {
                    // Print an error message if the field has not been filled in
                    echo "<span class='emptyfield'>* This field is required</span>";
                }
                ?>
                <h3>Game Release Date:</h3>
                <input type="text" name="gameReleaseDate" value="<?php echo $row['gameReleaseDate']?>" size="30"/>
                <?php if ($gameReleaseDateEmpty) {
                    // Print an error message if the field has not been filled in
                    echo "<span class='emptyfield'>* This field is required</span>";
                }
                ?>
                <h3>Game Price:</h3>
                <input type="text" name="gamePrice" value="<?php echo $row['gamePrice']?>" size="30"/>
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
                            // If the column publisherName from the publisher table corresponds with the one in the game table, specify that option tag as selected
                            if ($row['publisherName'] == $publisherName) {
                                echo "<option value = \"{$row['publisherID']}\" selected>{$row['publisherName']}</option>";
                            }else {
                                echo "<option value = \"{$row['publisherID']}\">{$row['publisherName']}</option>";
                            }                         
                        }
                        
                    ?>
                </select>
                <br />
                <input type="submit" name="submitEdit" value="Submit" id="subbtn"/>
            </form>
        </main>

    </body>
</html>

<?php
