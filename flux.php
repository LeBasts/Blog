<?php 
$pageName = "Flux";
require_once('header.php');
isconnected();
if(!empty($_POST['newPost'])){
    modifyPost($bdd,$_POST['newPost'],$_POST['previousPost']);
}
$infos = showBdd($bdd);
?>
<main>
    <div id="grid-profil">
        <div id="content1">
            <h1>Tous les utilisateurs</h1>
            <ul>
                <?php showUsers($bdd);?>
            </ul>
        </div>
        <div id="content">
            <div id="post">
                <button id="buttonPost" onclick="ajouterPost()" value="Nouveau Post">Nouveau Post</button>
                <?php if(isset($_POST['inputPost'])){
                    addPost($bdd,$_POST['inputPost'],$infos['pseudo']);
                 } ?>
                <h2>Post de tout le monde</h2>
                <?php deletePost($bdd,$_SESSION['connected']) ; showPost($bdd,$infos['id'],NULL);  ?>
            </div>
        </div>
        <div id="ads">
        </div>
    </div>
</main>
<?php require_once('footer.php');?>