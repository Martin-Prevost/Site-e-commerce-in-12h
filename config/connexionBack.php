<?php
    session_start();
    require_once 'config.php';
    //test si les champs sont remplie
    if (isset($_POST['email']) && isset($_POST['password'])){
        $email = htmlspecialchars(strip_tags($_POST['email']));    //patcher des failles sécurité (enlever les balises php, html)
        $email = strtolower($email);       
        $password = htmlspecialchars(strip_tags($_POST['password']));    

        $verif = $bdd->prepare('SELECT id, pseudo, email, password, date_ins ,admin FROM utilisateurs WHERE email = ?');
        $verif->execute(array($email));
        $data = $verif->fetch();
        $row = $verif->rowCount();

        if ($row > 0){    //test si existe
            if (filter_var($email, FILTER_VALIDATE_EMAIL)){   //test email valide
                if (password_verify($password, $data['password'])){     //test password
                    $_SESSION['user'] = $data['pseudo'];
                    $_SESSION['admin'] = $data['admin'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['date_ins'] = $data['date_ins'];
                    $_SESSION['pannier'] = array();
                    $_SESSION['payer'] = false;
                    $_SESSION['id'] = $data['id'];
                    header('Location:../index.php');
                    
                } else header('Location: ../composants/connexion.php?login_err=password'); //si password invalide
            } else header('Location: ../composants/connexion.php?login_err=email');  //si email invalide
        } else header('Location: ../composants/connexion.php?login_err=already');  //si déjà connecté
    } else header('Location: ../composants/connexion.php'); 