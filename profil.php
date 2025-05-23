<?php 
$pageName = "Profil";
require_once('header.php');
isconnected();
$infos = showBdd($bdd);
//addPost($bdd,'ok',$infos['pseudo']);
?>
<main>
    <div id="grid-profil">
        <div id="content1">
            <h1>Profil de <?= $infos['pseudo'] ?></h1>
            <h3>Date d'inscription : 
            <?php 
                $dateInscription = explode(' ',$infos['dateInscription']);
                echo $dateInscription[0];     
            ?></h3>
            <a href="deleteAccount.php" class="delete">Supprimer mon compte</a>
        </div>
        <div id="content">
            <div id="post">
                <button id="buttonPost" onclick="ajouterPost()" value="Nouveau Post">Nouveau Post</button>
                <?php if(isset($_POST['inputPost'])){
                    addPost($bdd,$_POST['inputPost'],$infos['pseudo']);
                 } ?>
            </div>
            <div>
                <h2>Mes posts</h2>
                <?php deletePost($bdd,$_SESSION['connected']) ;showPost($bdd,$infos['id'],1);  ?>
            </div>
        </div>
        <div id="ads">
        </div>
    </div>
</main>
<?php require_once('footer.php');?>