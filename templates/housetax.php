<!DOCTYPE html>
<html lang="en">
    <head>
        <title>House Tax</title>
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
                background-image: linear-gradient(to right,rgb(255, 195, 110),rgb(255, 146, 91));
                border-radius: 50px;
                padding: 2%;
                padding-left: 5%;
                padding-right: 5%;
            }
        </style>
    </head>
    <body style="background-image: url('../img/housetax.jpg'); background-size: cover;">
        <header style="flex-direction: row; justify-content: space-around;">
            <img class="icon" src="../img/icon.jpeg" style="left: 0%">
            <h1>House Tax</h1>
            <button onclick="window.location.href='home.php'">Home</button>
            <button onclick="window.location.href='waterbill.php'">Water Bill</button>
            <button onclick="window.location.href='electricitybill.php'">Electricity Bill</button>
            <button onclick="window.location.href='phonebill.php'">Phone Bill</button>
            <button onclick="window.location.href='history.php'">History</button>
            <button class="clkbtn" onclick="window.location.href='../php/logoutsession.php'">Logout</button>
        </header>
        <div class="container" style="height: 520px; top: 2%">
            <form method="post" class="login-box" style="gap: 3%;">
                <H2>Bill Details</H2>
                <h4 style="color: #a5a5a5"><?php 
                session_start(); 

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "Grampanchayat";
                $flag = FALSE;

                if($_SESSION['admin'] != TRUE){
                    $amount = 0;
                    try{
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
                        
                        $aadhar = $_SESSION['aadharno'];

                        $sql = "SELECT * from house where aadharno = '$aadhar' order by id desc";

                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($result);
                        $pamount = $row['amount'];
                    }catch(exception $e){
                        echo $sql . "<br>" . $e->getMessage();
                    }
                    if($row['paid'] != TRUE && $pamount != NULL){
                        echo "Total amount to be paid: {$pamount}";
                    }else{
                        echo "There is No Due Bills.";
                    }

                    if(array_key_exists('payment', $_POST)){
                        try{
                            $conn = mysqli_connect($servername, $username, $password, $dbname);

                            $house = $_POST['house'];
                            $state = $_POST['state'];
                            $amount = $_POST['amount'];
                            $month = $_POST['month'];

                            $sql = "UPDATE house SET paid = TRUE where houseno = '$house' and State_ = '$state' and month_ = '$month'";
                            mysqli_query($conn, $sql);
                            $sql = "UPDATE house SET paymentdate = CURDATE() where houseno = '$house' and State_ = '$state' and month_ = '$month'";
                            mysqli_query($conn, $sql);

                            $flag = TRUE;
                        }catch(exception $e){
                            echo $sql . "<br>" . $e->getMessage();
                        }
                    }
                }else{
                    echo '<input type="text" name="aadhar" class="email ele" placeholder="aadhar no" required>';
                    if(array_key_exists('payment', $_POST)){
                        $aadhar = $_POST['aadhar'];
                        $houseno = $_POST['house'];
                        $state = $_POST['state'];
                        $amount = $_POST['amount'];
                        $month = $_POST['month'];

                        try{
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

                            $sql = "INSERT INTO house(aadharno, houseno, State_, amount, month_, billdate, paid) VALUES ('$aadhar', '$houseno', '$state', '$amount', '$month', CURDATE(), 'FALSE')";

                            $conn->exec($sql);
                            $flag = TRUE;
                        }catch(exception $e){
                            echo $sql . "<br>" . $e->getMessage();
                        }
                    }
                }
                ?></h4>
                <select name="month" class="email ele">
                    <option value=" ">Month</option>
                    <option value="JAN">JAN</option>
                    <option value="FEB">FEB</option>
                    <option value="MAR">MAR</option>
                    <option value="APR">APR</option>
                    <option value="MAY">MAY</option>
                    <option value="JUN">JUN</option>
                    <option value="JULY">JULY</option>
                    <option value="AUG">AUG</option>
                    <option value="SEPT">SEPT</option>
                    <option value="OCT">OCT</option>
                    <option value="NOV">NOV</option>
                    <option value="DEC">DEC</option>
                </select>
                <input name="house" type="text" class="email ele" placeholder="House no" required>
                <input name="state" type="text" class="email ele" placeholder="State" required>
                <input name="amount" type="text" class="email ele" placeholder="Amount" required>
                <?php
                if($flag == TRUE){
                    if($_SESSION['admin'] == TRUE){
                        echo '<h6 id="t" style="color:#42f56c;">Details have been added successfully</h6>';
                    }else{
                        echo '<h4 id="t" style="color:#42f56c;">Payment done successfully</h4>';
                    }
                }
                ?>
                <input name="payment" type="submit" class="clkbtn" value="Payment">
            </form>
        </div>
    </body>
</html>