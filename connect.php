<?php 
    //
    // This file to create database connection
    //
    
    $dsn        = "mysql:host=localhost;dbname=taawoni";   // Defining hostname and database name
    $user       = "root";   // Defininig database username
    $pass       = "";   // Defining database user's password
    // This array configures the settings for the PDO object and sets the character set to utf8 for proper encoding.
    $options    = array (
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    );

    try {

        $con    = new PDO($dsn, $user, $pass, $options);    // Establish a PDO database connection using given connection parameters: dsn, user, password, and options.
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //This code establishes a connection to a database using PDO and sets the error mode to throw exceptions if any errors occur.
    }

    catch (PDOEXception $e) {

        echo "There is an error" . $e->getMessage(); //This code is for catching a potential error and displaying its message to the user.
    }