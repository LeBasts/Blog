<?php 
    $pageName = "S'inscrire";
    require_once('header.php');
    if(!empty($_POST['pseudo']) && !empty($_POST['mdp']) && !empty($_POST['mdpcheck'])){
        if($_POST['mdp'] === $_POST['mdpcheck']){
            $pseudo = $_POST['pseudo'];
            $mdp = $_POST['mdp'];
            $mdpcheck = $_POST['mdpcheck'];
            $state = addUser($bdd,$pseudo,$mdp,$mdpcheck);
        } else {
            $state = "Mots de passe différents";
        }
    }
?>
<main>
    <!-- Ajouter une vérification du mot de passe a la création -->
    <?php if(empty($_SESSION['connected'])): ?>
        <form action="" method="post">
            <input type="text" placeholder="Pseudo du compte" name="pseudo" 
            <?php if(isset($state)&&$state ==="Pseudo déjà utilisé"):?>
                class="wrong"<?php endif ?>>
            <input type="password" placeholder="Entrez votre mot de passe" name="mdp" 
            <?php if(isset($state)&&$state ==="Mots de passe différents"):?>
                class="wrong"<?php endif ?>>
            <input type="password" placeholder="Entrez a nouveau votre mot de passe" name="mdpcheck"
            <?php if(isset($state)&&$state ==="Mots de passe différents"):
                ?>class="wrong"<?php endif ?>>
            <p><?php if(isset($state)){echo $state;} ?></p>
            <input type="submit" value="Créer votre compte">
        </form>
    <?php else: 
        header('Location: flux.php');
    endif; ?>
</main>
<?php require_once('footer.php');?>