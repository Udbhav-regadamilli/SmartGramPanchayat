<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Home Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="img/icon.jpeg" type="image/icon type">
        <link href="../css/style.css" rel="stylesheet">
        <link rel="icon" href="../img/icon.jpeg" type="image/icon type">
    </head>
    <body>
        <img class="icon" src="../img/icon.jpeg">
        <button class="clkbtn" style="position: relative; left: 40%; bottom: 5%" onclick="window.location.href='../php/logoutsession.php'">Logout</button>
        <header>
            <h1 style="margin-bottom: 1%">Welcome <?php session_start(); echo $_SESSION['name'] ?> to Smart Gram-panchayat</h1>
        </header>
        <div class="container menu">
            <button class="clkbtn" style="margin: 10px; width: 50%;" onclick="window.location.href='waterbill.php'">water Bill</button>
            <button class="clkbtn" style="margin: 10px; width: 50%;" onclick="window.location.href='electricitybill.php'">Electricity Bill</button>
            <button class="clkbtn" style="margin: 10px; width: 50%;" onclick="window.location.href='phonebill.php'">Phone Bill</button>
            <button class="clkbtn" style="margin: 10px; width: 50%;" onclick="window.location.href='housetax.php'">House Tax</button>
            <button class="clkbtn" style="margin: 10px; width: 50%;" onclick="window.location.href='history.php'">History</button>
        </div>
    </body>
</html>