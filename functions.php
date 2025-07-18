<?php
include('bdd.php');
function isconnected(){
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    if(empty($_SESSION['connected'])){
        header('Location: login.php');
    }
}
function showBdd($bdd){
    // $sql = "SELECT * FROM user";
    // $req = $bdd->query($sql);
    // while($rep = $req->fetch()){
    //     echo "<br>".$rep['pseudo']."<br>".$rep['mdp']."<br>";
    // }
    $pseudo = 'bast';
    $req2 = $bdd->prepare("SELECT * FROM user WHERE pseudo = ?");
    $req2 -> execute(['bast']);
    $reponse = $req2->fetchAll(PDO::FETCH_ASSOC);
    
    $pseudo = $_SESSION['connected'];
    $req3 = $bdd->prepare("SELECT * FROM user WHERE pseudo = :pseudo");
    $req3 -> execute(
        array(
            "pseudo" => "$pseudo"
            )
        );
        $reponse3 = $req3->fetch(PDO::FETCH_ASSOC);
        $infos = [
            'id' => $reponse3["id"],
            'pseudo' => $reponse3["pseudo"],
            'mdp' => $reponse3['mdp'],
            'dateInscription' => $reponse3['dateInscription']
        ];
        return $infos;
    }
function addUser($bdd,$pseudo,$mdp){
    $reqVerif = $bdd->prepare("SELECT * FROM user WHERE pseudo = :pseudo"); 
    $reqVerif->execute(
        array(
            "pseudo" => "$pseudo"
            )
        );
        $reponse = $reqVerif->fetchAll(PDO::FETCH_ASSOC);
    if(empty($reponse)){
        $mdp = password_hash($mdp, PASSWORD_DEFAULT);
        $state = "Bienvenue !";
        $req = $bdd->prepare("INSERT INTO user VALUES(NULL, :pseudo, :mdp, :dateInscription)");
        $req->execute(
            array(
                "pseudo" => $pseudo,
                "mdp" => $mdp,
                "dateInscription" => date("Y-m-d H:i:s")
            )
        );
        $state = "Compte créé";
    } else {
        $state = "Pseudo déjà utilisé";
    }
    return $state;
}
function userExist($bdd,$pseudo,$mdp){
    $exist = false;
    $reqVerif = $bdd->prepare("SELECT * FROM user WHERE pseudo = :pseudo"); 
    $reqVerif->execute(
        array(
            "pseudo" => $pseudo
        )
    );
    $reqVerif = $reqVerif->fetch();
    if($reqVerif || is_array($reqVerif)){
        echo "oui oui uoui";
        $hashed_pswd = $reqVerif['mdp'];
        echo $hashed_pswd;
        
        if(password_verify($mdp, $hashed_pswd)){
                $exist = true;
            }
    }
    return $exist;
}
function addPost($bdd,$post,$pseudo){
    $post = htmlspecialchars($post);
    if(!empty($post)){
        $reqVerif = $bdd->query("SELECT id FROM user WHERE pseudo = '$pseudo'");
        $userId = $reqVerif->fetch(PDO::FETCH_ASSOC)['id'];
        $req = $bdd->prepare("INSERT INTO post VALUES (NULL,:post,$userId)");
        $req->execute(
            array(
                "post" => "$post"
            )
        );
    }
}
function modifyPost($bdd,$post,$previousPost){
    $req = $bdd->prepare("UPDATE post SET message = :post WHERE message = :ancienPost");
    $req -> execute(
        array(
            "post" => $post,
            "ancienPost" => $previousPost
        )
    );
}
function showPost($bdd,$id,$public){
    if($public === NULL){
        $req = $bdd->query("SELECT u.pseudo, p.message, u.id, p.id AS postId FROM post p JOIN user u WHERE p.id_user = u.id");
        while($rep = $req->fetch()){
            if($rep['id'] === $id){
                $href = $rep['postId'];
                $modify = " <a class=\"edit modif\" id=\"$href\" onclick=\"modify($href)\">Modifier</a>"; //href=\"flux.php?modif=$href\"
                $suppr = " <a class=\"edit suppr\" href=\"flux.php?suppr=$href\">Supprimer</a>";
            } else {
                $modify = NULL;
                $suppr = NULL;
            }
            echo "<div><p>".$rep['message']."</p> <p>- ".$rep['pseudo']."</p>".$suppr.$modify."</div>";
        }
    } else {
        $req = $bdd->query("SELECT message, id_user, id AS postId FROM post WHERE id_user = $id");
        while($rep = $req->fetch()){
            $href = $rep['postId'];
            echo "<div><p>".$rep['message']."</p> <a class=\"edit suppr\" href=\"profil.php?suppr=$href\">Supprimer</a>"." <a class=\"edit modif\" id=\"$href\" onclick=\"modify($href)\" >Modifier</a>"."</div>";
        }
    }
}
function showUsers($bdd){
    $req = $bdd->query("SELECT pseudo FROM user");
    while($rep = $req->fetch()){
        echo "<li>".$rep['pseudo']."</li>";
    }
}
function deletePost($bdd,$user){
    if(isset($_GET['suppr'])){
        $postId = $_GET['suppr'];
        $reqVerif = $bdd->query("SELECT p.id as postId, u.id as userId, u.pseudo, p.message FROM post p JOIN user u ON u.id = p.id_user WHERE p.id = $postId");
        while($rep = $reqVerif->fetch()){
            if($rep['pseudo'] === $user){                
                $req = $bdd->query("DELETE FROM post WHERE post.id = '$postId'");
            }
        }
    }

}
function delete($bdd, $pseudo){
    $req = $bdd->exec("DELETE FROM user WHERE pseudo = '$pseudo'");
    $id_user = $bdd->query("SELECT id FROM user WHERE pseudo = '$pseudo'");
    $id_user = $id_user->fetch();
    $id_user = $id_user['id'];
    $reqPost = $bdd->exec("DELETE FROM post WHERE id_user = '$id_user'");
    
}