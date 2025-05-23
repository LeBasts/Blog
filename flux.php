<?php 
require_once('header.php');
isconnected();
?>
<main>
    <div id="grid-profil">
        <div id="content">
            <div id="post">
                <?php if(isset($_POST['inputPost'])){
                    addPost($bdd,$_POST['inputPost'],$infos['pseudo']);
                 } ?>
            </div>
            <div>
                <h2>Post de tout le monde</h2>
                <?php showPost($bdd,NULL);  ?>
            </div>
        </div>
        <div id="ads">
        </div>
    </div>
</main>
<?php require_once('footer.php');?>