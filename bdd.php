<?php
function connectBdd(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "blog";

    try{
        $bdd = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connexion bdd réussie !";
    } catch(PDOException $e) {
        echo "Erreur : ".$e->getMessage();
    }

    return $bdd;
}
?>