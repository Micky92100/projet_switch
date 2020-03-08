<?php
// if(!user_is_admin()) {
// 	header('location:' . URL . 'loginView.php');
// 	exit(); // bloque l'exécution du code 
// }
?>
<?php $title = 'Liste des avis'; ?>

<?php ob_start(); ?>


<!--****************************-->
<!-- DEBUT AFFICHAGE DES AVIS-->
<!--****************************-->
<?php if (!empty($rates_list)) {
    echo '<p>Nombre d\'avis : <b>' . $rates_list->rowCount() . '</b></p>';
} ?>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>id_avis</th>
            <th>id_membre</th>
            <th>id_salle</th>
            <th>commentaire</th>
            <th>note</th>
            <th>date_enregistrement</th>
            <th>actions</th>
        </tr>
        <?php
        while ($rate = $rates_list->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $rate['id_avis'] . '</td>';
            echo '<td>' . $rate['id_membre'] . '</td>';
            echo '<td>' . $rate['id_salle'] . '</td>';
            echo '<td>' . $rate['commentaire'] . '</td>';
            echo '<td>' . $rate['note'] . '</td>';
            echo '<td>' . $rate['date_enregistrement'] . '</td>';
            echo '<td><a href="?action=editRate&rate-id=' . $rate['id_avis'] . '" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>';
            echo '<td><a href="?action=deleteRate&rate-id=' . $rate['id_avis'] . '" class="btn btn-danger" onclick="return(confirm(\'Etes-vous sûr ?\'))"><i class="fas fa-trash-alt"></i></a></td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>
    <!--**************************-->
    <!-- FIN AFFICHAGE DES AVIS -->
    <!--**************************-->
<?php $content = ob_get_clean(); ?>

<?php require('view/template/template.php'); ?>