<?php
function connectBdd(){
    $servername = "localhost";
    $username = "root";
    $password = "";

    try{
        $bdd = new PDO("mysql:host=$servername;dbname=blog", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connexion bdd réussie !";
    } catch(PDOException $e) {
        echo "Erreur : ".$e->getMessage();
    }

    return $bdd;
}
function isconnected(){
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    if(empty($_SESSION['connected'])){
        header('Location: login.php');
    }
}
function delete($bdd, $pseudo){
    $req = $bdd->exec("DELETE FROM user WHERE pseudo = '$pseudo'");
    //$req = execute(['$pseudo']);
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
        // $pseudo = "bastun";
        // $mdp = 1111;
        // $req = $bdd->prepare("INSERT INTO user VALUES(NULL, :pseudo, :mdp, '')");
        // $req->execute(
        //     array(
        //         "pseudo" => $pseudo,
        //         "mdp" => $mdp
        //     )
        // );
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
    $reqVerif = $bdd->query("SELECT * FROM user WHERE pseudo = '$pseudo'"); 
    $hashed_pswd = $reqVerif->fetch(PDO::FETCH_ASSOC)['mdp'];
    if(password_verify($mdp, $hashed_pswd)){
        $exist = true;
        echo $exist;
    }
    return $exist;
}
function addPost($bdd,$post,$pseudo){
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
function modifyPost(){

}
function showPost($bdd,$id){
    if($id===NULL){
        $req = $bdd->query("SELECT u.pseudo, p.message FROM post p JOIN user u WHERE p.id_user = u.id");
        while($rep = $req->fetch()){
            echo "<div>".$rep['message']." - ".$rep['pseudo']."</div>";
        }
    } else {
        $req = $bdd->query("SELECT message, id_user FROM post WHERE id_user = $id");
        while($rep = $req->fetch()){
            echo "<div>".$rep['message']."</div>";
        }
    }
}
function deletePost(){

}