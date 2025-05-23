<?php 
require_once('functions\functions.php');
require_once('header.php');
isconnected();
$infos = showBdd($bdd);
delete($bdd, $infos['pseudo']);
// On reset Session connected
unset($_SESSION['connected']);
// On redirige vers index.php 
header('Location: login.php');
