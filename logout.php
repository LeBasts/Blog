<?php 
require_once('functions\functions.php');
isconnected();
// On reset Session connected
unset($_SESSION['connected']);
// On redirige vers index.php 
header('Location: login.php');
