<?php
    require 'config/config.php';

    $Gebruikersnaam = $_GET["usr"];
    $Persoon_ID = $_GET["id"];

    $query = 'SELECT * FROM GLR_Reserveringen WHERE Persoon_ID = "' . $Persoon_ID . '";';
    $result = mysqli_query($mysqli, $query);

?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grafisch Lyceum Ouderavond | Afspraakoverzicht</title>

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

    <main>

        <?php if (mysqli_num_rows($result) > 0) { ?>

        <a id="logout" href="logout.php">LOG UIT</a>

        <h2> Mijn Reserveringen: </h2>

        <table class="table_id">
            <tr>
                <th>Tijdsvak:</th>
                <th>Aantal Personen:</th>
                <th>Locatie:</th>
            </tr>

            <?php while ( $item = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td> <strong> Begintijd: </strong> <br/> <?= $item['Begintijd'] ?> <br/> <br/>
                        <strong> Eindtijd: </strong> <br/> <?= $item['Eindtijd'] ?> </td>
                    <td> <?= $item['aantalPersonen'] ?> </td>

                    <td>
                        Grafisch Lyceum Rotterdam, <br/>
                        Heer Bokelweg 255, <br/>
                        3032 AD Rotterdam
                    </td>
                </tr>
            <?php } ?>

            <?php
            } else {
                header("location: maakjeafspraak.php?id=" . $Persoon_ID . "&usr=" . $Gebruikersnaam);
            }
            ?>

        </table> <br/>
    </main>
</body>
</html>
