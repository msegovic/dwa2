<?php
session_start();
// AZURIRANJE PRIJAVE
$id_prijave = $_SESSION['id_prijave'];
$upit = "UPDATE prijave SET izlazak = NOW() 
    WHERE id = $id_prijave LIMIT 1";
require_once('db.php');
$c=db();
$c->query($upit);

unset($_SESSION['id_prijave']);
unset($_SESSION['login']);
unset($_SESSION['tip']);
session_destroy();
header("Location: index.php");
?>