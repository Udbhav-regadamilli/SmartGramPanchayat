<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Grampanchayat";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to create table
    $sql = "CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    fullname VARCHAR(50) NOT NULL,
    aadharno VARCHAR(12) NOT NULL,
    phonenumber INT(10) UNSIGNED NOT NULL,
    passwrd VARCHAR(20) NOT NULL,
    administrator boolean
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table Student created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>