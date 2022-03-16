<?php
    require 'config/config.php';


    $Persoon_ID = $_GET["id"];
    $Gebruikersnaam = $_GET["usr"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $aantalPersonen = $_POST['aantalPersonen'];
        $Begintijd = $_POST['begintijd'];
        $Eindtijd = $_POST['eindtijd'];

        $query = "INSERT INTO `GLR_Reserveringen` (`Reservering_ID`, `aantalPersonen`, `Begintijd`, `Eindtijd`, `Opmerking`, `Persoon_ID`) VALUES (NULL, '" . $aantalPersonen . "', '" . $Begintijd . "', '" . $Eindtijd . "',  '', '" . $Persoon_ID . "')";
        $result = mysqli_query($mysqli, $query);
        $item = mysqli_fetch_assoc($result);

        header("location: overzicht.php?usr=" . $Gebruikersnaam . "&id=" . $Persoon_ID);
    }
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grafisch Lyceum Rotterdam | Maak je afspraak</title>

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
        <form method="post">
            <h2> Maak je afspraak. </h2>

            <input type="hidden" id="id" name="id" value="<?= $Persoon_ID ?>"/>

            <label>Aantal personen: </label>
            <input type="number" id="aantalPersonen" name="aantalPersonen"/> <br/>

            <label>Begintijd:</label>
            <select name="begintijd" id="begintijd">
                <option value="2021-12-12 17:00:00">2021-12-12 - 17:00</option>
                <option value="2021-12-12 18:00:00">2021-12-12 - 18:00</option>
                <option value="2021-12-12 19:00:00">2021-12-12 - 19:00</option>
                <option value="2021-12-12 20:00:00">2021-12-12 - 20:00</option>
            </select> <br/>

            <label>Eindtijd:</label>
            <select name="eindtijd" id="eindtijd">
                <option value="2021-12-12 18:00:00">2021-12-12 - 18:00</option>
                <option value="2021-12-12 19:00:00">2021-12-12 - 19:00</option>
                <option value="2021-12-12 20:00:00">2021-12-12 - 20:00</option>
                <option value="2021-12-12 21:00:00">2021-12-12 - 21:00</option>
            </select> <br/>

            <label>Locatie:</label>
            <input type="locatie" id="locatie" name="locatie" value="Grafisch Lyceum Rotterdam" disabled><br><br>

            <input type="submit" value="Bevestig afspraak"> <br/> <br/>

            <a id="logout" href="logout.php"><strong>LOG UIT</strong></a>

        </form>
    </main>
</body>
</html>
