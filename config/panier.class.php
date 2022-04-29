<?php
class panier{

    public function __construct() {       
        if (!isset($_SESSION)){
            session_start();
        }
        if (!isset($_SESSION['pannier'])){
            $_SESSION['pannier'] = array();
        }
        //var_dump($_SESSION);
    }

    public function add($idProd){
        try {   
            $_SESSION['panier'][$idProd]+=1;
        } catch (Error $e) {  
            $_SESSION['panier'][$idProd]=1;    
        }       
    }

    public function del($idSup){
        unset($_SESSION['panier'][$idSup]);
    }
}