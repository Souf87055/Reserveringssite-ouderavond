<?php

    session_start();

    // Include config file
    require_once "config/config.php";

    // Define variables and initialize with empty values
    $username = "";
    $password = "";
    $username_err = "";
    $password_err = "";
    $login_err = "";
 
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Voer uw gebruikersnaam in";
    } else{
        $username = trim($_POST["username"]);
    }

    $queryCheck = 'SELECT * FROM GLR_Accounts WHERE Gebruikersnaam = "' . $username . '";';
    $resultCheck = mysqli_query($mysqli, $queryCheck);
    $itemCheck = mysqli_fetch_assoc($resultCheck);

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        if ($itemCheck['Functie'] == "Ouder") {
            header("location: overzicht.php?usr=" . $itemCheck['Gebruikersnaam'] . "&id=" . $itemCheck['Persoon_ID']);
        } else {
            header("location: admin.php");
        }

        exit;
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Voer uw wachtwoord in";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if($username_err == "" && $password_err == "") {
        // Prepare a select statement
        $sql = "SELECT `Persoon_ID`, `Gebruikersnaam`, `Wachtwoord` FROM `GLR_Accounts` WHERE `Gebruikersnaam` = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $username);
            
            // Set parameters
            // $param_username = $username;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($id, $db_username, $db_password);
                    if($stmt->fetch()) {
                        if($password == $db_password) {
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            
                            // Redirect user to welcome page
                            if ($itemCheck['Functie'] == "Ouder") {
                                header("location: overzicht.php?usr=" . $itemCheck['Gebruikersnaam'] . "&id=" . $itemCheck['Persoon_ID']);
                            } else if ($itemCheck['Functie'] == "Docent") {
                                header("location: admin.php");
                            } else {

                            }

                        } else {
                         
                            // Password is not valid, display a generic error message 
                            $login_err = "Onjuiste gebruikersnaam en/of wachtwoord.";
                        }
                    }
                } else {
                  
                    // Username doesn't exist, display a generic error message
                    $login_err = "Onjuiste gebruikersnaam en/of wachtwoord.";
                    $login_err2 = "<strong>ERROR:</strong> Verkeerde inloggegevens! Denk goed na en voer de JUISTE gegevens in.";
                }
            } else{
                
                echo "Error";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
}
?>
 
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Grafisch Lyceum Rotterdam | Portal - Login</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css"/>

    <!-- Icon -->
    <link rel="icon" href="media/glr_logo.png"/>

</head>
<body>
    <header>
        <div class="links">
            <img class="header_logo" src="media/glr_logo.png"/>
        </div>

        <div class="midden">
            <h1 class="header_tekst"> Grafisch Lyceum Rotterdam® </h1>
        </div>
    </header>

    <main id="login_width">
        <div>
            <div>

                <h2>Ouderavond Portal - Login</h2>
                <p>Vul uw inloggegevens in:</p>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <label>Gebruikersnaam</label>
                    <input type="text" name="username" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>"> <br/>
                        <span><?php echo $username_err; ?></span>

                        <label>Wachtwoord</label>
                        <input type="password" name="password" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"> <br/>
                        <span><?php echo $password_err; ?></span> <br/>

                        <input class="knop" type="submit" value="Login"> <br/>

                </form> <br/>

                <?php
                    if(!empty($login_err)){
                        //echo $login_err;
                        echo $login_err2;
                    }
                ?>

    </main>
</body>
</html>