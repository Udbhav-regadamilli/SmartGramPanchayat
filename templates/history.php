<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Transaction History</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../css/style.css" rel="stylesheet">
        <style>
            button{
                background-color: transparent;
                border: 0px;
                font-size: large;
                font-weight: bold;
            }

            button:hover{
                background-color: blueviolet;
                border-radius: 50px;
                transition-duration: 1s;
                transition: all 0.5s ease;
                padding: 0.8%;
                padding-left: 2%;
                padding-right: 2%;
                cursor: pointer;
            }

            h2{
                background-color: blueviolet;
                border-radius: 50px;
                padding: 2%;
                padding-left: 5%;
                padding-right: 5%;
            }

            select{
                width: 80%;
                border-radius: 50px;
                height: 8%;
                text-align: center;
                margin: 8%;
                margin-bottom: 6%;
                font-weight: 700;
                text-transform: uppercase;
                border-width: 2px;
            }

            option{
                border-radius: 50px;
                font-weight: 700;
            }

            .detail{
                width: 80%;
                height: 30%;
                background-image: linear-gradient(to right,rgb(255, 195, 110),rgb(255, 146, 91));
                border-radius: 50px;
                padding-top: 5px;
                padding-left: 50px;
                margin: 10px;
                margin-bottom: 25px;
                font-size: medium;
            }

            .detailsinfo{
                margin-left: 15%;
            }

            input{
                position: relative;
                left: 87%;
                bottom: 70px;
                background-color: transparent;
                border-width: 0px;
                font-size: 20px;
            }

            input:hover{
                background-color: blueviolet;
                border-radius: 50px;
                transition-duration: 1s;
                transition: all 0.5s ease;
                padding: 0.8%;
                padding-left: 2%;
                padding-right: 2%;
                cursor: pointer;
            }
        </style>
    </head>
    <body style="background-image: url('../img/history.jpg'); background-repeat: no-repeat; background-size: cover;">
        <header style="flex-direction: row; justify-content: space-around;">
            <img class="icon" src="../img/icon.jpeg" style="left: 0%">
            <h1>History</h1>
            <button onclick="window.location.href='home.php'">Home</button>
            <button onclick="window.location.href='waterbill.php'">Water Bill</button>
            <button onclick="window.location.href='electricitybill.php'">Electricity Bill</button>
            <button onclick="window.location.href='phonebill.php'">Phone Bill</button>
            <button onclick="window.location.href='housetax.php'">House Tax</button>
            <button class="clkbtn" onclick="window.location.href='../php/logoutsession.php'">Logout</button>
        </header>
        <div class="container" style="height: 520px;">
            <form style="top: 2%; overflow: auto;" method="post">
                <select name="hist" id="hist" style="height: 50px; position: relative; left: -10px">
                    <option value="electricity">electricity bill</option>
                    <option value="water">water bill</option>
                    <option value="phone">phone bill</option>
                    <option value="house">house tax</option>
                </select>
                <input type="submit" name="search" value="&#128269;">
            </form>
            <div class="detailsinfo">
                <?php
                    session_start();

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "Grampanchayat";

                    if($_SESSION['admin'] != TRUE){
                        if(array_key_exists('search', $_POST)){
                            try{
                                $name = $_POST['hist'];
                                $aadhar = $_SESSION['aadharno'];
                                $conn = mysqli_connect($servername, $username, $password, $dbname);
    
                                $sql = "SELECT * from $name where aadharno = '$aadhar' order by paymentdate desc";
    
                                $result = mysqli_query($conn, $sql);

                                if(!$result){
                                    die(mysqli_error($conn));
                                }

                                while($row = mysqli_fetch_array($result)){
                                    if($row['paid'] == TRUE){
                                        echo "<div class='detail'>
                                            <h4>Month: {$row['month_']}</h4>
                                            <h4>Amount: {$row['amount']}</h4>
                                            <h4>Bill: {$name}bill</h4>
                                            <h4>Date: {$row['paymentdate']}</h4>
                                        </div>";
                                    }
                                }
                                
                            }catch(exception $e){
                                echo $sql . "<br>" . $e->getMessage();
                            }
                        }
                    }else{
                        if(array_key_exists('search', $_POST)){
                            try{
                                $name = $_POST['hist'];
                                $aadhar = $_SESSION['aadharno'];
                                $conn = mysqli_connect($servername, $username, $password, $dbname);
    
                                $sql = "SELECT * from $name order by paymentdate desc";
    
                                $result = mysqli_query($conn, $sql);

                                if(!$result){
                                    die(mysqli_error($conn));
                                }

                                while($row = mysqli_fetch_array($result)){
                                    if($row['paid'] == TRUE){
                                        echo "<div class='detail'>
                                            <h4>ID: {$row['aadharno']} </h4>
                                            <h4>Month: {$row['month_']}</h4>
                                            <h4>Amount: {$row['amount']}</h4>
                                            <h4>Date: {$row['paymentdate']}</h4>
                                        </div>";
                                    }
                                }
                                
                            }catch(exception $e){
                                echo $sql . "<br>" . $e->getMessage();
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>