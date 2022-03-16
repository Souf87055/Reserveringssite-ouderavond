<?php
    // Verbind met de DB.
    require 'config/config.php';

    // Maak de query
    $query = 'SELECT * FROM GLR_Reserveringen';

    // Voer de query uit, en vang het resultaat op
    $result = mysqli_query($mysqli, $query);

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Grafisch Lyceum Rotterdam | Admin Panel</title>

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

        <h2> Alle reserveringen: </h2>

        <table class="table_id">
            <tr>
                <th>Reserveerder: </th>
                <th>Aantal Personen:</th>
                <th>Tijdsvak:</th>
                <th>Opmerking en/of Feedback:</th>
            </tr>

            <?php while ($item = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <!-- Naam & Voornaam ophalen. -->
                    <?php
                        $Persoon_ID = $item['Persoon_ID'];

                        $query2 = 'SELECT * FROM GLR_Accounts WHERE Persoon_ID = "' . $Persoon_ID . '";';
                        $result2 = mysqli_query($mysqli, $query2);

                        $item2 = mysqli_fetch_assoc($result2);
                    ?>

                    <td> <?= $item2['Voornaam'] . " " . $item2['Achternaam'] ?> </td>
                    <td> <?= $item['aantalPersonen'] ?> </td>
                    <td> <strong> Begintijd: </strong> <br/> <?= $item['Begintijd'] ?> <br/> <br/>
                        <strong> Eindtijd: </strong> <br/> <?= $item['Eindtijd'] ?> </td>
                    <td id="opmerking_tekst"> <?= $item['Opmerking'] ?> </td>
                </tr>
            <?php } ?>
            <?php } ?>

        </table> <br/> <br/>

        <a id="logout" href="logout.php">LOG UIT</a>
    </main>
</body>
</html>