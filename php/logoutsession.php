<?php
    echo "Logout!!";
    session_start();
    echo $_SESSION['name'];
    unset($_SESSION['name']);
    header("Location: ../index.html");
?>