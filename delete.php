<?php
error_reporting(0);
spl_autoload_register();

use Classes\Database\Database;

if(isset($_GET['id'])) {
    $db = new Database();
    $stmt ='DELETE FROM kunden WHERE id=' . $_GET['id'];
    $db->query($stmt);
    header('location:index.php');
} else {
    header('location:index.php');
}

?>