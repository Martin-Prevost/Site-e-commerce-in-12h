<nav class="navbar navbar-expand-md navbar-light" style="background-color: #EB984E;">
    <a class="navbar-brand text-light px-3 font-weight-bold" href="/index.php">BestShop</a>
    <button 
        type="button" 
        class="navbar-toggler bg-light" 
        data-toggle="collapse" 
        data-target="#navmenuid">
        <spam class="navbar-toggler-icon"></spam>
    </button>
    <div class="collapse navbar-collapse" id="navmenuid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-light px-3" href="/index.php">Accueil</a></li>
            <li class="nav-item">
                <a class="nav-link text-light px-3" href="/composants/produit.php">Produits</a></li>
            <?php           
            if (!isset($_SESSION['user'])){
                ?>
                <li class="nav-item">
                    <a class="nav-link text-light px-3" href="/composants/connexion.php">Connexion</a></li> 
                <li class="nav-item">
                    <a class="nav-link text-light px-3" href="/composants/inscription.php">Inscription</a></li> 
                <?php
            }
            if (isset($_SESSION['user'])){
                ?>
                <li class="nav-item">
                    <a class="nav-link text-light px-3" href="/composants/deconnexion.php">Déconnexion</a></li> 
                <li class="nav-item">
                    <a class="nav-link text-light px-3" href="/composants/profile.php">Mon Profile</a></li>     
                <?php
                if ($_SESSION['admin']==1){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-light px-3" href="/admin/admin.php">Page Admin</a></li> 
                    <?php
                }
            }
            ?>
            <li class="nav-item">
                    <a class="nav-link text-light px-3" href="/composants/panier.php">Panier</a></li> 
        </ul> 
    </div>
</nav>