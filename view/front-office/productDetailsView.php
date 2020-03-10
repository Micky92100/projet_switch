
<?php $title = 'Fiche produit'; ?>

<?php ob_start(); ?>
<?php
if (!empty($product)) {
    $title = $product['titre'];
    $rating = $product['note'];
    $img = $product['photo'];
    $desc = $product['description'];
    $arrival = $product['date_arrivee'];
    $departure = $product['date_depart'];
    $capacity = $product['capacite'];
    $category = $product['categorie'];
    $price = $product['prix'];
}
?>
    <!--******************************-->
    <!-- DEBUT AFFICHAGE FICHE PRODUIT -->
    <!--******************************-->
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>titre</th>
                <th>note moyenne</th>
                <th>photo</th>
                <th>description</th>
                <th>Date d'arrivée</th>
                <th>Date de départ</th>
                <th>capacité</th>
                <th>catégorie</th>
                <th>Prix</th>
            </tr>
            <?php
            echo '<tr>';
            echo '<td>' . $title . '</td>';
            echo '<td>' . $rating . '/5</td>';
            echo '<td><img src="../../img/' . $img . '" class="img-thumbnail" width="140" alt="' . $desc . '"></td>';
            echo '<td>' . $desc . '</td>';
            echo '<td>' . $arrival . '</td>';
            echo '<td>' . $departure . '</td>';
            echo '<td>' . $capacity . '</td>';
            echo '<td>' . $category . '</td>';
            echo '<td>' . number_format($price, 2, ',', ' ') . '€</td>';
            echo '</tr>';
            ?>
        </table>
    </div>
    <!--****************************-->
    <!-- FIN AFFICHAGE DES PRODUITS -->
    <!--****************************-->
<?php $content = ob_get_clean(); ?>

<?php require('view/template/template.php'); ?>