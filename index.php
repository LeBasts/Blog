<?php 
require_once('header.php');
isconnected();
?>
<main>
    <?php
        showBdd($bdd);
    ?>
</main>
<?php require_once('footer.php');?>