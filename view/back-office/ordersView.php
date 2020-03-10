<?php $title = 'Gestion de commande'; ?>

<?php ob_start(); ?>
<?php if (!empty($orders_list)) {
    echo '<p>Nombre d\'articles : <b>' . $orders_list->rowCount() . '</b></p>';
} ?>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Id commande</th>
            <th>Id membre</th>
            <th>Id produit</th>
            <th>Prix</th>
            <th>Date enregistrement</th>
            <th>Suppr</th>
        </tr>
        <?php
        while ($commande = $orders_list->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $commande['id_commande'] . '</td>';
            echo '<td>' . $commande['id_membre'] . ' - ' . $commande['email'] . '</td>';
            echo '<td>' . $commande['id_produit'] . ' - ' . $commande['titre'] . '<br/>' . $commande['date_arrivee'] . ' au ' . $commande['date_depart'] .'</td>';
            echo '<td>' . number_format($commande['prix'], 2, ',', ' ') . '€</td>';
            echo '<td>' . $commande['date_enregistrement'] . '</td>';
            echo '<td><a href="?action=deleteOrder&order-id=' . $commande['id_commande'] . '" class="btn btn-danger" onclick="return(confirm(\'Etes-vous sûr ?\'))"><i class="fas fa-trash-alt"></i></a></td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>
<?php $content = ob_get_clean(); ?>

<?php
if (!user_is_admin()) {
    $title = 'Accès interdit';
    $content = '<h1>Vers l\'<a href="?action=listProductsIndex">accueil</a></h1>';
}
?>

<?php require('view/template/template.php'); ?>