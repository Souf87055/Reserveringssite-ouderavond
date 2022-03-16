<?php
    // Config
    $db_hostname = 'localhost:3306';
    $db_username = 'beroepsusers';
    $db_password = 'adminDB!';
    $db_database = 'SCL_Reservering';

    $mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

    // Devtools
    //    if (!$mysqli){
    //        echo "FOUT: Geen connectie naar de database. <br>";
    //        echo "Error: " .mysqli_connect_error() . "<br/>";
    //        exit;
    //    } else {
    //         echo "Goedzo!";
    //    }

