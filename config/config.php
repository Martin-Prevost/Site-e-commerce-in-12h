<?php
//connexion à la bdd
try {   
    $bdd=new pdo("mysql:host=localhost;dbname=shop_bd;charset=utf8", "root", "");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (Exception $e) {  
    $e->getMessage();       //récup message d'erreur
}

?>