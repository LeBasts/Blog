<?php 
$pageName = "Se connecter";
require_once('header.php');
if(!empty($_POST['pseudo']) && !empty($_POST['mdp'])){
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];
    if(userExist($bdd,$pseudo,$mdp)){
        $_SESSION['connected'] = $pseudo;
    } else {
        $erreur = "Identifiants incorrects";
    }
}
?>
<main>
    <?php if(empty($_SESSION['connected'])): ?>
    <form action="" method="post">
        <input type="text" placeholder="Pseudo du compte" name="pseudo" <?php if(isset($erreur)):?>class="wrong"<?php endif; ?>>
        <input type="password" placeholder="Entrez votre mot de passe" name="mdp" <?php if(isset($erreur)):?>class="wrong"<?php endif; ?>>
        <p><?php if(isset($erreur)){echo $erreur;} ?></p>
        <input type="submit" value="Se connecter">
    </form>
    <?php else: 
        header('Location: profil.php');
    endif; ?>
</main>
<?php require_once('footer.php');?>