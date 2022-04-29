<?php

require("../config/commande.php");
$tabProduits=afficher();      //tableau avec tout les produits
session_start();

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['refCroi'])){
  sort($tabProduits);
}
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['refDesc'])){
  rsort($tabProduits);
}
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['prixCroi'])){
  for ($i=0; $i<count($tabProduits);$i++){
    for ($j=$i+1; $j<count($tabProduits);$j++){
      if ($tabProduits[$j]->prix < $tabProduits[$i]->prix){
        $temp = $tabProduits[$j];
        $tabProduits[$j] = $tabProduits[$i];
        $tabProduits[$i] = $temp;
      }
    }
  }
}
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['prixDesc'])){
  for ($i=0; $i<count($tabProduits);$i++){
    for ($j=$i+1; $j<count($tabProduits);$j++){
      if ($tabProduits[$j]->prix > $tabProduits[$i]->prix){
        $temp = $tabProduits[$j];
        $tabProduits[$j] = $tabProduits[$i];
        $tabProduits[$i] = $temp;
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
    <title>BestShop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include('menu.php'); ?> 

<div class="py-2 bg-light text-center">
<form method="post">
    <input type="submit" name="refCroi" class="btn btn-primary my-2" value="Ref par ordre croissant" />
    <input type="submit" name="refDesc" class="btn btn-primary my-2" value="Ref par ordre décroissant" />
    <input type="submit" name="prixCroi" class="btn btn-primary my-2" value="Prix par ordre croissant" />
    <input type="submit" name="prixDesc" class="btn btn-primary my-2" value="Prix par ordre décroissant" />
</form>
</div>

<main>
  <div class="py-2 bg-light">
    <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        <?php foreach($tabProduits as $produit):?>
        <div class="col mb-4">
            <div class="card shadow">
            <img src="<?= $produit->image ?>" height="225">
            <div class="card-body">
              <h3><?= substr($produit->nom, 0, 20) ?></h3>             
                <?php
                if (strlen($produit->description) >= 200){$final = " [...]";} 
                else {$final = "";}
                ?>
                <p class="textProb"><?php echo substr($produit->description, 0, 195); echo $final; ?></p>  
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-center"><a href="../config/addpanier.php?id=<?= $produit->id ?>" class="btn btn-info">Acheter</a></div>
                    <small class="text-muted">ref : <?= $produit->id ?></small>
                </div>
                <p class="text-muted mt-2"><?= $produit->prix ?> €</p>
            </div>
            </div>
        </div>
        <?php endforeach; ?>

      </div>
    </div>
  </div>
</main>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>