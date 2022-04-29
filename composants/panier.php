<?php
session_start();

if (!isset($_SESSION['user'])){
    header('Location:../composants/connexion.php');
}

require ("../config/config.php");
require("../config/panier.class.php");
$panier = new panier();

if (isset($_GET['del'])){
    $panier->del($_GET['del']);
}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['payement'])){
  $_SESSION['panier']=null;
  $_SESSION['payer']=true;
  header('Location:../index.php'); 
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pannier</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">  
    <link rel="stylesheet" href="../css/style.css">         
</head>
<body>
<?php include('menu.php'); ?>

<section class="h-100 gradient-custom">
  <div class="container py-5">
    <div class="row d-flex justify-content-center my-4">
      <div class="col-md-8">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Votre panier</h5>
          </div>
          <div class="card-body">

            <?php            
            if (empty($_SESSION['panier'])){
                $data = array();
            } else {
                $recup = $bdd->prepare("SELECT * FROM produits WHERE id=?");
                $data = array();
                $cpt=0;
                foreach(array_keys($_SESSION['panier']) as $id):
                    $recup->execute(array($id));
                    $data[$cpt]= $recup->fetchAll(PDO::FETCH_OBJ);
                    $cpt++;
                endforeach;
            }
            $total = 0;
            for($i=0; $i<count($data); $i++):
              $produit = $data[$i][0];
            ?>
            <div class="row">

              <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                  <img src="<?= $produit->image ?>"
                    class="w-100" alt="Blue Jeans Jacket" />
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                  </a>
                </div>
              </div>

              <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                <p><strong><?= substr($produit->nom, 0, 25) ?></strong></p>

                <?php
                if (strlen($produit->description) >= 200){$final = " [...]";} 
                else {$final = "";} ?>
                <p><?php echo substr($produit->description, 0, 195); echo $final; ?></p>  
              </div>

              <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">  
                <p class="text-md-center">Quantiter : <?= $_SESSION['panier'][$produit->id] ?></p> 
                <p class="text-md-center"> <strong>Prix unitaire: <?= $produit->prix; ?> €</strong></p>
                <?php if($_SESSION['panier'][$produit->id]>1):?>
                <p class="text-md-center"> <strong>Prix total: <?= $_SESSION['panier'][$produit->id]*$produit->prix; ?> €</strong></p>
                <?php endif; ?>
                <p class="text-muted text-md-center">ref : <?= $produit->id; ?></p>
                <div class="row justify-content-center">
                    <a type="button" href="panier.php?del=<?= $produit->id; ?>" class="btn btn-warning mx-auto">Supprimer</a>
                </div>
              </div>

            </div>
            <hr class="my-4" />
            <?php $total+=$_SESSION['panier'][$produit->id]*$produit->prix; endfor;?>    
            
          </div>
        </div>

        <div class="card mb-4">
          <div class="card-body">
            <h5><strong>Résumé</strong></h5>
            <h5 class="mb-4">Total : <?= $total; ?> €</h5>
            <form method="post">
              <input type="submit" name="payement" class="btn btn-primary btn-lg btn-block" value="Payer" />
            </form>
          </div>
        </div>
        

      </div>
    </div>
  </div>
</section>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>