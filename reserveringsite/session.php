<?php
    session_start();

    if (!isset($_SESSION['username']) || strlen($_SESSION['username']) == 0){
        header("location: inlog.php");
    }