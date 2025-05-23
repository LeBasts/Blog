<?php 
    require_once('header.php');
    if(!empty($_POST['pseudo']) && !empty($_POST['mdp']) && !empty($_POST['mdpcheck'])){
        $pseudo = $_POST['pseudo'];
        $mdp = $_POST['mdp'];
        $mdpcheck = $_POST['mdpcheck'];
        $state = addUser($bdd,$pseudo,$mdp,$mdpcheck);
    }
?>
<body>
    <!-- Ajouter une vérification du mot de passe a la création -->
    <?php if(empty($_SESSION['connected'])): ?>
        <form action="" method="post">
            <input type="text" placeholder="Pseudo du compte" name="pseudo">
            <input type="password" placeholder="Entrez votre mot de passe" name="mdp">
            <input type="password" placeholder="Entrez a nouveau votre mot de passe" name="mdpcheck">
            <p><?php if(isset($state)){echo $state;} ?></p>
            <input type="submit" value="Créer votre compte">
        </form>
    <?php else: 
        header('Location: flux.php');
    endif; ?>
</body>
<?php require_once('footer.php');?>