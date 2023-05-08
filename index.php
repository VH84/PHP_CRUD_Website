<?php


//statt require once:
spl_autoload_register();
error_reporting(0);

use Classes\Database\Database;

$db = new Database();
$blstmt = "SELECT DISTINCT Bundesland FROM kunden ORDER BY Bundesland";
$blresult = $db->query($blstmt);


if (isset($_POST["send"]) && $_POST["send"] == "Absenden") {
    $nachname = $_POST["nachname"];
    $bundesland = $_POST["bundesland"];
    $stmt = 'SELECT id, Anrede, Vorname, Nachname, Ort, Bundesland, Personenalter FROM kunden WHERE Nachname LIKE "' . $nachname . '%" AND Bundesland LIKE "' . $bundesland . '%"';

} else {
    $stmt = "SELECT id, Anrede, Vorname, Nachname, Ort, Bundesland, Personenalter FROM kunden LIMIT 0,50";
}

$result = $db->query($stmt);
$count = $result->rowCount();

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Css/style.css" type="text/css">
    <title>PHPDB</title>
</head>
<body>

<div id="wrapper">
    <div class="filter">
        <form class="searchform" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <input type="text" name="nachname" placeholder="Nachname" value=""<?php echo $_POST["nachname"]; ?>>
            <select name="bundesland" id="bundesland">
                <option value="">Bundesland wählen</option>
                <?php while ($blerg = $blresult->fetchObject()): ?>
                    <option value="<?php echo $blerg->Bundesland; ?>"<?php echo ($blerg->Bundesland == $_POST['bundesland']) ? 'selected' : ''; ?>><?php echo $blerg->Bundesland; ?></option>
                <?php endwhile; ?>
            </select>
            <input type="submit" name="send" id="button" value="Absenden">

        </form>
        <a href="formular.php?action=insert" class="myButton" target="_blank">Neuen Datensatz erstellen</a>
        <div class="clear"></div>
    </div>
    <?php
    if ($result->rowCount() > 1) {
        $info = "Es wurden " . $result->rowCount() . " Ergebnisse gefunden";
    } elseif ($result->rowCount() == 1) {
        $info = "Es wurde ein Ergebnisse gefunden";
    } else {
        $info = "Es konnten keine Ergebnisse gefunden werden";
    }
    ?>
    <h2>
        <?php echo $info; ?>
    </h2>
    <table class="admintable">
        <tr>
            <th>Anrede</th>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Wohnort</th>
            <th>Bundesland</th>
            <th>Personenalter</th>
            <th>Details</th>
            <th>Entfernen</th>
            <th>Bearbeiten</th>
        </tr>
        <?php
        $i = 0;
        while ($erg = $result->fetchObject()):?>

            <tr class="row_<?php echo $i % 2; ?>">
                <td><?php echo $erg->Anrede; ?></td>
                <td><?php echo $erg->Vorname; ?></td>
                <td><?php echo $erg->Nachname; ?></td>
                <td><?php echo $erg->Ort; ?></td>
                <td><?php echo $erg->Bundesland; ?></td>
                <td><?php echo $erg->Personenalter; ?></td>
                <td><a href="details.php?id=<?php echo $erg->id; ?>">Details</a></td>
                <td><a href="delete.php?id=<?php echo $erg->id; ?>">Löschen</a></td>
                <td><a href="formular.php?action=update&id=<?php echo $erg->id; ?>" target="_blank">Bearbeiten</a></td>
            </tr>

            <?php
            $i++;
        endwhile; ?>

    </table>
</div>
</body>
</html>


