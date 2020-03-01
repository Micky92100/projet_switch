<?php
include 'inc/init.inc.php';
include 'inc/function.inc.php';
?>

    <br>
    <br>
    <br>


    <!--refaire la requçte pour afficher les produit(enjointure vers salle et en jointure)
    et effectuer pour le formuliare-->
<?php
// récupération des catégories en BDD


// Récupération des titre en BDD
$liste_produit = $pdo->query("SELECT salle.id_salle, titre, description, photo, prix, date_arrivee, date_depart FROM salle, produit
WHERE produit.id_salle = salle.id_salle AND date_arrivee > NOW()");

$nbre_salle = $liste_produit->rowCount();


$id_salle = '';    // pour la modification

$_GET['action'] = 'affichage';

?>

<?php

//  } else if(isset($_GET['ville'])) {
//      $choix_ville = $_GET['ville'];
//     $liste_produit = $pdo->prepare("SELECT * FROM salle WHERE ville =
//      :ville ORDER BY titre");
//     $liste_produit->bindParam(':ville', $choix_ville, PDO::PARAM_STR);
//      $liste_produit->execute();
//    } else {
//     $liste_produit = $pdo->query("SELECT * FROM salle ORDER BY titre");
//     }   

var_dump($_GET);
include 'inc/nav.inc.php';
?>

    <div class="starter-template">
        <h1><i style="color: #4c6ef5;"></i> Accueil <i class="fas fa-ghost" style="color: #4c6ef5;"></i></h1>
        <p class="lead"><?php echo $msg; ?></p>
    </div>

    <div class="row">
    <div class="col-3">
        <!--------------------->
        <!-- ADVANCED SEARCH -->
        <!--------------------->
        <form><!-- method="post" action="model/model.php"-->
            <label for="category">Catégories</label>
            <select name="category" id="category" class="form-control">
                <option value="1">Réunion</option>
                <option value="2">Bureau</option>
                <option value="3">Formation</option>
            </select>

            <label for="city">Ville</label>
            <select name="city" id="city" class="form-control">
                <option value="paris">Paris</option>
                <option value="lyon">Lyon</option>
                <option value="marseille">Marseille</option>
            </select>

            <label for="capacity">Capacité min</label>
            <input type="number" min="0" name="capacity" id="capacity" class="form-control" step="5">

            <label for="price">Prix max</label>
            <input type="number" min="0" name="price" id="price" class="form-control" step="10">

            <label for="arrival">Date d'arrivée</label>
            <input type="date" name="arrival" id="arrival" class="form-control">

            <label for="departure">Date de départ</label>
            <input type="date" name="departure" id="departure" class="form-control"><br>

            <button type="submit" class="btn-primary form-control">Rechercher</button>
            <button type="reset" class="btn-danger form-control">Réinitialiser</button>
        </form>
        <!--------------------->
        <!-- ADVANCED SEARCH -->
        <!--------------------->
    </div>
    <div class="col-9">
        <div class="row justify-content-around">
            <?php

            /////////////////////////// affichage des produits/////////////////////////
            // if (isset($_GET['action']) && $_GET['action'] == 'affichage') {
            // on récupère les salle en bdd
            // $liste_produit = $pdo->query("SELECT * FROM produit");

            echo '<p>Nombre d\'article : <b>' . $nbre_salle . '</b></p>';


            while ($produit = $liste_produit->fetch(PDO::FETCH_ASSOC)) {

                echo '<tr>';
                echo '<pre>';
                var_dump($produit);
                echo '</pre><hr>';
                echo '<div class="col-sm-3 text-center p-2">';

                echo '<img src="img/' . $produit['photo'] . '" alt="' . '" class="img-thumbnail w-100">';

                echo '<h5>' . $produit['titre'] . '</h5>';

                echo '<h5>' . $produit['prix'] . '€</h5>';

                echo '<h5>' . substr($produit['description'], 0, 10) . '</h5>';

                echo '<h5>' . $produit['date_arrivee'] . 'au' . $produit['date_depart'] . '"</h5>';

                // bouton voir la fiche article
                echo '<a href="product-details.php?id_salle=' . $produit['id_salle'] . '" class="btn btn-primary w-100">Fiche produit</a><hr>';
                echo '<td><a href="?action=modifier&id_salle=' . $produit['id_salle'] . '" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>';

                echo '<td><a href="?action=supprimer&id_salle=' . $produit['id_salle'] . '" class="btn btn-danger" onclick="return(confirm(\'Etes-vous sûr ?\'))"><i class="fas fa-trash-alt"></i></a></td>';

                echo '</tr>';
                echo '</div>';
            }
            // }
            //     ///////////////////////FIN AFFICHAGE ARTICLES////////////////////////


            ?>
        </div>
    </div>


    <!-- Page Content -->

    <!-- <div class="row">

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
    </div>
</div> -->
    <!-- /.container -->

<?php
//include 'inc/footer.inc.php';
