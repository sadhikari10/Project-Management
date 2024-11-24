<?php 
session_start();
    session_destroy();
    header("Location:trader_login.php");
?>