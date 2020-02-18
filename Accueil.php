<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Switch</title>

    <!-- Bootstrap core CSS -->
    <link href="css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">

</head>

<body>


    <!------------------DEBUT SIDEBAR------------------------------------------------------>

    <div class="d-flex" id="wrapper">
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">catégorie </div><br>
            <div class="list-group list-group-flush">

                <a href="#" class="list-group-item list-group-item-action bg-light">Réunion</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Bureau</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Formation</a><br>
                <div class="sidebar-heading">Ville </div>
                <a href="#" class="list-group-item list-group-item-action bg-light">Paris</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Lyon</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Marseille</a><hr>
                <div class="sidebar-heading">Capacité</div><hr>
                <select name="capacite" id="capacite" class="form-control"><hr>
                    <option>1</option>
                    <option>5</option>
                    <option>20</option>
                    <option>50</option>
                    <option>100</option>
                </select><hr>
                <div class="sidebar-heading">Prix</div>
                <input type="range" value="15" max="1000" min="0" step="10"><hr>
                <div class="sidebar-heading">Période</div>
                <li>Date d'arrivée</li>
                <input type="date" name="reservation"><hr>
                <li>Date de départ</li>
                <input type="date" name="reservation">

            </div>
        </div>
        <!----------------------------Fin SIDEBAR----------------------------------------------->


        <!------------------DEBUT NAVBAR------------------------------------------------------>


        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">Switch</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Qui sommes nous
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="fiche_produit.php">fiche produit</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="connexion.php">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gestion_membre.php">gestion membre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gestion_salles.php">gestion salles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gestion_commandes.php">gestion commandes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gestion_avis.php">gestion avis</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="statistiques.php">statistiques</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!----------------------------Fin NAVBAR----------------------------------------------->

        <!-- Page Content -->

        <div class="row">

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="img/salle1.jpg" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">Bureau Monet</a>
                        </h4>
                        <h5>1200 €</h5>
                        <p class="card-text">Parfait pour une réunion</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="img/salle2.jpg" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">Salle Cézanne</a>
                        </h4>
                        <h5>990 €</h5>
                        <p class="card-text">Salle spacieuse.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="img/salle11.jpg" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">Salle Renoir</a>
                        </h4>
                        <h5>870 €</h5>
                        <p class="card-text">Si vous avez...</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="img/salle4.jpg" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">Salle Van Gogh</a>
                        </h4>
                        <h5>1500 €</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="img/salle5.jpg" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">Salle Duchamp</a>
                        </h4>
                        <h5>750 €</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! Lorem ipsum dolor sit amet.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="img/salle6.jpg" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">Bureau Bazille</a>
                        </h4>
                        <h5>590 €</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="img/salle7.jpg" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">Salle Klee</a>
                        </h4>
                        <h5>1350 €</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="img/salle12.jpg" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">Salle Rubens</a>
                        </h4>
                        <h5>1200 €</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! Lorem ipsum dolor sit amet.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="img/salle9.jpg" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">Salle Monet</a>
                        </h4>
                        <h5>710 €</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->


        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->
    </div>
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="css/vendor/jquery/jquery.min.js"></script>
    <script src="css/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<?php
include 'inc/footer.inc.php'

?>