<?php
$backOfficeAdmin = '<li></li>';
?>
<?php
if (!user_is_admin()) { // TODO invert that condition once security is implemented
    ?>
    <?php ob_start(); ?>

    <li class="nav-item">
        <a class="nav-link">|</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/view/back-office/usersView.php">Membres</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?action=listRooms">Salles</a>
    </li>
    <a href="?action=add"></a>
    <li class="nav-item">
        <a class="nav-link" href="/view/back-office/ordersView.php">Commandes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/view/back-office/ratingsView.php">Avis</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/view/back-office/productsView.php">Produits</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/view/back-office/statsView.php">Statistiques</a>
    </li>
    

    <?php $backOfficeAdmin = ob_get_clean(); ?>
    <?php
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Switch | <?= $title ?></title>
    <link href="../../css/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../../css/shop-homepage.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/styles.css">
</head>

<!------------>
<!-- HEADER -->
<!------------>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href=""><?= $title ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=login">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=signup">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/view/front-office/profileView.php">Profil</a>
                    </li>
                    <?= $backOfficeAdmin ?>
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
<p id="phpMsg"><?php if (!empty($msg)) {
        echo $msg;
    } ?></p>
<?php echo '$_GET = ';
var_dump($_GET);
echo '<br>';
echo '$_POST = ';
var_dump($_POST);
echo '<br>';
echo '$_FILES = ';
var_dump($_FILES);?>
<?= $content ?>
</body>
<!------------->
<!-- CONTENT -->
<!------------->

<!------------>
<!-- FOOTER -->
<!------------>
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; SwitchCo 2020</p>
    </div>
    <script src="../../css/vendor/jquery/jquery.min.js"></script>
</footer>
<!------------>
<!-- FOOTER -->
<!------------>

</html>


<!--TODO is that useful here?-->
<!--    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"-->
<!--            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"-->
<!--            crossorigin="anonymous"></script>-->