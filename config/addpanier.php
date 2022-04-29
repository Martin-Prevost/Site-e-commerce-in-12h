<?php
require 'config.php';
require("panier.class.php");
session_start();
if (!isset($_SESSION['user'])){
    header('Location:../composants/connexion.php');
}
$panier = new panier();

if (isset($_GET['id'])){
    $recup = $bdd->prepare("SELECT id FROM produits WHERE id=?");
    $recup->execute(array($_GET['id']));
    $data = $recup->fetchAll(PDO::FETCH_OBJ);
    if (empty($data)){
        header('Location:../composants/produit.php');
    }
    $panier->add($data[0]->id);
    header('Location:../composants/produit.php');
} else {
    header('Location:../composants/produit.php');
}
?>