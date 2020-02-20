<?php
include '../inc/init.inc.php';
include '../inc/fonction.inc.php';
var_dump($_POST);

//***************************
// AFFICHAGE DES ARTICLES
//***************************
?>
<div class="starter-template">
		<h1><i class="fas fa-ghost" style="color: #4c6ef5;"></i> Gestion produit <i class="fas fa-ghost" style="color: #4c6ef5;"></i></h1>
		<p class="lead"><?php echo $msg; ?></p>
		
		<p class="text-center">
			<a href="?action=ajouter" class="btn btn-outline-danger">Ajout produit</a>
			<a href="?action=affichage" class="btn btn-outline-primary">Affichage produit</a>
		</p>
		
	</div>

<?php

if (isset($_GET['action']) && $_GET['action'] == 'affichage') {
    // on récupère les salle en bdd
    $liste_salle = $pdo->query("SELECT * FROM salle");

    echo '<p>Nombre d\'article : <b>' . $liste_salle->rowCount() . '</b></p>';

    echo '<div class="table-responsive">';
    echo '<table class="table table-bordered">';
    echo '<tr>';
    echo '<th>id produit</th>';
    echo '<th>date d\'arrivee</th>';
    echo '<th>date de départ</th>';
    echo '<th>Id salle</th>';
    echo '<th>prix</th>';
    echo '<th>etat</th>';
    echo '<th>Modif</th>';
    echo '<th>Suppr</th>';
    echo '</tr>';

    while ($id_salle = $liste_salle->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . $id_salle['id_salle'] . '</td>';
        echo '<td>' . $id_salle['titre'] . '</td>';
        echo '<td>' . $id_salle['categorie'] . '</td>';
        echo '<td>' . substr($id_salle['description'], 0, 14) . '</td>';
        echo '<td><img src="' . URL . 'img/' . $id_salle['photo'] .
            '" class="img-thumbnail" width="140"></td>';
        echo '<td>' . $id_salle['pays'] . '</td>';
        echo '<td>' . $id_salle['ville'] . '</td>';
        echo '<td>' . $id_salle['adresse'] . '</td>';

        echo '<td>' . $id_salle['cp'] . '</td>';
        echo '<td>' . $id_salle['capacite'] . '</td>';

        echo '<td><a href="?action=modifier&id_article=' . $id_salle['id_salle'] . '" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>';

        echo '<td><a href="?action=supprimer&id_article=' . $id_salle['id_salle'] . '" class="btn btn-danger" onclick="return(confirm(\'Etes-vous sûr ?\'))"><i class="fas fa-trash-alt"></i></a></td>';

        echo '</tr>';
    }

    echo '</table>';
    echo '</div>';
}
//***************************
// FIN AFFICHAGE DES PRODUITS
//***************************

include '../inc/header.inc.php';
include '../inc/nav.inc.php';
?>

<li>Date d'arrivée</li>
                <input type="date" name="reservation"><hr>
                <li>Date de départ</li>
                <input type="date" name="reservation">

<?php
include '../inc/footer.inc.php'

?>