<?php $title = 'Fiche produit'; ?>

<?php ob_start(); ?>

    <!--******************************-->
    <!-- DEBUT AFFICHAGE FICHE PRODUIT -->
    <!--******************************-->
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
				<th>titre</th>
				<th>note</th>
				<th>photo</th>
				<th>description</th>
                <th>Date d'arrivée</th>
                <th>Date de départ</th>
				<th>capacité</th>
				<th>catégorie</th>
				<th>Prix</th>
            </tr>
            <?php
            if (!empty($product)) {
                echo '<tr>';
                echo '<td>' . $product['titre'] . '</td>';
                echo '<td>' . $product['note'] . '</td>';
                echo '<td><img src="../../img/' . $product['photo'] . '" class="img-thumbnail" width="140" alt="' . $product['description'] . '"></td>';
                echo '<td>' . $product['description'] . '</td>';
                echo '<td>' . $product['date_arrivee'] . '</td>';
                echo '<td>' . $product['date_depart'] . '</td>';
                echo '<td>' . $product['capacite'] . '</td>';
                echo '<td>' . $product['categorie'] . '</td>';
                echo '<td>' . $product['prix'] . '€</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
    <!--****************************-->
    <!-- FIN AFFICHAGE DES PRODUITS -->
	<!--****************************-->
	<?php $content = ob_get_clean(); ?>

<?php require('view/template/template.php'); ?>