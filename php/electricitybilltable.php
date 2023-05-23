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
    $sql = "CREATE TABLE ELECTRICITY (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        aadharno VARCHAR(12) NOT NULL,
        houseno varchar(12) NOT NULL,
        State_ varchar(30) NOT NULL,
        amount INT NOT NULL,
        month_ varchar(20) NOT NULL,
        billdate DATE NOT NULL,
        paid boolean NOT NULL,
        paymentdate DATE NOT NULL
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Electricity Bill Table created successfully";
}catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>