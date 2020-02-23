<?php
include 'inc/init.inc.php';
include 'inc/fonction.inc.php';
var_dump($_POST);

//***************************
// AFFICHAGE DES ARTICLES
//***************************
?>
    <div class="starter-template">
        <h1><i class="fas fa-ghost" style="color: #4c6ef5;"></i> Gestion produit <i class="fas fa-ghost"
                                                                                    style="color: #4c6ef5;"></i></h1>
        <p class="lead"><?php echo $msg; ?></p>

        <p class="text-center">
            <a href="?action=ajouter" class="btn btn-outline-danger">Ajout produit</a>
            <a href="?action=affichage" class="btn btn-outline-primary">Affichage produit</a>
        </p>

    </div>

<?php

if (isset($_GET['action']) && $_GET['action'] == 'affichage') {
// on récupère les produits en bdd
$liste_produit = $pdo->query("SELECT * FROM produit");

echo '<p>Nombre d\'articles : <b>' . $liste_produit->rowCount() . '</b></p>';

echo '<div class="table-responsive">';
echo '<table class="table table-bordered">';
echo '<tr>';
echo '<th>id produit</th>';
echo '<th>date d\'arrivee</th>';
echo '<th>date de départ</th>';
echo '<th>id salle</th>';
echo '<th>prix</th>';
echo '<th>etat</th>';
echo '<th>Modif</th>';
echo '<th>Suppr</th>';
echo '</tr>';

while ($produit = $liste_produit->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    echo '<td>' . $produit['id_produit'] . '</td>';
    echo '<td>' . $produit['date_arrivee'] . '</td>';
    echo '<td>' . $produit['date_depart'] . '</td>';
    echo '<td>' . $produit['id_salle'] . '</td>'; //include id titre et photo
//    echo '<td><img src="../img/' . $produit['photo'] .
//        '" class="img-thumbnail" width="140"></td>';
    echo '<td>' . $produit['prix'] . '</td>';
    echo '<td>' . $produit['etat'] . '</td>';

    echo '<td><a href="?action=modifier&id_article=' . $produit['id_produit'] . '" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>';

    echo '<td><a href="?action=supprimer&id_article=' . $produit['id_produit'] . '" class="btn btn-danger" onclick="return(confirm(\'Etes-vous sûr ?\'))"><i class="fas fa-trash-alt"></i></a></td>';

    echo '</tr>';
}

echo '</table>';
echo '</div>';
}
//***************************
// FIN AFFICHAGE DES PRODUITS
//***************************

include 'inc/header.inc.php';
include 'inc/nav.inc.php';
?>
    <form method="post" action="">
        <label for="start-date">Date d'arrivée</label><br>
        <input type="date" name="start-date" id="start-date">
        <hr>

        <label for="end-date">Date de départ</label><br>
        <input type="date" name="end-date" id="end-date"><br>
        <hr>

        <label for="select-salle">Salle</label>
        <select name="salle" id="select-salle">
            <?php
            // get all the salle rows from database
            $liste_salle = $pdo->query("SELECT * FROM salle");

            // use the data to populate the <select>
            while ($salle = $liste_salle->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value = ' . $salle['id_salle'] . '>
                ' . $salle['id_salle'] . ' 
                - ' . $salle['titre'] . ' 
                - ' . $salle['adresse'] . ', ' . $salle['cp'] . ', ' . $salle['ville'] . '
                - ' . $salle['capacite'] . '
                </option>';
            }
            ?>
        </select>
        <hr>

        <label for="tarif">Tarif</label>
        <input type="number" id="tarif" name="tarif">
        <hr>
        <button type="submit">OK</button>
    </form>
<?php
include 'inc/footer.inc.php'

?>