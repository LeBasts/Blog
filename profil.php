<?php 
require_once('header.php');
isconnected();
$infos = showBdd($bdd);
//addPost($bdd,'ok',$infos['pseudo']);
?>
<main>
    <div id="grid-profil">
        <div id="profil">
            <h1>Profil de <?= $infos['pseudo'] ?></h1>
            <h2>Date d'inscription : 
            <?php 
                $dateInscription = explode(' ',$infos['dateInscription']);
                echo $dateInscription[0];     
            ?></h2>
            <a href="deleteAccount.php" class="delete">Supprimer mon compte</a>
        </div>
        <div id="content">
            <div id="post">
                <button id="buttonPost" onclick="ajouterPost()">Nouveau Post</button>
                <?php if(isset($_POST['inputPost'])){
                    addPost($bdd,$_POST['inputPost'],$infos['pseudo']);
                 } ?>
            </div>
            <div>
                <h2>Mes posts</h2>
                <?php showPost($bdd,$infos['id']);  ?>
            </div>
        </div>
        <div id="ads">
        </div>
    </div>
</main>
<?php require_once('footer.php');?>