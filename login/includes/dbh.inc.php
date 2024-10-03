<?php

$dsn = "mysql:host=localhost;dbname=myfirstdatabase";
// data source name
$dbusername = "root";
$dbpassword = "";


try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    // connect database with php data object
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // while error - exception
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
    // if connection fails grab error message
}

