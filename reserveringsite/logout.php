<?php
    session_start();
    session_destroy();
    header("location: inlog.php");
    exit;