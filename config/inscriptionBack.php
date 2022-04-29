<?php
    require_once 'config.php';          //pouvoir écrire dans la bdd
    //test si les champs sont remplie
    if (isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_bis'])){

        $pseudo = htmlspecialchars(strip_tags($_POST['pseudo'])); 
        $email = htmlspecialchars(strip_tags($_POST['email']));          
        $password = htmlspecialchars(strip_tags($_POST['password'])); 
        $password_bis = htmlspecialchars(strip_tags($_POST['password_bis']));
        $admin = 0;

        $verif = $bdd->prepare('SELECT pseudo, email, password FROM utilisateurs WHERE email = ?');
        $verif->execute(array($email));
        $data = $verif->fetch();
        $row = $verif->rowCount();

        if ($row == 0){ //test si existe pas
            if (strlen($pseudo) <= 100){    //test si pseudo pas trop long
                if (strlen($email) <= 100){    //test si email pas trop long
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)){   //test si email valide
                        if ($password == $password_bis){             //test mdp
                            $cost = ['cost' => 12];
                            $password = password_hash($password, PASSWORD_BCRYPT, $cost);
                            $insert = $bdd->prepare('INSERT INTO utilisateurs(pseudo, email, password, admin) VALUES(:pseudo, :email, :password, :admin)');
                            $insert->execute(array('pseudo' => $pseudo, 'email' => $email, 'password' => $password, 'admin' => $admin));
                            header('Location: ../composants/inscription.php?reg_err=success');

                        } else header('Location: ../composants/inscription.php?reg_err=mdp');  
                    } else header('Location: ../composants/inscription.php?reg_err=email');    //si email invalide
                } else header('Location: ../composants/inscription.php?reg_err=email_length'); //si trop long
            } else header('Location: ../composants/inscription.php?reg_err=pseudo_length');    //si trop long
        } else header('Location: ../composants/inscription.php?reg_err=already');              //si existe déjà
    }
