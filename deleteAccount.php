<?php 
require_once('functions\functions.php');
isconnected();
$infos = showBdd($bdd);
delete($infos['pseudo']);
// On reset Session connected
unset($_SESSION['connected']);
// On redirige vers index.php 
header('Location: login.php');
