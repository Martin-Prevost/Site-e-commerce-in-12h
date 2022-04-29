<?php
session_start();
if ($_SESSION['admin']!=1){    //verif si user est un admin
    header('Location:../index.php');
}
require("../config/commande.php");

if(isset($_POST['valider'])){
    if(isset($_POST['image']) && isset($_POST['nom']) && isset($_POST['prix']) && isset($_POST['desc'])){
        if(!empty($_POST['image']) && !empty($_POST['nom']) && !empty($_POST['prix']) && !empty($_POST['desc'])){
        
        $image = htmlspecialchars(strip_tags($_POST['image']));
        $nom = htmlspecialchars(strip_tags($_POST['nom']));
        $prix = htmlspecialchars(strip_tags($_POST['prix']));
        $desc = htmlspecialchars(strip_tags($_POST['desc']));
        
        try {
            ajouter($image, $nom, $prix, $desc);
        } 
        catch (Exception $e) {
            $e->getMessage();
        }
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Page Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include('../composants/menu.php'); ?> 

<div class="container mt-5">
    <h1>Ajouter un produit</h1>
    <legend>Veuillez remplir les différents champs</legend>
    
    <form method="post">

    <div class="form-group">
    <label>Nom de l'article</label>
    <input type="text" class="form-control" name="nom" required></div>
    
    <div class="form-group">
    <label>Lien de l'image</label>
    <input type="text" class="form-control" name="image" required></div>
    
    <div class="form-group">
    <label>Description</label>
    <textarea type="text" class="form-control" name="desc" rows="3" required></textarea></div>

    <div class="form-group">
    <label>Prix</label>
    <textarea type="int" class="form-control" name="prix" required></textarea></div>

    <button type="submit" name="valider" class="btn btn-primary">Ajouter un nouveau produit</button>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>