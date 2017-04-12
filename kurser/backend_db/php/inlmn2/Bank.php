<?php

// A bank class to handle bank objects
class Bank {
    // Member variables to be used in the class
    private $accountType;
    private $fName;
    private $lName;
    private $balance;
    private $conn;
    
    // Construct method to be called when an object of the class is created
    public function __construct($fName) {
        // Mysql server connection details 
        $server = "83.168.227.23";
        $userName = "u1164707_TimNil";
        $password = "jK.0 zW7Dt";
        $database = "db1164707_TimNil";
        
        // Connect to the database using an mysqli object
        $this->conn = new mysqli($server, $userName, $password, $database);
        if ($this->conn->connect_error) {
            die("Could not connect: " . $this->conn->connect_error);
        }
        
        // Making a query statement to the database
        $sqlQuery = "CALL SP_account('" . $fName . "')";
        $sqlResults = $this->conn->query($sqlQuery);
        // Check if the query gave any results
        if ($sqlResults->num_rows == 0) {
            echo "No results";
        } else {
            // Take the first row of the results and assign the content of that row to the member variables
            $results = $sqlResults->fetch_assoc();
            $this->accountType = $results["accountName"];
            $this->fName = $results["accountFname"];
            $this->lName = $results["accountLname"];
            $this->balance = $results["accountBalance"];
        }
        
    }
    
    // Destruct method to be called when an object of the class dies
    public function __destruct() {
        // Close the mysql connection
        $this->conn->close();
    }
    
    // Method to return account information as a string
    public function printInfo() {
        return $this->fName . ". " . $this->lName . " has: " . $this->accountType . " account with " . $this->balance . " balance";
    }
}

