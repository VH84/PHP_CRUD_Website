<?php

spl_autoload_register();
error_reporting(0);

use Classes\Database\Database;

if (!isset($_GET["action"]) == "insert" || !isset($_GET["action"]) == "update") {
    header("location:index.php");
}

$db = new Database();
$blstmt = "SELECT DISTINCT Bundesland FROM kunden ORDER BY Bundesland";
$blresult = $db->query($blstmt);

if ($_GET['action'] == 'update') {
    $upstmt = 'SELECT * FROM kunden WHERE id=' . $_GET['id'];
    $upresult = $db->query($upstmt);
    $uperg = $upresult->fetchObject();
}
?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Css/style.css" type="text/css">
    <title>PHPDBformular</title>
</head>
<body>
<div id="wrapperform">
    <div class="filterform">
        <p>Erstellen eines neuen Datensatzes
        <p>
    </div>
    <div id="left">
        <form action="inup.php" method="post">
            <div class="form-row">
                <div class="form-input">
                    <select name="anrede" required>
                        <option value="">Anrede</option>
                        <option value="Frau" <?php echo ($uperg->Anrede=="Frau")? "selected":"";?>>Frau</option>
                        <option value="Herr" <?php echo ($uperg->Anrede=="Herr")? "selected":"";?>>Herr</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-input">
                    <input type="text" name="vorname" placeholder="Vorname" required
                           value="<?php echo $uperg->Vorname; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-input">
                    <input type="text" name="nachname" placeholder="Nachname" required
                           value="<?php echo $uperg->Nachname; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-input">
                    <input type="text" name="ort" placeholder="Wohnort" required value="<?php echo $uperg->Ort; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-input">
                    <input type="text" name="strasse" placeholder="Strasse" required
                           value="<?php echo $uperg->Strasse; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-input">
                    <input type="number" name="hausnummer" placeholder="Hausnummer" required
                           value="<?php echo $uperg->Hausnummer; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-input">
                    <input type="number" name="postleitzahl" placeholder="Postleitzahl" required
                           value="<?php echo $uperg->Postleitzahl; ?>">
                </div>
            </div>
                <select name="bundesland" id="bundesland">
                    <option value="">Bundesland wählen</option>
                    <?php while ($erg = $blresult->fetchObject()): ?>
                        <option value="<?php echo $erg->Bundesland; ?>" <?php echo ($erg->Bundesland == $uperg->Bundesland) ? 'selected' : ''; ?>><?php echo $erg->Bundesland; ?></option>
                    <?php endwhile; ?>
                </select>
                <div class="form-row">
                    <div class="form-input">
                        <input type="date" name="geburtsdatum" required
                               value="<?php echo $uperg->Geburtsdatum; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-input">
                        <input type="number" name="rechnungsbetrag" placeholder="rechnungsbetrag" required
                               value="<?php echo $uperg->Rechnungsbetrag; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-input">
                        <input type="number" name="personenalter" placeholder="Personenalter" required
                               value="<?php echo $uperg->Personenalter; ?>">
                    </div>
                </div>
            <div class="form-row">
                <input type="submit" name="absenden" class="myButton" value="Eintragen">
                <div class="clear"></div>
            </div>
                <input type="hidden" name="action" value="<?php echo $_GET["action"]; ?>"/>
            <input type="hidden" name="id" value="<?php echo $uperg->id; ?>"/>
        </form>
    </div>
</div>
</body>
</html>