<?php

require("config/commande.php");
$tabProduits=afficher();      //tableau avec tout les produits
session_start();

require("config/panier.class.php");
$panier = new panier();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BestShop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include('composants/menu.php'); ?> 

<h5><?php if(isset($_SESSION['payer'])){if($_SESSION['payer']==true){echo "Payement validé";}} ?></h5>

<main>
  <section class="text-center container mt-5">
    <div class="row py-2">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Bienvenu sur BestShop</h1>
        <p class="lead text-muted">Nous somme le meilleurs site e-commerce ! Nous vendons de nombreux produits, dont certains d'une extrême rareté.</p>
        <p>
          <a href="/composants/produit.php" class="btn btn-primary my-2">Voir les produits</a>
        </p>
      </div>
    </div>
  </section>
  <div class="text-center mb-4"><h4>Voici les dernières nouveautées</h4></div>
  <div class="text-center mb-2">
  <svg height="5" width="50%">
      <line x1="0" y1="0" x2="10000" y2="0" style="stroke:rgb(235, 152, 78);stroke-width:5"></line>
  </svg></div>
  

  <div class="py-4">
    <div class="container">

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        <?php $cpt=0; $_SESSION['payer'] = false; foreach($tabProduits as $produit): if($cpt>2){break;}?>
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
                    <div class="text-center"><a href="config/addpanier.php?id=<?= $produit->id ?>" class="btn btn-info">Acheter</a></div>
                    <small class="text-muted">ref : <?= $produit->id; ?></small>
                </div>
                <p class="text-muted mt-2"><?= $produit->prix ?> €</p>
            </div>
            </div>
        </div>
        <?php $cpt++; endforeach; ?>

      </div>
    </div>
  </div>

  
  <div class="text-center mb-4"><a href="/composants/produit.php" class="btn btn-primary my-2">Voir plus de produits</a></div>
  <div class="text-center mb-5">
        <svg height="5" width="50%">
            <line x1="0" y1="0" x2="10000" y2="0" style="stroke:rgb(235, 152, 78);stroke-width:5"></line>
        </svg>
  </div>

</main>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>