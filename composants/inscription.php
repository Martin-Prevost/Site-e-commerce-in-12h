<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inscription</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">           
</head>
<body>
<?php include('menu.php'); ?>
<section class="vh-100" style="background-color: #EB984E;">
    <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
        <?php 
            if (isset($_GET['reg_err'])){
                $err = htmlspecialchars($_GET['reg_err']);
                switch ($err){
                    case 'email_length':
                        ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> email trop long
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
                            <strong>Erreur</strong> pseudo trop long
                        </div>
                        <?php
                        break;
                    case 'already':
                        ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> déjà inscrit
                        </div>
                        <?php
                        break;
                    case 'mdp':
                        ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> passwords différents
                        </div>
                        <?php
                        break;
                    case 'success':
                        ?>
                        <div class="alert alert-success">
                            <strong>Succès</strong> inscription reussi !
                        </div>
                        <?php
                        break;
                }
            }
            ?>
            <form action="../config/inscriptionBack.php" method="post">
            <div class="card-body p-5 text-center">
            <h3 class="mb-5">Sign up</h3>

            <div class="form-outline mb-4">
              <input type="text" name="pseudo" class="form-control form-control-lg" placeholder="Pseudo" required="required">
            </div>
            <div class="form-outline mb-4">
              <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required="required">
            </div>
            <div class="form-outline mb-4">
              <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required="required">
            </div>
            <div class="form-outline mb-4">
              <input type="password" name="password_bis" class="form-control form-control-lg" placeholder="Confirm password" required="required">
            </div>

            <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>

</body>
</html>