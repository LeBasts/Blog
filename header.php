<?php
require_once('functions.php');
$bdd=connectBdd();
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
if(empty($pageName)){
    $pageName = "Blog";
}
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageName ?></title>
    <link rel="stylesheet" href="style\style.css">
    <script src="main.js"></script>
</head>
<header>
    <div>
        <nav>
            <?php if(empty($_SESSION['connected'])):?>
                <a href="signin.php">S'inscrire</a>
                <a href="login.php">Se connecter</a>
            <?php else:?>
                <a href="profil.php">Profil</a>
                <a href="flux.php">Flux</a>
                <a class="deco" href="logout.php">Se déconnecter</a>
            <?php endif;?>
        </nav>
    </div>
</header>
