<?php

    // Import the Bank.php file
    require_once 'Bank.php';

    // Create a new Bank object
    $myBankObject = new Bank("Joakim");
    // Call the printInfo method in the bank object
    echo $myBankObject->printInfo();

?>

