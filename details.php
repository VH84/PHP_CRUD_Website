<?php
error_reporting(0);
spl_autoload_register();

use Classes\Database\Database;

if(isset($_GET['id'])) {
    $db = new Database();
    $stmt ='SELECT * FROM kunden WHERE id=' . $_GET['id'];
    $result = $db->query($stmt);
    var_dump($result->fetchObject());
} else {
    header('location:index.php');
}

?>
