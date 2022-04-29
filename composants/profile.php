<?php
session_start();
if (!isset($_SESSION['user'])){
    header('Location:../index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Mon Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include('menu.php'); ?> 

<div class="container mt-5 mb-4">
    <h3 class="mb-4">Votre profile <?php if($_SESSION['admin']==1){echo "administrateur";}?>: </h3>
    <h4 class="mb-2">Pseudo : <?= $_SESSION['user']?></h4>
    <h4 class="mb-2">Adresse mail : <?= $_SESSION['email']?></h4>
    <h4 class="mb-2">Date de creation du compte : <?= $_SESSION['date_ins']?></h4>
</div>

<div class="text-center">
        <svg height="5" width="50%">
            <line x1="0" y1="0" x2="10000" y2="0" style="stroke:rgb(235, 152, 78);stroke-width:5"></line>
        </svg>
</div>
<div class="container">
<?php
if (isset($_GET['reg_err'])){
    $err = htmlspecialchars($_GET['reg_err']);
    echo $err;
    switch ($err){
        case 'email_length':
            ?>
            <div class="alert alert-danger">
                <strong>Erreur</strong> sur la longeur de l'email
            </div>
            <?php
            break;
        case 'email':
            ?>
            <div class="alert alert-danger">
                <strong>Erreur</strong> email incorrect
            </div>
            <?php
            break;
        case 'pseudo_length':
            ?>
            <div class="alert alert-danger">
                <strong>Erreur</strong> sur la longeur du pseudo
            </div>
            <?php
            break;
        case 'success':
            ?>
            <div class="alert alert-success">
                <strong>Succès</strong> le pseudo a etait changé
            </div>
            <?php
            break;
        case 'success2':
            ?>
            <div class="alert alert-success">
                <strong>Succès</strong> l'email a etait changé
            </div>
            <?php
            break;
        case 'success3':
            ?>
            <div class="alert alert-success">
                <strong>Succès</strong> mot de passe bien changé
            </div>
            <?php
            break;
        case 'mdp_diff':
            ?>
            <div class="alert alert-danger">
                <strong>Erreur</strong> les deux mots de passe sont différents
            </div>
            <?php
            break;
        case 'mdp_lenght':
            ?>
            <div class="alert alert-danger">
                <strong>Erreur</strong> longeur incorrect
            </div>
            <?php
            break;
    }
}
?>
</div>
<div class="container mt-4">
    <form action="../config/profilModif.php" method="post">
    <h4>Modifier votre profil</h4>

    <div class="form-group">
    <label>Nom</label>
    <textarea type="text" class="form-control" name="pseudo"></textarea></div>
    <button type="submit" name="changerPseudo" class="btn btn-primary">Changer le pseudo</button>

    <div class="form-group mt-2">
    <label>Email</label>
    <textarea type="email" class="form-control" name="email"></textarea></div>
    <button type="submit" name="changerEmail" class="btn btn-primary">Changer l'email</button>

    <div class="form-group mt-2">
    <label>Mot de passe</label>
    <textarea type="text" class="form-control" name="mdp"></textarea></div>
    <label>Mot de passe (confirm)</label>
    <textarea type="text" class="form-control mb-3" name="mdp_verif"></textarea>
    <button type="submit" name="changerMDP" class="btn btn-primary mb-5">Changer le mot de passe</button></div>

</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>