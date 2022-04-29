<?php
session_start();
require_once 'config.php'; 

if (isset($_POST['pseudo'])){
    $pseudo = htmlspecialchars(strip_tags($_POST['pseudo'])); 
    if (strlen($pseudo) <= 100 && strlen($pseudo) > 0){
        $id = $_SESSION['id'];
        $recup = $bdd->prepare("UPDATE utilisateurs SET pseudo = ? WHERE id = ?");
        $recup->execute(array($pseudo, $id));
        $recup->closeCursor();
        $_SESSION['user'] = $pseudo;
        header('Location: ../composants/profile.php?reg_err=success');
        return;
    } else header('Location: ../composants/profile.php?reg_err=pseudo_length');   
} 
if (isset($_POST['email'])){
    $email = htmlspecialchars(strip_tags($_POST['email'])); 
        if (strlen($email) <= 100){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            $id = $_SESSION['id'];
            $recup = $bdd->prepare("UPDATE utilisateurs SET email = ? WHERE id = ?");
            $recup->execute(array($email, $id));
            $recup->closeCursor();
            $_SESSION['email'] = $email;
            $bool = false;
            header('Location: ../composants/profile.php?reg_err=success2');
            return;
        } else header('Location: ../composants/profile.php?reg_err=email');
    } else header('Location: ../composants/profile.php?reg_err=email_lenght');    
} 
if (isset($_POST['mdp']) && isset($_POST['mdp_verif'])){
    if ($_POST['mdp']==$_POST['mdp_verif']){
        $mdp = htmlspecialchars(strip_tags($_POST['mdp']));
        if (strlen($mdp) <= 100 && strlen($mdp) > 5){
            $cost = ['cost' => 12];
            $password = password_hash($mdp, PASSWORD_BCRYPT, $cost);
            $recup = $bdd->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
            $recup->execute(array($password, $id));
            $recup->closeCursor();
            header('Location: ../composants/profile.php?reg_err=success3');
            return;
        } else header('Location: ../composants/profile.php?reg_err=mdp_lenght');
    } else header('Location: ../composants/profile.php?reg_err=mdp_diff');   
} else header('Location: ../composants/profile.php');

