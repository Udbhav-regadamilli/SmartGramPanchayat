<?php

session_start();

$name = $_POST['name'];
$aadhar_no = $_POST['aadhar_no'];
$phone_no = $_POST['phone_no'];
$passwd = $_POST['passwd'];

//DB connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Grampanchayat";
$administrator = FALSE;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO users (fullname, aadharno, phonenumber, passwrd, administrator) VALUES ('$name', '$aadhar_no', '$phone_no', '$passwd', '$administrator')";
    
    $conn->exec($sql);
    $_SESSION['aadharno'] = $aadhar_no;
    $_SESSION['name'] = $name;
    $_SESSION['admin'] = FALSE;
    header("Location: ../templates/home.php");
}
catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>