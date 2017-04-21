<?php

// Set configuration of error handling
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

// Try to make a connection to the database and catch an error if it fails
try {
    // Define the PDO connection by creating a PDO object
    $pdo = new PDO('mysql:host=83.168.227.23; dbname=db1164707_TimNil', 'u1164707_TimNil', 'jK.0 zW7Dt');
    // Set specific standard behaviours for the PDO object
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $error) {
    
    // Error message to display if the connection does not succed
    echo 'Could not connect, connection failed' . $error->getMessage();
    die();
}


?>