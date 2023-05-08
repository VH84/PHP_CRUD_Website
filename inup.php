<?php
error_reporting(0);

use Classes\Database\Database;

spl_autoload_register();

if (isset($_POST["absenden"]) && $_POST["absenden"] = "Eintragen") {

    $db = new Database();

    $data = [
        "anrede" => $_POST["anrede"],
        "vorname" => $_POST["vorname"],
        "nachname" => $_POST["nachname"],
        "strasse" => $_POST["strasse"],
        "hausnummer" => $_POST["hausnummer"],
        "postleitzahl" => $_POST["postleitzahl"],
        "ort" => $_POST["ort"],
        "bundesland" => $_POST["bundesland"],
        "geburtsdatum" => $_POST["geburtsdatum"],
        "personenalter" => $_POST["personenalter"],
        "rechnungsbetrag" => $_POST["rechnungsbetrag"]

    ];
    if($_POST["action"]=="insert") {

        $stmt = "INSERT INTO kunden(Anrede, Vorname, Nachname, Strasse, Hausnummer, Postleitzahl, Ort, Bundesland, Geburtsdatum, Personenalter, Rechnungsbetrag) 
    VALUES(:anrede, :vorname, :nachname, :strasse, :hausnummer, :postleitzahl, :ort, :bundesland, :geburtsdatum, :personenalter, :rechnungsbetrag)";
        $sql = $db->prepare($stmt);
        if ($sql->execute($data)) {
            header("location:index.php");
        }
    }
    elseif ($_POST["action"]== "update" && $_POST["id"]){
        $ustmt = "UPDATE kunden SET 
                  Anrede= :anrede,
                  Vorname = :vorname,
                  Nachname = :nachname,
                  Strasse = :strasse,
                  Hausnummer = :hausnummer,
                  Postleitzahl = :postleitzahl,
                  Ort = :ort,
                  Bundesland = :bundesland,
                  Geburtsdatum = :geburtsdatum,
                  Personenalter = :personenalter,
                  Rechnungsbetrag = :rechnungsbetrag WHERE id=" .$_POST["id"];

        if($db->prepare($ustmt)->execute($data)){
            header("location:formular.php?action=update&id=" . $_POST["id"]);
        }
    }

} else {
    header("location:formular.php");
}

