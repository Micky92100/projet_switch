<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Switch | <?= $title ?></title>
    <link href="css/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css" rel="stylesheet">
</head>

<!------------>
<!-- HEADER -->
<!------------>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="">Switch</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="product-details/product-details.php">Fiche produit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login/login.php">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users/users.php">Membre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rooms/rooms.php">Salles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="orders/orders.php">Commandes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ratings/ratings.php">Avis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products/products.php">Produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="stats/stats.php">Statistiques</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile/profile.php">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signup/signup.php">Inscription</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!------------>
<!-- HEADER -->
<!------------>

<!------------->
<!-- CONTENT -->
<!------------->
<body>
    <p style="color: #721c24"><?= $msg ?></p>
    <?= $content ?>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="css/vendor/jquery/jquery.min.js"></script>
</body>
<!------------->
<!-- CONTENT -->
<!------------->

<!------------>
<!-- FOOTER -->
<!------------>
<footer>
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; SwitchCo 2020</p>
    </div>
</footer>
<!------------>
<!-- FOOTER -->
<!------------>

</html>