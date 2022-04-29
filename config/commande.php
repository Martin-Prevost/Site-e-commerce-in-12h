<?php
//ajouter des produit a la bdd dans la table produits
function ajouter($image, $nom, $prix, $desc){
    if (require("config.php")){      //si connexion a la bdd
        $recup = $bdd->prepare("INSERT INTO produits(image, nom, prix, description) VALUES (:image, :nom, :prix, :desc)");
        $recup->execute(array('image' => $image,'nom' => $nom, 'prix' => $prix, 'desc' => $desc));
        $recup->closeCursor();
    }
}
//récupérer les produits de la bdd et les renvoyer sous forme de tableau : $data
function afficher(){
    if (require("config.php")){     //si connexion a la bdd
        $recup = $bdd->prepare("SELECT * FROM produits ORDER BY id DESC");
        $recup->execute();
        $data = $recup->fetchAll(PDO::FETCH_OBJ);
        return $data;
        $recup->closeCursor();
    }
}
//supprimer un produit de la bdd avec l'id
function supprimer($id){
    if (require("config.php")){
        $recup = $bdd->prepare("DELETE FROM produits WHERE id = ?");
        $recup->execute(array($id));
        $recup->closeCursor();
    }
}
function listUser(){
    if (require("config.php")){     //si connexion a la bdd
        $recup = $bdd->prepare("SELECT * FROM utilisateurs ORDER BY id");
        $recup->execute();
        $data = $recup->fetchAll(PDO::FETCH_OBJ);
        return $data;
        $recup->closeCursor();
    }
}
?>