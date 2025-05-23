<?php 
require_once('header.php');
isconnected();
$infos = showBdd($bdd);
$pseudo = "Bast";
?>
<body>
    <h1>Profil de <?= $infos['pseudo'] ?></h1>
    <h2>Date d'inscription : <?= $infos['dateInscription'] ?></h2>
    <h2>Mon mot de passe : <?= $infos['mdp'] ?></h2>
    <a href="deleteAccount.php">Supprimer mon compte</a>
</body>
<?php require_once('footer.php');?>