<?php 
$pageName = "Flux";
require_once('header.php');
isconnected();
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
                <?php if(isset($_POST['inputPost'])){
                    addPost($bdd,$_POST['inputPost'],$infos['pseudo']);
                 } ?>
            </div>
            <div>
                <h2>Post de tout le monde</h2>
                <?php showPost($bdd,$infos['id'],NULL);  ?>
            </div>
        </div>
        <div id="ads">
        </div>
    </div>
</main>
<?php require_once('footer.php');?>