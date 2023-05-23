<?php

session_start();

$aadhar_no = $_POST['aadhar_no'];
$passwd = $_POST['passwd'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Grampanchayat";

try{
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // set the PDO error mode to exception
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * from users where aadharno = '$aadhar_no' and passwrd = '$passwd'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        if($row['aadharno'] === $aadhar_no && $row['passwrd'] === $passwd){
            echo "Logged in!";
            $_SESSION['aadharno'] = $aadhar_no;
            $_SESSION['name'] = $row['fullname'];
            $_SESSION['admin'] = $row['administrator'];
            header("Location: ../templates/home.php");
            exit();
        }
    }else{
        header("Location: ../index.html");
        echo "Login Failed";
        exit();
    }
}catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}

?>